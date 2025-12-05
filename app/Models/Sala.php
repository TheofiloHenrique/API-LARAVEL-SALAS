<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    protected $table = "salas";
    protected $primaryKey = "id";
    protected $fillable = ["numero_sala","piso","descricao"];

    public function turmaSalas()
    {
        return $this->hasMany(TurmaSala::class, 'sala_id');
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'turma_salas', 'sala_id', 'turma_id')
                    ->withPivot(['seg','ter','quar','quin','sex','professor','materia']);
    }

}
