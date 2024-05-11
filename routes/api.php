<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\AlbumController;


route::get('/', function(){return response()->json(['Sucesso'=>true]);});
route::get('/album',[AlbumController::class, 'index']);
route::get('/album/{id}',[AlbumController::class,'show']);
route::post('/album',[AlbumController::class,'store']);
route::delete('/album/{id}', [AlbumController::class, 'destroy']);
route::put('/album/{id}', [AlbumController::class, 'update']);