<?php

class UserManagementController {
    // Fetch a single user by ID
    public function fetchUserById($id) {
        global $conn;
        $query = "SELECT user_id, name, email, role FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch all users
    public function fetchAllUsers() {
        global $conn;
        $query = "SELECT user_id, name, email, role FROM users";

        $result = $conn->query($query);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    // Add a new user
    public function addUser($name, $email, $password, $role) {
        global $conn;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $query = "INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$name, $email, $passwordHash, $role]);
    }

    // Update an existing user
    public function updateUser($id, $name, $email, $role) {
        global $conn;
        $query = "UPDATE users SET name = ?, email = ?, role = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $email, $role, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return;
    }

    // Delete a user
    public function deleteUser($id) {
        global $conn;
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return;
    }
}

