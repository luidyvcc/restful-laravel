<?php

Route::post('login', 'Auth\AuthController@authenticate');

// Clientes
Route::get('clientes/{id}/documento', 'API\ClienteController@documento');
Route::get('clientes/{id}/telefones', 'API\ClienteController@telefones');
Route::get('clientes/{id}/locacoes', 'API\ClienteController@locacoes');
Route::apiResource('clientes', 'API\ClienteController');

// Documentos
Route::get('documentos/{id}/cliente', 'API\DocumentoController@cliente');
Route::apiResource('documentos', 'API\DocumentoController');

// Telefones
Route::get('telefones/{id}/cliente', 'API\TelefoneController@cliente');
Route::apiResource('telefones', 'API\TelefoneController');

// Filmes
Route::apiResource('filmes', 'API\FilmeController');

// Filmes
Route::apiResource('locacoes', 'API\LocacaoController');
