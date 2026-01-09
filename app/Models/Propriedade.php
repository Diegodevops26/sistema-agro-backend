<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propriedade extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada do modelo.
     * @var string
     */
    protected $table = 'propriedades';

    /**
     * Os atributos que podem ser atribuídos em massa.
     * @var array<int, string>
     */
    protected $fillable = [
        'agricultor_usuario_id', // <--- CORRIGIDO (era usario)
        'nome',                  // <--- MUDADO (para bater com o Controller)
        'endereco',
        'cidade',
        'estado',
        'cep',
        'tamanho_hectares',      // <--- ADICIONADO (estava faltando)
    ];

    /**
     * RELACIONAMENTOS
     */

    // Relação: Uma propriedade PERTENCE A um agricultor
    public function agricultor()
    {
        // Certifique-se que na tabela 'propriedades' a coluna se chama 'agricultor_usuario_id'
        // e na tabela 'agricultores' a chave é 'usuario_id'
        return $this->belongsTo(Agricultor::class, 'agricultor_usuario_id', 'usuario_id');
    }
}