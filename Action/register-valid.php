<?php
include('../includes/config.php'); // DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
    $user_type = ucfirst($_POST['user_type']);

    // 1. Check if passwords match
    if ($password !== $confirm) {
        $error = "Passwords do not match!";
        header("Location: ../register.php?error=" . urlencode($error));
        exit;
    }

    // Email validation
    

    // 2. Check if email or username already exists
    $check = $db_conn->prepare("SELECT id FROM account WHERE email=? OR name=?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "User already exists with this Email/Username!";
        header("Location: ../register.php?error=" . urlencode($error));
        exit;
    }

    // 3. Save user if no errors
    $hashedPassword = $password;
    $sql = "INSERT INTO account (name, email, password,user_Type) VALUES (?, ?, ?, ?)";
    $stmt = $db_conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $user_type);

    if ($stmt->execute()) {
        header("Location: ../login.php?msg=registered");
    } else {
        $error = "Something went wrong: " . $stmt->error;
        header("Location: ../register.php?error=" . urlencode($error));
    }

    $stmt->close();
    $db_conn->close();
}
