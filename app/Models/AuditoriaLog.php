<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditoriaLog extends Model
{
    use HasFactory;

    /**
     * Tabela associada ao Model
     */
    protected $table = 'auditoria_logs';

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'usuario_id',   // Quem fez a ação
        'acao',         // Ex: 'Criar', 'Atualizar', 'Deletar', 'Login'
        'tabela',       // Ex: 'servicos', 'agendamentos'
        'registro_id',  // O ID do item que foi alterado
        'detalhes',     // JSON contendo os dados antes/depois ou descrição
        'ip_address',   // IP de onde veio a requisição
        'user_agent'    // Navegador/Dispositivo (opcional, mas recomendado)
    ];

    /**
     * Conversão automática de tipos
     */
    protected $casts = [
        // Isso é MUITO importante: faz o Laravel converter o JSON do banco
        // automaticamente para um Array PHP quando você lê o dado.
        'detalhes' => 'array', 
    ];

    /**
     * RELACIONAMENTOS
     */

    // Um log pertence a um Usuário (quem realizou a ação)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}