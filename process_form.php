<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: contact.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if($name === '' || $email === '' || $message === ''){
    echo "All fields are required. <a href='contact.php'>Go back</a>";
    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalid email. <a href='contact.php'>Go back</a>";
    exit;
}

// Prepared statement
$stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $name, $email, $message);
if($stmt->execute()){
    echo "<p>Message sent successfully. Thank you!</p>";
    echo "<p><a href='index.php'>Back to home</a></p>";
} else {
    echo "Error: " . htmlspecialchars($stmt->error);
}
$stmt->close();
$conn->close();
?>
