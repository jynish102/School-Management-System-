<?php
session_start();
include('../includes/config.php');
if(isset($_POST['user_type']) && $_POST['user_type'] == 'Teacher')
{
    $user_id = $_POST['user_id'];
$name = isset($_POST['name']) ? $_POST['name'] : '';
$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$gender =isset($_POST['gender']) ? $_POST['gender'] : '';
$current_address = isset($_POST['caddress']) ? $_POST['caddress'] : '';
$current_country = isset($_POST['ccountry']) ? $_POST['ccountry'] : '';
$current_state = isset($_POST['cstate']) ? $_POST['cstate'] : '';
$zip = isset($_POST['zip']) ? $_POST['zip'] : '';
$password = date('dmY', strtotime($dob));
$md_password = md5($password);

$father_name = isset($_POST['father_name']) ? $_POST['father_name'] : '';
$father_mobile = isset($_POST['father_mobile']) ? $_POST['father_mobile'] : '';
$mother_name = isset($_POST['mother_name']) ? $_POST['mother_name'] : '';
$mother_mobile = isset($_POST['mother_mobile']) ? $_POST['mother_mobile'] : '';
$parents_address = isset($_POST['parents_address']) ? $_POST['parents_address'] : '';
$parents_country = isset($_POST['parents_country']) ? $_POST['parents_country'] : '';
$parents_state = isset($_POST['parents_state']) ? $_POST['parents_state'] : '';
$zip = isset($_POST['zip']) ? $_POST['zip'] : '';

$qualification = isset($_POST['qualification']) ? $_POST['qualification'] : '';
$experience = isset($_POST['experience']) ? $_POST['experience'] : '';
$class = isset($_POST['class']) ? $_POST['class'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$date_joining = isset($_POST['doj']) ? $_POST['doj'] : '';
$designation = isset($_POST['designation']) ? $_POST['designation'] : '';



$date_add = date('Y-m-d');


// $check_query = mysqli_query($db_conn, "SELECT * FROM account WHERE email = '$email'");
// if (mysqli_num_rows($check_query) > 0) {
//     //$error = 'Email already exists';
//     echo 'Email already exists';
//     die;
// } else {
//     $query = mysqli_query($db_conn, "INSERT INTO account (name,email,password,user_Type) VALUES ('$name','$email','$md_password','$type')") or die(mysqli_error($db_conn));
//     if ($query) {
//         $user_id = mysqli_insert_id($db_conn);
//     }
// }
$usermeta = array(
    'dob' => $dob,
    'mobile' => $mobile,
    'gender' => $gender,
    'caddresh' => $current_address,
    'ccountry' => $current_country,
    'cstate' => $current_state,
    'zip' => $zip,

    'father_name' => $father_name,
    'father_mobile' => $father_mobile,
    'mother_name' => $mother_name,
    'mother_mobile' => $mother_mobile,
    'parents_address' => $parents_address,
    'parents_country' => $parents_country,
    'parents_state' => $parents_state,
    'zip' => $zip,

    'qualification' => $qualification,
    'experience' => $experience,
    'class' => $class,
    'subject' => $subject,

    'designation' => $designation,
    'doj' => $date_joining,

    
);
foreach ($usermeta as $key => $value) {
        if (!empty($value)) {
           mysqli_query($db_conn, "INSERT INTO usermeta (user_id,meta_key,meta_value) VALUES ('$user_id','$key','$value')") 
           or die(mysqli_error($db_conn));
        }
}

header("Location: ../Admin/manage_account.php?success=1");
exit();

}
?>







