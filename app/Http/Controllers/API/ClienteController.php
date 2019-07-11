<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\MasterController;
use App\Models\Cliente;

class ClienteController extends MasterController
{

    protected $model, $path, $upload, $width, $height;


    public function __construct(Cliente $cliente)
    {

        $this->model = $cliente;

        $this->path = "clientes";

        $this->upload = "image";

        $this->width = 500;

        $this->height = null;

    }

    public function documento($id)
    {
        if ( !$data = $this->model->with('documento')->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        return response()->json($data, 201);
    }

    public function telefones($id)
    {
        if ( !$data = $this->model->with('telefones')->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        return response()->json($data, 201);
    }

    public function locacoes($id)
    {
        if ( !$data = $this->model->with('locacoes')->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        return response()->json($data, 201);
    }

}
