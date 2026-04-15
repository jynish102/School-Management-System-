<?php
include('includes/config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $query = "INSERT INTO contact_messages (name, email, subject, message, created_at)
                  VALUES ('$name', '$email', '$subject', '$message', NOW())";

        if (mysqli_query($db_conn, $query)) {
            echo "<script>alert('Message sent successfully'); window.location='contact.php';</script>";
        } else {
            echo "<script>alert('Database error'); window.location='contact.php';</script>";
        }
    } else {
        echo "<script>alert('All fields are required'); window.location='contact.php';</script>";
    }
}
