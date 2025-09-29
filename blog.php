<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Blog - MyPortfolio</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'; ?>

<section>
  <h2>Blog</h2>
  <div class="blog-grid">
    <?php
    $stmt = $conn->prepare("SELECT id,title,content,created_at FROM blog ORDER BY created_at DESC");
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
      echo "<div class='blog-card'>";
      echo "<h3>".htmlspecialchars($row['title'])."</h3>";
      echo "<p>".htmlspecialchars(substr(strip_tags($row['content']),0,240))."... </p>";
      echo "<small>Posted: ".htmlspecialchars($row['created_at'])."</small>";
      echo "</div>";
    }
    $stmt->close();
    ?>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
