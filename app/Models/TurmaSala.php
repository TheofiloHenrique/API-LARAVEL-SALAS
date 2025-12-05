<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurmaSala extends Model
{
    protected $table = 'turma_salas';

    protected $fillable = [
        'turma_id',
        'sala_id',
        'seg',
        'ter',
        'quar',
        'quin',
        'sex',
        'professor',
        'materia',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }
}
