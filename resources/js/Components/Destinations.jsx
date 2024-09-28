import React, { useState } from 'react';
import { Box, Typography, Grid, Paper, Accordion, AccordionSummary, AccordionDetails, Button, Dialog, DialogTitle, DialogContent, DialogActions, List, ListItem, ListItemText } from '@mui/material';
import { Add } from '@mui/icons-material';
import Carousel from 'react-material-ui-carousel';

const destinationsData = [
    {
        title: 'Bali, Indonesia',
        description: 'Experience the paradise of Bali with stunning beaches and vibrant culture.',
        image: '/images/destination1.jpg',
    },
    {
        title: 'Paris, France',
        description: 'Discover the charm of Paris, the city of love and lights.',
        image: '/images/destination2.webp',
    },
    {
        title: 'Sarande, Albania',
        description: 'Explore the vibrant beaches of Albania with iconic landmarks and attractions.',
        image: '/images/destination3.jpg',
    },
    {
        title: 'Cape Town, South Africa',
        description: 'Discover the breathtaking landscapes and diverse culture of Cape Town.',
        image: '/images/destination4.jpg',
    },
    {
        title: 'Rome, Italy',
        description: 'Explore the ancient ruins and rich history of the Eternal City.',
        image: '/images/destination5.jpg',
    },
    {
        title: 'Kyoto, Japan',
        description: 'Immerse yourself in the ancient temples and beautiful gardens of Kyoto.',
        image: '/images/destination6.jpg',
    },
    {
        title: 'Barcelona, Spain',
        description: 'Enjoy the vibrant culture and stunning architecture of Barcelona.',
        image: '/images/destination7.jpeg',
    },
    {
        title: 'Lisbon, Portugal',
        description: 'Discover the stunning coastline and colorful streets of Lisbon.',
        image: '/images/destination8.jpg',
    }
];

const Destinations = () => {
    const [expanded, setExpanded] = useState(false);
    const [openDialog, setOpenDialog] = useState(false);

    const handleAccordionChange = (panel) => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    };

    const handleDialogToggle = () => {
        setOpenDialog(!openDialog);
    };

    return (
        <Box sx={{ 
            backgroundColor: '#121212', 
            padding: '20px 0', 
            fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"' 
        }}>
            <Box sx={{ textAlign: 'center', padding: '0 20px' }}>
                <Typography variant="h4" sx={{ color: '#ff4081', marginBottom: '20px', fontFamily: 'inherit' }}>
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
                    {destinationsData.map(({ image, title, description }, index) => (
                        <Paper key={index} sx={{ position: 'relative', height: '400px' }}>
                            <img
                                src={image}
                                alt={title}
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
                                <Typography variant="h6" sx={{ fontFamily: 'inherit' }}>{title}</Typography>
                                <Typography variant="body2" sx={{ fontFamily: 'inherit' }}>{description}</Typography>
                            </Box>
                        </Paper>
                    ))}
                </Carousel>

                <Box sx={{ marginTop: '40px' }}>
                    <Typography variant="h5" sx={{ color: '#ff4081', marginBottom: '20px', fontFamily: 'inherit' }}>
                        Why Visit These Destinations?
                    </Typography>
                    <Grid container spacing={3} justifyContent="center">
                        {[ 
                            {
                                title: 'Cultural Experiences',
                                text: 'Immerse yourself in the rich history and vibrant cultures of each destination.',
                                image: '/images/cultural_experiences.jpg',
                            },
                            {
                                title: 'Breathtaking Landscapes',
                                text: 'Enjoy stunning views and natural beauty at each location.',
                                image: '/images/breathtaking_landscapes.jpg',
                            },
                            {
                                title: 'Adventure Awaits',
                                text: 'Find unique adventures and activities to experience during your visit.',
                                image: '/images/adventure.jpg',
                            },
                        ].map(({ title, text, image }, index) => (
                            <Grid item xs={12} sm={6} md={4} key={index}>
                                <Accordion expanded={expanded === `panel${index}`} onChange={handleAccordionChange(`panel${index}`)} sx={{ backgroundColor: '#2a2a2a', borderRadius: '10px', marginBottom: '10px' }}>
                                    <AccordionSummary
                                        expandIcon={<Add sx={{ color: '#ff4081' }} />}
                                        aria-controls={`panel${index}d-content`}
                                        id={`panel${index}d-header`}
                                        sx={{ '&.Mui-expanded': { backgroundColor: '#3c3c3c' } }}
                                    >
                                        <Typography sx={{ color: '#ff4081', fontWeight: 'bold', fontSize: '1.2rem', fontFamily: 'inherit' }}>{title}</Typography>
                                    </AccordionSummary>
                                    <AccordionDetails sx={{ flexDirection: 'column', backgroundColor: '#1c1c1c', borderRadius: '10px', padding: '15px' }}>
                                        <Typography sx={{ color: '#f0f4f8', fontFamily: 'inherit', marginBottom: '10px' }}>{text}</Typography>
                                        <img src={image} alt={title} style={{ width: '100%', borderRadius: '10px' }} />
                                    </AccordionDetails>
                                </Accordion>
                            </Grid>
                        ))}
                    </Grid>
                </Box>

           {/* New Section for Advice on Online Hotel Management and Payment Methods */}
{/* New Section for Advice on Navigating Online Hotel Management and Payment Methods */}
<Box sx={{ marginTop: '40px', padding: '20px', backgroundColor: '#2a2a2a', borderRadius: '10px', display: 'flex', alignItems: 'center' }}>
    <Box sx={{ flex: 1, paddingRight: '20px' }}>
        <Typography variant="h5" sx={{ color: '#ff4081', marginBottom: '20px', fontFamily: 'inherit' }}>
            How To Navigate Our Online Hotel Management System
        </Typography>
        <Typography sx={{ color: '#f0f4f8', marginBottom: '20px' }}>
            Follow these steps to manage your bookings efficiently:
        </Typography>
        <List sx={{ color: '#f0f4f8', marginBottom: '20px' }}>
            <ListItem sx={{ display: 'list-item' }}>
                <ListItemText primary="1. Book a room from our available listings." />
            </ListItem>
            <ListItem sx={{ display: 'list-item' }}>
                <ListItemText primary="2. Confirm your booking details on the confirmation page." />
            </ListItem>
            <ListItem sx={{ display: 'list-item' }}>
                <ListItemText primary="3. Proceed to payment through our secure Stripe gateway." />
            </ListItem>
            <ListItem sx={{ display: 'list-item' }}>
                <ListItemText primary="4. Redirect to your bookings page where all your reservations are saved." />
            </ListItem>
        </List>
        <Typography sx={{ color: '#f0f4f8' }}>
            Enjoy seamless and secure transactions with various payment methods available!
        </Typography>
    </Box>
    <Box sx={{ flex: 1 }}>
        <img 
            src="/images/payment_methods.jpg" // Adjust the image path as needed
            alt="Payment Methods" 
            style={{ width: '100%', borderRadius: '10px', transition: 'transform 0.3s', '&:hover': { transform: 'scale(1.05)' } }} 
        />
    </Box>
</Box>


                <Button 
                    variant="contained" 
                    sx={{ backgroundColor: '#ff4081', color: '#fff', marginTop: '20px' }} 
                    onClick={handleDialogToggle}
                >
                    Learn More
                </Button>

                {/* Dialog with additional links */}
                <Dialog open={openDialog} onClose={handleDialogToggle}>
                    <DialogTitle sx={{ color: '#ff4081' }}>Learn More About Our Destinations</DialogTitle>
                    <DialogContent>
                        <Typography sx={{ marginBottom: '20px', color: '#555' }}>
                            Explore our various offerings and activities in these beautiful destinations.
                        </Typography>
                        <Typography variant="h6" sx={{ color: '#ff4081', marginBottom: '10px' }}>
                            Explore More:
                        </Typography>
                        <ul style={{ listStyleType: 'none', padding: 0 }}>
                            <li>
                                <Button
                                    component="a"
                                    href="/rooms" // Adjust the path as needed
                                    sx={{ color: '#ff4081', textDecoration: 'underline', padding: 0 }}
                                >
                                    Visit the Rooms We Offer
                                </Button>
                            </li>
                            <li>
                                <Button
                                    component="a"
                                    href="/blog" // Adjust the path as needed
                                    sx={{ color: '#ff4081', textDecoration: 'underline', padding: 0 }}
                                >
                                    Visit Our Blogs
                                </Button>
                            </li>
                            <li>
                                <Button
                                    component="a"
                                    href="/about" // Adjust the path as needed
                                    sx={{ color: '#ff4081', textDecoration: 'underline', padding: 0 }}
                                >
                                    Learn About Us
                                </Button>
                            </li>
                        </ul>
                    </DialogContent>
                    <DialogActions>
                        <Button onClick={handleDialogToggle} sx={{ color: '#ff4081' }}>Close</Button>
                    </DialogActions>
                </Dialog>
            </Box>
        </Box>
    );
};

export default Destinations;
