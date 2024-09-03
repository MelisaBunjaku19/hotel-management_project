<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking; // Ensure you import the Booking model as well
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->with('room')->get();
        return view('home.bookings', compact('bookings'));
    }

    public function showRooms()
    {
        $user = auth()->user(); // Get the logged-in user
    
        // Get all room IDs that the user has booked
        $bookedRoomIds = $user->bookings->pluck('room_id')->toArray();
    
        // Fetch rooms that the user hasn't booked
        $rooms = Room::whereNotIn('id', $bookedRoomIds)->get();
    
        return view('home.rooms', compact('rooms'));
    }
    
    public function showPaymentPage($id)
    {
        $room = Room::findOrFail($id);
        return view('home.payment', compact('room'));
    }

    public function processPayment(Request $request)
    {
        // Payment processing logic (e.g., using Stripe)
        // For demonstration, we'll assume payment is always successful
    
        // Save booking
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->room_id = $request->room_id;
        $booking->arrival_date = $request->arrival_date;
        $booking->departure_date = $request->departure_date;
        $booking->amount_paid = $this->calculateAmountPaid($request->room_id); // Example of calculating amount
        $booking->save();
    
        // Mark the room as booked
        $room = Room::find($request->room_id);
        $room->is_booked = true;
        $room->save();
    
        return redirect()->route('bookings.index')->with('success', 'Booking confirmed!');
    }


    
    
    
    private function calculateAmountPaid($roomId)
    {
        $room = Room::findOrFail($roomId);
        return $room->price; // Example calculation, you might need to adjust based on booking duration
    }

    public function showAvailableRooms()
    {
        // Fetch all rooms that are not booked
        $rooms = Room::where('is_booked', false)->get();
    
        return view('home.rooms', compact('rooms'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
            // other validation rules
        ]);
    
        $room = Room::find($validatedData['room_id']);
    
        if ($room->is_booked) {
            return redirect()->route('home.rooms')->with('error', 'Room is already booked.');
        }
    
        // Create booking
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->room_id = $room->id;
        $booking->arrival_date = $validatedData['arrival_date'];
        $booking->departure_date = $validatedData['departure_date'];
        $booking->save();
    
        // Update room status
        $room->is_booked = true;
        $room->save();
    
        return redirect()->route('home.rooms')->with('success', 'Booking confirmed!');
    }
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET')); // Set your Stripe Secret Key

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Room Booking',
                    ],
                    'unit_amount' => $this->calculateAmountPaid($request->room_id) * 100, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return response()->json(['id' => $checkoutSession->id]);
    }

 
public function handleSuccess(Request $request)
{
    // Extract parameters from the query string
    $roomId = $request->query('room_id');
    $arrivalDate = $request->query('arrival_date');
    $departureDate = $request->query('departure_date');
    
    // Save booking
    $booking = new Booking();
    $booking->user_id = auth()->id();
    $booking->room_id = $roomId;
    $booking->arrival_date = $arrivalDate;
    $booking->departure_date = $departureDate;
    $booking->amount_paid = $this->calculateAmountPaid($roomId);
    $booking->save();

    // Mark the room as booked
    $room = Room::find($roomId);
    $room->is_booked = true;
    $room->save();

    return redirect()->route('bookings.index')->with('success', 'Booking confirmed!');
}

    
}
