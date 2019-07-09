<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\MasterController;
use App\Models\Documento;

class DocumentoController extends MasterController
{
    protected $model, $upload, $path;


    public function __construct(Documento $documento)
    {

        $this->model = $documento;

        $this->upload = null;

        $this->path = null;

    }

    public function cliente($id)
    {
        if ( !$data = $this->model->with('cliente')->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        return response()->json($data, 201);

    }

}
