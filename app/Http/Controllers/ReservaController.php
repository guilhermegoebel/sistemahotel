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
        try {
            $reservas = Reserva::all();
            return view('reservas.index', compact('reservas'));
        } catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao carregar reservas.');
        }
    }

    public function formReserva()
    {
        try {
            $clientes = Cliente::all();
            $quartos = Quarto::all();
            $acompanhantes = Acompanhante::all();
            return view('reservas.add', compact('clientes', 'quartos', 'acompanhantes'));
        } catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao carregar formulário de reserva.');
        }
    }

    public function add(Request $request)
    {
            $validatedData = $request->validate([
                'id_cliente' => 'required|exists:cliente,id_cliente',
                'data_checkin' => 'required|date',
                'data_checkout' => 'required|date|after_or_equal:data_checkin',
                'quartos' => 'required|array',
                'quartos.*' => 'exists:quarto,id_quarto',
                'acompanhantes' => 'nullable|json'
            ], [
                'id_cliente.required' => 'O campo Cliente é obrigatório.',
                'id_cliente.exists' => 'O cliente selecionado não é válido.',
                'data_checkin.required' => 'A data de check-in é obrigatória.',
                'data_checkin.date' => 'A data de check-in deve ser uma data válida.',
                'data_checkout.required' => 'A data de check-out é obrigatória.',
                'data_checkout.date' => 'A data de check-out deve ser uma data válida.',
                'data_checkout.after_or_equal' => 'A data de check-out deve ser igual ou após a data de check-in.',
                'quartos.required' => 'É necessário selecionar pelo menos um quarto.',
                'quartos.array' => 'O campo quartos deve ser um array.',
                'quartos.*.exists' => 'Um dos quartos selecionados não é válido.',
            ]);

            $reserva = Reserva::create([
                'id_cliente' => $validatedData['id_cliente'],
                'data_checkin' => $validatedData['data_checkin'],
                'data_checkout' => $validatedData['data_checkout'],
                'valor' => 0,
                'status' => 'pendente',
            ]);

            if ($request->acompanhantes) {
                $acompanhantes = json_decode($validatedData['acompanhantes'], true);

                foreach ($acompanhantes as $acompanhanteData) {
                    $acompanhanteData['id_reserva'] = $reserva->id_reserva;
                    Acompanhante::create($acompanhanteData);
                }
            }

            $reserva->quartos()->attach($validatedData['quartos']);

            // Calcula o valor total da reserva com base nos quartos
            $totalValor = Quarto::whereIn('quarto.id_quarto', $validatedData['quartos'])->sum('quarto.valor');
            $reserva->update(['valor' => $totalValor]);

            return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
    }

    public function edit($id)
    {
        try {
            $reserva = Reserva::find($id);
            if (!$reserva) {
                return redirect()->back()->with('error', 'Reserva não encontrada.');
            }


            $clientes = Cliente::all();
            $quartos = Quarto::all();
            $quartosSelecionados = $reserva->quartos()->pluck('quarto.id_quarto')->toArray();


            return view('reservas.edit', compact('reserva', 'clientes', 'quartos', 'quartosSelecionados'));
        } catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao carregar a edição da reserva.');
        }
    }


    public function update(Request $request, $id)
    {
        try {
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


            // Atualiza os quartos associados à reserva
            $reserva->quartos()->sync($validatedData['quartos']);


            return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao atualizar a reserva.');
        }
    }


    public function cancelar($id)
    {
        try {
            $reserva = Reserva::find($id);
            if (!$reserva) {
                return redirect()->route('reservas.index')->with('error', 'Reserva não encontrada.');
            }


            // Verifica se o status da reserva é pendente
            if ($reserva->status !== 'pendente') {
                return redirect()->route('reservas.index')->with('error', 'A reserva não pode ser cancelada, pois não está pendente.');
            }


            $reserva->update(['status' => 'cancelada']);


            return redirect()->route('reservas.index')->with('success', 'Reserva cancelada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao cancelar a reserva.');
        }
    }


    public function getById($id)
    {
        try {
            $reserva = Reserva::find($id);
            if ($reserva) {
                $dataCheckin = Carbon::parse($reserva->data_checkin);
                $dataCheckout = Carbon::parse($reserva->data_checkout);
                $diasHospedagem = $dataCheckin->diffInDays($dataCheckout);


                $valorTotal = 0;
                foreach ($reserva->quartos as $quarto) {
                    $valorTotal += $quarto->valor * $diasHospedagem;
                }


                return view('reservas.show', compact('reserva', 'valorTotal', 'diasHospedagem'));
            } else {
                return redirect()->route('reservas.index')->with('error', 'Reserva não encontrada.');
            }
        } catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao carregar detalhes da reserva.');
        }
    }


    public function delete($id)
    {
        try {
            $reserva = Reserva::find($id);
            if (!$reserva) {
                return redirect()->route('reservas.index')->with('error', 'Reserva não encontrada.');
            }


            // Exclusão lógica
            $reserva->delete();


            return redirect()->route('reservas.index')->with('success', 'Reserva excluída com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao excluir a reserva.');
        }
    }
}

