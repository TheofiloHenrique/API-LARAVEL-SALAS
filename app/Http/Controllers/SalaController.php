<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

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
}
