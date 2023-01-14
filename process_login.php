<?php

include_once('page_utilities.php');
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: homepage.php");
//     exit;
// }

$username = $password = "";
$username_err = $password_err = $login_err = "";

include_once "database.php";
$connection = get_connection();


//Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"])) {

        // Check if username is empty
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["username"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (isset($username) && isset($password)) {
            // Prepare a select statement
            $sql = "SELECT user_id, user_name, password FROM users WHERE user_name = '$username'";
            $result = query_database($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row != null) {
                @$hashed_password = $row['password'];
                echo $hashed_password;
                // if (password_verify($password, $hashed_password)) {
                if ($password == $hashed_password) {
                    // Password is correct, so start a new session

                    // Store data in session variables
                    $_SESSION["logged_in"] = true;
                    $_SESSION["username"] = $username;
                    $id = $row['user_id'];
                    // Redirect user to welcome page
                    if ($row['user_id'] == 100) {
                        $_SESSION['account_type'] = 'admin';
                        $_SESSION['user_id'] = $id;
                        echo "<script language='javascript' type='text/javascript'>
                                window.location.href='homepage.php';
                              </script>";
                    } else {
                        $_SESSION['account_type'] = 'user';
                        $_SESSION['user_id'] = $id;
                        echo "<script language='javascript' type='text/javascript'>
                                window.location.href='homepage.php';
                              </script>";
                    }
                } else {
                    // Password is not valid, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                // Username doesn't exist, display a generic error message
                $login_err = "Invalid username or password.";
                // header("location:login.php");
                echo "<script language='javascript' type='text/javascript'>
                        window.location.href='login.php';
                      </script>";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}
