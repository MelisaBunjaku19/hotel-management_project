<nav id="sidebar">
    <!-- Sidebar Navigation Menus -->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="active">
            <a href="index.html"> 
                <i class="fas fa-home"></i> Home 
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="hotelRoomsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bed"></i> Hotel Rooms
            </a>
            <div class="dropdown-menu" aria-labelledby="hotelRoomsDropdown">
                <a class="dropdown-item" href="{{ route('admin.add_room') }}">
                    <i class="fas fa-plus"></i> Add Room
                </a>
                <a class="dropdown-item" href="{{ route('admin.index_room') }}">
                    <i class="fas fa-list"></i> Show Rooms
                </a>
                <a class="dropdown-item" href="{{ route('admin.room_availability') }}">
                    <i class="fas fa-calendar-check"></i> Room Availability
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="bookingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-calendar-check"></i> Bookings
            </a>
            <div class="dropdown-menu" aria-labelledby="bookingsDropdown">
                <a class="dropdown-item" href="{{ route('admin.show_bookings') }}">
                    <i class="fas fa-list"></i> Show Bookings
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-users"></i> Users
            </a>
            <div class="dropdown-menu" aria-labelledby="usersDropdown">
                <a class="dropdown-item" href="{{ route('admin.show_users') }}">
                    <i class="fas fa-list"></i> Show Users
                </a>
                <a class="dropdown-item" href="{{ route('admin.add_user') }}">
                    <i class="fas fa-plus"></i> Add User
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="importDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-upload"></i> Import Data
    </a>
    <div class="dropdown-menu" aria-labelledby="importDropdown">
        <a class="dropdown-item" href="{{ route('admin.import_data') }}">
            <i class="fas fa-file-import"></i> Import Data
        </a>
        <a class="dropdown-item" href="{{ route('admin.display_data') }}">
            <i class="fas fa-file-alt"></i> Display Data
        </a>
    </div>
</li>

    

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cogs"></i> Settings
            </a>
            <div class="dropdown-menu" aria-labelledby="settingsDropdown">
                <a class="dropdown-item" href="{{ route('admin.general') }}">
                    <i class="fas fa-cog"></i> General Settings
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="blogsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-blog"></i> Blogs
            </a>
            <div class="dropdown-menu" aria-labelledby="blogsDropdown">
                <a class="dropdown-item" href="{{ route('admin.add_blog') }}">
                    <i class="fas fa-plus"></i> Add Blog
                </a>
                <a class="dropdown-item" href="{{ route('admin.show_blogs') }}">
                    <i class="fas fa-list"></i> Show Blogs
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks"></i> Tasks
            </a>
            <div class="dropdown-menu" aria-labelledby="tasksDropdown">
                <a class="dropdown-item" href="{{ route('admin.create') }}">
                    <i class="fas fa-plus"></i> Add Task
                </a>
                <a class="dropdown-item" href="{{ route('admin.tasks') }}">
                    <i class="fas fa-list"></i> Show All Tasks
                </a>
            </div>
        </li>
    </ul>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
