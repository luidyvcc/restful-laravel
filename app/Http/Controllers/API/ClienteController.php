<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\MasterController;
use App\Models\Cliente;

class ClienteController extends MasterController
{

    protected $model, $path, $upload, $request;


    public function __construct(Cliente $cliente)
    {

        $this->model = $cliente;

        $this->path = "clientes";

        $this->upload = "image";

    }

    public function documento($id)
    {
        if ( !$data = $this->model->with('documento')->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        return response()->json($data, 201);
    }

}
