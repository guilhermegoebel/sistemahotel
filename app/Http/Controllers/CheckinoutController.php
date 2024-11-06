<?php

namespace App\Http\Controllers;

use App\Models\Checkinout;
use App\Models\Reserva;

class CheckinoutController extends Controller
{

    public function index()
    {
        try {
            $reservas = Reserva::all();
            return view('checkinout.index', compact('reservas'));
        } catch (\Exception $e) {
            return redirect()->route('checkinout.index')->with('error', 'Erro ao carregar reservas.');
        }
    }


    public function checkin($id)
    {
        try{
            $reserva = Reserva::find($id);
            if($reserva->status == 'pendente') {
                $reserva->status = 'confirmada';
                $reserva->save();
                return redirect()->route('reservas.index')->with('success', 'Check-in realizado com sucesso!');
            }
            return redirect()->route('reservas.index')->with('error', 'Esta reserva não pode ser marcada como check-in.');
        }catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao marcar reserva como check-in');
        }
    }

    public function checkout($id)
    {
        try{
            $reserva = Reserva::find($id);
            if($reserva->status == 'confirmada') {
                $reserva->status = 'completa';
                $reserva->save();
                return redirect()->route('reservas.index')->with('success', 'Check-out realizado com sucesso!');
            }
            return redirect()->route('reservas.index')->with('error', 'Esta reserva não pode ser marcada como check-out.');
        }catch (\Exception $e) {
            return redirect()->route('reservas.index')->with('error', 'Erro ao marcar reserva como check-out');
        }
    }

   //funçao do historico mas eu nao sei faze direito meu deus socorro me ajuda
    public function historico()
    {
        $reservas = Reserva::with('cliente')->get();
        return view('historico.index', compact('reservas'));
    }


}
