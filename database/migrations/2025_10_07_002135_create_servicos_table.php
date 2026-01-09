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
        Schema::create('servicos', function (Blueprint $table) {
        $table->id();
        $table->string('nome')->unique();
        $table->text('descricao')->nullable();
        $table->enum('categoria', ['Consultoria', 'Operacional', 'Manutenção', 'Análise', 'Outro']);
        $table->string('duracao_media', 50)->nullable();
        $table->decimal('valor_base', 10, 2)->nullable();
        $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos');
    }
};
