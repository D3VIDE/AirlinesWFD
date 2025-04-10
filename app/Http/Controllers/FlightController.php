<?php

namespace App\Http\Controllers;
use App\Models\Flight;
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
}
