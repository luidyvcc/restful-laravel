<?php


// Login - JWT Auth
Route::post('login', 'Auth\AuthController@authenticate');
Route::post('login-refresh', 'Auth\AuthController@refreshToken');
Route::get('login', 'Auth\AuthController@getAuthenticatedUser');


Route::group(['namespace' => 'API'/*, 'middleware' => 'auth:api'*/], function(){

    // Clientes
    Route::get('clientes/{id}/documento', 'ClienteController@documento');
    Route::get('clientes/{id}/telefones', 'ClienteController@telefones');
    Route::get('clientes/{id}/locacoes', 'ClienteController@locacoes');
    Route::apiResource('clientes', 'ClienteController');

    // Documentos
    Route::get('documentos/{id}/cliente', 'DocumentoController@cliente');
    Route::apiResource('documentos', 'DocumentoController');

    // Telefones
    Route::get('telefones/{id}/cliente', 'TelefoneController@cliente');
    Route::apiResource('telefones', 'TelefoneController');

    // Filmes
    Route::apiResource('filmes', 'FilmeController');

    // Locação
    Route::apiResource('locacoes', 'LocacaoController');

    // Fornecedor
    Route::apiResource('fornecedores', 'FornecedorController');

});
