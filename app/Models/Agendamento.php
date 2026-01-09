<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associado com o Model
     * @var string 
     */
    protected $table = 'agendamentos';

    /**
     * Os atributos que podem ser atribuídos em massa
     * @var array<int, string>
     */
    protected $fillable = [
        'propriedade_id',
        'servico_id',
        'tecnico_usuario_id',
        'data_inicio',
        'data_fim',
        'status',
        'observacoes',
        'relatorio_path'
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos
     * @var array<string, string>
     */
    protected $casts = [
        'data_inicio' => 'datetime', // <--- CORRIGIDO (era datatime)
        'data_fim' => 'datetime',    // <--- CORRIGIDO (era datatime)
    ];

    /**
     * Relacionamentos
     */

    // Relação: Um agendamento PERTENCE A uma propriedade 
    public function propriedade()
    {
        return $this->belongsTo(Propriedade::class, 'propriedade_id');
    }

    // Relação: Um agendamento Pertence a um serviço
    // <--- NOME CORRIGIDO (era 'agendamento', deve ser 'servico')
    public function servico() 
    {
        return $this->belongsTo(Servico::class, 'servico_id');
    }

    // Relação: Um agendamento pertence a um tecnico
    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'tecnico_usuario_id', 'usuario_id');
    }

    // Relação: Um agendamento pode ter muitos recursos (MUITOS PARA MUITOS)
    // <--- NOME CORRIGIDO PARA O PLURAL (era 'recurso', deve ser 'recursos')
    public function recursos()
    {
        return $this->belongsToMany(Recurso::class, 'agendamento_recursos', 'agendamento_id', 'recurso_id');
    }
}