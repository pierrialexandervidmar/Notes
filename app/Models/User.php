<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Classe User
 *
 * Representa uma entidade de usuário na aplicação.
 * Estende a classe Authenticatable para fornecer funcionalidades de autenticação.
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    /**
     * Obtém as notas associadas ao usuário.
     *
     * Define um relacionamento de um-para-muitos entre o modelo User e o modelo Note,
     * indicando que um usuário pode ter várias notas.
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}