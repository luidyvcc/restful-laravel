<?php

Route::get('clientes/{id}/documentos', 'API\ClienteController@documentos');
Route::apiResource('clientes', 'API\ClienteController');


Route::get('documentos/{id}/cliente', 'API\DocumentoController@cliente');
Route::apiResource('documentos', 'API\DocumentoController');
