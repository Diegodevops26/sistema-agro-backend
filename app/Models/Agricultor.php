<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agricultor extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada com Model
     * @var string
     */
    protected $table = 'agricultores';

    /** * A chave primaria de tabela
     * @var string 
     */
    protected $primaryKey = 'usuario_id';

    /**
     * Indica se a chave primaria é auto-incrementavel
     * @var bool
     */
    public $incrementing = false;

    /** * Os atributos que podem ser atribuidos em massa
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'cpf',
        'endereco',
        // Adicione outros campos se tiver na migração (telefone, cidade, etc)
    ];

    /**
     * RELACIONAMENTOS
     */

    // Relação: Um agricultor PERTENCE A um usuario 
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');    
    }

    // Relação: Um agricultor POSSUI MUITAS propriedades
    public function propriedades()
    {
        // CORREÇÃO AQUI: Mudamos 'usario_id' para 'usuario_id'
        return $this->hasMany(Propriedade::class, 'agricultor_id', 'usuario_id');
    }
}