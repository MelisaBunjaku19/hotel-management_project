<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Integration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Random Rooms from Firestore</h1>
        <p id="status" class="text-center">Initializing Firebase...</p>

        <h2 class="mt-5">Add/Edit Room</h2>
        <form id="roomForm" class="mt-3">
            <div class="form-group">
                <label for="roomType">Room Type</label>
                <input type="text" id="roomType" class="form-control" placeholder="e.g., Single, Double, Suite" required>
            </div>
            <div class="form-group">
                <label for="roomTitle">Room Title</label>
                <input type="text" id="roomTitle" class="form-control" placeholder="Enter room title" required>
            </div>
            <div class="form-group">
                <label for="roomDescription">Room Description</label>
                <textarea id="roomDescription" class="form-control" rows="3" placeholder="Enter room description" required></textarea>
            </div>
            <div class="form-group">
                <label for="wifi">Wi-Fi</label>
                <select id="wifi" class="form-control" required>
                    <option value="">Select Wi-Fi availability</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" class="form-control" placeholder="Enter room price" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submitButton">Add Room</button>
        </form>

        <h2 class="mt-5">Random Rooms Data:</h2>
        <div id="firestoreData" class="mt-3"></div> <!-- Container to display Firestore data -->
    </div>

    <script type="module">
        // Import Firebase functions
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-app.js";
        import { getFirestore, collection, addDoc, getDocs, updateDoc, doc, deleteDoc } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-firestore.js";

        // Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBpYDuH3-nkhL726RkDtVEdsqOSPvZM_Lw",
            authDomain: "hotel-d1090.firebaseapp.com",
            projectId: "hotel-d1090",
            storageBucket: "hotel-d1090.appspot.com",
            messagingSenderId: "255293456828",
            appId: "1:255293456828:web:0b3e2d44126dd901142bb9",
            measurementId: "G-QV8J0QCN5D"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);
        document.getElementById('status').innerText = 'Firebase Initialized Successfully';

        // Function to create a room object
        function createRoom(type, title, description, wifi, price) {
            return {
                type: type,
                title: title,
                description: description,
                wifi: wifi,
                price: price,
                timestamp: new Date().toISOString()
            };
        }

        // Function to add a new room
        async function addRoom() {
            const type = document.getElementById('roomType').value;
            const title = document.getElementById('roomTitle').value;
            const description = document.getElementById('roomDescription').value;
            const wifi = document.getElementById('wifi').value;
            const price = document.getElementById('price').value;

            const room = createRoom(type, title, description, wifi, price);

            try {
                await addDoc(collection(db, "roomsCollection"), room);
                document.getElementById('status').innerText = 'Room added successfully.';
                fetchFirestoreData();
                document.getElementById('roomForm').reset();
            } catch (error) {
                console.error("Error adding document: ", error);
                document.getElementById('status').innerText = 'Error adding document: ' + error.message;
            }
        }

        // Function to fetch random rooms from Firestore
        async function fetchFirestoreData() {
            try {
                const querySnapshot = await getDocs(collection(db, "roomsCollection"));
                const roomsArray = [];

                querySnapshot.forEach((doc) => {
                    roomsArray.push({ id: doc.id, ...doc.data() });
                });

                // Shuffle and display the rooms
                roomsArray.sort(() => Math.random() - 0.5);
                const randomRooms = roomsArray.slice(0, 5);
                const firestoreDataDiv = document.getElementById('firestoreData');
                firestoreDataDiv.innerHTML = '';

                randomRooms.forEach((room) => {
                    const formattedTimestamp = new Date(room.timestamp).toLocaleString();
                    const roomCard = `
                        <div class="card mb-3" id="${room.id}">
                            <div class="card-body">
                                <h5 class="card-title">${room.type} - ${room.title}</h5>
                                <p class="card-text">${room.description}</p>
                                <p class="card-text">Wi-Fi: ${room.wifi}</p>
                                <p class="card-text">Price: $${room.price}</p>
                                <p class="card-text"><small class="text-muted">Published on ${formattedTimestamp}</small></p>
                                <button class="btn btn-warning" onclick="editRoom('${room.id}', '${room.type}', '${room.title}', '${room.description}', '${room.wifi}', '${room.price}')">Edit</button>
                                <button class="btn btn-danger" onclick="deleteRoom('${room.id}')">Delete</button>
                            </div>
                        </div>
                    `;
                    firestoreDataDiv.insertAdjacentHTML('beforeend', roomCard);
                });
            } catch (error) {
                console.error("Error fetching documents: ", error);
                document.getElementById('firestoreData').innerText = 'Error fetching documents: ' + error.message;
            }
        }

        // Function to edit a room
        window.editRoom = (id, type, title, description, wifi, price) => {
            document.getElementById('roomType').value = type;
            document.getElementById('roomTitle').value = title;
            document.getElementById('roomDescription').value = description;
            document.getElementById('wifi').value = wifi;
            document.getElementById('price').value = price;
            document.getElementById('roomForm').dataset.editingId = id;

            const submitButton = document.getElementById('submitButton');
            submitButton.innerText = 'Update Room';
        }

        // Submit event to handle room updates or additions
        document.getElementById('roomForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const editingId = document.getElementById('roomForm').dataset.editingId;
            if (editingId) {
                // Update the room
                const updatedRoom = createRoom(
                    document.getElementById('roomType').value,
                    document.getElementById('roomTitle').value,
                    document.getElementById('roomDescription').value,
                    document.getElementById('wifi').value,
                    document.getElementById('price').value
                );
                try {
                    await updateDoc(doc(db, "roomsCollection", editingId), updatedRoom);
                    document.getElementById('status').innerText = 'Room updated successfully.';
                    fetchFirestoreData();
                    document.getElementById('roomForm').reset();
                    delete document.getElementById('roomForm').dataset.editingId;
                    const submitButton = document.getElementById('submitButton');
                    submitButton.innerText = 'Add Room';
                } catch (error) {
                    console.error("Error updating document: ", error);
                    document.getElementById('status').innerText = 'Error updating document: ' + error.message;
                }
            } else {
                addRoom();
            }
        });

        // Function to delete a room
        window.deleteRoom = async (id) => {
            try {
                await deleteDoc(doc(db, "roomsCollection", id));
                document.getElementById('status').innerText = 'Room deleted successfully.';
                fetchFirestoreData();
            } catch (error) {
                console.error("Error deleting document: ", error);
                document.getElementById('status').innerText = 'Error deleting document: ' + error.message;
            }
        }

        // Fetch random rooms on page load
        fetchFirestoreData();
    </script>
</body>
</html>
