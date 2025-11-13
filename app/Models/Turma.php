<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = "turmas";
    protected $primaryKey = "id";
    protected $fillable = ["name","codigo","curso"];
}
