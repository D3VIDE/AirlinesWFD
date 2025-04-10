@extends('base')
@section('content')

<div class="min-h-[calc(100vh-80px)] flex flex-col bg-black text-white p-6">
    <div class="max-w-3xl mx-auto bg-transparent p-6 rounded-lg shadow-md border border-white border-2">
        <h2 class="text-xl font-bold mb-4 text-center">Book Ticket for {{ $flight->flight_code }}</h2>

        <form action="{{ url('/ticket/submit') }}" method="POST">
            @csrf
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">

            <div class="mb-4">
                <label class="block text-sm mb-1">Passenger Name</label>
                <input type="text" name="passenger_name" class="w-full p-2 rounded bg-transparent text-white border border-white border-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Phone</label>
                <input type="text" name="passenger_phone" class="w-full p-2 rounded bg-transparent text-white border border-white border-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Seat Number</label>
                <input type="text" name="seat_number" value="{{ $availableSeat }}" class="w-full p-2 rounded bg-transparent text-white border border-white border-2" required>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white text-sm">
                    Submit Booking
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ url('/flights/') }}" class="text-sm text-orange-400 underline">Back to Detail</a>
        </div>
    </div>
</div>

@endsection
