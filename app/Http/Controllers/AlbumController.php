<?php

namespace App\Http\Controllers;

use App\Models\album;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosAlbum = album::All();
        $contador = $dadosAlbum->count();

        return 'Este Album contem: '.$contador.$dadosAlbum.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosAlbum = $request->all();
        $validarDados = Validator::make($dadosAlbum,[
            'nome' => 'required',
            'ano' => 'required',
            'quantidade'=> 'required',
            'id'=> 'required',
        ]);

        if($validarDados->fails()){
            return 'Dados Invalidos.'.$validarDados->error(true). 500;
        }

        $albumCadastrar = album::create($dadosAlbum);
        if($albumCadastrar){
            return 'Dados cadastrados com sucesso.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Dados não cadastrados.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::find($id);

        if($album){
            return 'Album Localizada.'. $album.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Album não localizada.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosAlbum = $request->all();
        $validarDados = Validator::make($dadosAlbum,[
            'nome' => 'required',
            'ano' => 'required',
            'quantidade'=> 'required',
            'id'=> 'required',
        ]);

        if($validarDados->fails()){
            return 'Dados Invalidos.'.$validarDados->error(true). 500;
        }

        $album = Album::find($id);
        $album->nome = $dadosAlbum['nome'];
        $album->ano = $dadosAlbum['ano'];
        $album->quantidade = $dadosAlbum['quantidade'];
        $album->id = $dadosAlbum['id'];

        $retorno = $album->save();

        if($retorno){
            return 'Dados atualizados com sucesso.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Dados não atualizados.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (string $id)
    {
        $dadosAlbum = Album::find($id);
        
        if ($dadosAlbum->delete()){
            return 'O album foi deletado com sucesso!';
        }

        return 'O album não foi deletado.'. response()->json([],Response::HTTP_NO_CONTENT);
    }
}
