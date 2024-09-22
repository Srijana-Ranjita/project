<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");  // Redirect to login if not logged in
}

include 'connect.php';
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section>
        <h2>Your Reported Items</h2>
        <div>
            <?php
            $sql = "SELECT * FROM items WHERE user_id = '$user_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='item'>";
                    echo "<h3>" . $row['item_name'] . "</h3>";
                    echo "<p>" . $row['item_description'] . "</p>";
                    echo "<p><strong>Location: </strong>" . $row['location'] . "</p>";
                    echo "<p><strong>Date Reported: </strong>" . $row['date_reported'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>You have not reported any items.</p>";
            }
            ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Lost and Found Website</p>
    </footer>

</body>
</html>
