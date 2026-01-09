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
        Schema::create('agendamentos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('propriedade_id')->constrained('propriedades')->onDelete('restrict');
        $table->foreignId('servico_id')->constrained('servicos')->onDelete('restrict');
        $table->foreignId('tecnico_usuario_id')->nullable()->constrained('tecnicos', 'usuario_id')->onDelete('set null');
        $table->dateTime('data_inicio');
        $table->dateTime('data_fim');
        $table->enum('status', ['Pendente', 'Confirmado', 'Em Andamento', 'Concluido', 'Cancelado'])->default('Pendente');
        $table->text('observacoes')->nullable();
        $table->string('relatorio_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
