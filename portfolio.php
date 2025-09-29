<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Portfolio - MyPortfolio</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'; ?>

<section>
  <h2>Portfolio</h2>
  <div class="portfolio-grid">
    <?php
    $stmt = $conn->prepare("SELECT id,title,description,image FROM portfolio ORDER BY created_at DESC");
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      $img = $row['image'] ? 'uploads/'.htmlspecialchars($row['image']) : 'https://via.placeholder.com/600x400?text=No+Image';
      echo "<div class='portfolio-item'>";
      echo "<img src='".htmlspecialchars($img)."' alt='".htmlspecialchars($row['title'])."'>";
      echo "<h3>".htmlspecialchars($row['title'])."</h3>";
      echo "<p>".htmlspecialchars($row['description'])."</p>";
      echo "</div>";
    }
    $stmt->close();
    ?>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
