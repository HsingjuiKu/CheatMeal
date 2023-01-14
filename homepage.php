<!--  -->


<?php
// Null coalescing operator - sets to a default value if null or undefined
$keyword = $_GET['keyword'] ?? "";
$category = $_GET['category'] ?? "all";
$ordering = $_GET['order_by'] ?? "name";


include_once('utilities.php');
?>
<!-- display a part of auctions -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'header.php';
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    ?>


    <div class=" container">
        <div class="home-middle">
            <div class="row">
                <div class="col-md-4 home-pic"> </div>
                <div class="col-md-8 home-info">
                    <div class="home-title1 ">The Best Place</div>
                    <div class="home-title2 ">To Buy And Sell</div>
                    <div class="home-register-button"><a href="signup.php" style="color: rgba(255, 255, 255, 1);">Register Now</a></div>
                    <!-- <div class="home-register-button"><a href="recommendations.php" style="color: rgba(255, 255, 255, 1);">Send Recommendation</a></div> -->

                    <button class="btn btn-primary btn-lg home-register-button" data-toggle="modal" data-target="#myModal" style="margin-top : 20px; width:300px; margin-left: 230px;">
                        Receive Recommendations
                    </button>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        Precise Recommendations
                                    </h4>
                                </div>

                                <div class="modal-body row">
                                    <?php
                                    if (isset($user_id)) {
                                        $recommendation = recommendation_by_other_users($user_id);
                                        display_precise_recommendations($recommendation);
                                    } else {
                                        echo "          Please Log In To Check Recommendations For YOU!";
                                    }

                                    ?>



                                </div>

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        Rough Recommendations
                                    </h4>
                                </div>

                                <div class="modal-body row">
                                    <?php
                                    if (isset($user_id)) {
                                        $bid_items = recommmendation_by_category($user_id);
                                        display_item_auctions($bid_items);
                                    } else {
                                        $bid_items_recommendations = recommendation_by_visitor();
                                        display_item_auctions($bid_items_recommendations);
                                    }
                                    ?>
                                </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close Recommendations
                                    </button>
                                </div>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                    </div>

                </div>
            </div>
        </div>

        <div id="searchSpecs" class="row" style="margin-top:20px">

            <form method="get" action="homepage.php" id="form" class="col-md-12">
                <div class="col-md-4">
                    <div class="form-inline">
                        <label for="keyword" class="home-item-name">Search for a keyword:</label>
                        <div class="input-group">
                            <!-- Define value to content of GET here to maintain keyword used after reload -->
                            <input type="text" class="form-control item-id-input" id="keyword" name="keyword" placeholder="Search for anything" value="<?php echo $keyword ?: '' ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-inline">
                        <label for="category" class="home-item-name">Search within:</label>
                        <select class="form-control item-id-input" id="category" name="category" onchange="handleSelectCat();">
                            <?php
                            $item_categories = get_item_categories();
                            echo ("<option id='all' value='all'>All categories</option>");
                            while ($row = mysqli_fetch_array($item_categories)) {
                                echo ("<option id='{$row['category_type']}' value='{$row['category_type']}'> {$row['category_type']} </option>");
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Script to preserve chosen category after reload -->
                <script type='text/javascript'>
                    if (localStorage.getItem('category')) {
                        document.getElementById("<?php echo $_GET['category'] ?>").selected = true;
                    }

                    function handleSelectCat() {
                        document.getElementById('form').submit();
                        localStorage.setItem('category', "<?php echo $_GET['category'] ?>");
                    }
                </script>

                <div class="col-md-3">
                    <div class="form-inline">
                        <!-- <label class="mx-2" for="order_by">Sort by:</label> -->
                        <select class="form-control item-id-input" id="order_by" name='order_by' onchange="handleSelectOrder();">
                            <option value="name" id='name'>Name</option>
                            <option value="pricelow" id='pricelow'>Price (low to high)</option>
                            <option value="pricehigh" id='pricehigh'>Price (high to low)</option>
                            <option value="datesoon" id='datesoon'>Expiry (soonest to latest)</option>
                            <option value="datelate" id='datelate'>Expiry (latest to soonest)</option>
                        </select>
                    </div>
                </div>


                <script type='text/javascript'>
                    if (localStorage.getItem('order_by')) {
                        document.getElementById("<?php echo $_GET['order_by'] ?>").selected = true;
                    }

                    function handleSelectOrder() {
                        document.getElementById('form').submit();
                        localStorage.setItem('order_by', "<?php echo $_GET['order_by'] ?>");
                    }
                </script>

                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary ">Search</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="title" style="font-family: K2D; font-size:40px; text-align:center; margin-top: 20px; margin: bottom 20px;">Latest Auctions</div>
        </div>


        <div class="container">
            <?php
            $result = generate_sql_search($keyword, $category, $ordering);
            if (isset($result)) {
                display_item_auctions($result);
            }
            ?>
        </div>


        <?php


        function generate_sql_search($keyword, $category, $ordering)
        {
            $connection = get_connection();


            include_once('end_auction.php');

            mysqli_close($connection);
            $connection = get_connection();


            //get details of expired auctions if ordering =pricelow/pricehigh
            if ($ordering == 'pricelow' || $ordering == 'pricehigh') {
                $sql_user_watch = "SELECT a.item_id, item_name, end_date, category_type, user_name, MAX(bid_price) max_price
                FROM items a, categories b, users c, bids d
                where a.item_category = b.category_id and a.seller_id = c.user_id and d.item_id = a.item_id
                and a.state = 'active'
                ";
                // Add keyword filter to SQL query
                $sql_user_watch .= " AND (item_name LIKE '%{$keyword}%' OR item_description LIKE '%{$keyword}%')";
                // $sql_user_watch = "SELECT * FROM watchlist WHERE user_id = '{$user_id}'";
                // Add category filter to SQL query
                if ($category != 'all') {
                    $sql_user_watch .= " AND (category_type = '{$category}')";
                }
                $sql_user_watch .= "GROUP BY a.item_id";
                // Add ordering filter to SQL query
                switch ($ordering) {
                    case 'pricelow':
                        $sql_user_watch .= ' ORDER BY max_price ASC';
                        break;
                    case 'pricehigh':
                        $sql_user_watch .= ' ORDER BY max_price DESC';
                        break;
                }
            } else {

                //get details of expired auctions if ordering = name ,expiredate
                $sql_user_watch = "SELECT a.item_id, item_name, end_date, category_type, user_name 
                    FROM items a, categories b, users c
                    where a.item_category = b.category_id and a.seller_id = c.user_id 
                    and a.state = 'active'
                    ";
                // Add keyword filter to SQL query

                // var_dump($sql_user_watch);
                $sql_user_watch .= " AND (item_name LIKE '%{$keyword}%' OR item_description LIKE '%{$keyword}%')";
                // var_dump($sql_user_watch);
                // $sql_user_watch = "SELECT * FROM watchlist WHERE user_id = '{$user_id}'";

                // Add category filter to SQL query
                if ($category != 'all') {
                    $sql_user_watch .= " AND (category_type = '{$category}')";
                }
                // var_dump($sql_user_watch);
                // var_dump($ordering);

                // Add ordering filter to SQL query
                switch ($ordering) {
                    case 'name':
                        $sql_user_watch .= ' ORDER BY item_name ASC';
                        break;
                    case 'datesoon':
                        $sql_user_watch .= ' ORDER BY end_date ASC';
                        break;
                    case 'datelate':
                        $sql_user_watch .= ' ORDER BY end_date DESC';
                        break;
                }
                // var_dump($sql_user_watch);
            }
            // var_dump($sql_user_watch);
            $result = mysqli_query($connection, $sql_user_watch);
            return $result;
        }


        function display_item_auctions($result)
        {

            while ($rows = $result->fetch_assoc()) {
                $item_id = $rows['item_id'];
                $item_name = $rows["item_name"];
                $category = $rows['category_type'];
                $seller_name = $rows['user_name'];

                echo "<div class='col-sm-3'>
                            <img src='images/item_images/the auctions/$item_id.png' class='img-rounded img-responsive homepage-img'>
                            
                            <p class='home-item-name'>$item_name</p>
                            
                                <div class='input-icon3 col-sm-2'></div>
                                <div style='text-align: left'>
                                    <p class='col-sm-4 category-title' >$category</p>
                                </div>
                                <div class='input-icon4 col-sm-3'></div>
                                <div style='text-align: left; padding-top: 5px'>
                                    <p class='col-sm-3 seller-title' >$seller_name</p>
                                </div>

                            <form action='item_display.php' method='POST'>
                                <div class='form-group col-md-12' style='text-align:center;'>
                                    <div class='row'>
                                         <label for='item_id' class='col-sm-4 col-form-label text-right item-id-label'>Number:</label>
                                         <input type='text' class='form-control col-sm-8 item-id-input' id='item_id' name='item_id' placeholder='$item_id' value ='$item_id' readonly='readonly'>
                                    </div>
                                    <input type='submit' class='btn btn-default browse-button' value='Bid Now' name='submit' id='submit'>
                                </div>    
                            </form>

                      </div>";
            };
        }

        function display_precise_recommendations($result)
        {
            if ($rows = $result->fetch_assoc()) {

                $item_id = $rows['item_id'];
                $item_name = $rows["item_name"];
                $item_description = $rows['item_description'];
                $end_time = $rows['end_date'];

                echo "<div class='col-sm-3'>
                            <img src='images/item_images/the auctions/$item_id.png' class='img-rounded img-responsive homepage-img'>
                            </div>";

                echo "<div class='col-sm-6'>
                            <p class='home-item-name'>$item_name</p>
                            
                            <p class='home-item-name' style='color:red;font-size: 25px;'>(Best Matching Auction)</p>

                            <div class='item-description' style = 'margin-top:20px'>
                                 Descriptions: $item_description 
                            </div>
        

                            <form action='item_display.php' method='POST'>
                                <div class='form-group col-md-12' style='text-align:center;'>
                                    <div class='row' style='margin-left:130px'>
                                         <label for='item_id' class='col-sm-4 col-form-label text-right item-id-label'>Number:</label>
                                         <input type='text' class='form-control col-sm-8 item-id-input' id='item_id' name='item_id' placeholder='$item_id' value ='$item_id' readonly='readonly'>
                                    </div>
                                    <input type='submit' class='btn btn-default browse-button' value='Bid Now' name='submit' id='submit'>
                                </div>    
                            </form>

                  </div>
                            ";
            } else {
                echo "Sorry! You Haven't Made Enough For  Us To Give You Precise Recommendations.";
            }
        };

        ?>



    </div>




</body>


<?php include 'footer.php'; ?>