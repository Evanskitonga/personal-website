<?php
// about.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>About - MyPortfolio</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section>
  <h2>About Me</h2>
  <div class="about-grid">
    <img src="uploads/profile.jpg" alt="profile">
    <div class="about-text">
      <p><strong>Evans Kitonga</strong> — Web Developer focused on delivering clean, performant and user-friendly websites.</p>
      <p>I build full-stack solutions using PHP and modern frontend tech. I love solving problems and creating experiences that delight users.</p>
      <h3>Skills</h3>
      <ul>
        <li>PHP, MySQL, JavaScript</li>
        <li>HTML, CSS, Responsive Design</li>
        <li>React (optional), API integration</li>
      </ul>
      <a class="btn" href="uploads/CV.pdf" download>Download My CV</a>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
