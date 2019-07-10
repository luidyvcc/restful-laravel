<?php

Route::get('clientes/{id}/documento', 'API\ClienteController@documento');
Route::apiResource('clientes', 'API\ClienteController');


Route::get('documentos/{id}/cliente', 'API\DocumentoController@cliente');
Route::apiResource('documentos', 'API\DocumentoController');
