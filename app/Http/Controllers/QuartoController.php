<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
    public function index() {
        $quartos = Quarto::all();

        return view('quarto.index', compact('quartos'));
    }

    public function formQuarto() {
        return view('quarto.add');
    }


    public function add(Request $request) {
        $validatedData = $request->validate([
            'tipo' => 'required|string|max:255',
            'valor' => 'required|min:0',
        ]);

        Quarto::create($validatedData);

        return redirect()->route('quarto.index')->with('success', 'Quarto criado com sucesso!');
    }


    public function edit($id) {
        $quarto = Quarto::find($id);

        if(!$quarto) {
            return redirect()->back()->with('error', 'Quarto não encontraddo');
        }

        return view('quarto.edit', compact('quarto'));
    }


    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'tipo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        $quarto = Quarto::find($id);

        if(!$quarto) {
            return redirect()->back()->with('error', 'Quarto não encontraddo');
        }

        $quarto->update($validatedData);
        return redirect()->route('quarto.index')->with('success', 'Quarto atualizado com sucesso');
    }


    public function delete($id) {
        $quarto = Quarto::find($id);

        if(!$quarto) {
            return redirect()->back()->with('error', 'Quarto não encontrado');
        }

        $quarto->delete();
        return redirect()->route('quarto.index')->with('success', 'Quarto deletado com sucesso');
    }
}