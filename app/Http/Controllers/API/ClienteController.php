<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreCliente;
use App\Http\Controllers\MasterController;
use App\Models\Cliente;

class ClienteController extends MasterController
{

    protected $model, $path, $upload;

    public function __construct(Cliente $cliente)
    {

        $this->model = $cliente;

        $this->path = "clientes";

        $this->upload = "image";

    }

}
