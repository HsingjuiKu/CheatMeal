

<?php
include_once "database.php";
include_once "utilities.php";
include_once "mail.php";
session_start();

$connection = get_connection();

$item_id = $_POST['item_id'];
var_dump($item_id);
$bid_price = $_POST['bid_price'];
$_SESSION['item_id'] = $item_id;
var_dump($bid_price);

function take_bid($connection, $item_id, $bid_price)
{
    $flag = true;
    try {
        //use transaction here
        $currentUser = $_SESSION["user_id"];
        // var_dump($currentUser);
        mysqli_query($connection, 'BEGIN');
        // $res1 = mysqli_query($connection, "insert into bids values(null, '{$currentUser}', '{$item_id}', '{$bid_price}', UNIX_TIMESTAMP())");
        //insert new bids
        $sql1 = "INSERT INTO `bids` (`bid_id`,`bidder_id`,`item_id`, `bid_price`, `createdDate`) VALUES (null, ?, ?, ?, null);";
        $res1 = prepare_bind_excecute($sql1, 'isi', $currentUser, $item_id, $bid_price);
        // $res1 = mysqli_query($connection, "insert into bids values(null, '{$currentUser}', '{$item_id}', '{$bid_price}', UNIX_TIMESTAMP())");
        //update bid_count
        $sql2 = "update items set bid_count = bid_count +1 where item_id = ?";
        $res2 = prepare_bind_excecute($sql2, 'i', $item_id);
        // $flag = true;
        // if ($res1 && $res2) {
        mysqli_query($connection, "COMMIT");
        // } else {
        mysqli_query($connection, 'ROLLBACK');
        //     $flag = false;
        // }
        mysqli_query($connection, "END");
        // return $flag;
    } catch (Exception $e) {
        $flag = false;
        echo 'Failed to place bid, please try again later.';
    }
    return $flag;
}

if (isset($item_id) and isset($bid_price)) {
    $flag = take_bid($connection, $_POST['item_id'], $_POST['bid_price']);
    var_dump($flag);
    if ($flag) {
        echo "<script language='javascript' type='text/javascript'>
                window.location.href='item_display.php';
              </script>";
    }
    $emails = get_emails_by_items($item_id);
    $body_type = 'body_new_highest_bid';
    emails_main('multiple', $emails, $body_type);
}



?>

