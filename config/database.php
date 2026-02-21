<?php
/**
 * Database Configuration for I Found - Lost & Found Management System
 * Make sure XAMPP Apache and MySQL are running before using this
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ifound_db');

// Create connection
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8
    $conn->set_charset("utf8");
    
    return $conn;
}

// Create database and tables if they don't exist
function initializeDatabase() {
    // First connect without database selected
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    if ($conn->query($sql) !== TRUE) {
        die("Error creating database: " . $conn->error);
    }
    
    // Select the database
    $conn->select_db(DB_NAME);
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone VARCHAR(20),
        password VARCHAR(255) NOT NULL,
        profile_image VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    
    // Create categories table
    $sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        icon VARCHAR(50) NOT NULL,
        color VARCHAR(20) NOT NULL
    )";
    $conn->query($sql);
    
    // Insert default categories if empty
    $result = $conn->query("SELECT COUNT(*) as count FROM categories");
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $categories = [
            ['Electronics', 'fa-mobile-alt', 'purple'],
            ['Documents', 'fa-id-card', 'blue'],
            ['Accessories', 'fa-glasses', 'pink'],
            ['Bags', 'fa-shopping-bag', 'green'],
            ['Keys', 'fa-key', 'yellow'],
            ['Pets', 'fa-paw', 'orange'],
            ['Other', 'fa-box', 'gray']
        ];
        
        $stmt = $conn->prepare("INSERT INTO categories (name, icon, color) VALUES (?, ?, ?)");
        foreach ($categories as $cat) {
            $stmt->bind_param("sss", $cat[0], $cat[1], $cat[2]);
            $stmt->execute();
        }
        $stmt->close();
    }
    
    // Create items table
    $sql = "CREATE TABLE IF NOT EXISTS items (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_id INT(11) NOT NULL,
        type ENUM('lost', 'found') NOT NULL,
        name VARCHAR(100) NOT NULL,
        category_id INT(11) NOT NULL,
        description TEXT NOT NULL,
        location VARCHAR(255) NOT NULL,
        date_lost_found DATE NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        contact_phone VARCHAR(20),
        status ENUM('active', 'claimed', 'closed') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(id)
    )";
    $conn->query($sql);
    
    // Create claims table
    $sql = "CREATE TABLE IF NOT EXISTS claims (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        item_id INT(11) NOT NULL,
        user_id INT(11) NOT NULL,
        message TEXT NOT NULL,
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $conn->query($sql);
    
    // Create messages table
    $sql = "CREATE TABLE IF NOT EXISTS messages (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        sender_id INT(11) NOT NULL,
        receiver_id INT(11) NOT NULL,
        item_id INT(11),
        message TEXT NOT NULL,
        is_read TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE SET NULL
    )";
    $conn->query($sql);
    
    // Create contact_messages table
    $sql = "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        is_read TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    
    $conn->close();
    
    return true;
}

// Initialize database on first load
initializeDatabase();
?>
