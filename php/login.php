<?php
// Include database configuration
require_once 'config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    
    // Validate inputs
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    // If no validation errors, proceed with login
    if (empty($errors)) {
        // Query to find user
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($query);
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, create session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // Log successful login
                $user_id = $user['id'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $log_query = "INSERT INTO login_logs (user_id, status, ip_address) 
                             VALUES ('$user_id', 'success', '$ip')";
                $conn->query($log_query);
                
                // Redirect to welcome page or dashboard
                $_SESSION['success_message'] = "Login successful! Welcome, " . $user['username'] . "!";
                header("Location: welcome.php");
                exit();
            } else {
                // Password is incorrect
                $errors[] = "Invalid username or password";
                
                // Log failed login attempt
                $ip = $_SERVER['REMOTE_ADDR'];
                $log_query = "INSERT INTO login_logs (status, ip_address) 
                             VALUES ('failed', '$ip')";
                $conn->query($log_query);
            }
        } else {
            // User not found
            $errors[] = "Invalid username or password";
        }
    }
    
    // If there are errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../index.html");
        exit();
    }
}
?>