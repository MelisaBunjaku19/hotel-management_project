import React, { useState } from 'react';

// FeedbackForm Component
const FeedbackForm = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: '',
  });

  const [statusMessage, setStatusMessage] = useState('');
  const [buttonHover, setButtonHover] = useState(false);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch('/feedback', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(formData),
      });

      const data = await response.json();

      if (response.ok) {
        setStatusMessage({ text: 'Feedback submitted successfully!', type: 'success' });
        setFormData({ name: '', email: '', message: '' });
      } else {
        setStatusMessage({ text: data.message || 'Failed to submit feedback.', type: 'error' });
      }
    } catch (error) {
      console.error('Error submitting feedback:', error);
      setStatusMessage({ text: 'An error occurred while submitting feedback.', type: 'error' });
    }
  };

  return (
    <div style={styles.container}>
      <h2 style={styles.heading}>Feedback Form</h2>
      <form onSubmit={handleSubmit} style={styles.form}>
        <div style={styles.inputGroup}>
          <label style={styles.label}>Name:</label>
          <input
            type="text"
            name="name"
            value={formData.name}
            onChange={handleChange}
            style={styles.input}
            required
          />
        </div>
        <div style={styles.inputGroup}>
          <label style={styles.label}>Email:</label>
          <input
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            style={styles.input}
            required
          />
        </div>
        <div style={styles.inputGroup}>
          <label style={styles.label}>Message:</label>
          <textarea
            name="message"
            value={formData.message}
            onChange={handleChange}
            style={{ ...styles.input, height: '100px' }}
            required
          />
        </div>
        <button
          type="submit"
          style={{ ...styles.button, ...(buttonHover ? styles.buttonHover : {}) }}  // Use dynamic styles
          onMouseEnter={() => setButtonHover(true)}  // Hover effect
          onMouseLeave={() => setButtonHover(false)}  // Hover effect
        >
          Submit Feedback
        </button>
      </form>
      {statusMessage && (
        <div style={styles.notification(statusMessage.type)}>
          {statusMessage.text}
        </div>
      )}
    </div>
  );
};

// CSS Styles
const styles = {
  container: {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center',
    minHeight: '100vh',
    backgroundColor: '#1c1c1e', // Dark background color
    padding: '20px',
    fontFamily: 'Arial, sans-serif',
  },
  heading: {
    fontSize: '28px',
    marginBottom: '20px',
    color: '#ffffff', // White color for the heading
    textAlign: 'center',
  },
  form: {
    width: '100%',
    maxWidth: '500px',
    backgroundColor: '#2c2c2e', // Darker background for the form
    padding: '20px',
    borderRadius: '10px',
    boxShadow: '0 5px 15px rgba(0, 0, 0, 0.3)',
  },
  inputGroup: {
    marginBottom: '20px',
  },
  label: {
    display: 'block',
    marginBottom: '8px',
    fontSize: '16px',
    color: '#ffffff', // White label color
  },
  input: {
    width: '100%',
    padding: '12px',
    fontSize: '16px',
    borderRadius: '6px',
    border: '1px solid #444', // Dark border color
    backgroundColor: '#3a3a3c', // Dark background for inputs
    color: '#ffffff', // White text color for inputs
    boxSizing: 'border-box',
    outline: 'none',
    transition: 'border-color 0.2s',
  },
  button: {
    width: '100%',
    padding: '14px',
    fontSize: '16px',
    backgroundColor: '#007bff',
    color: '#fff',
    border: 'none',
    borderRadius: '6px',
    cursor: 'pointer',
    transition: 'background-color 0.3s',
  },
  buttonHover: {
    backgroundColor: '#0056b3',
  },
  notification: (type) => ({
    marginTop: '20px',
    padding: '10px 20px',
    borderRadius: '5px',
    width: '80%',
    maxWidth: '400px',
    color: '#fff',
    boxShadow: '0 4px 8px rgba(0, 0, 0, 0.3)',
    backgroundColor: type === 'success' ? '#28a745' : '#dc3545', // Green for success, red for error
    animation: 'fadeIn 0.5s ease-in-out', // Fade-in animation
    position: 'fixed',
    top: '50%',  // Center vertically
    left: '50%', // Center horizontally
    transform: 'translate(-50%, -50%)', // Centering effect
    zIndex: 1000, // Ensure it's above other content
    border: '1px solid',
    borderColor: type === 'success' ? '#218838' : '#c82333', // Darker shades for borders
  }),
};

// Keyframes for fade-in animation
const fadeInAnimation = `
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}`;

// Append keyframes to the document
const styleSheet = document.createElement("style");
styleSheet.type = "text/css";
styleSheet.innerText = fadeInAnimation;
document.head.appendChild(styleSheet);

export default FeedbackForm;
