<?php
namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Conge;
use App\Models\Presence;
use App\Models\FichePaie;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeDashboardController extends Controller
{
    public function index()
    {
        $user    = auth()->user();
        $employe = Employe::with(['poste', 'structure'])
                    ->where('user_id', $user->id)
                    ->first();

        if (!$employe) {
            return view('dashboards.employes', [
                'employe'          => null,
                'conges'           => collect(),
                'presences'        => collect(),
                'fiches_paie'      => collect(),
                'stats'            => ['conges_restants' => 0, 'absences' => 0, 'conges_en_attente' => 0],
                'user'             => $user,
            ]);
        }

        // Ses congés
        $conges = Conge::where('employe_id', $employe->id)
                    ->latest()
                    ->get();

        // Ses présences du mois
        $presences = Presence::where('employe_id', $employe->id)
                        ->whereMonth('date', Carbon::now()->month)
                        ->latest()
                        ->get();

        // Ses fiches de paie
        $fiches_paie = FichePaie::where('employe_id', $employe->id)
                        ->latest()
                        ->take(6)
                        ->get();

        // Stats personnelles
        $conges_pris = $conges->where('statut', 'Approuvé')
                            ->sum('nb_jours');
        $stats = [
            'conges_restants'   => max(0, 30 - $conges_pris),
            'absences'          => $presences->where('statut', 'Absent')->count(),
            'conges_en_attente' => $conges->where('statut', 'En attente')->count(),
            'presences_mois'    => $presences->whereIn('statut', ['Présent', 'Retard'])->count(),
        ];

        return view('dashboards.employe', compact(
            'employe',
            'conges',
            'presences',
            'fiches_paie',
            'stats',
            'user'
        ));
    }

    public function storeConge(Request $request)
    {
        $user    = auth()->user();
        $employe = Employe::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
        ]);

        $nb_jours = Carbon::parse($request->date_debut)
                        ->diffInDays(Carbon::parse($request->date_fin)) + 1;

        Conge::create([
            'employe_id' => $employe->id,
            'type'       => $request->type ?? 'Congé annuel',
            'date_debut' => $request->date_debut,
            'date_fin'   => $request->date_fin,
            'nb_jours'   => $nb_jours,
            'motif'      => $request->motif,
            'statut'     => 'En attente',
        ]);

        return response()->json(['success' => true]);
    }
}
