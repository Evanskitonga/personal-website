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

</body>
</html>
