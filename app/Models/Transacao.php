<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transacao extends Model
{
    protected $table = 'transacoes';

    protected $fillable = ['descricao', 'valor', 'data', 'tipo', 'conta_id', 'categoria_id'];

    protected function casts(): array
    {
        return [
            'valor' => 'decimal:2', // converte saldo inicial para duas casas decimais
            'data' => 'date', // converte data em um objeto de data
        ];
    }

    public function conta(): BelongsTo // cada transação pertence a uma conta (conta_id)
    {
        return $this->belongsTo(Conta::class);
    }

    public function categoria(): BelongsTo // cada transação pertence a uma categoria (categoria_id)
    {
        return $this->belongsTo(Categoria::class);
    }
}
