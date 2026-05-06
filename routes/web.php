<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Employe\EmployeDashboardController;
use App\Http\Controllers\Comptable\ComptableDashboardController;

// ── Publiques ──────────────────────────────────────────────
Route::get('/', fn() => view('accueil'))->name('accueil');

Route::get('/login',   [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',  [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//  Redirection centrale après login
Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect()->route('login');
    return match(auth()->user()->role) {
        'admin'     => redirect()->route('admin.dashboard'),
        'manager'   => redirect()->route('manager.dashboard'),
        'employe'   => redirect()->route('employe.dashboard'),
        'comptable' => redirect()->route('comptable.dashboard'),
        default     => redirect()->route('login'),
    };
})->middleware('auth')->name('dashboard');

// routes pour admins
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
             ->name('dashboard');

        // Employés
        Route::post('/employes',        [AdminDashboardController::class, 'storeEmploye']);
        Route::put('/employes/{id}',    [AdminDashboardController::class, 'updateEmploye']);
        Route::delete('/employes/{id}', [AdminDashboardController::class, 'destroyEmploye']);

        // Congés
        Route::post('/conges',              [AdminDashboardController::class, 'storeConge']);
        Route::put('/conges/{id}/valider',  [AdminDashboardController::class, 'validerConge']);

        // Présences
        Route::post('/presences', [AdminDashboardController::class, 'storePresence']);

        // Postes
        Route::post('/postes',        [AdminDashboardController::class, 'storePoste']);
        Route::delete('/postes/{id}', [AdminDashboardController::class, 'destroyPoste']);

        // Structures
        Route::post('/structures',        [AdminDashboardController::class, 'storeStructure']);
        Route::delete('/structures/{id}', [AdminDashboardController::class, 'destroyStructure']);

        // Candidats
        Route::put('/candidats/{id}', [AdminDashboardController::class, 'updateCandidat']);
    });
// routes pour managers
Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')->name('manager.')
    ->group(function () {
        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])
             ->name('dashboard');
        Route::put('/conges/{id}/valider', [ManagerDashboardController::class, 'validerConge']);
    });

// routes pour employes
Route::middleware(['auth', 'role:employe'])
    ->prefix('employe')->name('employe.')
    ->group(function () {
        Route::get('/dashboard', [EmployeDashboardController::class, 'index'])
             ->name('dashboard');
        Route::post('/conges', [EmployeDashboardController::class, 'storeConge']);
    });
 Route::middleware(['auth', 'role:comptable'])
    ->prefix('comptable')->name('comptable.')
    ->group(function () {
        Route::get('/dashboard', [ComptableDashboardController::class, 'index'])->name('dashboard');
        Route::get('/export/pdf', [ComptableDashboardController::class, 'exportPaie'])->name('export.pdf');
        Route::get('/export/csv', [ComptableDashboardController::class, 'exportCSV'])->name('export.csv');
    });

Route::get('/create-user', function () {
    try {
        $user = new App\Models\User();
        $user->name = 'Administrateur';
        $user->email = 'admin@societas.com';
        $user->password = bcrypt('admin123');
        $user->role = 'admin';
        $user->save();
        return 'Utilisateur créé avec succès ! Email: admin@societas.com, Mot de passe: admin123';
    } catch (Exception $e) {
        return 'Erreur: ' . $e->getMessage();
    }
});