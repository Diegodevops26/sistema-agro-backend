<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importar o Trait
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recurso extends Model
{
    // Adicionar o Trait HasFactory
    use HasFactory;

    /**
     * O nome da tabela associada explicitamente com o Model.
     * Embora o Laravel possa inferir, definir explicitamente é mais claro.
     * @var string
     */
    protected $table = 'recursos';

    /**
     * Os atributos que podem ser atribuídos em massa (mass assignable).
     * Essencial para permitir a criação/atualização via ::create() ou ::update().
     * Inclui todos os campos do formulário de cadastro de recurso.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'tipo',
        'identificador_unico',
        'status', // Status geral do ativo (Operacional, Inativo)
        'observacoes',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     * Útil para garantir que certos campos sejam tratados como booleanos, datas, etc.
     * No momento, não há campos específicos que *precisem* de casting além dos timestamps padrões.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Exemplo: Se houvesse um campo 'requer_manutencao_especial'
        // 'requer_manutencao_especial' => 'boolean',
    ];

    /**
     * Os atributos de data que devem ser tratados como instâncias Carbon.
     * Inclui created_at e updated_at por padrão, mas você pode adicionar outros.
     *
     * @var array
     */
    // protected $dates = ['data_aquisicao']; // Exemplo se houvesse essa coluna

    /**
     * Indica se o modelo deve ter timestamps (created_at, updated_at).
     * Como a migration usa $table->timestamps(), o padrão (true) está correto.
     *
     * @var bool
     */
    // public $timestamps = true; // Não precisa definir explicitamente se for true

    // =========================================================================
    // RELACIONAMENTOS ELOQUENT
    // =========================================================================

    /**
     * Define a relação Muitos-para-Muitos com Agendamento.
     * Um recurso pode ser utilizado em vários agendamentos (em datas diferentes).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function agendamentos(): BelongsToMany
    {
        // Define a tabela pivot 'agendamento_recursos'
        // e as chaves estrangeiras (Laravel infere corretamente aqui)
        return $this->belongsToMany(Agendamento::class, 'agendamento_recursos');
    }

    /**
     * Define a relação Um-para-Muitos com RecursoAlocacao.
     * Um recurso pode ter várias alocações (manutenções, bloqueios, reservas) agendadas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alocacoes(): HasMany
    {
        // Define que a chave estrangeira na tabela 'recurso_alocacoes' é 'recurso_id'
        return $this->hasMany(RecursoAlocacao::class, 'recurso_id');
    }
}