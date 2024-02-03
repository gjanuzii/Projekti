<?php
require_once 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();

    // Get form data
    $image_url = $_POST['image_url'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory']; // Added subcategory
    $text = $_POST['text'];
    $author = $_POST['author'];

    // Use prepared statement to insert data into the database
    $stmt = $db->conn->prepare("INSERT INTO news_db (image_url, title, category, subcategory, text, author) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssss", $image_url, $title, $category, $subcategory, $text, $author);

    // Execute the statement
    if ($stmt->execute()) {
        echo "News added successfully!";
    } else {
        echo "Error adding news: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $db->conn->close();
}
?>
