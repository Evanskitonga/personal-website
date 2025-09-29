

<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact - MyPortfolio</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Contact Page Specific Styles */
    .contact-section {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 100px 6%;
      background: 
        radial-gradient(circle at 10% 20%, rgba(0, 209, 214, 0.08) 0%, transparent 40%),
        radial-gradient(circle at 90% 80%, rgba(33, 150, 243, 0.08) 0%, transparent 40%),
        radial-gradient(circle at 50% 50%, rgba(0, 168, 255, 0.05) 0%, transparent 50%);
      position: relative;
      overflow: hidden;
    }

    .contact-container {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 60px;
      max-width: 1200px;
      width: 100%;
      align-items: center;
    }

    .contact-info {
      padding: 40px;
      background: rgba(18, 19, 20, 0.7);
      border-radius: 25px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.05);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    .contact-info::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(0, 209, 214, 0.1) 0%, rgba(0, 168, 255, 0.1) 100%);
      z-index: -1;
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .contact-info:hover::before {
      opacity: 1;
    }

    .contact-info h2 {
      font-size: 2.8rem;
      margin-bottom: 10px;
      text-align: left;
      transform: translateX(-50%);
      left: 0;
      position: relative;
    }

    .contact-info h2::after {
      width: 80px;
      left: 0;
      transform: none;
    }

    .contact-info > p {
      font-size: 1.1rem;
      color: #cfeff1;
      margin-bottom: 40px;
      line-height: 1.7;
    }

    .contact-details {
      display: flex;
      flex-direction: column;
      gap: 25px;
      margin-bottom: 40px;
    }

    .contact-item {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px;
      border-radius: 12px;
      transition: all 0.3s ease;
      background: rgba(255, 255, 255, 0.02);
    }

    .contact-item:hover {
      background: rgba(0, 209, 214, 0.1);
      transform: translateX(10px);
    }

    .contact-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(135deg, #00d1d6, #00a8ff);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      color: #071018;
      flex-shrink: 0;
    }

    .contact-text h4 {
      font-size: 1.1rem;
      margin-bottom: 5px;
      color: #e9fbfc;
    }

    .contact-text p {
      color: #b9dfe1;
      font-size: 0.95rem;
    }

    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }

    .social-link {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #e6eef1;
      font-size: 1.2rem;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .social-link:hover {
      background: linear-gradient(135deg, #00d1d6, #00a8ff);
      transform: translateY(-5px);
      color: #071018;
    }

    /* Contact Form Styling */
    .contact-form-container {
      padding: 50px;
      background: rgba(18, 19, 20, 0.7);
      border-radius: 25px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.05);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }

    .contact-form-container::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(0, 209, 214, 0.05) 0%, transparent 70%);
      animation: rotate 15s linear infinite;
      z-index: -1;
    }

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .form-group {
      position: relative;
      margin-bottom: 30px;
    }

    .form-input {
      width: 100%;
      padding: 16px 20px;
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      outline: none;
      background: rgba(10, 11, 12, 0.7);
      color: #e6eef1;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-input:focus {
      border-color: #00d1d6;
      box-shadow: 0 0 0 3px rgba(0, 209, 214, 0.2);
      background: rgba(10, 11, 12, 0.9);
    }

    .form-label {
      position: absolute;
      top: 16px;
      left: 20px;
      color: #98dfe0;
      font-size: 1rem;
      pointer-events: none;
      transition: all 0.3s ease;
    }

    .form-input:focus + .form-label,
    .form-input:not(:placeholder-shown) + .form-label {
      top: -10px;
      left: 10px;
      font-size: 0.8rem;
      background: rgba(18, 19, 20, 0.9);
      padding: 0 8px;
      color: #00d1d6;
    }

    textarea.form-input {
      resize: vertical;
      min-height: 150px;
    }

    .submit-btn {
      width: 100%;
      padding: 16px;
      border-radius: 12px;
      border: none;
      background: linear-gradient(135deg, #00d1d6, #00a8ff);
      color: #071018;
      font-weight: 700;
      font-size: 1.1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    .submit-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #00a8ff, #00d1d6);
      transition: all 0.4s ease;
      z-index: -1;
    }

    .submit-btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 209, 214, 0.4);
    }

    .submit-btn:hover::before {
      left: 0;
    }

    .submit-btn i {
      margin-left: 8px;
      transition: transform 0.3s ease;
    }

    .submit-btn:hover i {
      transform: translateX(5px);
    }

    /* Floating Elements */
    .floating-element {
      position: absolute;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(0, 209, 214, 0.1), rgba(0, 168, 255, 0.1));
      filter: blur(40px);
      z-index: -1;
    }

    .floating-1 {
      width: 200px;
      height: 200px;
      top: 10%;
      left: 5%;
      animation: float 8s ease-in-out infinite;
    }

    .floating-2 {
      width: 150px;
      height: 150px;
      bottom: 15%;
      right: 8%;
      animation: float 10s ease-in-out infinite reverse;
    }

    .floating-3 {
      width: 100px;
      height: 100px;
      top: 50%;
      left: 80%;
      animation: float 12s ease-in-out infinite;
    }

    @keyframes float {
      0% {
        transform: translate(0, 0);
      }
      50% {
        transform: translate(-20px, -20px);
      }
      100% {
        transform: translate(0, 0);
      }
    }

    /* Success Message */
    .success-message {
      display: none;
      padding: 20px;
      background: rgba(46, 204, 113, 0.1);
      border: 1px solid rgba(46, 204, 113, 0.3);
      border-radius: 12px;
      color: #2ecc71;
      text-align: center;
      margin-bottom: 20px;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .contact-container {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      
      .contact-info, .contact-form-container {
        padding: 30px;
      }
      
      .contact-info h2 {
        font-size: 2.2rem;
      }
    }

    @media (max-width: 576px) {
      .contact-section {
        padding: 80px 4%;
      }
      
      .contact-info, .contact-form-container {
        padding: 25px;
      }
      
      .contact-info h2 {
        font-size: 1.8rem;
      }
      
      .contact-item {
        flex-direction: column;
        text-align: center;
        gap: 10px;
      }
      
      .social-links {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

<section class="contact-section">
  <!-- Floating Background Elements -->
  <div class="floating-element floating-1"></div>
  <div class="floating-element floating-2"></div>
  <div class="floating-element floating-3"></div>
  
  <div class="contact-container">
    <!-- Contact Information -->
    <div class="contact-info">
      <h2>Let's Connect</h2>
      <p>I'm always interested in new opportunities and collaborations. Feel free to reach out if you have a project in mind or just want to say hello!</p>
      
      <div class="contact-details">
        <div class="contact-item">
          <div class="contact-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="contact-text">
            <h4>Email</h4>
            <p>evanskitonga7@gmail.com</p>
          </div>
        </div>
        
        <div class="contact-item">
          <div class="contact-icon">
            <i class="fas fa-phone"></i>
          </div>
          <div class="contact-text">
            <h4>Phone</h4>
            <p>+254 717 179 975</p>
          </div>
        </div>
        
        <div class="contact-item">
          <div class="contact-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="contact-text">
            <h4>Location</h4>
            <p>Nairobi, Kenya</p>
          </div>
        </div>
      </div>
      
      <div class="social-links">
        <a href="https://www.linkedin.com/in/evans-kitonga-87384823a" class="social-link">
          <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="https://github.com/Evanskitonga" class="social-link">
          <i class="fab fa-github"></i>
        </a>
        <a href="#" class="social-link">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="social-link">
          <i class="fab fa-dribbble"></i>
        </a>
      </div>
    </div>
    
    <!-- Contact Form -->
    <div class="contact-form-container">
      <form id="contact-form" action="process_form.php" method="POST">
        <div id="success-message" class="success-message">
          <i class="fas fa-check-circle"></i> Thank you! Your message has been sent successfully.
        </div>
        
        <div class="form-group">
          <input type="text" name="name" id="name" class="form-input" placeholder=" " required>
          <label for="name" class="form-label">Your Name</label>
        </div>
        
        <div class="form-group">
          <input type="email" name="email" id="email" class="form-input" placeholder=" " required>
          <label for="email" class="form-label">Your Email</label>
        </div>
        
        <div class="form-group">
          <textarea name="message" id="message" class="form-input" placeholder=" " required></textarea>
          <label for="message" class="form-label">Your Message</label>
        </div>
        
        <button type="submit" class="submit-btn">
          Send Message <i class="fas fa-paper-plane"></i>
        </button>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script>
  // Form submission with animation
  document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // In a real implementation, you would submit the form via AJAX here
    // For demonstration, we'll just show the success message
    
    const successMessage = document.getElementById('success-message');
    successMessage.style.display = 'block';
    
    // Reset form after 3 seconds
    setTimeout(() => {
      this.reset();
      successMessage.style.display = 'none';
    }, 5000);
  });
  
  // Add floating animation to contact items on scroll
  document.addEventListener('DOMContentLoaded', function() {
    const contactItems = document.querySelectorAll('.contact-item');
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
        }
      });
    }, { threshold: 0.1 });
    
    contactItems.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateX(-20px)';
      item.style.transition = `all 0.5s ease ${index * 0.1}s`;
      observer.observe(item);
    });
  });
</script>
</body>
</html>