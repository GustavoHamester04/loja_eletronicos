<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['arquivo','produto_id'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
