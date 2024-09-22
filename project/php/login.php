<?php
session_start();
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Check user credentials in the database
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    // Set session variables
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role']; // Can be 'admin' or 'user'

    if ($row['role'] == 'admin') {
        header("Location: admin.php");  // Redirect to admin panel
    } else {
        header("Location: dashboard.php");  // Redirect to user dashboard
    }
} else {
    echo "Invalid username or password.";
}
$conn->close();
?>
