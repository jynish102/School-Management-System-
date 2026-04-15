<?php
session_start();
include('../includes/config.php');
if(isset($_POST['user_type']) && $_POST['user_type'] == 'Student')
{
    // ✅ Get existing account ID from hidden input
    $user_id = $_POST['user_id'];

    $name = $_POST['name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    // $email = isset($_POST['email']) ? $_POST['email'] : '';
    $current_address = $_POST['caddress'] ?? '';
    $current_country = $_POST['ccountry'] ??'';
    $current_state = $_POST['cstate'] ??'';
    $zip = $_POST['zip'] ?? '';
    

    $father_name = $_POST['father_name'] ?? '';
    $father_mobile = $_POST['father_mobile'] ?? '';
    $mother_name = $_POST['mother_name'] ?? '';
    $mother_mobile = $_POST['mother_mobile'] ?? '';
    $parents_address = $_POST['parents_address'] ?? '';
    $parents_country = $_POST['parents_country'] ?? '';
    $parents_state = $_POST['parents_state']?? '';
    $zip = isset($_POST['pzip']) ? $_POST['pzip'] : '';

    $previous_school_name = $_POST['previous_school_name'] ?? '';
    $previous_class = $_POST['previous_class'] ?? '';
    $status = $_POST['status'] ?? '';
    $total_marks = $_POST['total_marks'] ?? '';
    $obtain_marks = $_POST['obtain_marks'] ?? '';
    $previous_percentage = $_POST['previous_percentage'] ?? '';

    $class = $_POST['class'] ?? '';
    $section = $_POST['section'] ?? '';
    $date_admission = $_POST['doa'] ?? '';
    

    $date_add = date('Y-m-d');

    
   
    // $check_query = mysqli_query($db_conn, "SELECT * FROM account WHERE email = '$email'");
    // if(mysqli_num_rows($check_query) > 0) 
    // {
    //     //$error = 'Email already exists';
    //     echo 'Email already exists';
    //     die;
        
    // } 
    
     // ✅ Collect student meta data
    $usermeta = [
        'dob' => $_POST['dob'] ?? '',
        'mobile' => $_POST['mobile'] ?? '',
        'caddress' => $_POST['caddress'] ?? '',
        'ccountry' => $_POST['ccountry'] ?? '',
        'cstate' => $_POST['cstate'] ?? '',
        'zip' => $_POST['zip'] ?? '',
        'father_name' => $_POST['father_name'] ?? '',
        'father_mobile' => $_POST['father_mobile'] ?? '',
        'mother_name' => $_POST['mother_name'] ?? '',
        'mother_mobile' => $_POST['mother_mobile'] ?? '',
        'parents_address' => $_POST['parents_address'] ?? '',
        'parents_country' => $_POST['parents_country'] ?? '',
        'parents_state' => $_POST['parents_state'] ?? '',
        'pzip' => $_POST['pzip'] ?? '',
        'previous_school_name' => $_POST['previous_school_name'] ?? '',
        'previous_class' => $_POST['previous_class'] ?? '',
        'status' => $_POST['status'] ?? '',
        'total_marks' => $_POST['total_marks'] ?? '',
        'obtain_marks' => $_POST['obtain_marks'] ?? '',
        'previous_percentage' => $_POST['previous_percentage'] ?? '',
        'class' => $_POST['class'] ?? '',
        'section' => $_POST['section'] ?? ''
    ];
    // ✅ Insert each meta key/value
    foreach ($usermeta as $key => $value) {
        if (!empty($value)) {
            $stmt = $db_conn->prepare("INSERT INTO usermeta (user_id, meta_key, meta_value) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $key, $value);
            $stmt->execute();
        }
    }
// ✅ Success redirect
header("Location: ../Admin/manage_account.php?success=1");
exit();
}  
?>