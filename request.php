<?php
header('Content-Type: application/json');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ticketing_system');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate ticket number (format: JUMP-YYYYMMDD-XXXX)
    $ticket_number = 'JUMP-' . date('Ymd') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    
    // Prepare data for insertion
    $request_date = $_POST['request_date'];
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $address = $conn->real_escape_string($_POST['address']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $contact_person = $conn->real_escape_string($_POST['contact_person']);
    $email = $conn->real_escape_string($_POST['email']);
    $on_site_address = $conn->real_escape_string($_POST['on_site_address']);
    $brand = $conn->real_escape_string($_POST['brand']);
    $make = $conn->real_escape_string($_POST['make']);
    $model = $conn->real_escape_string($_POST['model']);
    $serial_no = $conn->real_escape_string($_POST['serial_no']);
    $warranty_status = $conn->real_escape_string($_POST['warranty_status']);
    $remarks = $conn->real_escape_string($_POST['remarks']);

    // Insert ticket into database
    $stmt = $conn->prepare("INSERT INTO tickets (
        ticket_number, request_date, customer_name, address, mobile, 
        contact_person, email, on_site_address, brand, make, model, 
        serial_no, warranty_status, remarks
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssssssss", 
        $ticket_number, $request_date, $customer_name, $address, $mobile,
        $contact_person, $email, $on_site_address, $brand, $make, $model,
        $serial_no, $warranty_status, $remarks
    );

    if ($stmt->execute()) {
        $ticket_id = $stmt->insert_id;
        $attachments_success = true;
        $uploaded_files = [];

        // Handle file uploads if any
        if (!empty($_FILES['attachments']['name'][0])) {
            $upload_dir = 'uploads/' . $ticket_number . '/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            foreach ($_FILES['attachments']['tmp_name'] as $key => $tmp_name) {
                $file_name = basename($_FILES['attachments']['name'][$key]);
                $file_path = $upload_dir . $file_name;
                
                if (move_uploaded_file($tmp_name, $file_path)) {
                    // Insert attachment record
                    $stmt_attach = $conn->prepare("INSERT INTO ticket_attachments (ticket_id, file_name, file_path) VALUES (?, ?, ?)");
                    $stmt_attach->bind_param("iss", $ticket_id, $file_name, $file_path);
                    if (!$stmt_attach->execute()) {
                        $attachments_success = false;
                    }
                    $stmt_attach->close();
                    $uploaded_files[] = $file_name;
                } else {
                    $attachments_success = false;
                }
            }
        }

        if ($attachments_success) {
            echo json_encode([
                'success' => true,
                'ticket_number' => $ticket_number,
                'message' => 'Ticket submitted successfully!',
                'attachments' => $uploaded_files
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'ticket_number' => $ticket_number,
                'message' => 'Ticket submitted but some attachments failed to upload',
                'attachments' => $uploaded_files
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error submitting ticket: ' . $stmt->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}

$conn->close();
?>
