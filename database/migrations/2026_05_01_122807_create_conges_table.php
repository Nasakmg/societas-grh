<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('valideur_id')->nullable();
            $table->enum('type', [
                'Congé annuel','Congé maladie',
                'Congé maternité','Congé sans solde','RTT'
            ]);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nb_jours')->default(1);
            $table->text('motif')->nullable();
            $table->enum('statut', ['En attente','Approuvé','Refusé'])
                  ->default('En attente');
            $table->timestamps();

            $table->foreign('employe_id')
                  ->references('id')->on('employes')
                  ->cascadeOnDelete();
            $table->foreign('valideur_id')
                  ->references('id')->on('users')
                  ->nullOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('conges');
    }
};
