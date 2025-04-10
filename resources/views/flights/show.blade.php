@extends('base')
@section('content')
<div class="min-h-screen bg-black text-white p-4 sm:p-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-center mb-6">Airplane Booking System</h1>

    <div class="bg-transparent border border-white border-2 p-6 rounded-lg shadow-md">
        <div class="flex flex-wrap justify-between items-center mb-4 gap-2">
            <h2 class="text-lg sm:text-xl font-semibold">Ticket Details for {{ $flights->flight_code }}</h2>
            <span class="text-xs sm:text-sm text-gray-300">
                {{ $passengers->count() }} passengers • {{ $boardedCount }} boardings
            </span>
        </div>

        <p class="text-sm text-white italic font-semibold mb-2">{{ $flights->origin }} → {{ $flights->destination }}</p>
        <p class="text-sm mb-2">Departure: 
            <span class="italic text-white">
                {{ \Carbon\Carbon::parse($flights->departure_time)->translatedFormat('l, d F Y, H:i') }}
            </span>
        </p>
        <p class="text-sm mb-6">Arrived: 
            <span class="italic text-white">
                {{ \Carbon\Carbon::parse($flights->arrival_time)->translatedFormat('l, d F Y, H:i') }}
            </span>
        </p>

        <h3 class="text-base sm:text-lg font-semibold mb-3">Passengers list</h3>

        <div class="overflow-x-auto">
            <table class="min-w-[900px] w-full text-xs sm:text-sm text-left">
                <thead class="text-white">
                    <tr>
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Passenger Name</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Seat</th>
                        <th class="px-4 py-3 text-center">Boarding</th>
                        <th class="px-4 py-3 text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($passengers as $index => $p)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">{{ $p->passenger_name }}</td>
                        <td class="px-4 py-3">{{ $p->passenger_phone }}</td>
                        <td class="px-4 py-3">{{ $p->seat_number }}</td>
                        <td class="px-4 py-3 text-center">
                            @if ($p->boarded_at == null)
                            <form action="{{ url('/flights/board/' . $p->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 text-xs">
                                    Confirm
                                </button>
                            </form>
                            @else
                            {{ \Carbon\Carbon::parse($p->boarded_at)->format('d-m-Y, H:i') }}
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <form action="{{ url('/flights/delete/' . $p->id) }}" method="POST" onsubmit="return confirm('Delete this passenger?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-700 text-white px-3 py-1 rounded hover:bg-red-600 text-xs 
                                    @if($p->boarded_at != null) opacity-50 cursor-not-allowed @endif"
                                    @if($p->boarded_at != null) disabled @endif>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ url('/flights') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>

    <p class="mt-6 text-center text-xs text-gray-500 italic">by Web Framework and Deployment - 2024</p>
</div>
@endsection
