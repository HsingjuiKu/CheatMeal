<?php include 'database.php'; ?>
<?php include 'header.php'; ?>


<!-- oop -->
<?php

include_once('database.php');
include_once('header.php');

$user_id = $_SESSION['user_id'];
$_SESSION['funtion'] = "all_users";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=K2D&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">

        <div class="row">

            <?php include('side_bar.php') ?>

            <div class="col-md-9">
                <div class="watchlist">
                    <div class=" watchlist-title clearfix">
                        All Users:
                    </div>
                    <?php
                    // get all users and link three tables to get full information
                    $connection = get_connection();
                    $sql_item = "SELECT * FROM users";
                    $result = mysqli_query($connection, $sql_item);
                    display_HTML_table_from($result);
                    ?>


                </div>

            </div>
        </div>
    </div>

</body>

<?php


display_HTML_table_from($result);

function display_HTML_table_from($results)
{
    // echo "<div class='container'>";
    echo "<table class='table'>";
    if ($row = $results->fetch_assoc()) {
        // display attributes
        echo "<thead>";
        echo "<tr>";
        foreach ($row as $key => $val) {
            echo "<th>" . $key . "</th>";
        }
        echo "</tr>";
        echo "</thead>";

        // display query data
        echo "<tbody>";
        do {
            echo "<tr>";
            foreach ($row as $key => $val) {
                echo "<td>" . $val . "</td>";
            }
            echo "</tr>";
        } while ($row = $results->fetch_assoc());
        echo "</tbody>";
    }
    echo "</table>";
    // echo "</div>";
}


?>
<?php include 'footer.php'; ?>