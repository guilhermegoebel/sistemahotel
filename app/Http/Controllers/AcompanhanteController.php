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
            'id_reserva' =>'required|exists:reserva,id_reserva',
            'nome' => 'required|string|max:255',
            'idade' => 'required|integer|min:0',
        ]);
        Acompanhante::create([
            'id_reserva' => $request->id_reserva,
            'nome' => $request->nome,
            'idade' => $request->idade,
        ]);
        return back()->with('success', 'Acompanhante adicionado com sucesso!');
    }
}
