<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'image',
        'cpf_cnpj'
    ];

    public function storeRules()
    {
        return [
            'nome' => 'required',
            'image' => 'image',
            'cpf_cnpj' => 'required|unique:clientes',
        ];
    }

    public function updateRules()
    {
        return [
            'nome' => '',
            'image' => 'image',
            'cpf_cnpj' => 'unique:clientes',
        ];
    }

    public function arquivo($id)
    {
        $data = $this->find($id);
        return $data->image;
    }
}
