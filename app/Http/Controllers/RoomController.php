<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Review;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all rooms query
        $query = Room::query();
    
        // Fetch the booked rooms by querying the bookings table
        $bookedRoomIds = Booking::pluck('room_id')->toArray();
    
        // Apply room type filter if provided
        if ($request->filled('room_type')) {
            $query->where('room_type', $request->input('room_type'));
        }
    
        // Apply price range filter if provided
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
    
        if (is_numeric($minPrice) && is_numeric($maxPrice)) {
            // Ensure that minPrice is less than or equal to maxPrice
            $minPrice = floatval($minPrice);
            $maxPrice = floatval($maxPrice);
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif (is_numeric($minPrice)) {
            // If only min_price is provided
            $minPrice = floatval($minPrice);
            $query->where('price', '>=', $minPrice);
        } elseif (is_numeric($maxPrice)) {
            // If only max_price is provided
            $maxPrice = floatval($maxPrice);
            $query->where('price', '<=', $maxPrice);
        }
    
        // Apply Wi-Fi filter if provided
        if ($request->filled('wifi')) {
            $wifi = $request->input('wifi');
            // Convert 'yes' to 1 and 'no' to 0
            $wifiValue = ($wifi === 'yes') ? 1 : 0;
            $query->where('wifi', $wifiValue);
        }
    
        // Apply booking status filter if provided
        if ($request->filled('booking_status')) {
            $bookingStatus = $request->input('booking_status');
    
            if ($bookingStatus === 'booked') {
                // Filter for booked rooms
                $query->whereIn('id', $bookedRoomIds);
            } elseif ($bookingStatus === 'available') {
                // Filter for available rooms
                $query->whereNotIn('id', $bookedRoomIds);
            } elseif ($bookingStatus === 'booked_by_me') {
                // Filter for rooms booked by the logged-in user
                $userBookedRoomIds = Booking::where('user_id', auth()->id())->pluck('room_id')->toArray();
                $query->whereIn('id', $userBookedRoomIds);
            }
        }
    
        // Fetch the filtered rooms
        $rooms = $query->get();
    
        // Fetch the rooms booked by the logged-in user for displaying separately if needed
        $userBookedRoomIds = Booking::where('user_id', auth()->id())->pluck('room_id')->toArray();
    
        // Return the view and pass the necessary data
        return view('home.rooms', compact('rooms', 'bookedRoomIds', 'userBookedRoomIds'));
    }
    
    
    
    
    // Display a listing of all rooms in the admin dashboard
    public function adminIndex(Request $request)
    {
        $sortField = $request->input('sort', 'id'); // Default to sorting by ID
        $sortDirection = $request->input('direction', 'asc'); // Default to ascending order

        // Validate sort field and direction
        $validSortFields = ['id', 'room_title', 'price', 'room_type'];
        if (!in_array($sortField, $validSortFields)) {
            $sortField = 'id'; // Default to ID if invalid field
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc'; // Default to ascending if invalid direction
        }

        // Fetch and sort rooms
        $rooms = Room::orderBy($sortField, $sortDirection)->get();

        return view('admin.index_room', compact('rooms', 'sortField', 'sortDirection'));
    }

    // Show the form to create a new room
    public function create()
    {
        return view('admin.add_room'); // Ensure this view file exists
    }

    // Store a newly created room in storage
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'room_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'room_type' => 'required|string',
            'wifi' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $validatedData['image'] = $filename;
        }

        // Create the room
        Room::create($validatedData);

        // Redirect with success message
        return redirect()->route('admin.index_room')->with('success', 'Room added successfully!');
    }

    // Show the form to edit a specific room
    public function edit($id)
    {
        $room = Room::findOrFail($id); // Fetch room by ID or fail if not found
        return view('admin.edit_room', compact('room')); // Return the edit view with room data
    }

    // Update the specified room in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'room_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'room_type' => 'required|string',
            'wifi' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
        ]);
    
        $room = Room::findOrFail($id);
        $room->room_title = $request->input('room_title');
        $room->description = $request->input('description');
        $room->price = $request->input('price');
        $room->room_type = $request->input('room_type');
        $room->wifi = $request->input('wifi');
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($room->image && file_exists(public_path('images/' . $room->image))) {
                unlink(public_path('images/' . $room->image));
            }
            
            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $room->image = $imageName;
        }
    
        $room->save();
    
        return redirect()->route('admin.index_room')->with('success', 'Room updated successfully!');
    }

    // Show the confirmation for deleting a room
    public function confirm($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.delete_room', compact('room')); // Confirm delete view
    }

    // Delete the specified room
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.index_room')->with('success', 'Room deleted successfully.');
    }

    // Display a listing of all rooms in the admin dashboard
    public function showAvailability()
    {
        // Fetch all rooms
        $rooms = Room::all();

        // Fetch the booked room IDs
        $bookedRoomIds = Booking::pluck('room_id')->toArray();

        // Determine availability for each room
        foreach ($rooms as $room) {
            $room->is_available = !in_array($room->id, $bookedRoomIds);
        }

        // Pass the data to the view
        return view('admin.room_availability', compact('rooms', 'bookedRoomIds'));
    }
    public function storeReview(Request $request, $roomId)
    {
        // Validate the rating
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Check if user has already submitted a review for this room
        $existingReview = Review::where('user_id', auth()->id())
                                ->where('room_id', $roomId)
                                ->first();
    
        if ($existingReview) {
            return response()->json(['success' => false, 'message' => 'You have already submitted a review for this room.']);
        }
    
        // Create a new review
        Review::create([
            'user_id' => auth()->id(),
            'room_id' => $roomId,
            'rating' => $request->rating,
            'review' => $request->input('review', null), // Optional review text
        ]);
    
        return response()->json(['success' => true, 'message' => 'Rating submitted successfully!']);
    }
    
}
