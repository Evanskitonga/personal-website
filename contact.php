<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact - MyPortfolio</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<section>
  <h2>Contact Me</h2>
  <form action="process_form.php" method="POST">
    <input name="name" type="text" placeholder="Your name" required>
    <input name="email" type="email" placeholder="Your email" required>
    <textarea name="message" rows="6" placeholder="Your message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
