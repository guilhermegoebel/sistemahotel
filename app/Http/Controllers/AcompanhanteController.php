<?php
namespace App\Http\Controllers;

use App\Models\Acompanhante;
use Illuminate\Http\Request;

class AcompanhanteController extends Controller
{
    // Função pra pegar geral (chamada na criação de reserva)
    public function index() {
        $acompanhantes = Acompanhante::all();
        return view('acompanhante.index', compact('acompanhantes'));
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:255',
            'idade' => 'required|integer|min:0',
        ]);
        Acompanhante::create($request->all());
        return redirect()->route('acompanhante.index')->with('success', 'Acompanhante adicionado com sucesso receba');
    }
}
