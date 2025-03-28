<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ticketing_system');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed',
        'error_code' => 'DB_CONNECTION_FAILED'
    ]));
}

// Set charset
$conn->set_charset("utf8mb4");

// Get input data
$input = json_decode(file_get_contents('php://input'), true);

// Validate ticket number exists
if (empty($input['ticket_number'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Ticket number is required',
        'error_code' => 'MISSING_TICKET_NUMBER'
    ]);
    exit;
}

// Clean inputs
$ticket_number = trim($input['ticket_number']);
$email = isset($input['email']) ? strtolower(trim($input['email'])) : null;

try {
    // Base query
    $query = "SELECT * FROM tickets WHERE ticket_number = ?";
    $params = ["s", $ticket_number];
    
    // Add email condition if provided
    if ($email !== null) {
        $query .= " AND LOWER(email) = ?";
        $params[0] .= "s";
        $params[] = $email;
    }

    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Database query preparation failed");
    }

    $stmt->bind_param(...$params);
    
    if (!$stmt->execute()) {
        throw new Exception("Database query execution failed");
    }

    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $message = "No ticket found with this number.";
        if ($email !== null) {
            // Check if ticket exists without email match
            $checkTicket = $conn->prepare("SELECT 1 FROM tickets WHERE ticket_number = ?");
            $checkTicket->bind_param("s", $ticket_number);
            $checkTicket->execute();
            if ($checkTicket->get_result()->num_rows > 0) {
                $message = "Ticket exists but email doesn't match.";
            }
        }
        throw new Exception($message);
    }

    $ticket = $result->fetch_assoc();
    
    // Successful response
    echo json_encode([
        'success' => true,
        'ticket' => $ticket,
        'attachments' => $ticket['attachments'] ? explode('||', $ticket['attachments']) : []
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => 'TICKET_SEARCH_ERROR'
    ]);
} finally {
    $conn->close();
}
?>