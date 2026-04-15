<?php
include('includes/config.php');

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || 
        !preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', $email)) {
    echo "<script>alert('Invalid or uppercase email'); </script>";
    exit;
   }

    // Basic non-empty check
    if (empty($name) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required');</script>";
        exit;
    }

    // Hash password for security
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $query = "INSERT INTO users (name, email, password, created_at)
              VALUES ('$name', '$email', '$hashed_pass', NOW())";

    if (mysqli_query($db_conn, $query)) {
        echo "<script>alert('Registration successful'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Database error'); window.location='register.php';</script>";
    }
}
