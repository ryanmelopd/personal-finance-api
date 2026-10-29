<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conta extends Model
{
    protected $fillable = ['nome', 'tipo', 'saldo_inicial'];

    protected function casts(): array // função para conversão de tipos do model
    {
        return [
        'saldo_inicial' => 'decimal:2', // converte saldo inicial para duas casas decimais
        ];
    }

    // User  ──(tem muitas)──►  Conta  ──(tem muitas)──►  Transacao

    public function user(): BelongsTo // uma conta pertence a um usuário @BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transacoes(): HasMany // um usuário tem muitas contas @HasMany
    {
        return $this->hasMany(Transacao::class);
    }

    public function saldoAtual(): float
    {
        $receitas = $this->transacoes()->where('tipo', 'receita')->sum('valor');
        $despesas = $this->transacoes()->where('tipo','despesa')->sum('valor');

        return round((float) $this->saldo_inicial + $receitas - $despesas, 2); // ,2 arrendonda em duas casas decimais
    }
}
