<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($name, $surname, $email, $password, $user_type) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO user_forma (name, surname, email, password, user_type) VALUES ('$name', '$surname', '$email', '$hashed_password', '$user_type')";

        $result = $this->db->conn->query($sql);

        return $result;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM user_forma WHERE email = '$email'";
        $result = $this->db->conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, return user type
                return $user['user_type'];
            } else {
                // Password is incorrect
                return false;
            }
        } else {
            // User not found
            return false;
        }
    }

    // Since the role is specified in the registration form, you might not need this method
    public function getRoleByEmail($email) {
        return false;
    }
}
?>
