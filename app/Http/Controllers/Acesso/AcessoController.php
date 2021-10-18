<?php

namespace App\Http\Controllers\Acesso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AcessoController extends Controller
{
    public function index()
    {
        $response = Http::get(env('API_URL').'api/clientes');
        dd($response->json());
    }

    public function show($id)
    {
        $response = Http::withBasicAuth('admin@admin.com','123456789')->get(env('API_URL').'api/cliente/'.$id);

        return response($response['nome']);
    }

    public function create()
    {
        $response = Http::post(env('API_URL').'api/clientes',[
            'nome'=>'',
            'cpf_cnpj'=>'',
            'email'=>'',
            'tipo_pessoa'=>'',
            'data_nasc'=>'',
            'id_loja' =>''
        ]);
    }

}
