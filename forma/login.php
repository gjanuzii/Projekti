<?php
require_once 'database.php';
require_once 'User.php';

$db = new Database();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['l_email']);
    $password = $_POST['l_password'];

    $user_type = $user->login($email, $password);

    // Set the user type in a session variable
    session_start();
    $_SESSION['user_type'] = (string) $user_type;

    // Redirect to the common dashboard page
    header('Location: dashboard.php');
    exit();
}
?>
