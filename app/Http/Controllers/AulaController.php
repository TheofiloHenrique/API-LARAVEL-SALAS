<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use Illuminate\Http\Request; 

class AulaController extends Controller
{
    public function aula1(){
        $objeto = new Aula();
        $objeto->curso = 'ADS';
        $objeto->turma = 'E03';

        return view('theo', ["retorno"=>$objeto->retorno()]);
    }
}
