<?php
session_start();
include 'connect.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the report ID from the URL
$report_id = $_GET['id'];

// Delete the report from the database
$sql = "DELETE FROM reports WHERE id = ? AND user_id = ?"; // Ensure only the user's reports are deleted
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $report_id, $_SESSION['user_id']);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Report deleted successfully
    header("Location: ../myreports.html?message=Report deleted successfully.");
} else {
    // Handle the case where the report was not found or not deleted
    header("Location: ../myreports.html?message=Failed to delete report.");
}
?>
