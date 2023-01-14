<!-- TASK: WIRTE DOWN ALL FUNCTIONS THAT WILL BE CALLED MANY TIMES AND ALLOWD TO INCLUDE BY MANY PHP FILES -->


<?php
include_once('database.php');
// TASK1: display_time_remaining:
// Helper function to help figure out what time to display
function display_time_remaining($interval)
// need to connect to database to display specific time remaining for certain auction
{
    //在auction_display里写好了，直接调用auction_display.php的resttime方法

    if ($interval->days == 0 && $interval->h == 0) {
        // Less than one hour remaining: print mins + seconds:
        $time_remaining = $interval->format('%im %Ss');
    } else if ($interval->days == 0) {
        // Less than one day remaining: print hrs + mins:
        $time_remaining = $interval->format('%hh %im');
    } else {
        // At least one day remaining: print days + hrs:
        $time_remaining = $interval->format('%ad %hh');
    }

    return $time_remaining;
}


// print_listing_li: need to connect to database to display all auctions or part of auctions
// 展示目前存在的auction，先调用bid表格确认有效其次调用item展示信息。
// This function prints an HTML <li> element containing an auction listing
// use certain attributes to control the scope and number 
// function print_listing_auctions()
// {
//     $connection = get_connection();
//     //不需要在这里展示description,图片放在哪里
//     $sql = "select items.item_name, items.bid_count, items.price_buynow, items.end_date, users.user_name  
//             from items, bids, users 
//             where (bids.user_id = users.user_id) and (bids.item_id = items.item_id)";
//     $result = query_database($connection, $sql);
//     $array = mysqli_fetch_assoc($result);
//     return $array;

//    // Truncate long descriptions
//    if (strlen($desc) > 250) {
//        $desc_shortened = substr($desc, 0, 250) . '...';
//    } else {
//        $desc_shortened = $desc;
//    }
//
//    // Fix language of bid vs. bids
//    if ($num_bids == 1) {
//        $bid = ' bid';
//    } else {
//        $bid = ' bids';
//    }
//
//    // Calculate time to auction end
//    $now = new DateTime();
//    if ($now > $end_time) {
//        $time_remaining = 'This auction has ended';
//    } else {
//        // Get interval:
//        $time_to_end = date_diff($now, $end_time);
//        $time_remaining = display_time_remaining($time_to_end) . ' remaining';
//    }
// }

// print_listing_users: need to connect to database to display all users or specific types of users
// use certain attributes to control the scope and number 
function print_listing_users($name)
{
    $connection = get_connection();
    if (isset($name)) {
        $sql = "select user_name, user_id, password from user where user_name = {$name}";
        $result = query_database($connection, $sql);
        $array = mysqli_fetch_assoc($result);
        return $array;
    } else {
        $sql = "select user_name, user_id, password from users";
        $result = mysqli_query($connection, $sql);
        $array = mysqli_fetch_assoc($result);
        return $array;
    }
}



// function end_bid($bid)
// {
//     $connection = get_connection();
//     $sql = "select items.*, bids.* from items, bids where bids.item_id = items.item_id";
//     $res = query_database($connection, $sql);
//     $row = mysqli_fetch_assoc($res);
//     $cur_time = getdate();
//     foreach ($row as $r) {
//         if (resttime($cur_time, $r["end_date"]) <= 0) {
//             $item = $r["bids.item_id"];
//             $winner = $r["bids.bidder_id"];
//             $price = $r["bids.bid_price"];
//             $bid = $r["bids.bid_id"];
//             $sql1 = "insert into orders values (null, '{$winner}', '{$item}', '{$price}')";
//             $sql2 = "delete from bids where bid_id = '{$bid}'";
//             $sql = $sql1 . $sql2;
//             query_database($connection, $sql);
//         }
//     }
// }

//Recommendation

//Recommend by category of bid history
//1. search all the thing which the user has buy
//2. search all the category of the things
//3. search the valid bid for current by category
function recommmendation_by_category($user_id)
{
    $connection = get_connection();
    $sql = "SELECT a.item_id, item_name, end_date, category_type, user_name 
            from items a, categories b, users c
            where item_id in 
                    (select item_id from bids where item_id in 
                            (select item_id from items where item_category in 
                                    (select distinct item_category from items where item_id in 
                                            (select item_id from bids where bidder_id = '{$user_id}') 
                                    group by item_category order by count(item_category) desc
                                    )
                            ) 
                    ) 
            AND a.item_category = b.category_id and a.seller_id = c.user_id   and a.state = 'active'
            ORDER BY a.item_name LIMIT 4";
    $result = query_database($connection, $sql);
    return $result;
}


//Recommendation by other bider bid thing
//1. search this people bid history, get the item_id
//2. search all the people bid the same thing with you, get the user_id
//3. search the item_id by their user_id in bids table, get the item_id
//4. show all the things by item_id in items table.
function recommendation_by_other_users($userid)
{
    $connection = get_connection();
    //    $sql1 = "select item_id from bids where bidder_id = {$userid}";
    //    $sql2 = "select distinct bidder_id from bids where item_id in (select item_id from bids where bidder_id = {$userid}) group by bidder_id";
    //    $sql3 = "select distinct item_id from bids where bidder_id in (select distinct bidder_id from bids where item_id in (select item_id from bids where bidder_id = {$userid}) group by bidder_id) order by count(item_id)";
    //    $sql4 = "select distinct item_id from items where seller_id <> {$userid}";
    $sql1 = "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
    mysqli_query($connection, $sql1);
    $sql2 = "SELECT *, count(item_category) AS number FROM items 
             WHERE item_id in 
                (SELECT DISTINCT item_id FROM bids WHERE bidder_id IN 
                        (SELECT DISTINCT bidder_id FROM bids WHERE item_id IN 
                                (SELECT item_id FROM bids WHERE bidder_id = {$userid}) 
                         AND bidder_id <> {$userid} GROUP BY bidder_id) 
                AND item_id NOT IN 
                        (SELECT DISTINCT item_id FROM items WHERE seller_id <> {$userid})) 
             GROUP BY item_category ORDER BY number"; // make sure no item is seller of current user
    $result = mysqli_query($connection, $sql2);
    return $result;
}



#Non-Login status recommendation
#根据bid过的历史，计算每个item bid过的数量,最大值，选择前四个
#根据order的历史，找到数量前四位，衔接item_id，找到seller_id
#让第一步的所有的item
#根据用户售出数量属于第二步的seller_id
#然后展示
#根据user售出的数量
function recommendation_by_visitor()
{
    //Use orders form to find the corresponding best reputation seller by the number of successful items being sold,
    // this form at the same time with the bid form to find the most current number of bid to find the most
    // popular item on the current page while returning the corresponding seller, the two sellers to take the intersection
    //    elect i.seller_id
    //                    from items as i , orders as o
    //                    where o.item_id = i.item_id and i.seller_id in
    //    (select i.seller_id
    //                                 from items as i, bids as b
    //                                 where i.item_id = b.item_id
    //                                 group by i.item_id
    //                                 order by COUNT(i.item_id) DESC)
    //                    group by i.seller_id
    //                    order by COUNT(i.seller_id) DESC
    //    Find the corresponding item_id by seller id and return the result
    //    select * from items where state = 'active' and seller_id in (
    //        select i.seller_id
    //                    from items as i , orders as o
    //                    where o.item_id = i.item_id and i.seller_id in
    //    (select i.seller_id
    //                                 from items as i, bids as b
    //                                 where i.item_id = b.item_id
    //                                 group by i.item_id
    //                                 order by COUNT(i.item_id) DESC)
    //                    group by i.seller_id
    //                    order by COUNT(i.seller_id) DESC) LIMIT 1
    $sql = "SELECT a.item_id, item_name, end_date, category_type, user_name 
            from items a, categories b, users c
            where state = 'active' and seller_id in (
                        select i.seller_id 
                        from items as i , orders as o 
                        where o.item_id = i.item_id and i.seller_id in 
                                    (select i.seller_id 
                                     from items as i, bids as b 
                                     where i.item_id = b.item_id 
                                     group by i.item_id 
                                     order by COUNT(i.item_id) DESC) 
                        group by i.seller_id 
                        order by COUNT(i.seller_id) DESC) 
            AND a.item_category = b.category_id AND a.seller_id = c.user_id  AND a.state = 'active' LIMIT 4;";
    $result = query_database(get_connection(), $sql);
    return $result;
}





function get_item_categories()
{
    static $sql = 'SELECT DISTINCT category_type FROM categories';
    $connection = get_connection();
    return query_database($connection, $sql);
}


function get_emails_by_items($item_id)
{
    $sql_emails_by_bids = "SELECT DISTINCT email_address 
                FROM items a, users b, bids c 
                where c.bidder_id = b.user_id and c.item_id = a.item_id 
                and c.item_id = '{$item_id}'";
    $connection = get_connection();
    $result = query_database($connection, $sql_emails_by_bids);
    return $result;
}

function get_emails_by_username($user_name)
{
    $sql_emails_by_userid = "SELECT DISTINCT email_address 
                FROM users
                where user_name = '{$user_name}'";
    $connection = get_connection();
    $row = query_database($connection, $sql_emails_by_userid)->fetch_assoc();
    return $row['email_address'];
}

function get_emails_by_userid($user_id)
{
    $sql_emails_by_userid = "SELECT DISTINCT email_address 
                FROM users
                where user_id = '{$user_id}'";
    $connection = get_connection();
    $row = query_database($connection, $sql_emails_by_userid)->fetch_assoc();
    return $row['email_address'];
}

function get_nums_items()
{
    $sql_nums_items = "SELECT DISTINCT count(*) as counts  FROM items";
    $connection = get_connection();
    return query_database($connection, $sql_nums_items)->fetch_assoc()['counts'];
}


function get_bids_by_items($item_id)
{
    $sql_bid_by_items = "SELECT DISTINCT bid_price, a.user_name, createdDate 
                FROM users a, bids b 
                where b.bidder_id = a.user_id 
                and b.item_id = '{$item_id}'";
    $connection = get_connection();
    return query_database($connection, $sql_bid_by_items);
}


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
