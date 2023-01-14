<!-- TAKS1: LOGO ON THE LEFT -->


<!-- TASK2: SEARCH IN THE MIDDLE -->

<!-- TASK3: FUNCTIONS ON THE RIGHT
        INCLUDED:LOGIN 
                 LOG OUT
                 REGISTER
                 RETURN TO HOMEPAGE   
                 Switch to personal page
                 Help document
                 Create auction
        HINT: Funtions displayed Should be determined by the user's login credentials 
    For example: -->
<?php

session_start();


?>

<!doctype html>

<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=K2D&display=swap" rel="stylesheet">
</head>

<body>


    <div class="navbar" style="margin-top: 15px;">
        <!-- <div class="container"> -->
        <div class="navbar-header">
            <a href="homepage.php" class="navbar-brand"></a>
        </div>


        <ul class="nav navbar-nav navbar-right">

            <!-- <li class="header-li">
                
                <div class="header-img1 col-sm-2"></div>
           
                <input type="search" name="" id="" placeholder="Search Bar" class="col-sm-8">
                <button type="button" class="col-sm-2">搜索</button>
              
            </li> -->

            <li class="header-li">
                <span>
                    <div class="header-img2 col-sm-4"></div>
                    <a href="homepage.php" class="header-button col-sm-8">Home</a>
                </span>

            </li>
            <li class="header-li">
                <span>

                    <div class="header-img3 col-sm-4"></div>
                    <a class="header-button col-sm-8" href="help.html">Help</a>
                    <?php

                    ?>
                </span>
            </li>


            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                $username = $_SESSION['username'];
                echo " <li class='header-li'>
                            <span>
                                <div class='header-img4 col-sm-4'></div>
                                <a href='logout.php' class='header-button col-sm-8'>Log out</a>
                            </span>
                       </li>";

                if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'admin') {
                    echo " <li class='header-li'>
                            <span>
                                <div class='header-img5 col-sm-4'></div>
                                <a href='admin_home.php' class='header-button col-sm-8'>Admin</a>
                                </span>
                            </li>";
                } else {
                    if ($_SESSION['account_type'] == 'seller' || $_SESSION['account_type'] == 'both') {
                        echo " <li class='header-li' style='width:200px'>
                        <span>
                            <div class='header-img6 col-sm-4'></div>
                            <a href='item_create.php' class='header-button col-sm-8'>CreateAuction</a>
                            </span>
                        </li>";
                    }

                    echo " <li class='header-li'>
                            <span>
                                <div class='header-img5 col-sm-4'></div>
                                <a href='user_home.php' class='header-button col-sm-8'>$username</a>
                                </span>
                            </li>";
                }
            } else {
                echo " <li class='header-li'>
                            <span>
                                <div class='header-img4 col-sm-2'></div>
                                <a href='signup.php' class='header-button col-sm-10'>Sign Up</a>
                            </span>
                            </li>";

                echo " <li class='header-li'>
                            <span>
                                <div class='header-img5 col-sm-4'></div>
                                <a href='login.php' class='header-button col-sm-8'>Log in</a>
                            </span>
                       </li>";
            }
            ?>

        </ul>
        <!-- </div> -->

    </div>
</body>

</html>