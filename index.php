<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Home - MyPortfolio</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="hero">
  <div class="hero-text">
    <h1>Hi, I'm <strong>Evans Kitonga</strong></h1>
    <p>Web Developer • Designer • Freelancer — I build modern, responsive websites and apps.</p>
    <a class="btn" href="contact.php">Hire Me</a>
  </div>
</section>

<section>
  <h2>About Me</h2>
  <div class="about-grid">
    <img src="uploads/profile.jpg" alt="profile image">
    <div class="about-text">
      <p>Hello — I'm Evans, a web developer who creates attractive and functional websites. I work with PHP, MySQL, JavaScript and modern frontend frameworks.</p>
      <ul>
        <li>✔ Web Development (PHP & MySQL)</li>
        <li>✔ Frontend (HTML/CSS/JS, React)</li>
        <li>✔ UI/UX Design & Responsive Layouts</li>
      </ul>
      <a class="btn" href="about.php">Read More</a>
    </div>
  </div>
</section>

<section>
  <h2>Services</h2>
  <div class="services-grid">
    <div class="service-card">
      <h3>Web Development</h3>
      <p>Custom websites, CMS, e-commerce and more.</p>
    </div>
    <div class="service-card">
      <h3>UI/UX Design</h3>
      <p>Clean, modern interfaces focused on usability.</p>
    </div>
    <div class="service-card">
      <h3>Backend APIs</h3>
      <p>REST API development and integration.</p>
    </div>
    <div class="service-card">
      <h3>Mobile Friendly</h3>
      <p>Responsive design for all devices.</p>
    </div>
  </div>
</section>

<section>
  <h2>Featured Work</h2>
  <div class="portfolio-grid">
    <?php
    include 'db.php';
    $stmt = $conn->prepare("SELECT id,title,description,image FROM portfolio ORDER BY created_at DESC LIMIT 6");
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      $img = $row['image'] ? 'uploads/'.htmlspecialchars($row['image']) : 'https://via.placeholder.com/600x400?text=No+Image';
      echo "<div class='portfolio-item'>";
      echo "<img src='".htmlspecialchars($img)."' alt='".htmlspecialchars($row['title'])."'>";
      echo "<h3>".htmlspecialchars($row['title'])."</h3>";
      echo "<p>".htmlspecialchars(substr($row['description'],0,140))."</p>";
      echo "</div>";
    }
    $stmt->close();
    ?>
  </div>
</section>

<?php include 'footer.php'; ?>



<script>
document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('nav');
  
  if (menuToggle) {
    menuToggle.addEventListener('click', function() {
      nav.classList.toggle('active');
    });
  }
  
  // Close mobile menu when clicking on a link
  const navLinks = document.querySelectorAll('nav a');
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      nav.classList.remove('active');
    });
  });
  
  // Scroll animations
  const fadeElements = document.querySelectorAll('.service-card, .portfolio-item, .about-grid > *');
  
  const appearOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -100px 0px"
  };
  
  const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('appear');
      appearOnScroll.unobserve(entry.target);
    });
  }, appearOptions);
  
  fadeElements.forEach(element => {
    element.classList.add('fade-in');
    appearOnScroll.observe(element);
  });
  
  // Header background on scroll
  window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (window.scrollY > 100) {
      header.style.background = 'rgba(16, 18, 20, 0.95)';
      header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
    } else {
      header.style.background = 'rgba(16, 18, 20, 0.85)';
      header.style.boxShadow = 'none';
    }
  });
});
</script>

</body>
</html>
