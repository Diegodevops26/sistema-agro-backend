<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * O nome da tabela associada com o Model.
     * Laravel infere 'usuarios' a partir de 'Usuario', mas é bom ser explícito.
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'senha_hash',
        'telefone',
        'perfil',
        'url_avatar',
        'ativo',
    ];

    /**
     * Os atributos que devem ser ocultados para serialização (conversão para JSON).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'senha_hash',
        'remember_token', // O Laravel pode usar esta coluna
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ativo' => 'boolean',
        'senha_hash' => 'hashed', // Garante que a senha seja sempre hasheada ao ser definida
    ];

    // Relação: Um usuário PODE TER um perfil de agricultor
    public function agricultor()
    {
        return $this->hasOne(Agricultor::class, 'usuario_id');
    }

    // Relação: Um usuário PODE TER um perfil de técnico
    public function tecnico()
    {
        return $this->hasOne(Tecnico::class, 'usuario_id');
    }
}
