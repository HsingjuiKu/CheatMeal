<!-- MAINLY HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>login form</title>

    <!-- custom css file link  -->
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=K2D&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</head>


<script type="text/javascript">
    $(function() {
        $('form').submit(function() {
            var username = $('#username').val();
            var password = $('#password').val();

            if ($.trim(username) == '') {
                alert('Please enter username.');
                return false;
            }
            if ($.trim(password) == '') {
                alert('Please enter your password.');
                return false;
            }
            $.post('ajax_login.php', {
                username: username,
                password: password
            }, function(ret) {
                if (ret == 'success') {
                    window.location.href = 'homepage.php';
                } else {
                    alert(ret);
                }
                return false;
            });
            return false;
        });
    })
</script>

<body>
    <div class="logo"></div>


    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <img src="images/login/burger_1.png" alt="bur" class="login-pic">
                <div class="login-hint">
                    <span class="login-title">Welcome Back <br> Little Bidburger</span>
                </div>


                <form role="form" class="form-horizontal" action="process_login.php" method="POST">

                    <label for="username" class="control-label login-label">Username:</label>
                    <div class="form-group">
                        <div class="col-md-2 input-icon1"></div>

                        <div class="col-md-10">
                            <input type='text' id="username" class="form-control input-frame" name="username" required placeholder="enter your username">
                        </div>
                    </div>

                    <label for="password" class="control-label login-label">Password:</label>
                    <div class="form-group">
                        <div class="col-md-2 input-icon2"></div>

                        <div class="col-md-10">
                            <input type='password' id="password" class="form-control input-frame" name="password" required placeholder="enter your password">
                        </div>
                    </div>

                    <div class="form-group col-md-12" style="text-align:center;">
                        <input type="submit" class="btn btn-default login-button" value="Sign In" name="submit" id="submit">
                    </div>

                    <!-- <p>don't have an account? <a href="register_form.php">register now</a></p> -->
                    <p class="login-title" style="width: 360px">Don't have an account? <a href="signup.php" style="font-family:K2D">Sign up now</a>.</p>

                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<span class="error-msg">' . $error . '</span>';
                        };
                    };
                    ?>

                </form>

            </div>
        </div>

    </div>

</body>

</html>


<!-- SWITCH TO SIGNUP PAGE -->