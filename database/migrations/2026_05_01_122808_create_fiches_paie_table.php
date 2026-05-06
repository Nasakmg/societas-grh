<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fiches_paie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_id');
            $table->string('periode'); // ex: "Avril 2025"
            $table->decimal('salaire_brut', 15, 2);
            $table->decimal('cnss_employe', 15, 2)->default(0);
            $table->decimal('ipres_employe', 15, 2)->default(0);
            $table->decimal('autres_deductions', 15, 2)->default(0);
            $table->decimal('salaire_net', 15, 2);
            $table->date('date_emission');
            $table->enum('statut', ['Généré','Payé'])->default('Généré');
            $table->timestamps();

            $table->foreign('employe_id')
                  ->references('id')->on('employes')
                  ->cascadeOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('fiches_paie');
    }
};
