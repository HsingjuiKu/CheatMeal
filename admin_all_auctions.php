<?php include 'database.php'; ?>
<?php include 'header.php'; ?>


<!-- oop -->
<?php

include_once('database.php');
include_once('header.php');

$user_id = $_SESSION['user_id'];
$_SESSION['funtion'] = "all_auctions";
// @$item_id_admin = $_POST['item_id_admin'];
// if (isset($item_id_admin)) {
//     $remove_from_all_auctions = 'remove_from_all_auctions';
// };
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
                        All Auctions:
                    </div>
                    <?php
                    // get all auctions and link three tables to get full information
                    $connection = get_connection();
                    $sql_item = "SELECT a.item_id as ID, a.bid_count as Counts, item_name as Name, 
                                        category_type as Category, item_description as Description, c.user_name as Seller
                                 FROM items a, categories b, users c 
                                 Where a.item_category = b.category_id and a.seller_id = c.user_id 
                                ";
                    $result = mysqli_query($connection, $sql_item);
                    //display all auctions
                    display_HTML_table_from($result);
                    ?>


                </div>

            </div>
        </div>
    </div>

</body>

<?php


// Function to display every attributes of result
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
            // echo "<tr>";
            // $item_id_admin = $row['ID'];
            // echo " <td> <form action='admin_all_auctions.php' method='POST'>
            //     <div class='form-group col-md-12' style='text-align:center;'>
            //     <input type='text' class='form-control watchlist-id-input' id='item_id_admin' name='item_id_admin' placeholder='$item_id_admin' value ='$item_id_admin' readonly='readonly'> </td>
            //     <td> <input type='submit' class='btn btn-default browse-button' value='Delete Now' name='submit' id='submit'>
            //     </div>    
            // </form> </td>";
            // echo "</tr>";
        } while ($row = $results->fetch_assoc());
        echo "</tbody>";
    }
    echo "</table>";
    // echo "</div>";

}

// function remove_from_all_auctions($connection, $remove_from_all_auctions, $item_id_admin)
// {
//     if ($remove_from_all_auctions == 'remove_from_all_auctions') {
//         // $connection = get_connection();
//         $sql_delete_watch = "DELETE FROM items WHERE item_id = '{$item_id_admin}'";
//         $result = mysqli_query($connection, $sql_delete_watch);
//         if ($result) {
//             echo "<script language='javascript' type='text/javascript'>
//                         window.location.href='admin_all_auctions.php';
//           </script>";
//         } else {
//             echo "移出watchlist失败";
//         }
//     }
// }
// var_dump($remove_from_all_auctions);
// var_dump($item_id_admin);

// remove_from_all_auctions($connection, $remove_from_all_auctions, $item_id_admin);
// 
?>
<?php include 'footer.php'; ?>