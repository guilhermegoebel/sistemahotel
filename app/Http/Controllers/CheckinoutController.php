<?php

namespace App\Http\Controllers;

use App\Models\Checkinout;
use App\Models\Reserva;

class CheckinoutController extends Controller
{

    public function index() {
        $reservas = Reserva::all();
        return view('checkinout.index', compact('reservas'));
    }
    public function checkinTela(){
        $reservas = Reserva::all();
        return view('checkin.index', compact('reservas'));
    }
    public function checkoutTela(){
        $reservas = Reserva::all();
        return view('checkout.index', compact('reservas'));
    }

    public function checkin($id)
    {
        $reserva = Reserva::find($id);
        if($reserva->status == 'pendente') {
            $reserva->status = 'confirmada';
            $reserva->save();
            return redirect()->route('reservas.index')->with('success', 'Check-in realizado com sucesso!');
        }
        return redirect()->route('reservas.index')->with('error', 'Esta reserva não pode ser marcada como check-in.');
    }

    public function checkout($id)
    {
        $reserva = Reserva::find($id);
        if($reserva->status == 'confirmada') {
            $reserva->status = 'completa';
            $reserva->save();
            return redirect()->route('reservas.index')->with('success', 'Check-out realizado com sucesso!');
        }
        return redirect()->route('reservas.index')->with('error', 'Esta reserva não pode ser marcada como check-out.');
    }

}
