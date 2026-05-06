<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_id');
            $table->enum('type', ['CDI','CDD','Intérim','Stage']);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->decimal('salaire', 15, 2)->default(0);
            $table->text('avantages')->nullable();
            $table->string('document_path')->nullable();
            $table->timestamps();

            $table->foreign('employe_id')
                  ->references('id')->on('employes')
                  ->cascadeOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('contrats');
    }
};
