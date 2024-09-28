import React from 'react';
import { Typography, Box, Rating } from '@mui/material';

// Testimonial data
const testimonialsData = [
    {
        id: 1,
        name: 'Laura Adams',
        rating: 5,
        comment: 'The online hotel management system made booking a breeze! The interface is user-friendly and intuitive.',
    },
    {
        id: 2,
        name: 'James Wilson',
        rating: 4,
        comment: 'I was able to manage my reservations effortlessly. The customer support was fantastic too!',
    },
    {
        id: 3,
        name: 'Sophia Turner',
        rating: 5,
        comment: 'Everything is streamlined. I loved how easy it was to access my booking history and make changes.',
    },
    {
        id: 4,
        name: 'David Chen',
        rating: 3,
        comment: 'Good overall experience, but I wish there were more payment options available.',
    },
    {
        id: 5,
        name: 'Ella Martinez',
        rating: 5,
        comment: 'The system is incredibly efficient. I could easily compare room rates and availability in one place.',
    },
    {
        id: 6,
        name: 'Michael Johnson',
        rating: 4,
        comment: 'Great experience with the online system! The notifications kept me informed every step of the way.',
    },
];

// Testimonials component
const Testimonials = () => {
    return (
        <Box 
            sx={{ 
                padding: '40px', 
                backgroundColor: '#1e1e1e', 
                borderRadius: '10px', 
                maxWidth: '800px', 
                margin: '40px auto', 
                boxShadow: 3 
            }}
        >
            <Typography variant="h4" sx={{ color: '#ff4081', marginBottom: '20px', textAlign: 'center' }}>
                What Our Guests Say
            </Typography>

            {testimonialsData.map((testimonial) => (
                <Box 
                    key={testimonial.id} 
                    sx={{ 
                        marginBottom: '20px', 
                        padding: '20px', 
                        backgroundColor: '#2a2a2a', 
                        borderRadius: '10px', 
                        boxShadow: 2 
                    }}
                >
                    <Typography variant="h6" sx={{ color: '#ff4081' }}>
                        {testimonial.name}
                    </Typography>
                    <Rating name="read-only" value={testimonial.rating} readOnly sx={{ marginBottom: '10px' }} />
                    <Typography variant="body1" sx={{ color: '#e0e0e0' }}>
                        {testimonial.comment}
                    </Typography>
                </Box>
            ))}
        </Box>
    );
};

// Main App component
const App = () => (
    <Box 
        sx={{ 
            backgroundColor: '#121212', 
            minHeight: '100vh', 
            padding: '20px',
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center',
        }}
    >
        <Testimonials />
    </Box>
);

export default App;
