<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index() {
        return view('cliente.index');
    }

    public function formCliente() {
        return view('cliente.add');
    }

    public function getAll() {
        $clientes = Cliente::all();

        return view('cliente.tabela', compact('clientes'));
    }

    public function add(Request $request) {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:cliente,cpf',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:cliente,email',
            'endereco' => 'required|string|max:255',
        ]);

        $cliente = Cliente::create($validatedData);

        return redirect()->route('cliente.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function delete($id) {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->back()->with('error', 'Cliente não encontrado.');
        }

        $cliente->delete();
        return redirect()->back()->with('success', 'Cliente deletado com sucesso.');
    }
    //O commit ta no negócio do shigio, mas o amigão fez essa aqui rapaiz
    public function edit($id) {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->back()->with('error', 'Cliente não encontrado');
        }

        //Retorna a view do caba
        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request, $id) {
        //Valida a galera
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:cliente,cpf, ' .$id. ',id_cliente',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:cliente,email, ' .$id. ' ,id_cliente',
            'endereco' => 'required|string|max:255',
        ]);

        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->back()->with('error', 'Cliente não encontrado');
        }

        $cliente->update($validatedData);

        return redirect()->route('cliente.index')->with('success', 'Dados do cliente atualizados com sucesso!');
    }

}
