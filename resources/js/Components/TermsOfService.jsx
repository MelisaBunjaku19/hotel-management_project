import React from 'react';
import { Box, Typography, Container } from '@mui/material';
import { motion } from 'framer-motion'; // For animations
import { FaCheckCircle } from 'react-icons/fa'; // For icons

const TermsOfService = () => {
  return (
    <Box
      sx={{
        backgroundColor: '#1A1A1A', // Dark background for the entire page
        minHeight: '100vh', // Fill the viewport height
        padding: '40px', // Space around the content
      }}
    >
      <Container maxWidth="md">
        <Box
          component={motion.div}
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
          sx={{
            backgroundColor: '#333', // Dark gray background for the main container
            padding: '40px',
            borderRadius: '8px',
            boxShadow: '0 4px 20px rgba(0, 0, 0, 0.1)',
          }}
        >
          <Typography
            variant="h2"
            align="center"
            sx={{ color: '#ffffff', marginBottom: '30px', fontFamily: '"Roboto", sans-serif' }}
          >
            Terms of Service
          </Typography>

          {/* Section with Icon */}
          {sections.map((section, index) => (
            <Box
              key={index}
              sx={{
                marginTop: '30px',
                backgroundColor: index % 2 === 0 ? '#444' : '#555', // Lighter gray backgrounds for sections
                borderRadius: '8px',
                padding: '20px',
                transition: '0.3s', // Transition for hover effect
                '&:hover': {
                  backgroundColor: '#666', // Change color on hover
                  boxShadow: '0 6px 30px rgba(0, 0, 0, 0.2)', // Shadow on hover
                },
              }}
            >
              <Typography
                variant="h5"
                sx={{ display: 'flex', alignItems: 'center', fontWeight: 'bold', color: '#ff4081' }} // Bright color for the title
              >
                <FaCheckCircle style={{ color: '#4CAF50', marginRight: '8px' }} />
                {section.title}
              </Typography>
              <Typography variant="body1" sx={{ lineHeight: '1.6', marginTop: '10px', color: '#ffffff' }}>
                {section.content}
              </Typography>
            </Box>
          ))}

          <Typography variant="body1" sx={{ lineHeight: '1.6', marginTop: '20px', fontStyle: 'italic', color: '#ffffff' }}>
            For questions regarding these Terms of Service, please contact us at{' '}
            <a href="mailto:support@onlinehotel.com" style={{ color: '#ff4081' }}>support@onlinehotel.com</a>
          </Typography>
        </Box>

        {/* Optional Decorative Element */}
        <Box
          component={motion.div}
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.7, delay: 0.3 }}
          sx={{
            marginTop: '40px',
            padding: '20px',
            borderRadius: '8px',
            backgroundColor: '#444',
            textAlign: 'center',
          }}
        >
          <Typography variant="h6" sx={{ fontWeight: 'bold', color: '#ffffff' }}>
            Thank you for choosing us! Enjoy your stay!
          </Typography>
        </Box>
      </Container>
    </Box>
  );
};

// Data for sections
const sections = [
  {
    title: '1. Acceptance of Terms',
    content:
      'By accessing or using our services, you agree to be bound by these Terms of Service and our Privacy Policy. If you do not agree, please do not use our services.',
  },
  {
    title: '2. Changes to Terms',
    content:
      'We may modify these Terms of Service from time to time. We will notify you of any changes by posting the new terms on our website. Your continued use of the service after any changes constitutes your acceptance of the new terms.',
  },
  {
    title: '3. User Responsibilities',
    content:
      'You are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer. You agree to accept responsibility for all activities that occur under your account or password.',
  },
  {
    title: '4. Service Availability',
    content:
      'We strive to provide the best possible service, but we cannot guarantee that the service will be uninterrupted, secure, or free of errors. We may need to suspend the service for maintenance or other reasons.',
  },
  {
    title: '5. Limitation of Liability',
    content:
      'To the fullest extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of our service.',
  },
  {
    title: '6. Governing Law',
    content:
      'These Terms of Service shall be governed by and construed in accordance with the laws of [Your Country/State]. Any disputes arising under or in connection with these terms shall be subject to the exclusive jurisdiction of the courts of [Your Location].',
  },
  {
    title: '7. Contact Information',
    content: 'If you have any questions about these Terms of Service, please contact us at support@onlinehotel.com.',
  },
];

export default TermsOfService;
