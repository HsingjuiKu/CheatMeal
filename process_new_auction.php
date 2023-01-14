<?php include_once("header.php") ?>
<?php
include_once('database.php')
?>

<?php
@$seller = $_SESSION['user_id']; // the user id as identifier.

$insert_flag = false;
//insert new auction
$sql_insert_new_auction = "INSERT INTO items(item_name, item_description, starting_Price, 
                reserve_price, item_category, end_date, bid_count, seller_id, state) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
$default_bidcount = 0;
$insert_item_result = prepare_bind_excecute(
    $sql_insert_new_auction,
    "ssiisssss",
    $_POST['name'],
    $_POST['description'],
    $_POST['startingprice'],
    $_POST['reserveprice'],
    // $_POST['pricebuynow'],
    $_POST['category'],
    $_POST['endtime'],
    $default_bidcount,
    $seller,
    "active"
);
// $new_item_id = mysqli_query(get_connection(), "select item_id from items where item_name = '{$_POST['name']}'")->fetch_assoc();
// var_dump($new_item_id);
// $sql_insert_new_bid = "INSERT INTO bids(bid_id, bidder_id, item_id, bid_price, 
//                 createdDate) VALUES(?, ?, ?, ?, ?)";
// $$insert_bid_result = prepare_bind_excecute($sql_insert_new_bid, 'iiiis', null, $seller, $new_item_id, $_POST['startingprice'], null);
if ($insert_result = true) {
    $insert_flag = true;
}
// auction created
echo 'Auction is successfully created! <a href="mylistings.php">View your new listing.</a>';
// redirect('create_auction.php'); // prevent refresh to re-post

?>


<?php
include_once('utilities.php');
// 允许上传的图片后缀
$picture_flag = false;
$allowedExts = array("gif", "jpeg", "jpg", "png", "doc", "docx", "pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);     // 获取文件后缀名
// $_FILES需要找到对应的文件的MIME 类型，这个可以到网上找
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "application/msword") //上传doc文件
        || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") //上传docx文件
        || ($_FILES["file"]["type"] == "application/pdf")) //上传pdf文件

    && ($_FILES["file"]["size"] < 102400000)   // 小于 100 mb（这个可以自己修改）
    && in_array($extension, $allowedExts)
) {
    if ($_FILES["file"]["error"] > 0) {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    } else {
        // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        $current_num = get_nums_items();
        if (file_exists("./images/item_images/the auctions/" . $current_num . ".png")) {
            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        } else {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "./images/item_images/the auctions/" . $current_num . ".png");
            $picture_flag = true;
            // echo "文件存储在: " . "./" . $_FILES["file"]["name"];
        }
    }
} else {
    echo "非法的文件格式";
}

if ($insert_flag && $picture_flag) {
    echo "<script language='javascript' type='text/javascript'>
                        window.location.href='homepage.php';
          </script>";
}

?>


<?php include_once("footer.php") ?>