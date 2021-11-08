<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/redirect', function (Request $request) {
    $state = Str::random(40);
    session([
        'state' => $state
    ]);
    $query = http_build_query([
        'client_id' =>env( 'CLIENT_ID'),
        'redirect_uri' => env('REDIRECT_URL'),
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect(env('API_URL').'oauth/authorize?'.$query);
    })->name('redirect');

Route::get("callback", function (Request $request){

    $response = Http::post(env('API_URL').'oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
        'redirect_uri' => env('REDIRECT_URL'),
        'code' => $request->code,
    ]);
    dd($response->json());

});

Route::get('/acessar',[\App\Http\Controllers\Acesso\AcessoController::class,'index']);
Route::get('/acessa/{id}',[\App\Http\Controllers\Acesso\AcessoController::class,'show']);
