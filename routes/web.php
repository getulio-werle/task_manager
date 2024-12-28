<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;

Route::get('/', function () {
    try {
        DB::connection()->getPdo();
        echo 'Conexão efetuada: ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die('Não foi possivel se conectar à base de dados' . $e->getMessage());
    }
});

Route::get('/main', [Main::class, 'index']);