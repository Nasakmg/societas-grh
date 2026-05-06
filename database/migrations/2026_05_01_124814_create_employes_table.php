<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->unsignedBigInteger('poste_id')->nullable();
            $table->unsignedBigInteger('structure_id')->nullable();
            $table->enum('contrat', ['CDI','CDD','Intérim','Stage'])
                  ->default('CDI');
            $table->decimal('salaire_base', 15, 2)->default(0);
            $table->date('date_embauche')->nullable();
            $table->string('matricule')->unique()->nullable();
            $table->string('photo')->nullable();
            $table->enum('statut', [
                'Actif','Inactif','Suspendu',
                'Mis à pied','Démissionnaire','En congé'
            ])->default('Actif');
            $table->integer('duree_suspension')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->nullOnDelete();
            $table->foreign('poste_id')
                  ->references('id')->on('postes')
                  ->nullOnDelete();
            $table->foreign('structure_id')
                  ->references('id')->on('structures')
                  ->nullOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('employes');
    }
};
