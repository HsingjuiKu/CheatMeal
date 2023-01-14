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


    <?php include_once("header.php");
    include_once("database.php");
    include_once("utilities.php") ?>


    <?php
    if (isset($_POST['item_id'])) {
        $item_id = $_POST['item_id'];
    } else if (isset($_SESSION['item_id'])) {
        $item_id = $_SESSION['item_id'];
    }

    //get details of certain item
    $connection = get_connection();
    $sql_item = "SELECT item_name, category_type, item_description, user_name,  end_date , MAX(bid_price) max_price 
                 FROM items a, categories b, users c, bids d 
                 where a.item_category = b.category_id and a.seller_id = c.user_id and d.item_id = a.item_id 
                 and a.item_id = '{$item_id}'";
    $result = mysqli_query($connection, $sql_item);
    $rows = $result->fetch_assoc();
    $item_name = $rows["item_name"];
    $item_description = $rows['item_description'];
    $seller_name = $rows['user_name'];
    $bid_price =  isset($rows['max_price']) ? $rows['max_price'] : "  No Bid Now";
    $category = $rows['category_type'];
    $end_time = $rows['end_date'];
    $time = strtotime($end_time); //时间戳
    $nowtime = time(); //当前时间戳
    if ($time >= $nowtime) {
        $overtime = $time - $nowtime; //实际剩下的时间（单位/秒）
    } else {
        $overtime = 0;
    }


    $has_session = false;
    $watching = false;
    @$user_id = $_SESSION['user_id'];
    if (@$_SESSION['logged_in']) {
        $has_session = true;
        //check if this item is in watchlist
        $sql_check_watchlist = "SELECT * FROM `watchlist` WHERE user_id = '{$user_id}' AND item_id = '{$item_id}'";
        $res = query_database($connection, $sql_check_watchlist)->fetch_assoc();
        if ($res) {
            $watching = true;
        }
    }

    ?>



    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <img src='images/item_images/the auctions/<?php echo $item_id . '.png' ?>' class='img-rounded img-responsive item-img'>
                <div id="watch_nowatch" <?php if ($has_session && $watching) echo ('style="display: none"'); ?>>
                    <button type="button" class="btn btn-outline-secondary item-button" onclick="addToWatchlist()" <?php if (!isset($_SESSION['logged_in'])) echo ('disabled'); ?>>+ Add to watchlist</button>
                </div>
                <div id="watch_watching" <?php if (!$has_session || !$watching) echo ('style="display: none"'); ?>>
                    <button type="button" class="btn btn-success item-button" disabled>Watching</button>
                    <button type="button" class="btn btn-danger item-button" onclick="removeFromWatchlist()">Remove watch</button>
                </div>


                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="margin-top : 20px;">
                    Bid History
                </button>
                <!-- 模态框（Modal） -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    Bid History
                                </h4>
                            </div>
                            <div class="modal-body">
                                <?php
                                $bid_items = get_bids_by_items($item_id);
                                display_HTML_table_from($bid_items);
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                </button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>

            </div>



            <div class="col-sm-6">
                <div class="item-title"><?php echo $item_name ?></div>

                <div class="col-sm-6">
                    <div class="col-sm-2">
                        <div class="input-icon4"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="item-seller-title"><?php echo "Seller By:" . $seller_name ?></div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="col-sm-2">
                        <div class="input-icon3"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="item-seller-title"><?php echo "Category:" . $category ?></div>
                    </div>
                </div>

                <div class="item-description">
                    <?php echo "Descriptions:" . $item_description ?>
                </div>


                <div style="margin-top: 20px;">
                    <div class="col-sm-2">
                        <div class="bid-icon"></div>
                    </div>
                    <div class="col-sm-10">
                        <div class="item-bid-title"><?php echo "Current Bid:" . "  " . $bid_price ?></div>
                    </div>
                </div>

                <script language="JavaScript">
                    var runtimes = 0;

                    function GetRTime() {
                        var nMS = <?php echo $overtime; ?> * 1000 - runtimes * 1000;

                        if (nMS >= 0) {
                            var nD = Math.floor(nMS / (1000 * 60 * 60 * 24)) % 24;
                            var nH = Math.floor(nMS / (1000 * 60 * 60)) % 24;
                            var nM = Math.floor(nMS / (1000 * 60)) % 60;
                            var nS = Math.floor(nMS / 1000) % 60;
                            document.getElementById("RemainD").innerHTML = nD;
                            document.getElementById("RemainH").innerHTML = nH;
                            document.getElementById("RemainM").innerHTML = nM;
                            document.getElementById("RemainS").innerHTML = nS;
                            runtimes++;
                            if (nD == 0) {
                                document.getElementById("hideD").style.display = "none";
                                if (nH == 0) {
                                    document.getElementById("hideH").style.display = "none";
                                    if (nM == 0) {
                                        document.getElementById("hideM").style.display = "none";
                                    }
                                }
                            }
                            setTimeout("GetRTime()", 1000);
                        }
                    }
                    window.onload = function() {
                        GetRTime();
                    }
                </script>
                <h4 style="font-family:K2D;margin-left:70px">Auction Ends in
                    <span id="hideD"> <strong id="RemainD"></strong>Days </span>
                    <span id="hideH"><strong id="RemainH"></strong>Hours </span>
                    <span id="hideM"> <strong id="RemainM"></strong>Minutes </span>
                    <span id="hideS"><strong id="RemainS"></strong>Seconds </span>
                </h4>

                <div style="margin-top: 20px;">

                    <div class="col-sm-2">
                        <div class="price-icon"></div>
                    </div>

                    <div class="col-sm-10">
                        <form action="process_bid.php" method="POST">

                            <div class="row form-group">
                                <label for="item_id" class="col-sm-4 col-form-label text-right item-id-label">ID:</label>
                                <input type="text" class="form-control col-sm-8 item-id-input" id="item_id" name="item_id" value="<?php echo $item_id ?>" placeholder="<?php echo $item_id ?>" readonly="readonly">
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-8">
                                    <input type="text" id="bid_price" name="bid_price" placeholder="Enter Your Bid" class="form-control input-frame" <?php if (!isset($_SESSION['logged_in'])) echo ('disabled'); ?>>
                                </div>
                                <input type="submit" class="btn btn-default item-button" value="Bid Now" name="submit" id="submit" <?php if (!isset($_SESSION['logged_in'])) echo ('disabled'); ?> />
                            </div>




                            <!-- <form action='process_bid.php' method='POST'>
                                <div class='form-group col-md-12' style='text-align:center;'>
                                    <div class='row'>
                                        <label for='item_id' class='col-sm-4 col-form-label text-right item-id-label'>Item_id:</label>
                                        <input type='text' class='form-control col-sm-8 item-id-input' id='item_id' name='item_id' placeholder='$item_id'' value =' $item_id' readonly='readonly'>
                                    </div>
                                    <input type='submit' class='btn btn-default browse-button' value='Bid Now' name='submit' id='submit'>
                                </div>
                            </form> -->


                        </form>

                    </div>

                </div>
            </div>
        </div>


</body>



</html>


<script>
    // JavaScript functions: addToWatchlist and removeFromWatchlist.

    function addToWatchlist(button) {
        console.log("These print statements are helpful for debugging btw");

        // This performs an asynchronous call to a PHP function using POST method.
        // Sends item ID as an argument to that function.
        $.ajax('process_watchlist.php', {
            type: "POST",
            data: {
                functionname: 'add_to_watchlist',
                arguments: [<?php echo ($item_id); ?>]
            },

            success: function(obj, textstatus) {
                // Callback function for when call is successful and returns obj
                console.log("Success");
                var objT = obj.trim();

                if (objT == "success") {
                    console.log("sql success");
                    $("#watch_nowatch").hide();
                    $("#watch_watching").show();
                } else {
                    console.log(objT);
                    var mydiv = document.getElementById("watch_nowatch");
                    mydiv.appendChild(document.createElement("br"));
                    mydiv.appendChild(document.createTextNode("Add to watch failed. Try again later."));
                }
            },

            error: function(obj, textstatus) {
                console.log("Error");
            }
        }); // End of AJAX call

    } // End of addToWatchlist func

    function removeFromWatchlist(button) {
        // This performs an asynchronous call to a PHP function using POST method.
        // Sends item ID as an argument to that function.
        $.ajax('process_watchlist.php', {
            type: "POST",
            data: {
                functionname: 'remove_from_watchlist',
                arguments: [<?php echo ($item_id); ?>]
            },

            success: function(obj, textstatus) {
                // Callback function for when call is successful and returns obj
                console.log("Success");
                var objT = obj.trim();

                if (objT == "success") {
                    $("#watch_watching").hide();
                    $("#watch_nowatch").show();
                } else {
                    var mydiv = document.getElementById("watch_watching");
                    mydiv.appendChild(document.createElement("br"));
                    mydiv.appendChild(document.createTextNode("Watch removal failed. Try again later."));
                }
            },

            error: function(obj, textstatus) {
                console.log("Error");
            }
        }); // End of AJAX call

    } // End of addToWatchlist func
</script>