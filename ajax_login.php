<?php


session_start();

$login_err = "";

include_once "database.php";
$connection = get_connection();
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);
//get password according to username
$sql = "SELECT user_id, user_name, password, account_role FROM users WHERE user_name = '$username'";
$result = query_database($connection, $sql);
$row = mysqli_fetch_assoc($result);
if ($row != null) {
    @$hashed_password = $row['password'];
    if ((password_verify($password, $hashed_password)) || $hashed_password == $password) {

        // if (password_verify($password, $hashed_password)) {
        // Password is correct, so start a new session

        // Store data in session variables
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username;
        $id = $row['user_id'];
        // Redirect user to welcome page
        if ($row['user_id'] == 100) {
            $_SESSION['account_type'] = 'admin';
            $_SESSION['user_id'] = $id;
            die("success");
        } else {
            $role = $row['account_role'];
            $_SESSION['account_type'] = $role;
            $_SESSION['user_id'] = $id;
            die("success");
        }
    } else {
        // Password is not valid, display a generic error message
        $login_err = "Invalid username or password.";
    }
} else {
    // Username doesn't exist, display a generic error message
    $login_err = "Invalid username or password.";
}
die($login_err);
