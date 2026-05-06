<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_id');
            $table->date('date');
            $table->time('heure_arrivee')->nullable();
            $table->time('heure_depart')->nullable();
            $table->enum('statut', ['Présent','Absent','Retard','Congé'])
                  ->default('Présent');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('employe_id')
                  ->references('id')->on('employes')
                  ->cascadeOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('presences');
    }
};
