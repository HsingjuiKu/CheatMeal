<?php

// $username = $_POST['username'];
// $password = $_POST['password'];
// $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
// // TASK1. function to check the input data
// if (isset($username) and isset($password)) {
//     //use filter_var to check values

//     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         echo "$email is a valid email address.";
//     } else {
//         echo "$email is NOT a valid email address.";
//     }
// }
// if (!isset($username)) {
//     echo "$email is NOT a valid email address.";
//     header('location:signup.php');
// }
// // TASK2: hash data and add salt
// $password_hash = password_hash($password, PASSWORD_DEFAULT);
// $verify = password_verify($password, $password_hash);

// // TASK3: function to insert registration data into database


// // TASK4: function to jump to login-in page
// if ($FLAG) {
//     header('location:login.php');
// }

// 
?>
<!-- // OPTIONAL TASK: Need to use HTTPS to send passwords across The internet securely -->
<?php
require('./database.php');
include_once('utilities.php');
include_once('mail.php');
@$username = $_POST['username'];
@$password1 = $_POST['password'];
@$password2 = $_POST['passwordConfirmation'];
@$role = $_POST['role'];
@$firstname = $_POST['firstname'];
@$familyname = $_POST['familyname'];
@$gender = $_POST['gender'];
@$birth = $_POST['date_of_birth'];
// var_dump($birth);
@$email = $_POST['email'];
@$phone = $_POST['phonenumber'];
@$address = $_POST['address'];

$connection = get_connection();
// echo $conn == true ? '数据库连接成功' : '数据库连接失败';

$sq = "select * from users where user_name='$username'";
$result = query_database($connection, $sq);






// $chars=array_merge(range('A','Z'),range('a','z'),range('0','9'));
// for($i=0;$i<4;$i+=1){
//     $salt=$chars[mt_rand(0, count($chars) - 1)]; 
// }Here is a brief introduction to the principle of adding salt to passwords
$hash = password_hash($password1, PASSWORD_BCRYPT);
//insert new account
$sq1l = "INSERT INTO `users` (user_name,password,first_name,family_name,gender,date_of_birth,email_address,phone_number,address,account_role) 
         values('$username','$hash','$firstname','$familyname','$gender','$birth','$email','$phone','$address', '$role')";
$connection2 = get_connection();
$ret = query_database($connection2, $sq1l);
if ($ret) {
    $mail_type = 'single';
    $mail_add  =  get_emails_by_username($username);
    $body_type = 'body_registrations';
    emails_main($mail_type, $mail_add, $body_type);
    die("<script>window.location.href='login.php';</script>");
    // header("Location:index.php") ;
} else {
    echo "注册失败";
}
?>