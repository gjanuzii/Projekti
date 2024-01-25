<?php
require_once 'Database.php';
require_once 'User.php';

$db = new Database();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];



    if (!isset($_POST['name']) || !preg_match('/^[A-Z].{2,}$/', $_POST['name'])) {
        echo "Please enter a valid name.";
        exit;
    }

    // Validate the surname
    if (!isset($_POST['surname']) || !preg_match('/^[A-Z].{3,}$/', $_POST['surname'])) {
        echo "Please enter a valid surname.";
        exit;
    }

    // Validate the email
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit;
    }

    // Validate the password
    if (!isset($_POST['password']) || strlen($_POST['password']) < 6) {
        echo "Password must be at least 6 characters.";
        exit;
    }

    // Validate the confirmation password
    if (!isset($_POST['cpassword']) || $_POST['cpassword'] !== $_POST['password']) {
        echo "Password and confirmation password do not match.";
        exit;
    }


    // Simple validation to check if password and confirmation password match
    if ($password != $cpassword) {
        echo "Password and confirmation password do not match.";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Attempt to register the user
    $result = $user->register($name, $surname, $email, $hashedPassword, $user_type);

    if ($result) {
        // Registration successful, you may redirect the user or display a success message.
        echo "Registration successful!";
    } else {
        // Registration failed, handle accordingly (e.g., display an error message).
        echo "Registration failed!";
    }
}
?>
