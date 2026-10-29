<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $fillable = ['nome', 'tipo'];

    public function user(): BelongsTo // cada categoria pertence a uma conta
    {
        return $this->belongsTo(User::class);
    }

    public function transacoes(): HasMany // uma categoria tem muitas transações
    {
        return $this->hasMany(Transacao::class);
    }
}
