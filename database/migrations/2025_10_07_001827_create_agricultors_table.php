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
        Schema::create('agricultores', function (Blueprint $table) {
        // Mude de 'usuarios' para 'users' 
        $table->foreignId('usuario_id')->primary()->constrained('users')->onDelete('cascade');
        $table->string('cpf', 14)->unique()->nullable();
        $table->text('endereco')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agricultores');
    }
};
