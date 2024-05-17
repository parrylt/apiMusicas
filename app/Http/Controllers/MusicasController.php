<?php

namespace App\Http\Controllers;

use App\Models\musicas;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MusicasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosMusicas = musicas::All();
        $contador = $dadosMusicas->count();

        return 'Musicas: '.$contador.$dadosMusicas.Response()->json([],Response::HTTP_NO_CONTENT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosMusicas = $request->all();
        $validarDados = Validator::make($dadosMusicas,[
            'nome' => 'required',
            'tempo' => 'required',
            'compositores'=> 'required',
            'id'=> 'required',
        ]);

        if($validarDados->fails()){
            return 'Dados Invalidos.'.$validarDados->error(true). 500;
        }

        $musicasCadastrar = musicas::create($dadosMusicas);
        if($musicasCadastrar){
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
        $musica = musica::find($id);

        if($musica){
            return 'Musica Localizada.'. $musica.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Musica não localizada.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosMusicas = $request->all();
        $validarDados = Validator::make($dadosMusicas,[
            'nome' => 'required',
            'tempo' => 'required',
            'compositores'=> 'required',
            'id'=> 'required',
        ]);

        if($validarDados->fails()){
            return 'Dados Invalidos.'.$validarDados->error(true). 500;
        }

        $musica = Moto::find($id);
        $musica->nome = $dadosMusicas['nome'];
        $musica->tempo = $dadosMusicas['tempo'];
        $musica->compositores = $dadosMusicas['compositores'];
        $musica->id = $dadosMusicas['id'];

        $retorno = $musica->save();

        if($retorno){
            return 'Dados atualizados com sucesso.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Dados não atualizados.'.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosMusicas = Musicas::find($id);
        
        if ($dadosMusicas->delete()){
            return 'A musica foi deletado com sucesso!';
        }

        return 'A musica não foi deletado.'. response()->json([],Response::HTTP_NO_CONTENT);
    }
}
