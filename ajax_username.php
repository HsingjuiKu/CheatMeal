<?php
require('./database.php');
get_connection();
//check if the username has been used
$username = $_GET['username'];
$sq = "select * from users where user_name='$username'";
$result = query_database($connection, $sq);
if ($result && $result->num_rows != 0) {
    echo 1;
} else {
    echo 0;
}
