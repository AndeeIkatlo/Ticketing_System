<?php
// Database connection
$conn = new mysqli("localhost", "username", "password", "ticketing_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure ticket type is set
    if (!isset($_POST['ticket_type']) || empty($_POST['ticket_type'])) {
        die("Error: Ticket type is required.");
    }

    // Get form values
    $ticket_type = $_POST['ticket_type']; // Will be 'ASC' or 'Technical Support' based on user selection
    $request_date = $_POST['request_date'];
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email'];
    $on_site_address = $_POST['on_site_address'];
    $brand = $_POST['brand'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $serial_no = $_POST['serial_no'];
    $warranty_status = $_POST['warranty_status'];
    $remarks = $_POST['remarks'];
    $attachments = $_POST['attachments'];
    $ticket_number = $_POST['ticket_number'];

    // Validate ticket_type (only allow ASC or Technical Support)
    if ($ticket_type !== "ASC" && $ticket_type !== "Technical Support") {
        die("Error: Invalid ticket type selected.");
    }

    // Prepare and execute query
    $sql = "INSERT INTO tickets (ticket_type, request_date, customer_name, address, mobile, contact_person, email, on_site_address, brand, make, model, serial_no, warranty_status, remarks, attachments, ticket_number) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssss", $ticket_type, $request_date, $customer_name, $address, $mobile, $contact_person, $email, $on_site_address, $brand, $make, $model, $serial_no, $warranty_status, $remarks, $attachments, $ticket_number);

    if ($stmt->execute()) {
        echo "New ticket created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
