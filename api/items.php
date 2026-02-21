<?php
/**
 * Items API for I Found
 * Handles CRUD operations for lost/found items
 */

session_start();
header('Content-Type: application/json');

require_once '../config/database.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {
    case 'create':
        createItem();
        break;
    case 'get':
        getItem();
        break;
    case 'get_all':
        getAllItems();
        break;
    case 'update':
        updateItem();
        break;
    case 'delete':
        deleteItem();
        break;
    case 'search':
        searchItems();
        break;
    case 'get_user_items':
        getUserItems();
        break;
    case 'get_categories':
        getCategories();
        break;
    case 'get_stats':
        getStats();
        break;
    case 'claim':
        claimItem();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function createItem() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Please login to report an item']);
        return;
    }
    
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    
    // Get form data
    $type = $_POST['type'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $categoryId = intval($_POST['category_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $dateLostFound = $_POST['date_lost_found'] ?? '';
    $contactPhone = trim($_POST['contact_phone'] ?? '');
    
    // Validation
    if (empty($type) || empty($name) || empty($categoryId) || empty($description) || empty($location) || empty($dateLostFound)) {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
        return;
    }
    
    if (!in_array($type, ['lost', 'found'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid item type']);
        return;
    }
    
    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/items/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Invalid image type. Only JPG, PNG, GIF, WEBP allowed']);
            return;
        }
        
        // Check file size (5MB max)
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'Image size must be less than 5MB']);
            return;
        }
        
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = 'uploads/items/' . $fileName;
        }
    }
    
    $stmt = $conn->prepare("INSERT INTO items (user_id, type, name, category_id, description, location, date_lost_found, image, contact_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississsss", $userId, $type, $name, $categoryId, $description, $location, $dateLostFound, $imagePath, $contactPhone);
    
    if ($stmt->execute()) {
        $itemId = $stmt->insert_id;
        echo json_encode([
            'success' => true,
            'message' => 'Item reported successfully',
            'item_id' => $itemId
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to report item. Please try again.']);
    }
    
    $stmt->close();
    $conn->close();
}

function getItem() {
    $conn = getConnection();
    $itemId = intval($_GET['id'] ?? 0);
    
    if ($itemId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid item ID']);
        return;
    }
    
    $sql = "SELECT i.*, c.name as category_name, c.icon as category_icon, c.color as category_color,
            u.first_name, u.last_name, u.email as user_email
            FROM items i
            JOIN categories c ON i.category_id = c.id
            JOIN users u ON i.user_id = u.id
            WHERE i.id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
        $stmt->close();
        $conn->close();
        return;
    }
    
    $item = $result->fetch_assoc();
    echo json_encode(['success' => true, 'item' => $item]);
    
    $stmt->close();
    $conn->close();
}

function getAllItems() {
    $conn = getConnection();
    
    $type = $_GET['type'] ?? '';
    $categoryId = $_GET['category_id'] ?? '';
    $limit = intval($_GET['limit'] ?? 20);
    $offset = intval($_GET['offset'] ?? 0);
    
    $sql = "SELECT i.*, c.name as category_name, c.icon as category_icon, c.color as category_color,
            u.first_name, u.last_name
            FROM items i
            JOIN categories c ON i.category_id = c.id
            JOIN users u ON i.user_id = u.id
            WHERE i.status = 'active'";
    
    $params = [];
    $types = "";
    
    if (!empty($type) && in_array($type, ['lost', 'found'])) {
        $sql .= " AND i.type = ?";
        $params[] = $type;
        $types .= "s";
    }
    
    // Handle category filter - can be ID or name
    if (!empty($categoryId)) {
        if (is_numeric($categoryId)) {
            $sql .= " AND i.category_id = ?";
            $params[] = intval($categoryId);
            $types .= "i";
        } else {
            // Filter by category name
            $sql .= " AND LOWER(c.name) = LOWER(?)";
            $params[] = $categoryId;
            $types .= "s";
        }
    }
    
    $sql .= " ORDER BY i.created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= "ii";
    
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    
    // Get total count
    $countSql = "SELECT COUNT(*) as total FROM items i JOIN categories c ON i.category_id = c.id WHERE i.status = 'active'";
    if (!empty($type)) {
        $countSql .= " AND i.type = '$type'";
    }
    if (!empty($categoryId)) {
        if (is_numeric($categoryId)) {
            $countSql .= " AND i.category_id = " . intval($categoryId);
        } else {
            $countSql .= " AND LOWER(c.name) = LOWER('$categoryId')";
        }
    }
    $countResult = $conn->query($countSql);
    $total = $countResult->fetch_assoc()['total'];
    
    echo json_encode([
        'success' => true,
        'items' => $items,
        'total' => $total,
        'limit' => $limit,
        'offset' => $offset
    ]);
    
    $stmt->close();
    $conn->close();
}

function searchItems() {
    $conn = getConnection();
    
    $query = trim($_GET['query'] ?? '');
    $type = $_GET['type'] ?? '';
    $categoryId = intval($_GET['category_id'] ?? 0);
    $limit = intval($_GET['limit'] ?? 20);
    $offset = intval($_GET['offset'] ?? 0);
    
    $sql = "SELECT i.*, c.name as category_name, c.icon as category_icon, c.color as category_color,
            u.first_name, u.last_name
            FROM items i
            JOIN categories c ON i.category_id = c.id
            JOIN users u ON i.user_id = u.id
            WHERE i.status = 'active'";
    
    $params = [];
    $types = "";
    
    if (!empty($query)) {
        $sql .= " AND (i.name LIKE ? OR i.description LIKE ? OR i.location LIKE ?)";
        $searchTerm = "%$query%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= "sss";
    }
    
    if (!empty($type) && in_array($type, ['lost', 'found'])) {
        $sql .= " AND i.type = ?";
        $params[] = $type;
        $types .= "s";
    }
    
    if ($categoryId > 0) {
        $sql .= " AND i.category_id = ?";
        $params[] = $categoryId;
        $types .= "i";
    }
    
    $sql .= " ORDER BY i.created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= "ii";
    
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'items' => $items,
        'query' => $query
    ]);
    
    $stmt->close();
    $conn->close();
}

function getUserItems() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Not logged in']);
        return;
    }
    
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    
    $sql = "SELECT i.*, c.name as category_name, c.icon as category_icon, c.color as category_color
            FROM items i
            JOIN categories c ON i.category_id = c.id
            WHERE i.user_id = ?
            ORDER BY i.created_at DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    
    echo json_encode(['success' => true, 'items' => $items]);
    
    $stmt->close();
    $conn->close();
}

function updateItem() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Not logged in']);
        return;
    }
    
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    $itemId = intval($_POST['item_id'] ?? 0);
    
    // Verify ownership
    $stmt = $conn->prepare("SELECT id FROM items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $itemId, $userId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Item not found or access denied']);
        $stmt->close();
        $conn->close();
        return;
    }
    $stmt->close();
    
    $name = trim($_POST['name'] ?? '');
    $categoryId = intval($_POST['category_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $dateLostFound = $_POST['date_lost_found'] ?? '';
    $contactPhone = trim($_POST['contact_phone'] ?? '');
    $status = $_POST['status'] ?? 'active';
    
    $sql = "UPDATE items SET name = ?, category_id = ?, description = ?, location = ?, date_lost_found = ?, contact_phone = ?, status = ? WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssssi", $name, $categoryId, $description, $location, $dateLostFound, $contactPhone, $status, $itemId);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update item']);
    }
    
    $stmt->close();
    $conn->close();
}

function deleteItem() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Not logged in']);
        return;
    }
    
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    $itemId = intval($_POST['item_id'] ?? 0);
    
    // Get item info and verify ownership
    $stmt = $conn->prepare("SELECT image FROM items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $itemId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Item not found or access denied']);
        $stmt->close();
        $conn->close();
        return;
    }
    
    $item = $result->fetch_assoc();
    $stmt->close();
    
    // Delete item
    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $itemId);
    
    if ($stmt->execute()) {
        // Delete associated image file
        if (!empty($item['image']) && file_exists('../' . $item['image'])) {
            unlink('../' . $item['image']);
        }
        echo json_encode(['success' => true, 'message' => 'Item deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete item']);
    }
    
    $stmt->close();
    $conn->close();
}

function getCategories() {
    $conn = getConnection();
    
    $result = $conn->query("SELECT * FROM categories ORDER BY name");
    
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    
    echo json_encode(['success' => true, 'categories' => $categories]);
    
    $conn->close();
}

function getStats() {
    $conn = getConnection();
    
    $stats = [];
    
    // Total items reported
    $result = $conn->query("SELECT COUNT(*) as count FROM items");
    $stats['total_items'] = $result->fetch_assoc()['count'];
    
    // Items returned (claimed/closed)
    $result = $conn->query("SELECT COUNT(*) as count FROM items WHERE status IN ('claimed', 'closed')");
    $stats['items_returned'] = $result->fetch_assoc()['count'];
    
    // Active users
    $result = $conn->query("SELECT COUNT(*) as count FROM users");
    $stats['active_users'] = $result->fetch_assoc()['count'];
    
    // Success rate
    if ($stats['total_items'] > 0) {
        $stats['success_rate'] = round(($stats['items_returned'] / $stats['total_items']) * 100);
    } else {
        $stats['success_rate'] = 0;
    }
    
    // Lost items count
    $result = $conn->query("SELECT COUNT(*) as count FROM items WHERE type = 'lost' AND status = 'active'");
    $stats['lost_items'] = $result->fetch_assoc()['count'];
    
    // Found items count
    $result = $conn->query("SELECT COUNT(*) as count FROM items WHERE type = 'found' AND status = 'active'");
    $stats['found_items'] = $result->fetch_assoc()['count'];
    
    echo json_encode(['success' => true, 'stats' => $stats]);
    
    $conn->close();
}

function claimItem() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Please login to claim an item']);
        return;
    }
    
    $conn = getConnection();
    $userId = $_SESSION['user_id'];
    $itemId = intval($_POST['item_id'] ?? 0);
    $message = trim($_POST['message'] ?? '');
    
    if ($itemId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid item ID']);
        return;
    }
    
    if (empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Please provide a message']);
        return;
    }
    
    // Check if item exists and is active
    $stmt = $conn->prepare("SELECT user_id FROM items WHERE id = ? AND status = 'active'");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Item not found or already claimed']);
        $stmt->close();
        $conn->close();
        return;
    }
    
    $item = $result->fetch_assoc();
    
    // Can't claim own item
    if ($item['user_id'] == $userId) {
        echo json_encode(['success' => false, 'message' => 'You cannot claim your own item']);
        $stmt->close();
        $conn->close();
        return;
    }
    $stmt->close();
    
    // Check if already claimed by this user
    $stmt = $conn->prepare("SELECT id FROM claims WHERE item_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $itemId, $userId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'You have already submitted a claim for this item']);
        $stmt->close();
        $conn->close();
        return;
    }
    $stmt->close();
    
    // Create claim
    $stmt = $conn->prepare("INSERT INTO claims (item_id, user_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $itemId, $userId, $message);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Claim submitted successfully. The owner will be notified.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit claim']);
    }
    
    $stmt->close();
    $conn->close();
}
?>
