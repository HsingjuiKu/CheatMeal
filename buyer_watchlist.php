<?php include_once('database.php');
include_once('header.php');

$user_id = $_SESSION['user_id'];
$_SESSION['funtion'] = "watchlist";
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
                        My Watchlist:
                    </div>
                    <?php
                    display_buyer_watchlist($user_id);
                    ?>


                </div>

            </div>
        </div>
    </div>

</body>
<!-- <form method="POST" action="user_watchlist">
    <div id="watch_watching">
        <button type="submit" value="add_to_watchlist" name="add_to_watchlist">Add To Watchlist</button>
        <button type="submit" value="remove_from_watchlist" name="remove_from_watchlist">Remove From Watchlist</button>
    </div>
</form> -->

<?php



// if (isset($_POST['add_to_watchlist'])) {
//     $add_to_watchlist = $_POST['add_to_watchlist'] or false;
//     add_to_watchlist($add_to_watchlist, $item_id, $user_id);
// }

// if (isset($_POST['remove_from_watchlist'])) {
//     $remove_from_watchlist = $_POST['remove_from_watchlist'] or false;
//     remove_from_watchlist($remove_from_watchlist, $item_id);
// }

//get bids according to watchlist
function display_buyer_watchlist($user_id)
{
    $connection = get_connection();
    $sql_user_watch = "SELECT b.item_name, b.item_id, b.bid_count, e.user_name, c.category_type, MAX(bid_price) current_bid 
                        FROM watchlist a, items b, categories c, bids d, users e
                        WHERE a.item_id = b.item_id And b.item_id = d.item_id and b.item_category = c.category_id and b.seller_id = e.user_id
                        And a.user_id = '{$user_id}' GROUP BY item_id ";
    // $sql_user_watch = "SELECT * FROM watchlist WHERE user_id = '{$user_id}'";
    $result = mysqli_query($connection, $sql_user_watch);
    while ($rows = $result->fetch_assoc()) {
        $item_id = $rows['item_id'];
        $item_name = $rows["item_name"];
        $seller_name = $rows['user_name'];
        $category = $rows['category_type'];
        $bid_count = $rows['bid_count'];
        $current_bid = $rows['current_bid'];
        echo "<div class='watchlist-item'>";
        echo "<div class='row'>

                <div class='col-sm-4'>
                      <img src='images/item_images/the auctions/$item_id.png' class='img-rounded img-responsive watchlist-img'>
                </div>

                <div class='col-sm-6'>
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
                            <p class='col-sm-9 seller-title'>Current Bid:$current_bid</p>
                        </div>
                    </div>
                </div>

                <div class='col-md-2'>
                    <form action='item_display.php' method='POST'>
                        <div class='form-group col-md-12' style='text-align:center;'>
                            <label for=item_id' class='col-form-label text-center watchlist-id-label'>ID:</label>
                            <input type='text' class='form-control watchlist-id-input' id='item_id' name='item_id' placeholder='$item_id'' value ='$item_id' readonly='readonly'>
                            <input type='submit' class='btn btn-default browse-button' value='Bid Now' name='submit' id='submit'>
                        </div>    
                    </form>
                </div>

        
            </div>";
        echo "</div>";
    };
}

// function add_to_watchlist($add_to_watchlist, $item_id, $user_id)
// {
//     if ($add_to_watchlist == 'add_to_watchlist') {
//         $connection = get_connection();
//         $sql_insert_watch = "INSERT INTO watchlist VALUES('{$user_id}','{$item_id}')";
//         $result = mysqli_query($connection, $sql_insert_watch);
//         if ($result) {
//             header("Refresh:0;user_watchlist.php");
//         } else {
//             echo "添加watchlist失败";
//         }
//     }
// }


// function remove_from_watchlist($remove_from_watchlist, $item_id)
// {
//     if ($remove_from_watchlist == 'remove_from_watchlist') {
//         $connection = get_connection();
//         $sql_delete_watch = "DELETE FROM watchlist WHERE item_id = '{$item_id}'";
//         $result = mysqli_query($connection, $sql_delete_watch);
//         if ($result) {
//             header("Refresh:0;user_watchlist.php");
//         } else {
//             echo "移出watchlist失败";
//         }
//     }
// }

?>