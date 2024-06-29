<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todas las reservas activas del usuario
        $reservations = Reservation::where('user_id', $user->id)->get();

        // Devolver la vista con la información del usuario y sus reservas
        return view('reservations.index', compact('user', 'reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar la reserva
        $reservation = Reservation::findOrFail($id);

        // Verificar si la reserva pertenece al usuario autenticado
        if ($reservation->user_id != Auth::id()) {
            return redirect()->route('reservations.index')->with('error', 'No tienes permiso para eliminar esta reserva.');
        }

        // Eliminar la reserva
        $reservation->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
