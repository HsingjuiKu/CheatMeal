<?php include_once('database.php');
include_once('header.php');

@$_SESSION['funtion'] = "admin_home";
?>


<!-- Function to get personal information according to the account type  -->
<?php
function get_profile()
{
    $connection = get_connection();
    @$role = $_SESSION['account_type'];
    if ($role == 'admin') {
        // $admin_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id=100 ";
    } else if ($role == 'user') {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id =$user_id";
    }
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $account = get_profile();
}
$user_name = $account['user_name'];
$first_name = $account['first_name'];
$family_name = $account['family_name'];
$gender = $account['gender'];
$date_of_birth = $account['date_of_birth'];
$email_address = $account['email_address'];
$phone_number = $account['phone_number'];
$address = $account['address'];

// $password = $account['password'];


// First: get personal information according to the account type 
// Second: display all the information as defalult values
// Third: Edit the information and submit 
// Fourth: Refresh The Page and Display the latest version
function edit_user_profile($user_name)
{
    $connection = get_connection();
    if (isset($_POST['submit'])) {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $new_username = $_POST['username'];
        $gender = $_POST['gender'];
        $date_of_birth = $_POST['date_of_birth'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeatpassword'];


        //update new input information for admin profile
        $sql_update = "UPDATE users set user_name = '{$new_username}', first_name = '{$firstname}', family_name = '{$lastname}',
                    gender = '{$gender}', date_of_birth = '{$date_of_birth}', email_address = '{$email}', phone_number = '{$phonenumber}', 
                    address = '{$address}' where user_name = '{$user_name}'";
        $query = query_database($connection, $sql_update);

        if (isset($password) && isset($repeatpassword) && $password == $repeatpassword) {
        }
        if ($query) {
            echo "<script language='javascript' type='text/javascript'>
                        window.location.href='user_edit_profile.php';
                  </script>";
            // header("Refresh:0;user_edit_profile.php");
        } else {
            echo "表单更新失败";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script> -->
</head>

<body>



    <div class="container">


        <div class="row">

            <?php include('side_bar.php') ?>

            <div class="col-md-8 col-sm-offset-1">
                <div class=" watchlist-title clearfix">
                    Your Profile:
                </div>


                <div class="row">
                    <label for="fname" class="col-md-2 users-label">First Name:</label>
                    <label for="fname" class="col-md-2 users-label"><?php echo $first_name ?></label>
                </div>


                <div class="row">
                    <label for="lname" class="col-md-2 users-label">Last Name</label>
                    <label for="lname" class="col-md-2 users-label"><?php echo $family_name ?></label>
                </div>

                <div class="row">
                    <label for="username" class="col-md-2 users-label">Username</label>
                    <label for="username" class="col-md-2 users-label"><?php echo $user_name ?></label>
                </div>

                <div class="row">
                    <label for="gender" class="col-md-2 users-label">Gender</label>
                    <label for="gender" class="col-md-2 users-label"><?php echo $gender ?></label>
                </div>

                <div class="row">
                    <label for="email" class="col-md-2 users-label">Email</label>
                    <label for="email" class="col-md-2 users-label"><?php echo $email_address ?></label>
                </div>

                <div class="row">
                    <label for="phonenumber" class="col-md-2 users-label">Phone number</label>
                    <label for="phonenumber" class="col-md-2 users-label"><?php echo $phone_number ?></label>
                </div>

                <div class="row">
                    <label for="address" class="col-md-2 users-label">Address</label>
                    <label for="address" class="col-md-2 users-label"><?php echo $address ?></label>
                </div>


                <div class="row">
                    <label for="date_of_birth" class="col-md-2 users-label">Date of Birth</label>
                    <label for="date_of_birth" class="col-md-2 users-label"><?php echo $date_of_birth ?></label>
                </div>

            </div>



        </div>
    </div>
</body>

<!-- FUNCTION1:CHECK THE INPUT DATA -->
<!-- FUNCTION2:USE DATABASED TO  CHANGE THE DATA WITH HTML -->
<!-- MANY SQL HERE -->

<!-- TASK2: EDIT My profile -->
<!-- // TASK1: START A SESSION.
// With a database, these should be set automatically ONLY after the user's login credentials have been verified via a
// database query. -->


<?php

edit_user_profile($user_name);

// echo '<script language="JavaScript">
// window.location.replace("side_bar.php"); 
// </script>';

// 
?>

<!-- TASK3: My watchlist -->
<?php include_once("utilities.php") ?>