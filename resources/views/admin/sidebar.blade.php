<nav id="sidebar">
    <!-- Sidebar Navigation Menus -->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-windows"></i>Hotel Rooms
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('admin.add_room') }}">Add Room</a>
    <a class="dropdown-item" href="{{ route('admin.index_room') }}">Show Rooms</a>
</div>

</li>

        
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="bookingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-bookmark"></i>Bookings
    </a>
    <div class="dropdown-menu" aria-labelledby="bookingsDropdown">
        <a class="dropdown-item" href="">Show Bookings</a>
        <a class="dropdown-item" href="">Add Booking</a>
    </div>
</li>


    

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-user"></i> Users
    </a>
    <div class="dropdown-menu" aria-labelledby="usersDropdown">
        <a class="dropdown-item" href="{{ route('admin.show_users') }}">Show Users</a>
        <a class="dropdown-item" href="{{ route('admin.add_user') }}">Add User</a>
    </div>
</li>


        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-settings"></i>Settings
    </a>
    <div class="dropdown-menu" aria-labelledby="settingsDropdown">
        <a class="dropdown-item" href="{{ route('admin.general') }}">General Settings</a>
      
    </div>
</li>


            <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-windows"></i>Blogs
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('admin.add_blog') }}">Add Blog</a>
    <a class="dropdown-item" href="{{ route('admin.show_blogs') }}">Show Blogs</a>
</div>

</li>



        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-tasks"></i>Tasks
            </a>
            <div class="dropdown-menu" aria-labelledby="tasksDropdown">
                <a class="dropdown-item" href="#">
                    <span class="badge badge-success mr-2"></span> Done
                </a>
                <a class="dropdown-item" href="#">
                    <span class="badge badge-warning mr-2"></span> In Progress
                </a>
                <a class="dropdown-item" href="#">
                    <span class="badge badge-primary mr-2"></span> Started
                </a>
                <a class="dropdown-item" href="#">
                    <span class="badge badge-secondary mr-2"></span> Pending
                </a>
            </div>
        </li>
      
    </ul>
</nav>
<style>
    .badge {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: currentColor;
        vertical-align: middle;
        margin-right: 5px;
    }

    .badge-success {
        color: #28a745; /* Green */
    }

    .badge-warning {
        color: #ffc107; /* Yellow */
    }

    .badge-primary {
        color: #007bff; /* Blue */
    }

    .badge-secondary {
        color: #6c757d; /* Grey */
    }
</style>
