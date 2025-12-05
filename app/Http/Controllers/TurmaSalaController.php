<?php

namespace App\Http\Controllers;
use App\Models\TurmaSala;
use Illuminate\Http\Request;

class TurmaSalaController extends Controller
{
      public function listar()
    {
        return TurmaSala::with(['turma', 'sala'])->get();
    }

    public function criar(Request $request)
    {
        return TurmaSala::create($request->all());
    }

    public function listarPorId($id)
    {
        return TurmaSala::with(['turma', 'sala'])->findOrFail($id);
    }

    public function atualizar(Request $request, $id)
    {
        $data = TurmaSala::findOrFail($id);
        $data->update($request->all());
        return $data;
    }

    public function deletar($id)
    {
        return TurmaSala::destroy($id);
    }

   public function buscarPorCodigo($codigo)
    {
        $registros = TurmaSala::with(['turma', 'sala'])
            ->whereHas('turma', function ($query) use ($codigo) {
                $query->where('codigo', $codigo);
            })
            ->get();

        if ($registros->isEmpty()) return response()->json(['message' => 'Nenhum registro encontrado'], 404);

        $resultado = $registros->map(function ($item) {
            $diasTrue = collect([
                'seg' => $item->seg,
                'ter' => $item->ter,
                'quar' => $item->quar,
                'quin' => $item->quin,
                'sex' => $item->sex,
            ])->filter()->keys()->toArray();

            return [
                "turma"     => $item->turma->name,
                "codigo"    => $item->turma->codigo,
                "curso"     => $item->turma->curso,
                "sala"      => $item->sala->numero_sala,
                "piso"      => $item->sala->piso,
                "dias"      => $diasTrue,
                "professor" => $item->professor,
                "materia"   => $item->materia
            ];
        });

        return response()->json($resultado);
    }
}
