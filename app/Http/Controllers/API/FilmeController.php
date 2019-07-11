<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\MasterController;
use App\Models\Filme;

class FilmeController extends MasterController
{
    protected $model, $path, $upload, $width, $height;


    public function __construct(Filme $filme)
    {

        $this->model = $filme;

        $this->path = "filmes";

        $this->upload = "capa";

        $this->width = 800;

        $this->height = 533;

    }

    public function documento($id)
    {
        if ( !$data = $this->model->with('documento')->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        return response()->json($data, 201);
    }

}
