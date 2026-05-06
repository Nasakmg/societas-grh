<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('poste_vise');
            $table->enum('contrat_souhaite', ['CDI','CDD','Intérim','Stage'])
                  ->default('CDI');
            $table->string('cv_path')->nullable();
            $table->string('lm_path')->nullable();
            $table->boolean('has_recommandation')->default(false);
            $table->enum('statut', [
                'Nouveau','En analyse','Retenu','Refusé'
            ])->default('Nouveau');
            $table->date('date_candidature');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('candidats');
    }
};
