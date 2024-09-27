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
        <h1 class="text-center">Firebase Integration Page</h1>
        <p class="text-center">This is where you will integrate Firebase.</p>
        <p id="status" class="text-center">Loading Firebase...</p>
        
        <h2 class="mt-5">Add/Edit Blog Post</h2>
        <form id="blogForm" class="mt-3">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Blog Post</button>
        </form>

        <h2 class="mt-5">Data from Firestore:</h2>
        <div id="firestoreData" class="mt-3"></div> <!-- Container to display Firestore data -->
    </div>

    <script type="module">
        // Import Firebase functions
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-analytics.js";
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
        const analytics = getAnalytics(app);
        const db = getFirestore(app);
        document.getElementById('status').innerText = 'Firebase Initialized Successfully';

        // Function to create a blog post object
        function createBlogPost(title, content) {
            return {
                title: title,
                content: content,
                timestamp: new Date().toISOString()
            };
        }

        // Function to add a new blog post
        async function addBlogPost() {
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;

            const blogPost = createBlogPost(title, content);

            try {
                await addDoc(collection(db, "testCollection"), blogPost);
                document.getElementById('status').innerText = 'Blog post added successfully.';
                fetchFirestoreData();
                document.getElementById('blogForm').reset();
            } catch (error) {
                console.error("Error adding document: ", error);
                document.getElementById('status').innerText = 'Error adding document: ' + error.message;
            }
        }

        // Function to fetch data from Firestore
        async function fetchFirestoreData() {
            try {
                const querySnapshot = await getDocs(collection(db, "testCollection"));
                const firestoreDataDiv = document.getElementById('firestoreData');
                firestoreDataDiv.innerHTML = '';

                querySnapshot.forEach((doc) => {
                    const data = doc.data();
                    const formattedTimestamp = new Date(data.timestamp).toLocaleString();

                    const blogCard = `
                        <div class="card mb-3" id="${doc.id}">
                            <div class="card-body">
                                <h5 class="card-title">${data.title}</h5>
                                <p class="card-text">${data.content}</p>
                                <p class="card-text"><small class="text-muted">Published on ${formattedTimestamp}</small></p>
                                <button class="btn btn-warning" onclick="editBlogPost('${doc.id}', '${data.title}', '${data.content}')">Edit</button>
                                <button class="btn btn-danger" onclick="deleteBlogPost('${doc.id}')">Delete</button>
                            </div>
                        </div>
                    `;
                    firestoreDataDiv.insertAdjacentHTML('beforeend', blogCard);
                });
            } catch (error) {
                console.error("Error fetching documents: ", error);
                const firestoreDataDiv = document.getElementById('firestoreData');
                firestoreDataDiv.innerText = 'Error fetching documents: ' + error.message;
            }
        }

        // Function to edit a blog post
        window.editBlogPost = (id, title, content) => {
            document.getElementById('title').value = title;
            document.getElementById('content').value = content;
            document.getElementById('blogForm').dataset.editingId = id; // Store the ID for editing

            // Change the button text to "Update Blog Post"
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.innerText = 'Update Blog Post';
        }

        // Update the blog post when the form is submitted
        document.getElementById('blogForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const editingId = document.getElementById('blogForm').dataset.editingId; // Get the ID of the blog being edited
            if (editingId) {
                // If we are editing, update the blog post
                const updatedBlogPost = createBlogPost(document.getElementById('title').value, document.getElementById('content').value);

                try {
                    await updateDoc(doc(db, "testCollection", editingId), updatedBlogPost);
                    document.getElementById('status').innerText = 'Blog post updated successfully.';
                    fetchFirestoreData();
                    document.getElementById('blogForm').reset();
                    delete document.getElementById('blogForm').dataset.editingId; // Clear editing ID
                    const submitButton = document.querySelector('button[type="submit"]');
                    submitButton.innerText = 'Add Blog Post'; // Reset the button text
                } catch (error) {
                    console.error("Error updating document: ", error);
                    document.getElementById('status').innerText = 'Error updating document: ' + error.message;
                }
            } else {
                // If not editing, add a new blog post
                addBlogPost();
            }
        });

        // Function to delete a blog post
        window.deleteBlogPost = async (id) => {
            try {
                await deleteDoc(doc(db, "testCollection", id));
                document.getElementById('status').innerText = 'Blog post deleted successfully.';
                fetchFirestoreData();
            } catch (error) {
                console.error("Error deleting document: ", error);
                document.getElementById('status').innerText = 'Error deleting document: ' + error.message;
            }
        }

        // Fetch existing blog posts when the page loads
        fetchFirestoreData();

    </script>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
