<?php

namespace App\Http\Controllers;
use App\Models\Turma;
use Illuminate\Http\Request;

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
}
