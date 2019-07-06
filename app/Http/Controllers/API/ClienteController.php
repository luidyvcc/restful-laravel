<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreCliente;
use App\Http\Controllers\MasterController;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends MasterController
{

    protected $model, $path, $upload, $request;


    public function __construct(Cliente $cliente, StoreCliente $request)
    {

        $this->model = $cliente;

        $this->request = $request;

        $this->path = "clientes";

        $this->upload = "image";

    }

}
