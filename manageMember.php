<?php

$link = mysqli_connect("localhost", "root", "root123456", "group_09") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$html="";
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, "SELECT * FROM member")) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id=$row['id'];
        $user=$row['user'];
        $s_date=$row['createDate'];
        $d_arr=explode(" ",$s_date);
        $date=$d_arr[0];
        $mail=$row['mail'];
        $phone=$row['phone'];
        $addr=$row['address'];
        $level=$row['level'];
        $sex=$row['sex'];
        
        $html.='<li>'
        . '<div class="member_window_manage_member_description">'
        . '<button type="button" onclick="moreinfo(this)">'
        . '<span>' .$id.'</span>'
        . '<span>' .$user. '</span>'
        . '<span>' .$date. '</span>'
        . '</button>'
        . '<div class="member_window_manage_member_details member_window_item_padding" style="display:none">'
        . '<div class="member_window_item_cutting"></div>'
        . '<form name="form" action=""  method="post">'
        . '<div class="member_window_member_info" style="margin: 7px 0px;">'
        . '<div class="member_window_member_info_level"><span>會員等級：</span>'
        . '<select name="level" id="'.$id.'" class="'.$level.'"disabled>'
        . '<option value="copper">copper</option>'
        . '<option value="silver">silver</option>'
        . '<option value="golden">golden</option>'
        . '</select>'
        . '</div>'
        . ' <div class="member_window_member_info_name"><span>會員名稱：</span><input'
        . ' type="text" value="' .$user. '" id="username" disabled>'
        . '<span id="nametxt" class="errormsg"></span>'
        . '</div>'
        . '<div class="member_window_member_info_mail"><span>電子信箱：</span><input'
        . ' type="email" value="' .$mail. '" id="mail" disabled></span>'
        . '<span id="mailtxt" class="errormsg"></span>'
        . '</div>'
        . '<div class="member_window_member_info_phone"><span>電話號碼：</span><input'
        . ' type="text" value="' .$phone. '" id="phone" disabled>'
        . '<span id="phonetxt" class="errormsg"></span>'
        . '</div>'
        . '<div class="member_window_member_info_sex "><span>性　　別：</span>'
        . '<select name="sex" id="sex" class="'.$sex.'" disabled>'
        . '<option value="none">未設定</option>'
        . '<option value="男">男</option>'
        . '<option value="女">女</option>'
        . '</select>'
        . '</div>'
        . '<div class="member_window_member_info_address"><span>通訊地址：</span><input type="text" value="' .$addr. '" id="address" disabled>'
        . '<span id="addresstxt" class="errormsg"></span>'
        . '</div>'
        . '</div>'
        . '<div class="member_window_item_cutting"></div>'
        . '<div class="member_window_member_btn">'
        . '<div class="member_window_member_accept"><button type="button" onclick=" modify(this)">修改內容</button>'
        . '</div>'
        . '<div class="member_window_member_delete"><button type="button" onclick="remove(this)">刪除帳號</button>'
        . '</div>'
        . '</div>'
        . '</form>'
        . '</div>'
        . '</div>'
        . '</li>';
    }
}

mysqli_close($link); // 關閉資料庫連結
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Member to ADS</title>
    <link href="styles/member.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
</head>

<body>
<?php include("./php/navNotSearch.php");?>
    <div class="page">
        <div class="member_window">
            <div class="member_window_list">
                <ul>
                    <li><a href="memberData.php">會員資料</a></li>
                    <li><a href="orderStatus.php">訂單進度</a></li>
                    <li><a href="browsingHistory.php">瀏覽紀錄</a></li>
                    <li><a href="buyHistory.php">購買紀錄</a></li>
                    <li style="opacity: 1;"><a href="">管理會員</a></li>
                    <li><a href="manageComment.php">管理評論</a></li>
                    <li><a href="manageOrder.php">管理訂單</a></li>
                    <li><a href="manageProduct.php">管理商品</a></li>
                    <li><a href="adSelect.php">廣告分類</a></li>
                    <li ><button onclick="logout()">登出</button></li>
                </ul>
            </div>

            <div class="member_window_right">
                <div class="member_window_manage_search">
                    <form action="">
                        <input type="text" placeholder="Search" hidden>
                    </form>
                </div>
                <div class="member_window_manage_member_bar">
                    <span>會員編號</span><span>會員名稱</span><span>加入日期</span>
                </div>
                
                <div class="member_window_cutting"></div>
                <div class="member_window_manage_member_list">
                    <ul>
                        <?php echo $html;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php");?>
    <script src="scripts/manageMember.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>