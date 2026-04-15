<?php
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // same as your login
    $user_type = ucfirst(strtolower($_POST['user_type']));

    // Prevent duplicate
    $check = mysqli_query($db_conn, "SELECT * FROM account WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        die("User already exists!");
    }

    $sql = "INSERT INTO account (name, email, password, user_Type) VALUES ('$name', '$email', '$password', '$user_type')";
    mysqli_query($db_conn, $sql) or die(mysqli_error($db_conn));
    // Get new user ID
    $user_id = mysqli_insert_id($db_conn);

    if ($user_type == 'Student') {
        header("Location: ../Admin/student_form.php?user_id=$user_id&user_type=Student&success=1");
        exit();
    } elseif ($user_type == 'Teacher') {
        header("Location: ../Admin/teacher_form.php?user_id=$user_id&user_type=Teacher&success=1");
        exit();
    } elseif ($user_type == 'Parent') {
        header("Location: parent_form.php?user_id=$user_id");
        exit();
    }
}