<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // mais recursos de login (Authenticatable)
{
    
    use HasFactory, Notifiable; // trait, injeta métodos prontos sem usar herança, HasFactory dá
                                // o User::factory(), Notifiable serve para enviar notificações 
                                // (e-mail, etc)

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token']; // colunas que somem ao converter 
                                                        // o model para JSON
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // converte a coluna de confirmação de e-mail em
                                               // um objeto de data                                             
            'password' => 'hashed', // ao atribuir uma senha, gera um hash sozinho
        ];
    }

    public function contas(): HasMany // um usuário tem muitas contas
    {
        return $this->hasMany(Conta::class);
    }

    public function categorias(): HasMany // um usuário tem muitas categorias
    {
        return $this->hasMany(Categoria::class);
    }
}
