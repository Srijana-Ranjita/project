<?php
session_start();
include 'connect.php';  // Ensure the database connection file is correct

// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Simple form validation
if (empty($username) || empty($email) || empty($password)) {
    header("Location: ../signup.html?error=1");
    exit();
}

// Check if the username or email already exists
$sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Username or email already exists
    header("Location: ../signup.html?error=2");
} else {
    // Insert new user into the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    $insert_sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', 'user')";

    if ($conn->query($insert_sql) === TRUE) {
        // Signup success, redirect to the login page
        header("Location: ../login.html");
    } else {
        // Signup failed, redirect back with an error
        header("Location: ../signup.html?error=3");
    }
}

$conn->close();
?>
