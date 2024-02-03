<?php
session_start();


$userMessage = '';
if (isset($_SESSION['id'], $_SESSION['name'])) {
    // Display a welcome message
    $userMessage = 'Je i lloguar si, ' . $_SESSION['name'] . '!';
}


echo "<div class='d-container'>";
// Check if the user type is set in the session
if (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];

    // Display common dashboard content
    echo "<h1>Mire Se Erdhet </h1>";

    // Display content based on user type
    if ($user_type == 'user') {
        echo "<p>Kjo eshte faqja e Userit.</p>";
        echo "<a href='../index.php' class='btn'>Home</a>";
       echo "<a href='logout.php' class='btn'>Logout</a>";
    
    } else{
        echo "<p>Kjo eshte faqja e Adminit.</p>";
        
        // Show link to admin dashboard for admin users
        echo "<a href='admin_dashboard.php' class='btn'>Dashboard</a>";
        echo "<a href='../index.php' class='btn'>Home</a>";
       echo "<a href='logout.php' class='btn'>Logout</a>";
    }
    echo "</div>";

    // Display common header elements
    

} else {
    // Redirect to login page if user type is not set
    header('Location: login.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    
</body>
</html>