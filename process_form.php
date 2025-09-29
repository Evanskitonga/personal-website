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
?> -->




<?php
include 'db.php';

// Include PHPMailer (make sure to install it first)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Or manually include PHPMailer files

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: contact.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validation
if($name === '' || $email === '' || $message === ''){
    header('Location: contact.php?status=error&message=All fields are required');
    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header('Location: contact.php?status=error&message=Invalid email address');
    exit;
}

// Store in database
$stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $name, $email, $message);

if($stmt->execute()){
    // Send email notification
    $emailSent = sendEmailNotification($name, $email, $message);
    
    if($emailSent) {
        header('Location: contact.php?status=success&message=Message sent successfully! We will get back to you soon.');
    } else {
        header('Location: contact.php?status=success&message=Message received! We will get back to you soon. (Email notification failed)');
    }
} else {
    header('Location: contact.php?status=error&message=Database error: ' . urlencode($stmt->error));
}

$stmt->close();
$conn->close();

/**
 * Send email notification to your Gmail
 */
function sendEmailNotification($name, $email, $message) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings for Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'evanskitonga7@gmail.com';
        $mail->Password = ''; //  App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('evanskitonga7@gmail.com', 'Portfolio Contact Form');
        $mail->addAddress('evanskitonga7@gmail.com'); // Your Gmail where you want to receive messages
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message from $name";
        
        // Beautiful email template
        $mail->Body = createEmailTemplate($name, $email, $message);
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message\n\nSent from your portfolio contact form.";
        
        return $mail->send();
        
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}


function createEmailTemplate($name, $email, $message) {
    $currentTime = date('F j, Y \a\t g:i A');
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { 
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background: white;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            }
            .header {
                background: linear-gradient(135deg, #00d1d6, #00a8ff);
                color: white;
                padding: 30px 20px;
                text-align: center;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
                font-weight: 600;
            }
            .content {
                padding: 30px;
            }
            .field {
                margin-bottom: 20px;
                padding: 15px;
                background: #f8f9fa;
                border-radius: 8px;
                border-left: 4px solid #00d1d6;
            }
            .label {
                font-weight: 600;
                color: #2c3e50;
                display: block;
                margin-bottom: 5px;
                font-size: 14px;
            }
            .value {
                color: #34495e;
                font-size: 16px;
            }
            .message-content {
                background: #e8f4f8;
                padding: 15px;
                border-radius: 8px;
                border: 1px solid #00d1d6;
                margin-top: 10px;
                line-height: 1.6;
            }
            .footer {
                text-align: center;
                padding: 20px;
                background: #f8f9fa;
                color: #7f8c8d;
                font-size: 12px;
                border-top: 1px solid #e9ecef;
            }
            .action-btn {
                display: inline-block;
                background: linear-gradient(135deg, #00d1d6, #00a8ff);
                color: white;
                padding: 12px 25px;
                text-decoration: none;
                border-radius: 25px;
                margin: 10px 5px;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>📧 New Portfolio Message</h1>
                <p>You have received a new contact form submission</p>
            </div>
            <div class='content'>
                <div class='field'>
                    <span class='label'>👤 Name</span>
                    <span class='value'>$name</span>
                </div>
                <div class='field'>
                    <span class='label'>📧 Email</span>
                    <span class='value'>$email</span>
                </div>
                <div class='field'>
                    <span class='label'>💬 Message</span>
                    <div class='message-content'>$message</div>
                </div>
                <div class='field'>
                    <span class='label'>📅 Date & Time</span>
                    <span class='value'>$currentTime</span>
                </div>
                
                <div style='text-align: center; margin-top: 30px;'>
                    <a href='mailto:$email' class='action-btn'>📧 Reply to $name</a>
                </div>
            </div>
            <div class='footer'>
                This message was sent from your portfolio contact form at " . $_SERVER['HTTP_HOST'] . ".
            </div>
        </div>
    </body>
    </html>
    ";
}
?> 



