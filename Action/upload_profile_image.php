<?php
session_start();
include('../includes/config.php');
header('Content-Type: application/json');

$user_id = intval($_SESSION['user_id'] ?? 0);
if (!$user_id || !isset($_FILES['profile_image'])) {
    echo json_encode(['status' => 'error', 'message' => 'No file or user']);
    exit;
}

$target_dir = "../uploads/profile/";
if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

$ext ='png';

// $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
// $allowed = ['jpg', 'jpeg', 'png', 'gif'];
// if (!in_array($ext, $allowed)) {
//     echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
//     exit;
// }

$filename = "user_{$user_id}_" . time() . "png" ;
$target_file = $target_dir . $filename;

if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
    $image_url = "uploads/profile/$filename";

    if (!mysqli_query($db_conn, "UPDATE account SET image='$image_url' WHERE id='$user_id'")) {
        echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
        exit;
    }

    $_SESSION['profile_image'] = $image_url;
    echo json_encode(['status' => 'success', 'image_url' => $image_url]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Upload failed']);
}
