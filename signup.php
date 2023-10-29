<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up to ADS</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
</head>

<body>
    <div>
        <?php include("./php/navNotSearch.php");?>
        <div class="login_div">
            <div class="signup_window">
                <div class="login_logo">
                    <div class="signup_logo_logo">
                        <img src="images/logo.svg" alt="Icon">
                    </div>
                    <div class="login_logo_p">
                        <p>Sign up</p>
                    </div>
                </div>
                <form name="form" action="" method="post" class="signupForm">
                    <div class="signup_email">
                        <input type="email" placeholder="Email" id="mail">
                        <span class="errormsg" id="mailtxt"></span>
                    </div>
                    <div class="signup_username">
                        <input type="text" placeholder="Username" id="username">
                        <span class="errormsg" id="usernametxt"></span>
                    </div>
                    <div class="signup_password">
                        <input type="password" placeholder="Password" id="password">
                        <span class="errormsg" id="passwordtxt"></span>
                    </div>
                    <div class="signup_password_check">
                        <input type="password" placeholder="Re-enter Password" id="repassword">
                        <span class="errormsg" id="repasswordtxt"></span>
                    </div>
                    <div class="signup_button"><button type="button" onclick="signup()">Register</button></div>
                </form>
                <div class=" signup_href">
                            <a href="login.php" target="_self">Sign in</a>
                    </div>
            </div>
        </div>
    </div>
    <script src="scripts/signup.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>