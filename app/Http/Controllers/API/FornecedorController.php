<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterController;
use App\Models\Fornecedor;

class FornecedorController extends MasterController
{
    protected $model, $path, $upload, $width, $height, $paginate;


    public function __construct(Fornecedor $fornecedor)
    {

        $this->model = $fornecedor;

        $this->path = null;

        $this->upload = null;

        $this->width = null;

        $this->height = null;

        $this->paginate = 5;

    }
}
