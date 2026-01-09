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
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table -> string('nome');
            $table -> enum('tipo', ['Máquina', 'Implemento', 'Veiculo', 'Drone', 'Outro']);
            $table -> string ('identificador_unico', 100) -> unique() -> nullable();
            $table -> enum('status', ['Operacional', 'Inativo']) -> default('Operacional');
            $table -> text('descricao') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};
