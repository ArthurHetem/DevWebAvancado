<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'unidade_id', 'peso' ];

    public function produtoDetalhe()
    {
        return $this->hasOne(ProdutoDetalhe::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
