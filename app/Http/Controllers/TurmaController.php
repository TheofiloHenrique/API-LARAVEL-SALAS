<?php

namespace App\Http\Controllers;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    function cadastro(){
        $turma = Turma::create(["name"=>"Theo","codigo"=>"69","curso"=>"ADS"]);
        dd($turma);
    }

    function listar(){
        $turma = Turma::get()->toArray();
        dd($turma);
    }

    function listarId($id){
        $turma = Turma::where('id',$id)->get()->toArray();
        dd($turma);
    }

    function alterar($id,$name){
        $turma = Turma::where('id',$id)->update(["name"=>$name]);
        dd($turma);
    }

    function deletar($id){
        $turma = Turma::where('id',$id)->delete();
        dd($turma);
    }
}

