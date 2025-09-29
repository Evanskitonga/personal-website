<?php
session_start();
if(!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once __DIR__ . '/../db.php';
$success = $error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if($title === '' || $content === '') { $error = "Title and content required."; }
    else {
        $stmt = $conn->prepare("INSERT INTO blog (title, content) VALUES (?, ?)");
        $stmt->bind_param('ss', $title, $content);
        if($stmt->execute()) $success = "Blog added.";
        else $error = "DB error: " . htmlspecialchars($stmt->error);
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Add Blog</title><link rel="stylesheet" href="../style.css"></head>
<body>
<section style="padding:40px;">
  <h2>Add Blog Post</h2>
  <?php if($success) echo "<p style='color:green;'>$success</p>"; ?>
  <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="POST">
    <input name="title" placeholder="Blog title" required>
    <textarea name="content" placeholder="Content (HTML allowed)" rows="10" required></textarea>
    <button type="submit">Publish</button>
  </form>
</section>
</body>
</html>
