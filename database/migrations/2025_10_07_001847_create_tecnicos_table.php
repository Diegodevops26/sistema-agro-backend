<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tecnicos', function (Blueprint $table) {
          // Mude de 'usuarios' para 'users'
        $table->foreignId('usuario_id')->primary()->constrained('users')->onDelete('cascade');
        $table->string('especialidade', 100)->nullable();
        $table->string('registro_profissional', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnicos');
    }
};
