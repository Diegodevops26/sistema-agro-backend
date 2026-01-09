<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servico extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada com o Model.
     * @var string
     */
    protected $table = 'servicos';

    /**
     * Os atributos que podem ser atribuídos em massa.
     * Corresponde aos campos do modal "Cadastrar Novo Serviço".
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
        'categoria',
        'duracao_media',
        'valor_base',
        'status', // Status do serviço (Ativo, Inativo)
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'valor_base' => 'decimal:2', // Garante que o valor seja tratado como decimal com 2 casas
    ];

    /**
     * Indica se o modelo deve ter timestamps (created_at, updated_at).
     * Como a migration usa $table->timestamps(), o padrão (true) está correto.
     * @var bool
     */
    // public $timestamps = true;

    // =========================================================================
    // RELACIONAMENTOS ELOQUENT
    // =========================================================================

    /**
     * Define a relação Um-para-Muitos com Agendamento.
     * Um serviço pode estar associado a vários agendamentos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agendamentos(): HasMany
    {
        // Define que a chave estrangeira na tabela 'agendamentos' é 'servico_id'
        return $this->hasMany(Agendamento::class, 'servico_id');
    }
}