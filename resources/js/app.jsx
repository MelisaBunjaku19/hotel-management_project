// resources/js/app.js
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import React from 'react';
import ReactDOM from 'react-dom';
import About from './Components/About';
import Navbar from './Components/Navbar'; 
import HotelPamphlet from './Components/HotelPamphlet';
import Destinations from './Components/Destinations';
import { BrowserRouter as Router } from 'react-router-dom';
// Import Navbar if needed

if (document.getElementById('about-root')) {
    ReactDOM.render(<About />, document.getElementById('about-root'));
}
if (document.getElementById('navbar-root')) {
    ReactDOM.render(<Navbar />, document.getElementById('navbar-root'));
}

if (document.getElementById('hotel-pamphlet-root')) {
    ReactDOM.render(<HotelPamphlet />, document.getElementById('hotel-pamphlet-root'));
}



if (document.getElementById('destinations-root')) {
    ReactDOM.render(<Destinations />, document.getElementById('destinations-root'));
}