<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\MusicasController;

//artista//

route::get('/artista',[ArtistaController::class, 'index']);
route::post('/artista/{id}',[ArtistaController::class,'show']);
route::post('/artista',[ArtistaController::class,'store']);
route::delete('/artista/{id}', [ArtistaController::class, 'destroy']);
route::put('/artista/{id}', [ArtistaController::class, 'update']);

//album//

route::get('/', function(){return response()->json(['Sucesso'=>true]);});
route::get('/album',[AlbumController::class, 'index']);
route::get('/album/{id}',[AlbumController::class,'show']);
route::post('/album',[AlbumController::class,'store']);
route::delete('/album/{id}', [AlbumController::class, 'destroy']);
route::put('/album/{id}', [AlbumController::class, 'update']);


//musicas//

route::get('/', function(){return response()->json(['Sucesso'=>true]);});
route::get('/musica',[MusicasController::class, 'index']);
route::get('/musica/{id}',[MusicasController::class,'show']);
route::post('/musica',[MusicasController::class,'store']);
route::delete('/musica/{id}', [MusicasController::class, 'destroy']);
route::put('/musica/{id}', [MusicasController::class, 'update']);