<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password'])); 

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();
        
        $_SESSION['user_id'] = $user_id; // Set the session variable

        echo "DEBUG: Session ID - " . session_id() . "<br>";
        echo "DEBUG: User ID - " . $_SESSION['user_id'] . "<br>";

        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password!'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$conn->close();


?>
