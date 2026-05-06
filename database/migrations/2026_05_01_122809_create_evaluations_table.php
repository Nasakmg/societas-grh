<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('evaluateur_id');
            $table->string('periode');
            $table->decimal('score', 4, 2)->default(0);
            $table->text('objectifs')->nullable();
            $table->text('commentaires')->nullable();
            $table->timestamps();

            $table->foreign('employe_id')
                  ->references('id')->on('employes')
                  ->cascadeOnDelete();
            $table->foreign('evaluateur_id')
                  ->references('id')->on('users')
                  ->cascadeOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('evaluations');
    }
};
