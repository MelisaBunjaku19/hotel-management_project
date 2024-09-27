// resources/js/components/About.js
import React from 'react';
import './About.css'; // Create a CSS file for custom styles

const About = () => {
    return React.createElement('div', { className: 'about' },
        React.createElement('div', { className: 'container' },
            React.createElement('div', { className: 'titlepage' },
                React.createElement('h2', null, 'About Us'),
                React.createElement('p', null,
                    'Welcome to HotelH, where luxury meets comfort. Our mission is to provide an unforgettable experience to every guest that walks through our doors.'
                ),
                React.createElement('a', { href: '#more-info', className: 'btn-primary' }, 'Learn More')
            ),
            React.createElement('div', { className: 'about_img' },
                React.createElement('img', { src: require('../images/about-image.jpg'), alt: 'About Us' })
            ),
            React.createElement('div', { className: 'more-info', id: 'more-info' },
                React.createElement('div', { className: 'info-item' },
                    React.createElement('h3', null, 'Our Mission'),
                    React.createElement('p', null, 'To deliver exceptional service and a memorable experience.')
                ),
                React.createElement('div', { className: 'info-item' },
                    React.createElement('h3', null, 'Our Vision'),
                    React.createElement('p', null, 'To be the leading hotel brand known for excellence and hospitality.')
                )
            )
        )
    );
};

export default About;
