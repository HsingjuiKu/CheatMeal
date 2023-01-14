<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <?php include("header.php");
    include("database.php") ?>



    <div class=" container">

        <div class=" col-md-7 col-md-offset-3">


            <h2 class="my-3 register-title">Create New Auction</h2>
            <form method="POST" action="process_new_auction.php" role="form" class=" form-horizontal" enctype="multipart/form-data">

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-right item-create-label">Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="name" placeholder="Auction Name" required name="name">
                        <small id="nameHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-sm-4 col-form-label text-right item-create-label">Category:</label>
                    <div class="col-sm-8">
                        <select name="category" class="form-control input-frame">
                            <option value="1">Toys</option>
                            <option value="2">Electronics</option>
                            <option value="3">Books</option>
                            <option value="4">Appliances</option>
                            <option value="5">Fashion</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="startingprice" class="col-sm-4 col-form-label text-right item-create-label">Starting Price:</label>
                    <div class="col-sm-8">
                        <input type="startingprice" class="form-control input-frame" id="startingprice" required placeholder="Starting Price" name="startingprice">
                        <small id="startingpriceHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>
                <!-- 
                <div class="form-group row">
                    <label for="pricebuynow" class="col-sm-4 col-form-label text-right item-create-label"> Price Buynow:</label>
                    <div class="col-sm-8">
                        <input type="pricebuynow" class="form-control input-frame" id="pricebuynow" placeholder="" name="pricebuynow">
                        <small id="passwordConfirmationHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="reserveprice" class="col-sm-4 col-form-label text-right item-create-label">Reserve Price:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="reserveprice" required placeholder="Enter Your Reserve Price" name="reserveprice">
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="endtime" class="col-sm-4 col-form-label text-right item-create-label">End Time:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="endtime" required placeholder="XXXX-XX-XX XX-XX-XX" name="endtime">
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="file" class="col-sm-4 col-form-label text-right item-create-label">Auction Photo:</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control " id="file" name="file">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-4 col-form-label text-right item-create-label">Description:</label>
                    <div class="col-sm-8">
                        <textarea name="description" id="description" cols="30" rows="10" required class="form-control description-input-frame"></textarea>
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>


                <div class="form-group col-md-12" style="text-align:center;">
                    <input type="submit" class="btn btn-default login-button" value="Create" name="submit"></input>
                </div>
            </form>

        </div>
    </div>


    <?php
    if (isset($_POST['submit'])) {
        if ($_FILES["file"]["error"] > 0) { //如果上传出错
            echo "Error: " . $_FILES["file"]["error"] . "<br />";
        } else {
            $image = $_FILES["file"]["name"];
            $type = $_FILES["file"]["type"];
            //图片另存为自己的路径下
            if (file_exists("../source/" . $_FILES["file"]["name"])) {
                $file_path = "../source/" . $_FILES["file"]["name"];
            } else {
                move_uploaded_file(
                    $_FILES["file"]["tmp_name"],
                    "../source/" . $_FILES["file"]["name"]
                );
                $file_path =  "../source/" . $_FILES["file"]["name"];
            }
            //            $pic_data = mysql_escape_string(file_get_contents($file_path));
            //            $pic_data = addslashes(fread(fopen($file_path,"r"), filesize($_FILES["file"]["size"])));


            //insert details of item
            $sql1 = "insert into items 
                     values( null,'{$description}', '{$item_name}', '{$starting_bid}','{$reserve_price}','{$ending_date}', 0, '{$buy_now_price}','{$user_id}','{$category}')";
            $res = query_database($connection, $sql1);
            $get_item_id = mysqli_fetch_assoc(query_database($connection, "select item_id from items where item_name = '{$item_name}' and user_id = '{$user_id}'"))["item_id"];
            //插入bid, 还差pay和rest time，在auction display集成了一个方法，但是有个小bug
            //$sql2 = "insert into bids values( null,'{$user_id}', '{$get_item_id}','{$starting_bid}',null)";
            //$res2 = query_database($sql2);

            //到这里位置功能就算结束了
        }
    }

    ?>


</body>