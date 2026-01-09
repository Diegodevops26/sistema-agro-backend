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
        Schema::create('propriedades', function (Blueprint $table) {
            $table -> id();
            // CÓDIGO CORRETO:
            $table->foreignId('agricultor_usuario_id')->constrained('agricultores', 'usuario_id')->onDelete('cascade');
            $table -> string('nome_propriedade', 100);
            $table -> string('endereco', 255) -> nullable();
            $table -> string('cidade', 100) -> nullable();
            $table -> char('estado', 2) -> nullable();
            $table -> string('cep', 9) -> nullable();
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propriedades');
    }
};
