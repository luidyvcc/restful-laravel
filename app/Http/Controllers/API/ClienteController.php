<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCliente;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Intervention\Image\ImageManagerStatic as Image;
use  Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{

    private $cliente;
    private $request;

    public function __construct(Cliente $cliente, Request $request)
    {

        $this->cliente = $cliente;
        $this->request = $request;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  $this->cliente->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCliente  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCliente $request)
    {
        $dataForm = $request->all();

        if ( $request->hasFile('image') && $request->file('image')->isValid() ) {

            $extension = $request->image->extension();

            $name = kebab_case($request->nome)."_".uniqid(date('dmYHis'));

            $nameFile = $name.".".$extension;

            $upload = Image::make($dataForm['image'])
                            ->resize(500)
                            ->save(storage_path("app/public/clientes/{$nameFile}", 70));

            if ( !$upload ) response()->json( ["error" => "Falha no upload do arquivo!"], 500 );
            else $dataForm['image'] = $nameFile;

        }

        $create = $this->cliente->create($dataForm);

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
        if ( !$data = $this->cliente->find($id) ) {
            return response()->json(['error' => "Nenhum registro com o id {$id} encontrado!"], 404);
        }

        return response()->json($data, 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreCliente  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCliente $request, $id)
    {
        if ( !$data = $this->cliente->find($id) ) {
            return response()->json(['error' => "Nenhum registro com o id {$id} encontrado!"], 404);
        }

        $dataForm = $request->all();

        if ( $request->hasFile('image') && $request->file('image')->isValid() ) {


            if ( $data->image && Storage::disk('public')->exists("/clientes/{$data->image}") ) {

                Storage::disk('public')->delete("/clientes/{$data->image}");

                $nameFile = $data->image;

            } else {

                $extension = $request->image->extension();

                $name = kebab_case($request->nome)."_".uniqid(date('dmYHis'));

                $nameFile = $name.".".$extension;

            }

            $upload = Image::make($dataForm['image'])
                            ->resize(500)
                            ->save(storage_path("app/public/clientes/{$nameFile}", 70));

            if ( !$upload ) {

                response()->json( ["error" => "Falha no upload do arquivo!"], 500 );

            } else {

                $dataForm['image'] = $nameFile;

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
        if ( !$data = $this->cliente->find($id) ) {
            return response()->json(['error' => "Nenhum registro com o id {$id} encontrado!"], 404);
        }

        if ( $data->image && Storage::disk('public')->exists("/clientes/{$data->image}") ) {
            Storage::disk('public')->delete("/clientes/{$data->image}");
        }

        $data->delete();

        return response()->json(['success' => "Registro {$id} deletado!"], 200);
    }
}
