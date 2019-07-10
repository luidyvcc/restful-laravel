<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
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
}
