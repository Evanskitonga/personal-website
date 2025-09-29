<?php
session_start();
if(!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once __DIR__ . '/../db.php';

$success = $error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if($title === '' || $description === ''){
        $error = "Title and description required.";
    } else {
        // handle image
        $imageName = null;
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
            $fileTmp = $_FILES['image']['tmp_name'];
            $origName = basename($_FILES['image']['name']);
            $ext = pathinfo($origName, PATHINFO_EXTENSION);
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if(!in_array(strtolower($ext), $allowed)){
                $error = "Invalid image type. Allowed: " . implode(',', $allowed);
            } else {
                $newName = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $target = __DIR__ . '/../uploads/' . $newName;
                if(move_uploaded_file($fileTmp, $target)){
                    $imageName = $newName;
                } else {
                    $error = "Upload failed.";
                }
            }
        }
        if(!$error){
            $stmt = $conn->prepare("INSERT INTO portfolio (title, description, image) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $title, $description, $imageName);
            if($stmt->execute()){
                $success = "Project added.";
            } else {
                $error = "DB error: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Add Project</title><link rel="stylesheet" href="../style.css"></head>
<body>
<section style="padding:40px;">
  <h2>Add Project</h2>
  <?php if($success) echo "<p style='color:green;'>$success</p>"; ?>
  <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="POST" enctype="multipart/form-data">
    <input name="title" placeholder="Project title" required>
    <textarea name="description" placeholder="Project description" rows="6" required></textarea>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Add Project</button>
  </form>
</section>
</body>
</html>
