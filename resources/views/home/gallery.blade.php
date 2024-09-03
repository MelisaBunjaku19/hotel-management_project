<div class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Gallery</h2>
                </div>
            </div>
        </div>
        <!-- Filter Buttons -->
        <div class="row">
            <div class="col-md-12">
                <div class="gallery-filter">
                    <button class="btn filter-btn active" data-filter="all">All</button>
                    <button class="btn filter-btn" data-filter="deluxe">Deluxe</button>
                    <button class="btn filter-btn" data-filter="standard">Standard</button>
                    <button class="btn filter-btn" data-filter="suite">Suite</button>
                </div>
            </div>
        </div>
        <!-- Gallery Images -->
        <div class="row gallery-items">
            <!-- Deluxe Images -->
            <div class="col-md-3 col-sm-6 gallery-item" data-category="deluxe">
                <figure class="gallery_img">
                    <img src="images/deluxe1.jpg" alt="Deluxe Image 1"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="deluxe">
                <figure class="gallery_img">
                    <img src="images/deluxe2.jpeg" alt="Deluxe Image 2"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="deluxe">
                <figure class="gallery_img">
                    <img src="images/deluxe3.jpg" alt="Deluxe Image 3"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="deluxe">
                <figure class="gallery_img">
                    <img src="images/deluxe4.jpg" alt="Deluxe Image 4"/>
                </figure>
            </div>

            <!-- Standard Images -->
            <div class="col-md-3 col-sm-6 gallery-item" data-category="standard">
                <figure class="gallery_img">
                    <img src="images/standard1.jpg" alt="Standard Image 1"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="standard">
                <figure class="gallery_img">
                    <img src="images/standard2.jpg" alt="Standard Image 2"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="standard">
                <figure class="gallery_img">
                    <img src="images/standard3.jpg" alt="Standard Image 3"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="standard">
                <figure class="gallery_img">
                    <img src="images/standard4.jpg" alt="Standard Image 4"/>
                </figure>
            </div>

            <!-- Suite Images -->
            <div class="col-md-3 col-sm-6 gallery-item" data-category="suite">
                <figure class="gallery_img">
                    <img src="images/suite1.jpeg" alt="Suite Image 1"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="suite">
                <figure class="gallery_img">
                    <img src="images/suite2.jpg" alt="Suite Image 2"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="suite">
                <figure class="gallery_img">
                    <img src="images/suite3.jpg" alt="Suite Image 3"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="suite">
                <figure class="gallery_img">
                    <img src="images/suite4.avif" alt="Suite Image 4"/>
                </figure>
            </div>
            <div class="col-md-3 col-sm-6 gallery-item" data-category="suite">
                <figure class="gallery_img">
                    <img src="images/suite5.jpg" alt="Suite Image 5"/>
                </figure>
            </div>
        </div>
    </div>
</div>

<style>
.gallery {
    padding: 30px 0;
}

.titlepage h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    text-align: center;
}

.gallery-filter {
    text-align: center;
    margin-bottom: 30px;
}

.gallery-filter .filter-btn {
    margin: 0 5px;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    background-color: #d3d3d3; /* Light gray color */
    color: #333; /* Darker text color for contrast */
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.3s;
}

.gallery-filter .filter-btn:hover {
    background-color: #b0b0b0; /* Slightly darker gray on hover */
    transform: scale(1.05); /* Slightly enlarge the button on hover */
}

.gallery-filter .filter-btn.active {
    background-color: #a0a0a0; /* Darker gray for active state */
    color: #000; /* Black text color for better visibility */
}

.gallery_img img {
    width: 100%;
    height: 200px; /* Adjust height as needed */
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery_img img:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.gallery-item {
    padding: 5px;
}

@media (min-width: 768px) {
    .gallery-item {
        padding: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');

            // Toggle active class on buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Show/hide gallery items
            galleryItems.forEach(item => {
                const category = item.getAttribute('data-category');
                item.style.display = filter === 'all' || category === filter ? 'block' : 'none';
            });
        });
    });

    // Initialize with 'all' filter
    document.querySelector('.filter-btn.active')?.click();
});
</script>