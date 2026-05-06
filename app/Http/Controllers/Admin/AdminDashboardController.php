<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Conge;
use App\Models\Presence;
use App\Models\Candidat;
use App\Models\FichePaie;
use App\Models\Structure;
use App\Models\Poste;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $employes = Employe::with(['poste', 'structure'])->get();

        $stats = [
            'total_employes'   => $employes->where('statut', 'Actif')->count(),
            'presents'         => Presence::whereDate('date', $today)
                                    ->whereIn('statut', ['Présent', 'Retard'])
                                    ->count(),
            'conges_approuves' => Conge::where('statut', 'Approuvé')->count(),
            'candidatures'     => Candidat::count(),
        ];

        $conges_attente = Conge::with('employe')
                            ->where('statut', 'En attente')
                            ->latest()->get();

        $candidatures_recentes = Candidat::latest()->take(5)->get();

        $presences_today = Presence::with('employe')
                            ->whereDate('date', $today)
                            ->get();

        $structures  = Structure::withCount('employes')->get();
        $postes      = Poste::withCount('employes')->get();
        $fiches_paie = collect();

        $total         = $employes->count() ?: 1;
        $absents_today = Presence::whereDate('date', $today)
                            ->where('statut', 'Absent')->count();

        $kpis = [
            'taux_presence'    => round(($stats['presents'] / $total) * 100, 1),
            'taux_absenteisme' => round(($absents_today / $total) * 100, 1),
            'emm'              => $total,
            'turnover'         => 2.4,
        ];

        $contrats = [
            'CDI'     => $employes->where('contrat', 'CDI')->count(),
            'CDD'     => $employes->where('contrat', 'CDD')->count(),
            'Intérim' => $employes->where('contrat', 'Intérim')->count(),
            'Stage'   => $employes->where('contrat', 'Stage')->count(),
        ];

        $presences_semaine = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $presences_semaine[] = [
                'jour'  => $date->locale('fr')->isoFormat('ddd'),
                'count' => Presence::whereDate('date', $date)
                                ->whereIn('statut', ['Présent', 'Retard'])
                                ->count(),
            ];
        }

        return view('dashboards.admin', compact(
            'stats', 'conges_attente', 'candidatures_recentes',
            'presences_today', 'employes', 'structures', 'postes',
            'fiches_paie', 'kpis', 'contrats', 'presences_semaine'
        ));
    }
}
