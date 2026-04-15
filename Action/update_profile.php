<?php
session_start();
include('../includes/config.php');
header('Content-Type: application/json');


$user_id = $_SESSION['user_id'] ?? 0;
if (!$user_id) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Not logged in'
    ]);
    exit;
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

if (!$name || !$email) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Missing fields'
    ]);
    exit;
}

$stmt = $db_conn->prepare("UPDATE account SET name=?, email=? WHERE id=?");
$stmt->bind_param("ssi", $name, $email, $user_id);

if ($stmt->execute()) {
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    echo json_encode([
        'status' => 'success'
    ]);
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Update failed'
    ]);
}
