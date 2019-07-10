<?php

Route::get('clientes/{id}/documento', 'API\ClienteController@documento');
Route::get('clientes/{id}/telefones', 'API\ClienteController@telefones');
Route::apiResource('clientes', 'API\ClienteController');


Route::get('documentos/{id}/cliente', 'API\DocumentoController@cliente');
Route::apiResource('documentos', 'API\DocumentoController');

Route::get('telefones/{id}/cliente', 'API\TelefoneController@cliente');
Route::apiResource('telefones', 'API\TelefoneController');
