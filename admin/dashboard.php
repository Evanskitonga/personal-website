<?php
session_start();
if(!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Admin Dashboard</title><link rel="stylesheet" href="../style.css"></head>
<body>
<section style="padding:40px;">
  <h2>Admin Dashboard</h2>
  <p>Welcome, <?=htmlspecialchars($_SESSION['admin_username'])?></p>
  <ul>
    <li><a href="add_project.php">Add Project</a></li>
    <li><a href="add_blog.php">Add Blog Post</a></li>
    <li><a href="view_messages.php">View Messages</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</section>
</body>
</html>
