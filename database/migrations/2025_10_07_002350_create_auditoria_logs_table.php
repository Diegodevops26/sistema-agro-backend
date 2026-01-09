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
        Schema::create('auditoria_logs', function (Blueprint $table) {
        $table->id();
        // Mude de 'usuarios' para 'users'
        $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null');
        $table->string('acao');
        $table->json('detalhes')->nullable();
        $table->string('ip_address', 45)->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditoria_logs');
    }
};
