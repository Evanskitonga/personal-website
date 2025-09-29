<?php
// Only run this once to create the first admin user.
// After creating user, delete this file or restrict access.
require_once __DIR__ . '/../db.php';

$message = '';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if($username === '' || $password === ''){
        $message = "Username and password are required.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $hash);
        if($stmt->execute()){
            $message = "Admin user created. Please remove or secure create_admin.php now.";
        } else {
            $message = "Error creating admin: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Create Admin</title><link rel="stylesheet" href="../style.css"></head>
<body>
<section style="padding:40px;">
  <h2>Create Admin User (One-time)</h2>
  <?php if($message) echo "<p>$message</p>"; ?>
  <form method="POST">
    <input name="username" placeholder="username" required>
    <input name="password" placeholder="password" required type="password">
    <button type="submit">Create Admin</button>
  </form>
  <p>After creating, delete or secure this file.</p>
</section>
</body>
</html>
