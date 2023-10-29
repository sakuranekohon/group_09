<?php
    session_start();
    $li="";
    if(isset($_SESSION['level'])){
        $level=$_SESSION['level'];
        
        if($level==3){
            $li='<li ><a href="manageMember.php">管理會員</a></li>
                <li ><a href="manageComment.php" >管理評論</a></li>
                <li ><a href="manageOrder.php" >管理訂單</a></li>
                <li ><a href="manageProduct.php" >管理商品</a></li>
                <li ><a href="adSelect.php">廣告分類</a></li>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Setting to ADS</title>
    <link href="styles/member.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <script src="./scripts/checklogin.js"></script>
</head>

<body>
    <?php include("./php/navNotSearch.php"); ?>
    <div class="page">
        <div class="member_window">
            <div class="member_window_list">
                <ul>
                    <li style="opacity: 1;"><a href="memberData.php">會員資料</a></li>
                    <li><a href="orderStatus.php">訂單進度</a></li>
                    <li><a href="browsingHistory.php">瀏覽紀錄</a></li>
                    <li><a href="buyHistory.php">購買紀錄</a></li>
                    <?php echo $li;?>
                    <li><button onclick="logout()">登出</button></li>
                </ul>
            </div>

            <div class="member_window_right">
                <form name="form" action="" method="post">
                    <div class="member_window_member_avatar">
                        <img src="images/user.svg" alt="avatar">
                        <!-- <input type="file" accept="image/png, image/jpeg"> -->
                    </div>
                    <div class="member_window_cutting"></div>
                    <div class="member_window_member_info">
                        <div class="member_window_member_info_level"><span>會員等級：</span><input type="text" value="" id="level" disabled>
                        </div>
                        <div class="member_window_member_info_name"><span>會員名稱：</span><input type="text" value="" id="username">
                            <span id="nametxt" class="errormsg"></span>
                        </div>
                        <div class="member_window_member_info_mail"><span>電子信箱：</span><input type="text" value="" id="mail"></span>
                            <span id="mailtxt" class="errormsg"></span>
                        </div>
                        <div class="member_window_member_info_phone"><span>電話號碼：</span><input type="text" value="" id="phone" name="phone">
                            <span id="phonetxt" class="errormsg"></span>
                        </div>
                        <div class="member_window_member_info_sex"><span>性　　別：</span>
                            <select name="sex" id="sex">
                                <option value="none">未設定</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="member_window_member_info_password"><span>修改密碼：</span><input type="password" value="" id="password">
                            <span id="passwordtxt" class="errormsg"></span>
                        </div>
                        <div class="member_window_member_info_repassword"><span>再次確認：</span><input type="password" value="" id="repassword">
                            <span id="repasswordtxt" class="errormsg"></span>
                        </div>
                        <div class="member_window_member_info_address"><span>通訊地址：</span><input type="text" id="address" value="">
                            <span id="addresstxt" class="errormsg"></span>
                        </div>
                    </div>
                    <div class="member_window_cutting"></div>
                    <div class="member_window_member_btn">
                        <div class="member_window_member_accept"><button type="button" onclick="return validateForm()">確認修改</button></div>
                        <div class="member_window_member_delete"><button type="button" onclick="remove()">刪除帳號</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php");?>
    <script src="scripts/memberSetting.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>