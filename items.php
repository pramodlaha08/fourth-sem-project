<?php
header('Content-Type: application/json');

// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "lostfound";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed.'
    ]);
    exit;
}

// Fetch items
$sql = "SELECT id, name, description, image, status FROM items ORDER BY id DESC";
$result = $conn->query($sql);

$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $row['image'], // e.g., "uploads/item1.jpg"
            'status' => $row['status']
        ];
    }
}

echo json_encode([
    'success' => true,
    'items' => $items
]);

$conn->close();