<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Quarto;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index() {
        $reservas = Reserva::all();

        return view('reservas.index', compact('reservas'));
    }

    public function formReserva() {
        $clientes = Cliente::all();
        $quartos = Quarto::all();
        return view('reservas.add', compact('clientes', 'quartos'));
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'data_checkin' => 'required|date',
            'data_checkout' => 'required|date|after_or_equal:data_checkin',
            'quartos' => 'required|numeric',
            //'quartos.*' => 'exists:quarto,id_quarto',
        ]);

        $reserva = Reserva::create([
            'id_cliente' => $validatedData['id_cliente'],
            'data_checkin' => $validatedData['data_checkin'],
            'data_checkout' => $validatedData['data_checkout'],
            'valor' => 0, //$validatedData['valor'],
            'status' => 'pendente', //$validatedData['status'],
            'quartos' => $validatedData['quartos'],
        ]);

        //Atacar os quartos na reserva
        //$reserva->quartos()->attach($validatedData['quartos']);

        return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
    }

    public function edit($id) {
        $reserva = Reserva::find($id);
        $clientes = Cliente::all();

        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva não encontrada');
        }

        //Retorna a view do caba
        return view('reservas.edit', compact('reserva', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'data_checkin' => 'date',
            'data_checkout' => 'date|after_or_equal:data_checkin',
            //Aqui o valor ta sendo alterado manualmente, a gente vai mudar esse troço
            //'valor' => 'required|numeric',
            'status' => 'required|string|max:255',
            // 'quartos' => 'required|array',
            'quartos' => 'required|numeric',
            // 'quartos.*' => 'exists:quarto,id_quarto',
        ]);

        $reserva = Reserva::find($id);

        if (!$reserva) {
            return redirect()->route('reserva.index')->with('error', 'Reserva não encontrada.');
        }

        $reserva->update([
            'id_cliente' => $validatedData['id_cliente'],
            'data_checkin' => $validatedData['data_checkin'],
            'data_checkout' => $validatedData['data_checkout'],
            'valor' => 0, //$validatedData['valor'],
            'status' => $validatedData['status'],
            'quartos' => $validatedData['quartos'],
            // 'valor' => $validatedData['valor'],
        ]);

        // Atualiza os quartos q tao atacado na reserva
        //if(isset($validatedData['quartos'])) {
            //$reserva->quartos()->sync($validatedData['quartos']);
        //}

        return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso!');
    }

    public function getById($id)
    {
        // Tenta encontrar a reserva com o ID
        $reserva = Reserva::find($id);

        // Verifica se a reserva foi encontrada
        if ($reserva) {
            return view('reservas.show', compact('reserva'));
        } else {
            return redirect()->route('reservas.index')->with('error', 'Reserva não encontrada.');
        }
    }

    public function delete($id)
    {
        // Tenta encontrar a reserva com o ID
        $reserva = Reserva::find($id);

        // Verifica se a reserva foi encontrada
        if (!$reserva) {
            return redirect()->route('reservas.index')->with('error', 'Reserva não encontrada.');
        }

        // Exclusao logica
        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva excluída com sucesso.');
    }
}
