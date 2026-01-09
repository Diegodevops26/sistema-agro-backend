<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoAlocacao extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada com o Model.
     * @var string
     */
    protected $table = 'recurso_alocacoes';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'recurso_id',
        'usuario_id',
        'tipo_alocacao',
        'data_inicio',
        'data_fim',
        'motivo',
        'observacoes',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
    ];

    /**
     * RELACIONAMENTOS
     */

    /**
     * Relação: Uma alocação PERTENCE A um recurso.
     */
    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id');
    }

    /**
     * Relação: Uma alocação FOI CRIADA POR um usuário (opcional).
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}