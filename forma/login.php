<?php
require_once 'database.php';
require_once 'User.php';

$db = new Database();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['l_email']);
    $password = $_POST['l_password'];

    $loginResult = $user->login($email, $password);

    session_start();

    if ($loginResult['success']) {
        $_SESSION['user_type'] = $loginResult['user_type'];
        $_SESSION['id'] = $loginResult['id'];
        $_SESSION['name'] = $loginResult['name'];

        header('Location: dashboard.php');
        exit();
    } else {
        // Handle unsuccessful login
        $errorMessage = $loginResult['message'];
    }
}
?>
