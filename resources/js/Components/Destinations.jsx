// Destinations.jsx
import React from 'react';
import { Box, Typography, Grid, Paper } from '@mui/material';
import Carousel from 'react-material-ui-carousel';
import ArrowForwardIcon from '@mui/icons-material/ArrowForward';

// Sample destination data
const destinationsData = [
    {
        title: 'Bali, Indonesia',
        description: 'Experience the paradise of Bali with stunning beaches and vibrant culture.',
        image: '/images/destination1.jpg', // Change this to your image path
    },
    {
        title: 'Paris, France',
        description: 'Discover the charm of Paris, the city of love and lights.',
        image: '/images/destination2.webp', // Change this to your image path
    },
    {
        title: 'Sarande, Albania',
        description: 'Explore the vibrant beaches of Albania with iconic landmarks and attractions.',
        image: '/images/destination3.jpg', // Change this to your image path
    },
   

    {
        title: 'Cape Town, South Africa',
        description: 'Discover the breathtaking landscapes and diverse culture of Cape Town.',
        image: '/images/destination4.jpg', // Change this to your image path
    },
    {
        title: 'Rome, Italy',
        description: 'Explore the ancient ruins and rich history of the Eternal City.',
        image: '/images/destination5.jpg', // Change this to your image path
    },
    {
        title: 'Kyoto, Japan',
        description: 'Immerse yourself in the ancient temples and beautiful gardens of Kyoto.',
        image: '/images/destination6.jpg', // Change this to your image path
    },
    {
        title: 'Barcelona, Spain',
        description: 'Enjoy the vibrant culture and stunning architecture of Barcelona.',
        image: '/images/destination7.jpeg', // Change this to your image path
    },
    {
        title: 'Lisbon, Portugal',
        description: 'Discover the stunning coastline and colorful streets of Lisbon.',
        image: '/images/destination8.jpg', // Change this to your image path
    },
    
    
];

const Destinations = () => {
    return (
        <Box sx={{ marginTop: '40px', textAlign: 'center', padding: '0 20px' }}>
            <Typography variant="h4" sx={{ color: '#ff4081', marginBottom: '20px' }}>
                Explore Our Top Destinations
            </Typography>
            <Carousel
                autoPlay={true}
                interval={5000}
                animation="slide"
                navButtonsAlwaysVisible={true}
                indicatorContainerProps={{
                    style: { display: 'flex', justifyContent: 'center', marginTop: '10px' },
                }}
            >
                {destinationsData.map((destination, index) => (
                    <Paper key={index} sx={{ position: 'relative', height: '400px' }}>
                        <img
                            src={destination.image}
                            alt={destination.title}
                            style={{
                                width: '100%',
                                height: '100%',
                                objectFit: 'cover',
                                borderRadius: '10px',
                            }}
                        />
                        <Box
                            sx={{
                                position: 'absolute',
                                bottom: '20px',
                                left: '20px',
                                backgroundColor: 'rgba(0, 0, 0, 0.5)',
                                color: '#fff',
                                padding: '10px',
                                borderRadius: '8px',
                            }}
                        >
                            <Typography variant="h6">{destination.title}</Typography>
                            <Typography variant="body2">{destination.description}</Typography>
                        </Box>
                    </Paper>
                ))}
            </Carousel>

            <Box sx={{ marginTop: '40px' }}>
                <Typography variant="h5" sx={{ color: '#ff4081', marginBottom: '20px' }}>
                    Why Visit These Destinations?
                </Typography>
                <Grid container spacing={3} justifyContent="center">
                    <Grid item xs={12} sm={6} md={4}>
                        <Paper sx={{ padding: '20px', backgroundColor: '#2a2a2a', borderRadius: '10px' }}>
                            <Typography variant="h6" sx={{ color: '#f0f4f8', textAlign: 'center', fontWeight: 'bold' }}>
                                Cultural Experiences
                            </Typography>
                            <Typography variant="body2" sx={{ color: '#f0f4f8' }}>
                                Immerse yourself in the rich history and vibrant cultures of each destination.
                            </Typography>
                        </Paper>
                    </Grid>
                    <Grid item xs={12} sm={6} md={4}>
                        <Paper sx={{ padding: '20px', backgroundColor: '#2a2a2a', borderRadius: '10px' }}>
                            <Typography variant="h6" sx={{ color: '#f0f4f8', textAlign: 'center', fontWeight: 'bold' }}>
                                Breathtaking Landscapes
                            </Typography>
                            <Typography variant="body2" sx={{ color: '#f0f4f8' }}>
                                Enjoy stunning views and natural beauty at each location.
                            </Typography>
                        </Paper>
                    </Grid>
                    <Grid item xs={12} sm={6} md={4}>
                        <Paper sx={{ padding: '20px', backgroundColor: '#2a2a2a', borderRadius: '10px' }}>
                            <Typography variant="h6" sx={{ color: '#f0f4f8', textAlign: 'center', fontWeight: 'bold' }}>
                                Adventure Awaits
                            </Typography>
                            <Typography variant="body2" sx={{ color: '#f0f4f8' }}>
                                Find unique adventures and activities to experience during your visit.
                            </Typography>
                        </Paper>
                    </Grid>
                </Grid>
            </Box>
        </Box>
    );
};

export default Destinations;
