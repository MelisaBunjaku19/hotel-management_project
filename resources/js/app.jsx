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
import Testimonials from './Components/Testimonials';
import Help from './Components/Help';
import TermsOfService from './Components/TermsOfService';// Adjust the import path as necessary

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



// Render the Testimonials component in the specified root element
if (document.getElementById('testimonials-root')) {
    ReactDOM.render(<Testimonials />, document.getElementById('testimonials-root'));
}



if (document.getElementById('help-root')) {
    ReactDOM.render(<Help />, document.getElementById('help-root'));
}

if (document.getElementById('terms-root')) {
    ReactDOM.render(<TermsOfService />, document.getElementById('terms-root'));
}