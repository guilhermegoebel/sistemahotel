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
        return view('cliente.form');
    }

    public function getAll() {
        $clientes = Cliente::all();

        return view('cliente.tabela', compact('clientes'));
    }

    public function delete($id) {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->back()->with('error', 'Cliente não encontrado.');
        }

        $cliente->delete();
        return redirect()->back()->with('success', 'Cliente deletado com sucesso.');
    }

}
