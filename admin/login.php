<?php
session_start();
require_once __DIR__ . '/../db.php';

$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if($username === '' || $password === '') {
        $error = "Enter username and password.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if($row = $res->fetch_assoc()){
            if(password_verify($password, $row['password_hash'])){
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_username'] = $row['username'];
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Invalid credentials.";
            }
        } else {
            $error = "Invalid credentials.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Admin Login</title><link rel="stylesheet" href="../style.css"></head>
<body>
<section style="padding:40px;">
  <h2>Admin Login</h2>
  <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="POST">
    <input name="username" placeholder="Username" required>
    <input name="password" placeholder="Password" type="password" required>
    <button type="submit">Login</button>
  </form>
</section>
</body>
</html>
