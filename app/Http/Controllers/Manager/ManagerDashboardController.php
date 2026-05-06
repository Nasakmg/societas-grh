<?php
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Conge;
use App\Models\Presence;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Le manager voit seulement son équipe
        // On récupère la structure du manager connecté
        $user = auth()->user();
        $employe_manager = Employe::where('user_id', $user->id)->first();
        $structure_id = $employe_manager?->structure_id;

        // Employés de son équipe
        $equipe = Employe::with(['poste', 'structure'])
            ->when($structure_id, fn($q) => $q->where('structure_id', $structure_id))
            ->get();

        // Congés en attente de son équipe
        $conges_attente = Conge::with('employe')
            ->whereIn('employe_id', $equipe->pluck('id'))
            ->where('statut', 'En attente')
            ->latest()
            ->get();

        // Présences aujourd'hui
        $presences = Presence::with('employe')
            ->whereIn('employe_id', $equipe->pluck('id'))
            ->where('date', $today)
            ->get();

        $stats = [
            'total_equipe'   => $equipe->count(),
            'presents'       => $presences->whereIn('statut', ['Présent', 'Retard'])->count(),
            'absents'        => $presences->where('statut', 'Absent')->count(),
            'conges_attente' => $conges_attente->count(),
        ];

        return view('dashboards.manager', compact(
            'equipe',
            'conges_attente',
            'presences',
            'stats',
            'user'
        ));
    }

    public function validerConge(Request $request, $id)
    {
        $conge = Conge::findOrFail($id);

        // Vérifier que le congé appartient bien à son équipe
        $user = auth()->user();
        $employe_manager = Employe::where('user_id', $user->id)->first();

        if ($employe_manager) {
            $employe = Employe::find($conge->employe_id);
            if ($employe->structure_id !== $employe_manager->structure_id) {
                return response()->json(['error' => 'Non autorisé'], 403);
            }
        }

        $conge->update([
            'statut'      => $request->statut,
            'valideur_id' => auth()->id(),
        ]);

        return response()->json(['success' => true]);
    }
}
