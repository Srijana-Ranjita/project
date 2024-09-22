<?php
include 'connect.php';

$query = $_GET['query'];

// Search for items in the database
$sql = "SELECT * FROM items WHERE item_name LIKE '%$query%' OR item_description LIKE '%$query%' OR location LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'>";
        echo "<h3>" . $row['item_name'] . "</h3>";
        echo "<p>" . $row['item_description'] . "</p>";
        echo "<p><strong>Location: </strong>" . $row['location'] . "</p>";
        echo "<p><strong>Contact: </strong>" . $row['contact_info'] . "</p>";
        if ($row['image_path']) {
            echo "<img src='../" . $row['image_path'] . "' alt='Item Image'>";
        }
        echo "</div>";
    }
} else {
    echo "No items found.";
}

$conn->close();
?>
