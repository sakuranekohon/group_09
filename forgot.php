<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Forgot to ADS</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .forgot {
            display: flex;
            align-items: center;
            justify-content: space-around;
            width: 85%;
        }

        .forgot>div:first-child {
            width: 40%;
            font-size: 2rem;
            background-color: white;
        }

        .forgot>input {
            width: 50%;
        }

    </style>
</head>

<body>
    <div>
        <?php include("./php/navNotSearch.php"); ?>
        <div class="login_div">
            <div class="login_window">
                <div class="login_logo">
                    <div class="login_logo_logo">
                        <img src="images/logo.svg" alt="Icon">
                    </div>
                    <div class="login_logo_p">
                        <p>Reset Password</p>
                    </div>
                </div>
                <form name="form" action="" method="post">
                    <div class="login_username"><input type="text" placeholder="Email" id="mail">
                        <span class="errormsg" id="mailtxt"></span>
                    </div>
                    <div class="login_password">
                        <input type="text" placeholder="Username" id="username">
                        <span class="errormsg" id="usernametxt"></span>
                    </div>
                    <div class="forgot">
                        <div id="captcha"></div>
                        <input type="text" placeholder="Captcha" id="cpatchaTextBox" />
                    </div>
                    <span class="errormsg" id="captchatxt"></span>
                    <div class="login_button"><button type="button" onclick="forgot()">Enter</button></div>
                </form>
                <div class="login_href">
                    <a href="login.php" target="_self">Sign in</a>
                    <a href="signup.php" target="_self">Sign up</a>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/mobileBar.js"></script>
    <script src="scripts/forgot.js"></script>
    <script src="scripts/logSignInOut.js"></script>
</body>

</html>