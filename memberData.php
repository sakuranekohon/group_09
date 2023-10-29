<?php
session_start();
$li = "";
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];

    if ($level == 3) {
        $li = '<li ><a href="manageMember.php">管理會員</a></li>
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
    <title>Member Data to ADS</title>
    <link href="styles/member.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
    <script src="./scripts/checklogin.js"></script>
</head>

<body>
    <?php include("./php/navNotSearch.php"); ?>
    <div class="page">
        <div class="member_window">
            <div class="member_window_list">
                <ul>
                    <li style="opacity: 1;"><a href="">會員資料</a></li>
                    <li><a href="orderStatus.php">訂單進度</a></li>
                    <li><a href="browsingHistory.php">瀏覽紀錄</a></li>
                    <li><a href="buyHistory.php">購買紀錄</a></li>
                    <?php echo $li; ?>
                    <li><button onclick="logout()">登出</button></li>
                </ul>
            </div>

            <div class="member_window_right">
                <div class="member_window_member_avatar">
                    <img src="images/user.svg" alt="avatar">
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_member_info">
                    <div class="member_window_member_info_level"><span>會員等級：</span><span></span></div>
                    <div class="member_window_member_info_name"><span>會員名稱：</span><span></span></div>
                    <div class="member_window_member_info_mail">
                        <span>電子信箱：</span><span></span>
                    </div>
                    <div class="member_window_member_info_phone"><span>電話號碼：</span><span></span></div>
                    <div class="member_window_member_info_sex"><span>性別：</span><span></span></div>
                    <div class="member_window_member_info_address"><span>通訊地址：</span><span></span></div>
                    <div class="member_window_member_info_joinday"><span>加入日期：</span><span></span></div>
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_member_setting"><button type="button"><a href="memberSetting.php">修改資料</a></button></div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php"); ?>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/memberData.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>