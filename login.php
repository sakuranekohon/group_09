<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to ADS</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
</head>

<body>
    <div>
        <?php include("./php/navNotSearch.php");?>
        <div class="login_div">
            <div class="login_window">
                <div class="login_logo">
                    <div class="login_logo_logo">
                        <img src="images/logo.svg" alt="Icon">
                    </div>
                    <div class="login_logo_p">
                        <p>讓圖跟這你</p>
                    </div>
                </div>
                <form id="loginForm" action="" method="post">
                    <div class="login_username">
                        <input type="text" placeholder="Username or Email" id="account" name = "account">
                    </div>
                    <div class="login_password">
                        <input type="password" placeholder="Password" id="password" name = "password">
                    </div>
                    <span class="errormsg" id="errortxt"></span>
                    <div class="login_button"><button type="button" onclick="login()">Sign in</button></div>
                </form>
                <div class="login_href">
                    <a href="signup.php" target="_self">Sign up</a>
                    <a href="forgot.php" target="_self">Forgot?</a>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/signin.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>