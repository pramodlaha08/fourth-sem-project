<?php
/**
 * Contact API for I Found
 * Handles contact form submissions
 */

session_start();
header('Content-Type: application/json');

require_once '../config/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'send':
        sendMessage();
        break;
    case 'subscribe':
        subscribe();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function sendMessage() {
    $conn = getConnection();
    
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        return;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        return;
    }
    
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Message sent successfully. We will get back to you soon!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send message. Please try again.']);
    }
    
    $stmt->close();
    $conn->close();
}

function subscribe() {
    $conn = getConnection();
    
    $email = trim($_POST['email'] ?? '');
    
    if (empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Email is required']);
        return;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        return;
    }
    
    // Create newsletter table if not exists
    $conn->query("CREATE TABLE IF NOT EXISTS newsletter_subscribers (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL UNIQUE,
        subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Check if already subscribed
    $stmt = $conn->prepare("SELECT id FROM newsletter_subscribers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'You are already subscribed!']);
        $stmt->close();
        $conn->close();
        return;
    }
    $stmt->close();
    
    // Subscribe
    $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to subscribe. Please try again.']);
    }
    
    $stmt->close();
    $conn->close();
}
?>
