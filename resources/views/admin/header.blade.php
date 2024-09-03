<header class="header">   
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <!-- Other Navbar Content -->

      <!-- User Section with Dropdown -->
      <div class="ml-auto d-flex align-items-center">
        <div class="dropdown">
          <button class="btn btn-dark dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i> {{ Auth::user()->name }} <!-- Dynamic User Name -->
          </button>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ route('admin.profile') }}">
  <i class="fa fa-user"></i> Profile
</a>
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
              @csrf
              <button type="submit" class="btn btn-dark btn-sm w-100 text-left">
                <i class="fa fa-sign-out"></i> Logout
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
<style>
  /* Navbar background color */
.navbar {
  background-color: #121417; /* Dark gray background for the navbar */
  padding: 0; /* Remove default padding */
  margin: 0; /* Remove default margin */
}

/* Position the user dropdown section to the far right */
.ml-auto {
  margin-left: auto;
}

/* Style the dropdown button */
.btn-dark {
  background-color: #000; /* Black background */
  border-color: #000;     /* Black border */
  color: #fff;            /* White text */
  padding: 0.5rem 1rem;   /* Adjust padding to fit the design */
}

.btn-dark:hover {
  background-color: #333; /* Dark gray background on hover */
  border-color: #333;     /* Dark gray border on hover */
  color: #fff;            /* White text */
}

/* Dropdown menu styles */
.dropdown-menu {
  background-color: #000; /* Black background for dropdown */
  border: 1px solid #333; /* Dark border for dropdown */
  padding: 0;            /* Remove default padding */
  margin: 0;             /* Remove default margin */
  box-shadow: none;      /* Remove default box-shadow */
}

/* Dropdown items styles */
.dropdown-menu .dropdown-item {
  color: #fff;            /* White text */
  padding: 10px 15px;    /* Adjust padding for items */
  margin: 0;             /* Remove margin to prevent extra spacing */
}

.dropdown-menu .dropdown-item:hover {
  background-color: #333; /* Dark gray background on hover */
  color: #fff;            /* White text on hover */
}

.dropdown-menu .dropdown-item i {
  margin-right: 5px; /* Space between icon and text */
}

/* Ensure no extra spaces in the dropdown form */
.dropdown-item form {
  margin: 0;
  padding: 0;
  display: flex;
}

/* Style for logout button inside the form */
.dropdown-item form .btn {
  background-color: #000; /* Black background for the button */
  border-color: #333;     /* Dark border */
  color: #fff;            /* White text */
}

.dropdown-item form .btn:hover {
  background-color: #333; /* Darker gray background on hover */
  border-color: #444;     /* Slightly lighter border on hover */
}

</style>