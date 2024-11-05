<?php

namespace App\Http\Controllers;

use App\Models\Acompanhante;
use App\Models\Cliente;
use App\Models\Quarto;
use App\Models\Reserva;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::all();

        return view('reservas.index', compact('reservas'));
    }

    public function formReserva()
    {
        $clientes = Cliente::all();
        $quartos = Quarto::all();
        $acompanhantes = Acompanhante::all();
        return view('reservas.add', compact('clientes', 'quartos', 'acompanhantes'));
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'data_checkin' => 'required|date',
            'data_checkout' => 'required|date|after_or_equal:data_checkin',
            'quartos' => 'required|array',
            'quartos.*' => 'exists:quarto,id_quarto',
        ]);

        $reserva = Reserva::create([
            'id_cliente' => $validatedData['id_cliente'],
            'data_checkin' => $validatedData['data_checkin'],
            'data_checkout' => $validatedData['data_checkout'],
            'valor' => 0, //Vai ser baguiado depois
            'status' => 'pendente',
        ]);

        $reserva->quartos()->attach($validatedData['quartos']);

        // Calcula o valor total da reserva com base nos quartos
        $totalValor = Quarto::whereIn('quarto.id_quarto', $validatedData['quartos'])->sum('quarto.valor');
        $reserva->update(['valor' => $totalValor]);

        return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
    }

    public function edit($id)
    {
        $reserva = Reserva::find($id);
        $clientes = Cliente::all();
        $quartos = Quarto::all();
        $quartosSelecionados = $reserva->quartos()->pluck('quarto.id_quarto')->toArray();

        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva não encontrada');
        }

        // Retorna a view do caba
        return view('reservas.edit', compact('reserva', 'clientes', 'quartos', 'quartosSelecionados'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'data_checkin' => 'date',
            'data_checkout' => 'date|after_or_equal:data_checkin',
            'quartos' => 'required|array',
            'quartos.*' => 'exists:quarto,id_quarto',
        ]);

        $reserva = Reserva::find($id);

        if (!$reserva) {
            return redirect()->route('reserva.index')->with('error', 'Reserva não encontrada.');
        }

        $reserva->update([
            'id_cliente' => $validatedData['id_cliente'],
            'data_checkin' => $validatedData['data_checkin'],
            'data_checkout' => $validatedData['data_checkout'],
        ]);

        // Atualiza os quartos q tao atacado na reserva
        $reserva->quartos()->sync($validatedData['quartos']);

        return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso!');
    }

    public function cancelar($id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return redirect()->route('reservas.index')->with('error', 'Reserva não encontrada.');
        }

        // Veja se o status da reserva é pendente
        if ($reserva->status !== 'pendente') {
            return redirect()->route('reservas.index')->with('error', 'A reserva não pode ser cancelada, pois não está pendente');
        }

        $reserva->update(['status' => 'cancelada']);

        return redirect()->route('reservas.index')->with('success', 'Reserva Cancelada com sucesso');
    }

    public function getById($id)
    {
        // Tenta encontrar a reserva com o ID
        $reserva = Reserva::find($id);

        // Verifica se a reserva foi encontrada
        if ($reserva) {
            // Calcula a quantidade de dias entre check-in e check-out
            $dataCheckin = Carbon::parse($reserva->data_checkin);
            $dataCheckout = Carbon::parse($reserva->data_checkout);
            $diasHospedagem = $dataCheckin->diffInDays($dataCheckout);

            // Inicializa o valor total da reserva
            $valorTotal = 0;

            // Calcula o valor total considerando o número de dias
            foreach ($reserva->quartos as $quarto) {
                $valorTotal += $quarto->valor * $diasHospedagem;
            }

            // Passa o valor total para a view
            return view('reservas.show', compact('reserva', 'valorTotal', 'diasHospedagem'));
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
