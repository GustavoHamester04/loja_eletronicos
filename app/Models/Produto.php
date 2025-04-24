<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function vendas()
{
    return $this->belongsToMany(Venda::class, 'produto_venda')
                ->withPivot(['quantidade','subtotal'])
                ->withTimestamps();
}
}
