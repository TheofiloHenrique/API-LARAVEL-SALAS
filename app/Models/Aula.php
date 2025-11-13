<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    public $turma;
    public $curso;

    public function retorno(){
        return 'Minha turma é ' .
        $this->turma .
        ' do curso: ' .
        $this->curso;
    }
}
