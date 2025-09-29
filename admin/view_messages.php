<?php
session_start();
if(!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once __DIR__ . '/../db.php';

$stmt = $conn->prepare("SELECT id, name, email, message, created_at FROM messages ORDER BY created_at DESC");
$stmt->execute();
$res = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Messages</title><link rel="stylesheet" href="../style.css"></head>
<body>
<section style="padding:30px;">
  <h2>Messages</h2>
  <table border="1" cellpadding="8" cellspacing="0" style="width:100%; background:#0b0c0c;">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>
    <?php while($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?=htmlspecialchars($row['id'])?></td>
        <td><?=htmlspecialchars($row['name'])?></td>
        <td><?=htmlspecialchars($row['email'])?></td>
        <td><?=nl2br(htmlspecialchars($row['message']))?></td>
        <td><?=htmlspecialchars($row['created_at'])?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</section>
</body>
</html>
<?php $stmt->close(); ?>
