<!-- TASK1: SWOTCH TO USER/SELLER/ADMIN homepage 
            USE SESSION TO MONITOR THE LOGIN STATUS-->
<?php include_once('database.php');
include_once('header.php');

$_SESSION['funtion'] = "edit_user_profile";
?>



<?php
function get_profile()
{
    $connection = get_connection();
    $role = $_SESSION['account_type'];
    if ($role == 'admin') {
        $admin_id = $_SESSION['admin_id'];
        $sql = "SELECT * FROM users WHERE user_id=$admin_id";
    } else {
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
        //update new edited details of certain account
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

            <div class="col-md-9">
                <div class=" watchlist-title clearfix">
                    Edit Your Profile:
                </div>

                <form method="POST" action="user_edit_profile.php" id="form" role="form" class="form-horizontal">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fname" class="control-label col-md-4 users-label">First Name</label>
                            <div class="col-md-8">
                                <input type='text' id="fname" class="form-control input-frame-users" name="fname" value="<?php echo $first_name ?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="lname" class="control-label col-md-4 users-label">Last Name</label>
                            <div class="col-md-8">
                                <input type='text' id="lname" class="form-control input-frame-users" name="lname" value="<?php echo $family_name ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="control-label col-md-4 users-label">Username</label>
                            <div class="col-md-8">
                                <input type='text' id="username" class="form-control input-frame-users" name="username" value="<?php echo $user_name ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="control-label col-md-4 users-label">Gender</label>
                            <div class="col-sm-8">
                                <label class="radio-inline register-label col-sm-3" style="width:100px; margin: left 20px;">
                                    <input type="radio" name="gender" id="male" value="1" <?php if ($gender == 1) {
                                                                                                echo 'checked';
                                                                                            } ?>> Male
                                </label>
                                <label class="radio-inline register-label col-sm-3" style="width:100px">
                                    <input type="radio" name="gender" id="female" value="0" <?php if ($gender == 0) {
                                                                                                echo 'checked';
                                                                                            } ?>> Female
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label col-md-4 users-label">New Password</label>
                            <div class="col-md-8">
                                <input type='text' id="password" class="form-control input-frame-users" name="password" value="">
                            </div>
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="email" class="control-label col-md-4 users-label">Email</label>
                            <div class="col-md-8">
                                <input type='text' id="email" class="form-control input-frame-users" name="email" value="<?php echo $email_address ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phonenumber" class="control-label col-md-4 users-label">Phone number</label>
                            <div class="col-md-8">
                                <input type='text' id="phonenumber" class="form-control input-frame-users" name="phonenumber" value="<?php echo $phone_number ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="control-label col-md-4 users-label">Address</label>
                            <div class="col-md-8">
                                <input type='text' id="address" class="form-control input-frame-users" name="address" value="<?php echo $address ?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="date_of_birth" class="control-label col-md-4 users-label">Date of Birth</label>
                            <div class="col-md-8">
                                <input type='text' id="date_of_birth" class="form-control input-frame-users" name="date_of_birth" value="<?php echo $date_of_birth ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="repeatpassword" class="control-label col-md-4 users-label">Repeat Password</label>
                            <div class="col-md-8">
                                <input type='text' id="repeatpassword" class="form-control input-frame-users" name="repeatpassword" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="text-align:center;">
                        <input type="submit" class="btn btn-default login-button" value="submit" name="submit" id="submit">
                    </div>

                </form>

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