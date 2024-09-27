// resources/js/app.js
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import React from 'react';
import ReactDOM from 'react-dom';
import About from './Components/About';
import Navbar from './Components/Navbar'; // Import Navbar if needed

if (document.getElementById('about-root')) {
    ReactDOM.render(<About />, document.getElementById('about-root'));
}
if (document.getElementById('navbar-root')) {
    ReactDOM.render(<Navbar />, document.getElementById('navbar-root'));
}