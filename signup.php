<!-- //TASK1: USE html FORM TO GET INPUT
     jump to process_registration.php -->
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

<script type="text/javascript">
    function checkPass(pass) {
        if (pass.length < 6) {
            return false;
        }
        var ls = 0;
        if (pass.match(/([a-z])+/)) {
            ls++;
        }
        if (pass.match(/([0-9])+/)) {
            ls++;
        }
        if (pass.match(/([A-Z])+/)) {
            ls++;
        }
        console.log(ls);
        return ls > 2;
    }

    function validateForm() {

        var username = document.getElementById("username").value;
        if (username == '') {
            alert('Please input username');
            document.getElementById("username").focus();
            return false;
        }

        // check username
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", "./ajax_username.php?username=" + username, true);
        xmlHttp.send(null);
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                if (xmlHttp.responseText == 1) {
                    alert('You have an account already');
                    document.getElementById("username").focus();
                    return false;
                    return false;
                } else {
                    var email = document.getElementById("email").value;
                    var email_reg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                    if (email == '' || !email_reg.test(email)) {
                        alert('Input a valid email address');
                        document.getElementById("email").focus();
                        return false;
                    }

                    var password = document.getElementById("password").value;
                    if (password == '' || !checkPass(password)) {
                        alert('Input a valid password,must contain lowercase,uppercase,number and longer than 6');
                        document.getElementById("password").focus();
                        return false;
                    }

                    var repassword = document.getElementById("passwordConfirmation").value;
                    if (repassword != password) {
                        alert('Put the same password');
                        document.getElementById("passwordConfirmation").focus();
                        return false;
                    }

                    var firstname = document.getElementById("firstname").value;
                    if (firstname == "" || !/^[a-zA-Z\s]+$/.test(firstname)) {
                        alert('Input a valid firstname');
                        document.getElementById("firstname").focus();
                        return false;
                    }

                    var familyname = document.getElementById("familyname").value;
                    if (familyname == "" || !/^[a-zA-Z\s]+$/.test(familyname)) {
                        alert('Input a valid familyname');
                        document.getElementById("familyname").focus();
                        return false;
                    }

                    // var gender = document.getElementById("gender").value;
                    // if (gender == '') {
                    //     alert('Please Input gender');
                    //     document.getElementById("gender").focus();
                    //     return false;
                    // }

                    var birthday = document.getElementById("date_of_birth").value;
                    if (birthday == '') {
                        alert('Please Input birthday');
                        document.getElementById("date_of_birth").focus();
                        return false;
                    }

                    var phone = document.getElementById("phonenumber").value;
                    if (phone.length != 11) {
                        alert('Check your phone number');
                        // document.getElementById("phone").focus();
                        return false;
                    }

                    var address = document.getElementById("address").value;
                    if (address == '') {
                        alert('Please Input address');
                        document.getElementById("address").focus();
                        return false;
                    }

                    return document.getElementById('form').submit();
                }
            }
        }

        return false;

    }
</script>

<body>
    <div class="logo"></div>

    <div class=" container">

        <div class=" col-md-6 col-md-offset-3">
            <div style="margin-left: 120px;">
                <img src="images/login/burger_1.png" alt="bur" class="login-pic">
                <div class="login-hint">
                    <span class="login-title">Welcome <br> Little Bidburger</span>
                </div>
            </div>

            <h2 class="my-3 register-title">Register New Account</h2>
            <form method="POST" action="process_registration.php" role="form" class=" form-horizontal" id="form">

                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label text-right register-label">Username:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="username" placeholder="Username" name="username">
                        <small id="usernameHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-right register-label">Email:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="email" placeholder="Email" name="email">
                        <small id="emailHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label text-right register-label">Password:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control input-frame" id="password" placeholder="Password" name="password">
                        <small id="passwordHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="passwordConfirmation" class="col-sm-4 col-form-label text-right register-label">Repeat password:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control input-frame" id="passwordConfirmation" placeholder="Enter password again" name="passwordConfirmation">
                        <small id="passwordConfirmationHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-sm-4 col-form-label text-right register-label">Role:</label>
                    <div class="col-sm-8">
                        <label class="radio-inline register-label col-sm-3" style="width:100px; margin: left 20px;">
                            <input type="radio" name="role" id="role1" value="seller" checked> Seller
                        </label>
                        <label class="radio-inline register-label col-sm-3" style="width:100px">
                            <input type="radio" name="role" id="role2" value="buyer"> Buyer
                        </label>
                        <label class="radio-inline register-label col-sm-3" style="width:100px">
                            <input type="radio" name="role" id="role3" value="both"> Both
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phonenumber" class="col-sm-4 col-form-label text-right register-label">Phone number:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="phonenumber" placeholder="Enter phone number" name="phonenumber">
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="firstname" class="col-sm-4 col-form-label text-right register-label">First name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="firstname" placeholder="Enter First name" name="firstname">
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="familyname" class="col-sm-4 col-form-label text-right register-label">Family name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="familyname" placeholder="Enter family name" name="familyname">
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date_of_birth" class="col-sm-4 col-form-label text-right register-label">Date of Birth:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="date_of_birth" placeholder="Enter your birthday" name="date_of_birth">
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="role" class="col-sm-4 col-form-label text-right register-label">Gender:</label>
                    <div class="col-sm-8">
                        <label class="radio-inline register-label col-sm-3" style="width:100px; margin: left 20px;">
                            <input type="radio" name="gender" id="male" value="1" checked> Male
                        </label>
                        <label class="radio-inline register-label col-sm-3" style="width:100px">
                            <input type="radio" name="gender" id="female" value="0"> Female
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-sm-4 col-form-label text-right register-label">Address:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-frame" id="address" placeholder="Enter address" name="address">
                        <small id="text" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
                    </div>
                </div>

                <div class="form-group col-md-12" style="text-align:center;">
                    <input type="submit" class="btn btn-default login-button" onclick="return validateForm()" value="Register" />
                </div>
            </form>

        </div>
    </div>


</body>

<script type="text/javascript">
    var a = document.getElementById("username").value;
    console.log(a)
</script>
</form>

<!-- TASK2: SWITHCH TO LOGIN PAGE AFTER FINISHNING THE REGISTERATION -->