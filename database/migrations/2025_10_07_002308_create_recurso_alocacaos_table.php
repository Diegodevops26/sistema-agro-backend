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
        Schema::create('recurso_alocacaos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('recurso_id')->constrained('recursos')->onDelete('cascade');
        $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->onDelete('set null');
        $table->enum('tipo_alocacao', ['Manutencao', 'Bloqueio', 'Reserva']);
        $table->dateTime('data_inicio');
        $table->dateTime('data_fim');
        $table->string('motivo')->nullable();
        $table->text('observacoes')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurso_alocacaos');
    }
};
