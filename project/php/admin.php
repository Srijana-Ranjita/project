<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");  // Redirect to login if not an admin
}

include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

    <header>
        <h1>Admin Panel - Lost and Found</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section>
        <h2>Manage Reported Items</h2>
        <div>
            <?php
            $sql = "SELECT * FROM items";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='item'>";
                    echo "<h3>" . $row['item_name'] . "</h3>";
                    echo "<p>" . $row['item_description'] . "</p>";
                    echo "<p><strong>Location: </strong>" . $row['location'] . "</p>";
                    echo "<p><strong>Contact: </strong>" . $row['contact_info'] . "</p>";
                    echo "<form action='delete_item.php' method='POST'>";
                    echo "<input type='hidden' name='item_id' value='" . $row['id'] . "'>";
                    echo "<input type='submit' value='Delete Item'>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No items reported.</p>";
            }
            ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Lost and Found Website</p>
    </footer>

</body>
</html>
