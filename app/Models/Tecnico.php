<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tecnico extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada com o Model.
     * @var string
     */
    protected $table = 'tecnicos';

    /**
     * A chave primária da tabela.
     * @var string
     */
    protected $primaryKey = 'usuario_id';

    /**
     * Indica se a chave primária é auto-incrementável.
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indica se o modelo deve ter timestamps (created_at, updated_at).
     * Como a migration não os incluiu, desativamos.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * Corresponde aos campos específicos do formulário de técnico.
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'especialidade',
        'registro_profissional',
    ];

    // =========================================================================
    // RELACIONAMENTOS ELOQUENT
    // =========================================================================

    /**
     * Define a relação inversa Um-para-Um com Usuario.
     * Um perfil de técnico PERTENCE A um usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Define a relação Um-para-Muitos com Agendamento.
     * Um técnico pode ser responsável por vários agendamentos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agendamentos(): HasMany
    {
        // Define que a chave estrangeira na tabela 'agendamentos' é 'tecnico_usuario_id'
        // e a chave local (nesta tabela 'tecnicos') é 'usuario_id'.
        return $this->hasMany(Agendamento::class, 'tecnico_usuario_id', 'usuario_id');
    }
}