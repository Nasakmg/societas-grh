<?php
namespace App\Http\Controllers\Comptable;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\FichePaie;
use App\Models\Conge;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ComptableDashboardController extends Controller
{
    public function index()
    {
        $employes    = Employe::with(['poste','structure'])->where('statut','Actif')->get();
        $fiches_paie = FichePaie::with('employe')->latest()->get();
        $periode     = Carbon::now()->isoFormat('MMMM YYYY');

        $masse_salariale = $employes->sum('salaire_base');
        $cnss_total      = round($masse_salariale * 0.04);
        $ipres_total     = round($masse_salariale * 0.06);
        $net_total       = $masse_salariale - $cnss_total - $ipres_total;

        $stats = [
            'total_employes'   => $employes->count(),
            'masse_salariale'  => $masse_salariale,
            'net_total'        => $net_total,
            'cotisations_total'=> $cnss_total + $ipres_total,
        ];

        $repartition = [
            'CDI'     => $employes->where('contrat','CDI')->count(),
            'CDD'     => $employes->where('contrat','CDD')->count(),
            'Intérim' => $employes->where('contrat','Intérim')->count(),
            'Stage'   => $employes->where('contrat','Stage')->count(),
        ];

        return view('dashboards.comptable', compact(
            'employes','fiches_paie','stats',
            'periode','repartition'
        ));
    }

    public function exportPaie(Request $request)
    {
        $employes = Employe::with(['poste','structure'])
                    ->where('statut','Actif')->get();

        $periode          = Carbon::now()->isoFormat('MMMM YYYY');
        $masse_salariale  = $employes->sum('salaire_base');
        $cnss_total       = round($masse_salariale * 0.04);
        $ipres_total      = round($masse_salariale * 0.06);
        $cnss_patronal    = round($masse_salariale * 0.07);
        $ipres_patronal   = round($masse_salariale * 0.036);
        $net_total        = $masse_salariale - $cnss_total - $ipres_total;

        $pdf = Pdf::loadView('pdf.rapport_paie', compact(
            'employes','periode',
            'masse_salariale','cnss_total','ipres_total',
            'cnss_patronal','ipres_patronal','net_total'
        ))->setPaper('a4','portrait');

        return $pdf->download("rapport-paie-{$periode}.pdf");
    }

    public function exportCSV()
    {
        $employes = Employe::with(['poste','structure'])
                    ->where('statut','Actif')->get();

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="rapport-paie-'.now()->format('Y-m').'.csv"',
        ];

        $callback = function() use ($employes) {
            $file = fopen('php://output','w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8
            fputcsv($file, [
                'Matricule','Prénom','Nom','Poste','Structure',
                'Contrat','Salaire Brut','CNSS (4%)','IPRES (6%)','Net à Payer'
            ], ';');
            foreach ($employes as $e) {
                $b    = $e->salaire_base;
                $cnss = round($b * 0.04);
                $ipres= round($b * 0.06);
                fputcsv($file, [
                    $e->matricule ?? '—',
                    $e->prenom,
                    $e->nom,
                    $e->poste?->nom ?? '—',
                    $e->structure?->nom ?? '—',
                    $e->contrat,
                    number_format($b,0,',',' ').' XOF',
                    number_format($cnss,0,',',' ').' XOF',
                    number_format($ipres,0,',',' ').' XOF',
                    number_format($b-$cnss-$ipres,0,',',' ').' XOF',
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
