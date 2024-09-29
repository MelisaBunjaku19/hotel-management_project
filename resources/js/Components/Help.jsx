import React, { useState } from 'react';
import { Box, Typography, Grid, Paper, Button } from '@mui/material';
import { useSpring, animated } from 'react-spring';

const Help = () => {
    // Animation for the entrance
    const props = useSpring({ opacity: 1, from: { opacity: 0 }, config: { duration: 800 } });

    // State to manage the expanded sections
    const [expandedSection, setExpandedSection] = useState(null);

    // Function to toggle the expanded section
    const toggleSection = (section) => {
        setExpandedSection(expandedSection === section ? null : section);
    };

    // FAQs Array
    const faqs = [
        {
            question: 'How do I make a reservation?',
            answer: 'To make a reservation, navigate to the booking section, select your desired room, choose your dates, and follow the prompts to complete the booking.'
        },
        {
            question: 'What is your cancellation policy?',
            answer: 'Our cancellation policy allows you to cancel your reservation up to 24 hours before your arrival date for a full refund.'
        },
        {
            question: 'Can I change my reservation details?',
            answer: 'Yes, you can change your reservation details by logging into your account and accessing your bookings.'
        },
        {
            question: 'What payment methods do you accept?',
            answer: 'We accept various payment methods including credit cards, debit cards, and online payment systems like PayPal and Stripe.'
        }
    ];

    return (
        <animated.div style={props}>
            <Box sx={{ padding: '40px', backgroundColor: '#1e1e1e', color: '#f0f4f8', fontFamily: 'Arial, sans-serif' }}>
                <Typography variant="h2" align="center" sx={{ color: '#ff4081', marginBottom: '20px' }}>
                    Help & Support
                </Typography>
                <Typography variant="body1" align="center" sx={{ fontSize: '18px', marginBottom: '30px', lineHeight: '1.6' }}>
                    Welcome to the Help Center! Here you'll find answers to common questions and information on how to use our services effectively.
                </Typography>
                
                <Grid container spacing={4} justifyContent="center">
                    {faqs.map((faq, index) => (
                        <Grid item xs={12} sm={6} md={4} key={index}>
                            <Paper elevation={3} sx={{ padding: '20px', backgroundColor: '#2a2a2a', textAlign: 'center' }}>
                                <Typography variant="h6" sx={{ color: '#ff4081', marginBottom: '10px' }}>
                                    {faq.question}
                                </Typography>
                                <Button
                                    variant="outlined"
                                    sx={{ color: '#ff4081', borderColor: '#ff4081', marginBottom: '10px' }}
                                    onClick={() => toggleSection(index)}
                                >
                                    {expandedSection === index ? 'Read Less' : 'Read More'}
                                </Button>
                                {expandedSection === index && (
                                    <Typography variant="body2" sx={{ color: '#f0f4f8', marginTop: '10px' }}>
                                        {faq.answer}
                                    </Typography>
                                )}
                            </Paper>
                        </Grid>
                    ))}
                </Grid>

                <Box sx={{ marginTop: '40px', textAlign: 'center' }}>
                    <Typography variant="h5" sx={{ color: '#ff4081', marginBottom: '20px' }}>
                        Contact Us
                    </Typography>
                    <Typography variant="body1" sx={{ marginBottom: '10px' }}>
                        If you need further assistance, feel free to reach out to our support team:
                    </Typography>
                    <Typography>Email: <a href="mailto:support@onlinehotel.com" style={{ color: '#ff4081' }}>support@onlinehotel.com</a></Typography>
                    <Typography>Phone: <a href="tel:+1234567890" style={{ color: '#ff4081' }}>+1 (234) 567-890</a></Typography>
                </Box>

                <Box sx={{ marginTop: '40px', textAlign: 'center' }}>
                    <Typography variant="h5" sx={{ color: '#ff4081', marginBottom: '20px' }}>
                        Helpful Resources
                    </Typography>
                    <ul style={{ listStyleType: 'none', padding: 0 }}>
                        <li><a href="/terms" style={{ color: '#ff4081', textDecoration: 'none' }}>Terms of Service</a></li>
   
                        <li><a href="/about" style={{ color: '#ff4081', textDecoration: 'none' }}>More FAQs in our About Us page!</a></li>
                    </ul>
                </Box>
            </Box>
        </animated.div>
    );
};

export default Help;
