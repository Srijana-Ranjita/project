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

// Fetch report details from the database
$sql = "SELECT * FROM reports WHERE id = ? AND user_id = ?"; // Ensure only the user's reports are fetched
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $report_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $report = $result->fetch_assoc();
} else {
    echo "Report not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Report</title>
</head>
<body>

<header>
    <h1>Report Details</h1>
    <nav>
        <ul>
            <li><a href="my_reports.html">Back to My Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Description: <?php echo htmlspecialchars($report['description']); ?></h2>
    <p>Status: <?php echo htmlspecialchars($report['status']); ?></p>
    <p>Location: <?php echo htmlspecialchars($report['location']); ?></p>
    <p>Date Submitted: <?php echo htmlspecialchars($report['date_submitted']); ?></p>
</main>

<footer>
    <p>© 2024 Lost and Seek | All Rights Reserved</p>
</footer>

</body>
</html>
