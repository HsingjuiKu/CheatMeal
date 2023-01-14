<?php include_once('database.php');
include_once('header.php');

$user_id = $_SESSION['user_id'];
$_SESSION['funtion'] = "orders";
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
                        My Orders:
                    </div>
                    <?php
                    display_buyer_orders($user_id);
                    ?>


                </div>

            </div>
        </div>
    </div>

</body>

<?php

//get orders according to user_id
function display_buyer_orders($user_id)
{
    $connection = get_connection();
    $sql_bids = "SELECT a.item_id, a.item_name, a.end_date, a.bid_count, c.user_name , category_type, d.final_bid_price  
                FROM items a, categories b, users c, orders d 
                where a.item_category = b.category_id and a.seller_id = c.user_id and d.item_id = a.item_id 
                and d.winner_id = '{$user_id}'";
    $result = mysqli_query($connection, $sql_bids);
    while ($rows = mysqli_fetch_assoc($result)) {
        $item_id = $rows["item_id"];
        $item_name = $rows["item_name"];
        $seller_name = $rows['user_name'];
        $bid_count = $rows['bid_count'];
        $final_bid_price = $rows['final_bid_price'];
        $category = $rows['category_type'];
        echo "<div class='watchlist-item'>";
        echo "<div class='row'>

                    <div class='col-sm-4'>
                        <img src='images/item_images/the auctions/$item_id.png' class='img-rounded img-responsive watchlist-img'>
                    </div>

                    <div class='col-sm-8'>
                        <div class='watchlist-item-name'>$item_name</div>

                        <div class='row'>
                            <div class='input-icon3 col-sm-2'></div>
                            <div style='text-align: left'>
                                <p class='col-sm-4 seller-title'>$category</p>
                            </div>
                            <div class='input-icon4 col-sm-3'></div>
                            <div style='text-align: left; padding-top: 5px'>
                                <p class='col-sm-3 seller-title'>$seller_name</p>
                            </div>
                        </div>


                        <div class='row'>
                            <div class='bid-icon col-sm-3'></div>
                            <div style='text-align: left; padding-top: 5px'>
                                <p class='col-sm-9 seller-title'>Bid Count:$bid_count</p>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='bid-icon col-sm-3'></div>
                            <div style='text-align: left; padding-top: 5px'>
                                <p class='col-sm-9 seller-title'>Final Bid:$final_bid_price</p>
                            </div>
                        </div>
                    </div>

                </div>";
        echo "</div>";
        // foreach ($rows as $key => $values) {

        //     echo "{$key},{$values} </br>";
        // }
    };
}



?>