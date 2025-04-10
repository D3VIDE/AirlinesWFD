<?php

namespace App\Http\Controllers;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(){
        // $flights = Flight::orderBy('id','asc')->get(); // atau 'desc' kalau mau data terbaru
        // return view('flights.index', [
        //     "flights" => $flights
        // ]);
        
        $flights = Flight::orderBy('id', 'asc')->get();
        return view('flights.index', compact('flights'));
  /* Cara ke 2
        $flight = Flight::orderBy('id','asc')->get(); //kalo mau data terbaru 'desc'
        return view('flights.index',compact('flight');
  */
    }
    public function show($id) {
        $flights = Flight::findOrFail($id);
        $passengers = Ticket::where('flight_id', $id)->get();
        $boardedCount = $passengers->whereNotNull('boarding_time')->count();
    
        return view('flights.show', [
            'flights' => $flights,
            'passengers' => $passengers,
            'boardedCount' => $boardedCount
        ]);
    }
    public function boardPassenger($id){
        $passenger = Ticket::findOrFail($id);
        // Cek kalau belum boarding, baru update
        if ($passenger->boarding_time === null) {
            $passenger->boarding_time = now();
            $passenger->save();
        }
        return back()->with('success', 'Passenger has boarded.');
    }

    public function deletePassenger($id)
{
    $ticket = Ticket::findOrFail($id);

    // Hanya boleh hapus kalau belum boarding
    if ($ticket->boarding_time === null) {
        $ticket->delete();
        return back()->with('success', 'Passenger deleted successfully.');
    }

    return back()->with('error', 'Cannot delete. Passenger already boarded.');
}
}
