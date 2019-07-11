<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MasterController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  $this->model->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate( $request, $this->model->storeRules() );

        $dataForm = $request->all();

        if ( $request->hasFile($this->upload) && $request->file($this->upload)->isValid() ) {

            $extension = $request->file($this->upload)->extension();

            $name = kebab_case($request->nome)."_".uniqid(date('dmYHis'));

            $nameFile = $name.".".$extension;

            $upload = Image::make($dataForm[$this->upload])
                            ->resize($this->width, $this->height,
                                        function ($constraint) { $constraint->aspectRatio(); }
                                    )
                            ->save(storage_path("app/public/{$this->path}/{$nameFile}", 70));

            if ( !$upload ) response()->json( ["error" => "Falha no upload do arquivo!"], 500 );
            else $dataForm[$this->upload] = $nameFile;

        }

        $create = $this->model->create($dataForm);

        return response()->json($create, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ( !$data = $this->model->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        return response()->json($data, 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate( $request, $this->model->updateRules() );

        if ( !$data = $this->model->find($id) ) {
            return response()->json(['error' => "Nenhum registro encontrado!"], 404);
        }

        $dataForm = $request->all();

        if ( $request->hasFile($this->upload) && $request->file($this->upload)->isValid() ) {

            $arquivo = $this->model->arquivo($id);

            if ( $arquivo && Storage::disk('public')->exists("/{$this->path}/{$arquivo}") ) {

                Storage::disk('public')->delete("/{$this->path}/{$arquivo}");

                $nameFile = $arquivo;

            } else {

                $extension = $request->file($this->upload)->extension();

                $name = kebab_case($request->nome)."_".uniqid(date('dmYHis'));

                $nameFile = $name.".".$extension;

            }

            $upload = Image::make($dataForm[$this->upload])
                            ->resize($this->width, $this->height,
                                        function ($constraint) { $constraint->aspectRatio(); }
                                    )
                            ->save(storage_path("app/public/{$this->path}/{$nameFile}", 70));

            if ( !$upload ) {

                response()->json( ["error" => "Falha no upload do arquivo!"], 500 );

            } else {

                $dataForm[$this->upload] = $nameFile;

            }

        }

        $data->update($dataForm);

        return response()->json($data, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $data = $this->model->find($id) ) {

            if ( method_exists( $this->model, 'arquivo' ) ) {

                Storage::disk('public')->delete("/{$this->path}/{$this->model->arquivo($id)}");

            }

            $data->delete();

            return response()->json(['success' => "Registro {$id} deletado!"], 200);

        }

        return response()->json(['error' => "Nenhum registro encontrado!"], 404);

    }
}
