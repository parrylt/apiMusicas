<?php

namespace App\Http\Controllers;

use App\Models\artista;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class ArtistaController extends Controller
{

    public function index()
    {
        $dadosArtistas = artista::All();
        $contador = $dadosArtistas->count();

        return 'Artistas: '.$contador.$dadosArtistas.Response()->json([],Response::HTTP_NO_CONTENT);
    }


    public function store(Request $request)
    {
        $dadosArtistas = $request->all();
        $validarDados = Validator::make($dadosArtistas,[
            'nome' => 'required',
            'genero' => 'required',
            'pais'=> 'required',
        ]);

        if($validarDados->fails()){
            return 'Dados Invalidos.'.$validarDados->error(true). 500;
        }

        $artistasCadastrar = artista::create($dadosArtistas);
        if($artistasCadastrar){
            return 'Dados cadastrados com sucesso. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Dados não cadastrados. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }


    public function show(string $id)
    {
        $artista = artista::find($id);

        if($artista){
            return 'Artista Encontrado.'. $artista.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Artista Não Encontrado. Underground demais. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }


    public function update(Request $request, string $id)
    {
        $dadosArtistas = $request->all();
        $validarDados = Validator::make($dadosArtistas,[
            'nome' => 'required',
            'genero' => 'required',
            'pais'=> 'required',
        ]);

        if($validarDados->fails()){
            return 'Dados Inválidos. Muito punk. '.$validarDados->error(true). 500;
        }

        $artista = artista::find($id);
        $artista->nome = $dadosArtistas['nome'];
        $artista->genero = $dadosArtistas['genero'];
        $artista->pais = $dadosArtistas['pais'];

        $retorno = $artista->save();

        if($retorno){
            return 'Dados atualizados com sucesso. BORA PORRAAAAA. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }else{
            return 'Dados não atualizados. Se fudeu. '.Response()->json([],Response::HTTP_NO_CONTENT);
        }
    }


    public function destroy(string $id)
    {
        $dadosArtistas = artista::find($id);
        
        if ($dadosArtistas->delete()){
            return 'O artista foi enviado para a escuridão do esquecimento com sucesso!';
        }

        return 'O artista não foi deletado. Continua forte igual os Rolling Stones. '. response()->json([],Response::HTTP_NO_CONTENT);
    }
}