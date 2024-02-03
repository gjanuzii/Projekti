<?php
require_once 'Database.php';

$db = new Database();

// Fetch all user data from the database
$sql = "SELECT id, name, surname, email, user_type FROM user_forma";
$result = $db->conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Admin Dashboard</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Surname</th><th>Email</th><th>User Type</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['surname']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['user_type']}</td>";
        echo "<td><a href='delete_user.php?id={$row['id']}'>Delete</a></td>"; // Provide a link to delete_user.php with the user ID
        echo "</tr>";
    }

    echo "</table>";

    // Form for adding news articles
    echo "<h2>Add News Article</h2>";
    echo "<form method='post' action='add_news.php'>";
    echo "<label for='image_url'>Image URL:</label>";
    echo "<input type='text' id='image_url' name='image_url' required>";

    echo "<label for='title'>Title:</label>";
    echo "<input type='text' id='title' name='title' required>";

    echo "<label for='category'>Category:</label>";
    echo "<input type='text' id='category' name='category' required>";

    echo "<label for='subcategory'>Subcategory:</label>"; 
    echo "<input type='text' id='subcategory' name='subcategory' required>";

    echo "<label for='text'>Text:</label>";
    echo "<textarea id='text' name='text' required></textarea>";

    echo "<label for='author'>Author:</label>";
    echo "<input type='text' id='author' name='author' required>";

    echo "<input type='submit' name='submit' value='Add News'>";
    echo "</form>";


    echo "<a href='dashboard.php' class='adbtn'>Kthehu</a>";
} else {
    echo "No users found";
}
?>


<style>
    *{
        background-color: #50577A;
    }
    h1{
        margin-left: 37%;
        margin-top: 5%;
        font-size: 50px;
        color: white;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    table{
        background-color: white;
        margin-left: 35%;
        margin-top: 7%;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        margin-bottom: 3%;
    }
    th{
        background-color: white;
    }
    td{
        background-color: white;
        padding: 5px;
    }
    a{
        background-color: white;
        text-decoration: none;
        color: #50577A;
        font-weight: bold;
    }
    .adbtn{
        width: 100px;
        margin-left: 48%;
        padding: 10px;
        border: 1px solid transparent;
        border-radius: 15px;
        cursor: pointer;
        background-color: #ffffff;
        color: #50577A;
        text-decoration: none;
    }
    @media only screen and (max-width:780px){
        h1{
            margin-left: 5%;
        }
        table{
            margin-left: 3%;
            margin-top: 1%;
            margin-bottom: 7%;
        }
        .adbtn{
            margin-left: 45%;
        }
    }

</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
</head>
<body>
</body>
</html>