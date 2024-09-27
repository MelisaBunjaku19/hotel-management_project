import React, { useState } from 'react';
import { Box, Typography, Grid, Paper, Button } from '@mui/material';
import { useSpring, animated } from 'react-spring';
import ArrowForwardIcon from '@mui/icons-material/ArrowForward';
import InfoIcon from '@mui/icons-material/Info'; // Importing an icon for tips

const HotelPamphlet = () => {
    // Animation for the entrance
    const props = useSpring({ opacity: 1, from: { opacity: 0 }, config: { duration: 800 } });

    // State to manage the expanded sections
    const [expandedSection, setExpandedSection] = useState(null);

    // Function to toggle the expanded section
    const toggleSection = (section) => {
        setExpandedSection(expandedSection === section ? null : section);
    };

    // Array of amenities with images
    const amenities = [
        { 
            title: 'Free Wi-Fi', 
            description: 'Stay connected with our complimentary high-speed internet access.', 
            details: 'Our Wi-Fi is available throughout the hotel, ensuring you can browse, stream, and connect without interruptions.',
            image: '/images/wifi.jpg' // Add the image path
        },
        { 
            title: 'Visit Our Blog', 
            description: 'Stay updated with the latest news and tips.', 
            details: 'Check out our blog for useful travel tips, local attractions, and hotel news. Stay informed and make the most of your stay!',
            image: '/images/blog.jpg' // Add the image path for the blog
        },
        { 
            title: 'Manage Your Bookings', 
            description: 'Easily manage your reservations online.', 
            details: 'With our user-friendly portal, you can view, modify, or cancel your bookings at any time. Stay in control of your travel plans effortlessly!',
            image: '/images/manage-bookings.jpg' // Update this to a relevant image
        },
        {
            title: 'Booking Info',
            description: 'Manage your bookings seamlessly through our online platform.',
            details: 'Easily view, modify, or cancel your reservations at any time. Visit our Booking Portal to get started!',
            image: '/images/booking.jpg' // Add the image path
        },
    ];

    // Array of guest information
    const guestInfo = [
        {
            title: 'Check-in / Check-out',
            description: 'Check-in: 3 PM | Check-out: 11 AM',
            details: 'Check-in is available from 3 PM onwards. Please note that check-out is required by 11 AM. Late check-out options may be available upon request. Early check-in is also available for an additional fee.',
            image: '/images/checkin-checkout.jpg' // Update this to a relevant image
        },
        {
            title: 'Cancellation Policy',
            description: 'Free cancellation up to 24 hours before check-in.',
            details: 'Guests can cancel their reservation without any charge up to 24 hours before the scheduled check-in time. Cancellations made after this period may incur a fee. Please review our terms and conditions for more information.',
            image: '/images/cancellation-policy.jpg' // Update this to a relevant image
        },
        {
            title: 'Help',
            description: 'Need assistance? Our friendly staff is available 24/7 to help you.',
            details: (
                <div>
                    Our hotel policy ensures that every guest is attended to promptly. 
                    For any inquiries, you can contact us via email at 
                    <a href="mailto:contact@onlinehotel.com" style={{ color: '#ff4081' }}> contact@onlinehotel.com</a> 
                    or ask questions on our 
                    <a href="https://forum.onlinehotel.com" style={{ color: '#ff4081' }}> forum</a>.
                    Our concierge is also available to assist with reservations and local recommendations.
                </div>
            ),
            image: '/images/help.jpg' // Update this to a relevant image
        },
    ];
    
    return (
        <animated.div style={props}>
            <Box sx={{ padding: '40px', backgroundColor: '#1e1e1e', color: '#f0f4f8', fontFamily: 'Arial, sans-serif' }}>
                <Typography variant="h2" align="center" sx={{ color: '#ff4081', marginBottom: '20px' }}>
                    Online Hotel Extra Information Centre
                </Typography>
                <Typography variant="body1" align="center" sx={{ fontSize: '18px', marginBottom: '30px', lineHeight: '1.6' }}>
                    Experience luxury and comfort at Online Hotel. Enjoy world-class amenities and personalized services designed to make your stay unforgettable.
                </Typography>
                
                <Grid container spacing={4} justifyContent="center">
                    {amenities.map((amenity) => (
                        <Grid item xs={12} sm={6} md={3} key={amenity.title}>
                            <Paper elevation={3} sx={{ padding: '20px', textAlign: 'center', backgroundColor: '#2a2a2a' }}>
                                <img src={amenity.image} alt={amenity.title} style={{ width: '100%', height: 'auto', borderRadius: '8px', marginBottom: '10px' }} />
                                <Typography variant="h6" sx={{ color: '#ff4081', marginBottom: '10px' }}>
                                    {amenity.title}
                                </Typography>
                                <Typography variant="body2" sx={{ color: '#f0f4f8' }}>{amenity.description}</Typography>
                                {amenity.details && (
                                    <>
                                        <Button
                                            variant="outlined"
                                            sx={{ marginTop: '10px', color: '#ff4081', borderColor: '#ff4081' }}
                                            onClick={() => toggleSection(amenity.title)}
                                        >
                                            {expandedSection === amenity.title ? 'Read Less' : 'Read More'}
                                        </Button>
                                        {expandedSection === amenity.title && (
                                            <Typography variant="body2" sx={{ color: '#f0f4f8', marginTop: '10px' }}>
                                                {amenity.details}
                                            </Typography>
                                        )}
                                    </>
                                )}
                            </Paper>
                        </Grid>
                    ))}
                </Grid>
    
                {/* New Section for Guest Information */}
                <Box sx={{ marginTop: '40px', textAlign: 'center' }}>
                    <Typography variant="h5" sx={{ color: '#ff4081', marginBottom: '20px' }}>
                        Guest Information
                    </Typography>
                    <Grid container spacing={4} justifyContent="center">
                        {guestInfo.map((info) => (
                            <Grid item xs={12} sm={6} md={3} key={info.title}>
                                <Paper elevation={3} sx={{ padding: '20px', textAlign: 'center', backgroundColor: '#2a2a2a' }}>
                                    <img src={info.image} alt={info.title} style={{ width: '100%', height: 'auto', borderRadius: '8px', marginBottom: '10px' }} />
                                    <Typography variant="h6" sx={{ color: '#ff4081', marginBottom: '10px' }}>
                                        {info.title}
                                    </Typography>
                                    <Typography variant="body2" sx={{ color: '#f0f4f8' }}>{info.description}</Typography>
                                    {info.details && (
                                        <>
                                            <Button
                                                variant="outlined"
                                                sx={{ marginTop: '10px', color: '#ff4081', borderColor: '#ff4081' }}
                                                onClick={() => toggleSection(info.title)}
                                            >
                                                {expandedSection === info.title ? 'Read Less' : 'Read More'}
                                            </Button>
                                            {expandedSection === info.title && (
                                                <Typography variant="body2" sx={{ color: '#f0f4f8', marginTop: '10px' }}>
                                                    {info.details}
                                                </Typography>
                                            )}
                                        </>
                                    )}
                                </Paper>
                            </Grid>
                        ))}
                    </Grid>
                </Box>
                <Box sx={{ marginTop: '40px', textAlign: 'center' }}>
    <Typography variant="h5" sx={{ color: '#ff4081', marginBottom: '20px' }}>
        Great Stay Advice
    </Typography>
    <Grid container spacing={3} justifyContent="center">
        {[
            {
                tip: 'Explore our local attractions and hidden gems.',
                image: '/images/local_attractions (2).jpg', // Add the relevant image path
            },
            {
                tip: 'Don’t hesitate to ask our staff for recommendations.',
                image: '/images/staff_recommendations.jpg', // Add the relevant image path
            },
            {
                tip: 'Join our loyalty program for exclusive discounts.',
                image: '/images/loyalty_program.jpg', // Add the relevant image path
            },
            {
                tip: 'Follow us on social media for the latest updates.',
                image: '/images/social_media.jpg', // Add the relevant image path
            },
        ].map((item, index) => (
            <Grid item xs={12} key={index}> {/* Each item in a new line */}
                <Paper
                    elevation={3}
                    sx={{
                        padding: '20px',
                        backgroundColor: '#2a2a2a',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center', // Center the content
                        borderRadius: '20px', // Rounded corners for Paper
                        transition: 'transform 0.3s, box-shadow 0.3s',
                        '&:hover': {
                            transform: 'scale(1.02)', // Scale up on hover
                            boxShadow: '0 8px 16px rgba(0, 0, 0, 0.3)', // Enhanced shadow on hover
                        },
                        marginBottom: '20px', // Space between each tip
                    }}
                    onClick={() => toggleSection(item.tip)} // Toggle section for the image
                >
                    <Box sx={{ display: 'flex', alignItems: 'center' }}>
                        <Typography 
                            variant="body2" // Smaller text size
                            sx={{ 
                                color: '#f0f4f8', 
                                borderRadius: '8px', // Rounded corners for the text
                                padding: '2px 5px', // Padding for the text
                                marginRight: '10px', // Space between text and arrow
                            }}
                        >
                            {item.tip}
                        </Typography>
                        <ArrowForwardIcon sx={{ color: '#ff4081' }} />
                    </Box>
                    <img 
                        src={expandedSection === item.tip ? item.image : ''} 
                        alt={item.tip} 
                        style={{ 
                            width: '300px', // Increased image size
                            height: 'auto', 
                            display: expandedSection === item.tip ? 'block' : 'none', 
                            marginTop: '10px', // Space between text and image
                            borderRadius: '8px', // Rounded corners for the image
                            boxShadow: '0 4px 8px rgba(0, 0, 0, 0.2)', // Shadow for the image
                            transition: 'transform 0.3s', // Smooth image transition
                        }} 
                    />
                </Paper>
            </Grid>
        ))}
    </Grid>
</Box>


            </Box>
        </animated.div>
    );
};

export default HotelPamphlet;
