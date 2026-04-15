<?php
session_start();
include('../includes/config.php');

$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');


if (empty($email) || empty($password)) {
    header("Location: ../login.php?error=Please enter both email and password");
    exit();
}

// Prepared statement lookup (plain-text password)
$stmt = $db_conn->prepare("SELECT * FROM account WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_object();

    // session
    $_SESSION['login']      = true;
    $_SESSION['session_id'] = uniqid('sess_');
    $_SESSION['user_id']    = $user->id;
    $_SESSION['user_name']  = $user->name;
    $_SESSION['user_type']  = ucfirst(strtolower($user->user_Type));

    $_SESSION['show_login_modal'] = true;

    // redirect by role
    $role = strtolower($user->user_Type);
    switch ($role) {
        case 'admin':
            header("Location: ../Admin/admin.php?user_id=" . urlencode($user->id));
            break;
        case 'teacher':
            header("Location: ../Teacher/teacher.php?user_id=" . urlencode($user->id));
            break;
        case 'student':
            header("Location: ../Student/student.php?user_id=" . urlencode($user->id));
            break;
        default:
            header("Location: ../login.php?error=Unknown user type");
    }
    exit();
} else {
    header("Location: ../login.php?error=Invalid email or password");
    exit();
}
