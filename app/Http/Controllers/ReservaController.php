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

    //Provavelmente essa aqui vai pro CheckinoutController
    public function confirmCheckin($id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'ERRO: Reserva não encontrada'], 404);
        } else {
            if ($reserva->checkin_confirmado) {
                return response()->json(['message' => 'Este checkin já foi confirmado.']);
            } else {
                $reserva->checkin_confirmado = true;
                $reserva->save();
                return response()->json(['message' => 'Checkin confirmado.'], 200);
            }
        }
    }

    //Provavelmente essa aqui vai pro CheckinoutController
    public function confirmCheckout($id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'ERRO: Reserva não encontrada'], 404);
        } else {
            if ($reserva->checkin_confirmado) {
                if ($reserva->checkout_confirmado) {
                    return response()->json(['message' => 'Este checkout já foi confirmado.']);
                } else {
                    $reserva->checkout_confirmado = true;
                    $reserva->save();
                    return response()->json(['message' => 'Checkout confirmado.'], 200);
                }
            } else {
                return response()->json(['message' => 'ERRO: Não houve confirmação de checkin.', 400]);
            }
        }
    }

    public function getAll()
    {
        // Pega todas as reservas do banco de dados
        $reservas = Reserva::with(['cliente', 'quartos'])->get();

        return view('reservas.index', compact('reservas'));
    }

    public function getById($id)
    {
        // Tenta encontrar a reserva com o ID
        $reserva = Reserva::find($id);

        // Verifica se a reserva foi encontrada
        if ($reserva) {
            return view('reservas.show', compact('reserva'));
        } else {
            return response()->json(['message' => 'Reserva não encontrada'], 404);
        }
    }

    public function delete($id)
    {
        // Tenta encontrar a reserva com o ID
        $reserva = Reserva::find($id);

        // Verifica se a reserva foi encontrada
        if (!$reserva) {
            return response()->json(['message' => 'Reserva não encontrada'], 404);
        }

        // Exclusao logica
        $reserva->delete();

        return response()->json(['message' => 'Reserva excluída com sucesso'], 200);
    }
}
