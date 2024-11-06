<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
    public function index()
    {
        try {
            $quartos = Quarto::all();
            return view('quarto.index', compact('quartos'));
        } catch (\Exception $e) {
            return redirect()->route('quarto.index')->with('error', 'Erro ao carregar os quartos.');
        }
    }

    public function formQuarto()
    {
        return view('quarto.add');
    }

    public function add(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'tipo' => 'required|string|max:255',
                'valor' => 'required|string',
            ]);

            function convertToFloat($value)
            {
                return (float) str_replace(['.', ','], ['', '.'], $value);
            }

            $validatedData['valor'] = convertToFloat($validatedData['valor']);
            Quarto::create($validatedData);

            return redirect()->route('quarto.index')->with('success', 'Quarto criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('quarto.index')->with('error', 'Erro ao criar quarto.');
        }
    }

    public function edit($id)
    {
        try {
            $quarto = Quarto::find($id);
            if (!$quarto) {
                return redirect()->back()->with('error', 'Quarto não encontrado');
            }

            $quarto->valor = number_format($quarto->valor, 2, ',', '.');
            return view('quarto.edit', compact('quarto'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao carregar os dados do quarto.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'tipo' => 'required|string|max:255',
                'valor' => 'required|string',
            ]);

            function convertToFloat($value)
            {
                return (float) str_replace(['.', ','], ['', '.'], $value);
            }

            $validatedData['valor'] = convertToFloat($validatedData['valor']);
            $quarto = Quarto::find($id);

            if (!$quarto) {
                return redirect()->back()->with('error', 'Quarto não encontrado');
            }

            $quarto->update($validatedData);
            return redirect()->route('quarto.index')->with('success', 'Quarto atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('quarto.index')->with('error', 'Erro ao atualizar quarto.');
        }
    }

    public function delete($id)
    {
        try {
            $quarto = Quarto::find($id);
            if (!$quarto) {
                return redirect()->back()->with('error', 'Quarto não encontrado');
            }

            $quarto->delete();
            return redirect()->route('quarto.index')->with('success', 'Quarto deletado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('quarto.index')->with('error', 'Erro ao deletar quarto.');
        }
    }
}
