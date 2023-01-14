
<?php include 'mail.php'; ?>


<?php
// ignore_user_abort(true);
// set_time_limit(0);
// // $connection = get_connection();
// do {
//根据时间寻找所有的item_id已经过期的//

//search for all expired items
$sql_expired = "SELECT item_id from items 
            where end_date <= CURRENT_DATE AND state = 'active'";
$result = mysqli_query($connection, $sql_expired);

while ($expired_bids_list = mysqli_fetch_assoc($result)) {
    if ($expired_bids_list != null) {
        foreach ($expired_bids_list as $expired_bids) {
            $find_max_bid = "SELECT max(bid_price) as max_price from bids where item_id = {$expired_bids} group by item_id";
            $result_max = mysqli_query($connection, $find_max_bid);
            if ($result_max) {

                $max_bid = mysqli_fetch_assoc($result_max);
                $max_bid = $max_bid['max_price'];
                $find_bid = "select * from bids where bid_price = {$max_bid} and item_id = {$expired_bids}";
                $result_max_bid = mysqli_query($connection, $find_bid);
                $find_info = mysqli_fetch_assoc($result_max_bid);

                $sql_insert_orders = "insert into orders values (null, {$find_info["bidder_id"]}, {$find_info["item_id"]}, {$max_bid})";
                $result_orders = mysqli_query($connection, $sql_insert_orders);

                $sql_seller_find = "SELECT a.user_id as user from users a, items b where a.user_id = b.seller_id AND b.item_id = {$expired_bids}";
                $result_sellers = mysqli_query($connection, $sql_seller_find);
                $find_seller = mysqli_fetch_assoc($result_sellers);

                $email = get_emails_by_userid($find_seller["user"]);
                emails_main('single', $email, 'body_finish_winner');

                $email = get_emails_by_userid($find_info["bidder_id"]);
                emails_main('single', $email, 'body_finish_auctions');

                $sql_change_state = "UPDATE items set state = 'inactive' where item_id = {$expired_bids} ";
                $result_update = mysqli_query($connection, $sql_change_state);
            }
        }
    }
}
//     sleep(1);
// } while (true);



?>