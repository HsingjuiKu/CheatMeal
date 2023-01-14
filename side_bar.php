<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css">
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</head>

<!-- <body> -->
<!-- <div class="container"> -->


<!-- <div class="row"> -->
<div class="col-md-3">
    <div class=" sidebar">
        <ul class="nav nav-pills nav-stacked">

            <?php
            $account_type = $_SESSION['account_type'];
            if ($account_type == 'seller' || $account_type == 'buyer' || $account_type == 'both') {

                echo " <li class=";
                if ($_SESSION['funtion'] == 'user_home') echo 'active';
                echo ">
                        <a href='user_home.php' class='sidebar-li'>
                            <img src='images/sidebar/home_1.png' class='sidebar-img'>
                            Home
                        </a>
                      </li>";

                echo " <li class=";
                if ($_SESSION['funtion'] == 'edit_user_profile') echo 'active';
                echo ">
                            <a href='user_edit_profile.php' class='sidebar-li'>
                                <img src='images/sidebar/user_2.png' class='sidebar-img'>
                                Edit Your Profile
                            </a>
                    </li>";

                if ($account_type == 'buyer' || $account_type == 'both') {
                    echo " <li class=";
                    if ($_SESSION['funtion'] == 'bids') echo 'active';
                    echo ">
                            <a href='buyer_mybids.php' class='sidebar-li'>
                                <img src='images/sidebar/bidding_1.png' class='sidebar-img'>
                                My Bids
                            </a>
                    </li>";


                    echo " <li class=";
                    if ($_SESSION['funtion'] == 'orders') echo 'active';
                    echo ">
                            <a href='buyer_myorders.php' class='sidebar-li'>
                                <img src='images/sidebar/dollar_1.png' class='sidebar-img'>
                                My Orders
                            </a>
                    </li>";


                    echo " <li class=";
                    if ($_SESSION['funtion'] == 'watchlist') echo 'active';
                    echo ">
                            <a href='buyer_watchlist.php' class='sidebar-li'>
                                <img src='images/sidebar/category_2.png' class='sidebar-img'>
                                My Watchlist
                            </a>
                    </li>";
                }

                if ($account_type == 'seller' || $account_type == 'both') {
                    echo " <li class=";
                    if ($_SESSION['funtion'] == 'auctions') echo 'active';
                    echo ">
                            <a href='seller_myauctions.php' class='sidebar-li'>
                                <img src='images/sidebar/bidding_1.png' class='sidebar-img'>
                                My Auctions
                            </a>
                    </li>";
                }
            } elseif ($account_type == 'admin') {
                echo " <li class=";
                if ($_SESSION['funtion'] == 'admin_home') echo 'active';
                echo ">
                            <a href='admin_home.php' class='sidebar-li'>
                                <img src='images/sidebar/home_1.png' class='sidebar-img'>
                                Home
                            </a>
                        </li>";

                echo " <li class=";
                if ($_SESSION['funtion'] == 'all_auctions') echo 'active';
                echo ">
                            <a href='admin_all_auctions.php' class='sidebar-li'>
                                <img src='images/sidebar/dollar_1.png' class='sidebar-img'>
                                All Auctions
                            </a>
                        </li>";

                echo " <li class=";
                if ($_SESSION['funtion'] == 'all_users') echo 'active';
                echo ">
                            <a href='admin_all_users.php' class='sidebar-li'>
                                <img src='images/sidebar/user_2.png' class='sidebar-img'>
                                All Users
                            </a>
                        </li>";
            }

            ?>


        </ul>
    </div>
</div>



<!-- </body> -->

</html>


<?php

// function check_status()
// {
//     session_start();
//     // $_SESSION['account_type'] = 'admin';
//     if ($_SESSION['account_type'] == 'user') {
//         sidebar_user();
//     } elseif ($_SESSION['account_type'] == 'admin') {
//         sidebar_admin();
//     } else {
//         echo "Please login in first";
//     }
// }
// check_status();
// sidebar_user();

?>