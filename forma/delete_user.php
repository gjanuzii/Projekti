<?php
require_once 'Database.php';

$db = new Database();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Perform the delete operation
    $sql = "DELETE FROM user_forma WHERE id = $userId";
    $result = $db->conn->query($sql);

    if ($result) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }
} else {
    echo "Invalid request.";
}
?>
