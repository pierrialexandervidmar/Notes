<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Classe Note
 *
 * Representa uma entidade de nota na aplicação.
 * Inclui funcionalidades de soft delete, fábrica de objetos e notificações.
 *
 * @package App\Models
 */
class Note extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    /**
     * Obtém o usuário associado à nota.
     *
     * Define um relacionamento de muitos-para-um entre o modelo Note e o modelo User,
     * indicando que cada nota pertence a um único usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'text',
        'title',
        'user_id',
    ];

    /**
     * Os atributos que devem ser ocultados na serialização.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtém os atributos que devem ser convertidos para tipos específicos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}