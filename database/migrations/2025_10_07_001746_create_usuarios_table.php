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
        Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('email')->unique();
        $table->string('senha_hash');
        $table->string('telefone', 20)->nullable();
        $table->enum('perfil', ['administrador', 'tecnico']);
        $table->string('url_avatar')->nullable();
        $table->boolean('ativo')->default(true);
        $table->timestamps(); // cria criado_em e atualizado_em
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
