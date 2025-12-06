<?php

namespace App\Http\Controllers;
use App\Models\Turma;
use App\Models\TurmaSala;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TurmaController extends Controller
{
    public function listar()
    {
        $turmas = Turma::all()->toArray();
        return response()->json($turmas);
    }

    public function listarPorId($id)
    {
        $turma = Turma::where('id', $id)->first();

        if (!$turma)return response()->json(['error' => 'Turma não encontrada'], 404);

        return response()->json($turma->toArray());
    }

    public function criar(Request $request)
    {
        $turma = Turma::create([
            "name" => $request->input('name'),
            "codigo" => $request->input('codigo'),
            "curso" => $request->input('curso')
        ]);

        return response()->json($turma->toArray(), 201);
    }

    public function atualizar(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'codigo' => 'sometimes|string|unique:turmas,codigo,' . $id,
            'curso' => 'sometimes|string|max:255'
        ]);

        $turma = Turma::find($id);

        if (!$turma) return response()->json(['error' => 'Turma não encontrada'], 404);

        $turma->fill($validated);

        if (!$turma->isDirty()) {
            return response()->json([
                'message' => 'Nenhuma alteração necessária',
                'turma' => $turma->toArray()
            ]);
        }

        $turma->save();

        return response()->json([
            'success' => true,
            'message' => 'Turma atualizada com sucesso',
            'turma' => $turma->toArray()
        ]);
    }

    public function deletar($id)
    {
        $turma = Turma::find($id);

        if (!$turma) return response()->json(['error' => 'Turma não encontrada'], 404);


        $turmaNome = $turma->name;
        $turma->delete();

        return response()->json([
            'success' => true,
            'message' => "Turma '{$turmaNome}' deletada com sucesso",
            'deleted_data' => [
                'id' => $id,
                'name' => $turmaNome,
                'codigo' => $turma->codigo
            ]
        ], 200);
    }

    public function ocupacaoPorCodigo(Request $request, $codigo)
    {
        $data = $request->query('data', now()->toDateString());

        $diaSemana = Carbon::parse($data)->locale('pt_BR')->dayName;

        $mapaDias = [
            'segunda-feira'  => 'seg',
            'terça-feira' => 'ter',
            'quarta-feira' => 'quar',
            'quinta-feira' => 'quin',
            'sexta-feira' => 'sex',
        ];

        if (!isset($mapaDias[$diaSemana])) return response()->json(['error' => 'Não há aula nesta data (sábado ou domingo).'], 400);

        $coluna = $mapaDias[$diaSemana];

        $turma = TurmaSala::with(['turma', 'sala'])
            ->whereHas('turma', function($q) use ($codigo) {
                $q->where('codigo', $codigo);
            })
            ->where($coluna, 1)
            ->first();

        if (!$turma) return response()->json(['message' => 'Nenhuma sala encontrada para esta turma neste dia.'], 404);

        return response()->json([
            'data'      => $data,
            'dia'       => $coluna,
            'turma'     => $turma->turma->name,
            'codigo'    => $turma->turma->codigo,
            'curso'     => $turma->turma->curso,
            'sala'      => $turma->sala->numero_sala,
            'piso'      => $turma->sala->piso,
            'professor' => $turma->professor,
            'materia'   => $turma->materia
        ]);
    }

}
