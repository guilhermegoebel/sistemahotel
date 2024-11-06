<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        try {
            $clientes = Cliente::all();
            return view('cliente.index', compact('clientes'));
        } catch (\Exception $e) {
            return redirect()->route('cliente.index')->with('error', 'Erro ao carregar clientes.');
        }
    }

    public function formCliente()
    {
        return view('cliente.add');
    }

    public function getAll()
    {
        try {
            $clientes = Cliente::all();
            return view('cliente.tabela', compact('clientes'));
        } catch (\Exception $e) {
            return redirect()->route('cliente.index')->with('error', 'Erro ao carregar tabela de clientes.');
        }
    }

    public function add(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'cpf' => 'required|string|max:14|unique:cliente,cpf',
                'data_nascimento' => 'required|date',
                'telefone' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:cliente,email',
                'endereco' => 'required|string|max:255',
            ]);

            $cliente = Cliente::create($validatedData);
            return redirect()->route('cliente.index')->with('success', 'Cliente cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('cliente.index')->with('error', 'Erro ao cadastrar cliente.');
        }
    }

    public function delete($id)
    {
        try {
            $cliente = Cliente::find($id);

            if (!$cliente) {
                return redirect()->back()->with('error', 'Cliente não encontrado.');
            }

            $cliente->delete();
            return redirect()->back()->with('success', 'Cliente deletado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao deletar cliente.');
        }
    }

    public function edit($id)
    {
        try {
            $cliente = Cliente::find($id);

            if (!$cliente) {
                return redirect()->back()->with('error', 'Cliente não encontrado');
            }

            return view('cliente.edit', compact('cliente'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao carregar dados do cliente.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'cpf' => 'required|string|max:14|unique:cliente,cpf,' . $id . ',id_cliente',
                'data_nascimento' => 'required|date',
                'telefone' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:cliente,email,' . $id . ',id_cliente',
                'endereco' => 'required|string|max:255',
            ]);

            $cliente = Cliente::find($id);

            if (!$cliente) {
                return redirect()->back()->with('error', 'Cliente não encontrado');
            }

            $cliente->update($validatedData);
            return redirect()->route('cliente.index')->with('success', 'Dados do cliente atualizados com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar dados do cliente.');
        }
    }
}
