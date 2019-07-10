<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'nome',
        'image',
    ];

    public function storeRules()
    {
        return [
            'nome' => 'required',
            'image' => 'image',
        ];
    }

    public function updateRules()
    {
        return [
            'nome' => '',
            'image' => 'image',
        ];
    }

    public function arquivo($id)
    {
        $data = $this->find($id);
        return $data->image;
    }

    public function documento()
    {
        return $this->hasOne(Documento::class, 'cliente_id', 'id');
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class, 'cliente_id', 'id');
    }
}
