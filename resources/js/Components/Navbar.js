import React from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
    return (
        <header>
            <div className="header">
                <div className="container">
                    <div className="row">
                        <div className="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div className="full">
                                <div className="center-desk">
                                    <div className="logo">
                                        <img src="images/hotel.png" alt="OnlineHotel" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav className="navigation navbar navbar-expand-md navbar-dark">
                                <button
                                    className="navbar-toggler"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#navbarNav"
                                    aria-controls="navbarNav"
                                    aria-expanded="false"
                                    aria-label="Toggle navigation"
                                >
                                    <span className="navbar-toggler-icon"></span>
                                </button>
                                <div className="collapse navbar-collapse" id="navbarNav">
                                    <ul className="navbar-nav">
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/">Home</Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/about">About</Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/rooms">Rooms</Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/blog">Blog</Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/contact">Contact</Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" to="/bookings">Bookings</Link>
                                        </li>
                                    </ul>
                                    {/* Authentication Links */}
                                    <ul className="navbar-nav ml-auto">
                                        {document.getElementById('user-auth') ? (
                                            <>
                                                {/* Profile and Logout options for authenticated users */}
                                                <li className="nav-item dropdown">
                                                    <a
                                                        id="navbarDropdown"
                                                        className="nav-link dropdown-toggle"
                                                        href="#"
                                                        role="button"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        {document.getElementById('user-name').innerText} <span className="caret"></span>
                                                    </a>
                                                    <div className="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <Link className="dropdown-item" to="/profile">
                                                            Profile
                                                        </Link>
                                                        <Link className="dropdown-item" to="/logout" onClick={(e) => { e.preventDefault(); document.getElementById('logout-form').submit(); }}>
                                                            Logout
                                                        </Link>
                                                        <form id="logout-form" action="/logout" method="POST" style={{ display: 'none' }}>
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        </form>
                                                    </div>
                                                </li>
                                            </>
                                        ) : (
                                            <>
                                                {/* Menu for guests */}
                                                <li className="nav-item">
                                                    <Link className="nav-link" to="/login">Login</Link>
                                                </li>
                                                <li className="nav-item">
                                                    <Link className="nav-link" to="/register">Register</Link>
                                                </li>
                                            </>
                                        )}
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Navbar;
