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
        Schema::create('agendamento_recursos', function (Blueprint $table) {
        $table->foreignId('agendamento_id')->constrained('agendamentos')->onDelete('cascade');
        $table->foreignId('recurso_id')->constrained('recursos')->onDelete('cascade');
        $table->primary(['agendamento_id', 'recurso_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamento_recursos');
    }
};
