<?php
include 'connect.php';

$item_type = $_POST['item_type'];
$item_name = $_POST['item_name'];
$item_description = $_POST['item_description'];
$location = $_POST['location'];
$contact_info = $_POST['contact_info'];

// Image upload handling
$image_path = '';
if (!empty($_FILES['item_image']['name'])) {
    $target_dir = "../images/";
    $image_path = $target_dir . basename($_FILES["item_image"]["name"]);
    move_uploaded_file($_FILES["item_image"]["tmp_name"], $image_path);
}

// Insert item into database
$sql = "INSERT INTO items (item_type, item_name, item_description, location, contact_info, image_path) 
        VALUES ('$item_type', '$item_name', '$item_description', '$location', '$contact_info', '$image_path')";

if ($conn->query($sql) === TRUE) {
    echo "New item reported successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
