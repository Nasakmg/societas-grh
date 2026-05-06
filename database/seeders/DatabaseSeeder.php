<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Structure;
use App\Models\Poste;
use App\Models\Employe;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Utilisateurs
        User::create([
            'name'     => 'Admin RH',
            'email'    => 'admin@societas.sn',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
        User::create([
            'name'     => 'Manager Test',
            'email'    => 'manager@societas.sn',
            'password' => Hash::make('password'),
            'role'     => 'manager',
        ]);
        User::create([
            'name'     => 'Employé Test',
            'email'    => 'employe@societas.sn',
            'password' => Hash::make('password'),
            'role'     => 'employe',
        ]);

        // Structures
        $fin  = Structure::create(['nom' => 'Finance']);
        $rh   = Structure::create(['nom' => 'RH']);
        $tech = Structure::create(['nom' => 'Technique']);
        $com  = Structure::create(['nom' => 'Commercial']);

        // Postes
        $p1 = Poste::create(['nom' => 'Dir. Financier',  'structure_id' => $fin->id]);
        $p2 = Poste::create(['nom' => 'Responsable RH',  'structure_id' => $rh->id]);
        $p3 = Poste::create(['nom' => 'Dev Web',         'structure_id' => $tech->id]);
        $p4 = Poste::create(['nom' => 'Commerciale',     'structure_id' => $com->id]);

        // Employés
        Employe::create([
            'prenom'        => 'Mamadou',
            'nom'           => 'Bâ',
            'email'         => 'mamadou.ba@societas.sn',
            'poste_id'      => $p1->id,
            'structure_id'  => $fin->id,
            'contrat'       => 'CDI',
            'salaire_base'  => 1500000,
            'date_embauche' => '2020-01-15',
            'statut'        => 'Actif',
            'matricule'     => 'MAT00001',
        ]);
        Employe::create([
            'prenom'        => 'Fatou',
            'nom'           => 'Camara',
            'email'         => 'fatou.camara@societas.sn',
            'poste_id'      => $p2->id,
            'structure_id'  => $rh->id,
            'contrat'       => 'CDI',
            'salaire_base'  => 800000,
            'date_embauche' => '2021-03-01',
            'statut'        => 'Actif',
            'matricule'     => 'MAT00002',
        ]);
        Employe::create([
            'prenom'        => 'Etienne',
            'nom'           => 'Imagu',
            'email'         => 'etienne.ima@societas.sn',
            'poste_id'      => $p3->id,
            'structure_id'  => $tech->id,
            'contrat'       => 'CDI',
            'salaire_base'  => 700000,
            'date_embauche' => '2022-09-01',
            'statut'        => 'Actif',
            'matricule'     => 'MAT00003',
        ]);
    }
}
