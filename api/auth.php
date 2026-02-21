<?php

/**
 * Authentication API for I Found
 * Handles user registration, login, logout
 */

session_start();
header('Content-Type: application/json');

require_once '../config/database.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'register':
        register();
        break;
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'check_session':
        checkSession();
        break;
    case 'update_profile':
        updateProfile();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function register()
{
    $conn = getConnection();

    // Get and sanitize input
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        return;
    }

    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
        return;
    }

    if ($password !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        return;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        $stmt->close();
        $conn->close();
        return;
    }
    $stmt->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $hashedPassword);

    if ($stmt->execute()) {
        $userId = $stmt->insert_id;

        echo json_encode([
            'success' => true,
            'message' => 'Registration successful. Please login to continue.',
            'user' => [
                'id' => $userId,
                'name' => $firstName . ' ' . $lastName,
                'email' => $email
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again.']);
    }

    $stmt->close();
    $conn->close();
}

function login()
{
    $conn = getConnection();

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required']);
        return;
    }

    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, password, profile_image FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        $stmt->close();
        $conn->close();
        return;
    }

    $user = $result->fetch_assoc();

    if (!password_verify($password, $user['password'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        $stmt->close();
        $conn->close();
        return;
    }

    // Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['profile_image'] = $user['profile_image'];

    // Set remember me cookie if checked
    if ($remember) {
        setcookie('user_email', $email, time() + (86400 * 30), "/"); // 30 days
    }

    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'user' => [
            'id' => $user['id'],
            'name' => $user['first_name'] . ' ' . $user['last_name'],
            'email' => $user['email'],
            'profile_image' => $user['profile_image']
        ]
    ]);

    $stmt->close();
    $conn->close();
}

function logout()
{
    session_unset();
    session_destroy();

    // Remove remember me cookie
    if (isset($_COOKIE['user_email'])) {
        setcookie('user_email', '', time() - 3600, "/");
    }

    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
}

function checkSession()
{
    if (isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => true,
            'logged_in' => true,
            'user' => [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'profile_image' => $_SESSION['profile_image'] ?? null
            ]
        ]);
    } else {
        echo json_encode(['success' => true, 'logged_in' => false]);
    }
}

function updateProfile()
{
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Not logged in']);
        return;
    }

    $conn = getConnection();
    $userId = $_SESSION['user_id'];

    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if (empty($firstName) || empty($lastName)) {
        echo json_encode(['success' => false, 'message' => 'First name and last name are required']);
        return;
    }

    // Handle profile image upload
    $profileImage = $_SESSION['profile_image'] ?? null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/profiles/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid() . '_' . basename($_FILES['profile_image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            $profileImage = 'uploads/profiles/' . $fileName;
        }
    }

    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, phone = ?, profile_image = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $firstName, $lastName, $phone, $profileImage, $userId);

    if ($stmt->execute()) {
        $_SESSION['user_name'] = $firstName . ' ' . $lastName;
        $_SESSION['profile_image'] = $profileImage;

        echo json_encode([
            'success' => true,
            'message' => 'Profile updated successfully',
            'user' => [
                'id' => $userId,
                'name' => $firstName . ' ' . $lastName,
                'profile_image' => $profileImage
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
    }

    $stmt->close();
    $conn->close();
}
