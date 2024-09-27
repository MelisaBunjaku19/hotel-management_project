<!-- User Navbar -->
<header>
    <!-- header inner -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                <img src="images/hotel.png" alt="OnlineHotel" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <nav class="navigation navbar navbar-expand-md navbar-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about') }}">About</a>
                                </li>
                                <li class="nav-item">
    <a class="nav-link" href="{{ route('rooms.index') }}">Rooms</a>
</li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('bookings.index') }}">Bookings</a>
                                </li>
                            </ul>
                            <!-- Authentication Links -->
                            <ul class="navbar-nav ml-auto">
                                @if (Route::has('login'))
                                    @auth
                                        <!-- Profile and Logout options for authenticated users -->
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                                    Profile
                                                </a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @else
                                        <!-- Menu for guests -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('login') }}">Login</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('register') }}">Register</a>
                                            </li>
                                        @endif
                                    @endauth
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="navbar-root"></div> <!-- React component will render here -->
</header>
<!-- end header inner -->
<!-- end header -->

<script src="{{ mix('js/app.js') }}"></script> <!-- Adjust the path according to your setup -->