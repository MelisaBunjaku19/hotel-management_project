<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class BookingController extends Controller
{
    public function showRooms()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    
        $bookedRoomIds = Booking::where('user_id', auth()->id())->pluck('room_id')->toArray();
        $rooms = Room::whereNotIn('id', $bookedRoomIds)->get();
    
        return view('home.rooms', compact('rooms'));
    }

    public function adminIndex(Request $request)
    {
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        $bookings = Booking::with(['room', 'user'])
                            ->orderBy($sortField, $sortDirection)
                            ->get();

        return view('admin.show_bookings', compact('bookings', 'sortField', 'sortDirection'));
    }

    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        return view('home.bookings', compact('bookings'));
    }
    
    // BookingController.php

    public function bookRoom(Request $request)
    {
        $roomId = $request->input('room_id');
        $room = Room::findOrFail($roomId);
    
        // Check if the room is already booked
        if ($room->is_booked) {
            return response()->json(['error' => 'Room is already booked.'], 400);
        }
    
        // Proceed with booking logic
        $room->is_booked = true;
        $room->save();
    
        // Optionally, you can create a booking record here if needed
        // For example:
        // Booking::create([
        //     'user_id' => auth()->id(),
        //     'room_id' => $roomId,
        //     'arrival_date' => $request->input('arrival_date'),
        //     'departure_date' => $request->input('departure_date'),
        //     // Add other necessary booking details
        // ]);
    
        // Handle payment and booking confirmation here
        // For example, initiate a payment process or redirect to a payment gateway
    
        return response()->json(['success' => 'Booking confirmed.']);
    }
    


    public function showPaymentPage($id)
    {
        $room = Room::findOrFail($id);
        return view('home.payment', ['room' => $room]);
    }

    public function createCheckoutSession(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|integer|exists:rooms,id',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:arrival_date',
        ]);
    
        $room = Room::findOrFail($validatedData['room_id']);
        $amount = $room->price * 100; // Amount in cents
    
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Room Booking',
                            ],
                            'unit_amount' => $amount,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
                'metadata' => [
                    'room_id' => $validatedData['room_id'],
                    'arrival_date' => $validatedData['arrival_date'],
                    'departure_date' => $validatedData['departure_date'],
                ],
            ]);
    
            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');
        
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
    
            if ($paymentIntent->status !== 'succeeded') {
                return redirect()->route('payment.cancel')->with('message', 'Payment was not successful.');
            }
    
            $roomId = $session->metadata->room_id;
            $room = Room::find($roomId);
    
            if (!$room) {
                return redirect()->route('payment.cancel')->with('message', 'Room not found.');
            }
    
            $booking = new Booking();
            $booking->user_id = auth()->id();
            $booking->room_id = $room->id;
            $booking->amount_paid = $paymentIntent->amount_received / 100; // Convert to dollars
            $booking->arrival_date = $session->metadata->arrival_date;
            $booking->departure_date = $session->metadata->departure_date;
            $booking->save();
    
            // Pass the payment and booking details to the view
            return view('home.payment-success', [
                'room' => $room,
                'amountPaid' => $booking->amount_paid,
                'arrivalDate' => $booking->arrival_date,
                'departureDate' => $booking->departure_date
            ]);
        } catch (\Exception $e) {
            return redirect()->route('payment.cancel')->with('message', 'There was an error processing your payment.');
        }
    }
    
    
    public function paymentCancel()
    {
        return view('home.payment-cancel', [
            'message' => 'Your payment was canceled. Please try again or contact support if you need assistance.'
        ]);
    }

    public function cancelBooking(Request $request)
    {
        // Validate the booking ID
        $validatedData = $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);
    
        // Find the booking by ID and check if it belongs to the authenticated user
        $booking = Booking::where('id', $validatedData['booking_id'])
                          ->where('user_id', auth()->id())
                          ->first();
    
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found.');
        }
    
        // Mark the room as available (assuming you have an 'is_available' field in the rooms table)
        $room = $booking->room;
        $room->is_available = true;
        $room->save();
    
        // Delete the booking
        $booking->delete();
    
        // Redirect with a success message
        return redirect()->route('rooms.index')->with('success', 'Booking has been canceled successfully.');
    }

    
    
}