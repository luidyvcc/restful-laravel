<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telefone extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'telefone',
        'cliente_id',
    ];

    public function storeRules()
    {
        return [
            'telefone' => 'required',
            'cliente_id' => 'required|exists:clientes,id',
        ];
    }

    public function updateRules()
    {
        return [
            'telefone' => '',
            'cliente_id' => 'exists:clientes,id',
        ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}
