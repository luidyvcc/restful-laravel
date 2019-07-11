<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filme extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'capa',
    ];

    public function storeRules()
    {
        return [
            'titulo' => 'required',
            'capa' => 'image',
        ];
    }

    public function updateRules()
    {
        return [
            'titulo' => '',
            'capa' => 'image',
        ];
    }

    public function arquivo($id)
    {
        $data = $this->find($id);
        return $data->capa;
    }

}
