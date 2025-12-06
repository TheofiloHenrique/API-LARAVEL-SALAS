<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TurmaSala;

class SalaController extends Controller
{
    public function listar()
    {
        return Sala::all();
    }

    public function criar(Request $request)
    {
        $validated = $request->validate([
            'numero_sala' => 'required|string|max:50',
            'piso'        => 'required|string|max:50',
            'descricao'   => 'nullable|string|max:255',
        ]);

        return Sala::create($validated);
    }

    public function listarPorId($id)
    {
      return Sala::findOrFail($id);
    }

    public function atualizar(Request $request, $id)
    {
        $sala = Sala::findOrFail($id);

        $validated = $request->validate([
            'numero_sala' => 'string|max:50',
            'piso'        => 'string|max:50',
            'descricao'   => 'nullable|string|max:255',
        ]);

        $sala->update($validated);

        return $sala;
    }

    public function deletar($id)
    {
        return Sala::destroy($id);
    }

     public function ocupacaoPorData($numeroSala, Request $request)
    {
        $data = $request->query('data', now()->toDateString());

        $diaSemana = Carbon::parse($data)->locale('pt_BR')->dayName;

        $mapa = [
            'segunda-feira' => 'seg',
            'terça-feira'   => 'ter',
            'quarta-feira'  => 'quar',
            'quinta-feira'  => 'quin',
            'sexta-feira'   => 'sex',
        ];

        if (!isset($mapa[$diaSemana])) return response()->json(['message' => 'Apenas dias úteis são suportados'], 400);

        $coluna = $mapa[$diaSemana];

        $ocupacao = TurmaSala::with(['turma', 'sala'])
            ->whereHas('sala', fn($q) => $q->where('numero_sala', $numeroSala))
            ->where($coluna, 1)
            ->get();

        return response()->json($ocupacao);
    }
}


