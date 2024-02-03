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
        $sql = "SELECT id, name, user_type, password FROM user_forma WHERE email = '$email'";
        $result = $this->db->conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, return user details
                return [
                    'success' => true,
                    'user_type' => $user['user_type'],
                    'id' => $user['id'],
                    'name' => $user['name'],
                ];
            } else {
                // Password is incorrect
                return ['success' => false, 'message' => 'Invalid password'];
            }
        } else {
            // User not found
            return ['success' => false, 'message' => 'User not found'];
        }
    }
}
?>
