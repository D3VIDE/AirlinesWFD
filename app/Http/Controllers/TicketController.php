<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
class TicketController extends Controller
{
    public function boardPassenger($id){
        $passenger = Ticket::findOrFail($id);
        // Cek kalau belum boarding, baru update
        if ($passenger->boarding_time === null) {
            $passenger->boarding_time = now();
            $passenger->is_boarding = 1;
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
