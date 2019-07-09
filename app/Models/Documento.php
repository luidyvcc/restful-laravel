<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'cpf_cnpj',
        'cliente_id',
    ];

    public function storeRules()
    {
        return [
            'cpf_cnpj' => 'required|unique:documentos',
            'cliente_id' => 'required|exists:clientes,id',
        ];
    }

    public function updateRules()
    {
        return [
            'cpf_cnpj' => 'unique:documentos',
            'cliente_id' => 'exists:clientes,id',
        ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

}
