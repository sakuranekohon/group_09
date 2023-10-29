<?php
$count = 0;
$link = mysqli_connect("localhost", "root", "root123456", "group_09") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$html = "";
$pre = "";

// $first=true;
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, "SELECT comment.user,comment.anonymous,comment.comment,comment.cid,products.* from comment join products on comment.product=products.name ORDER BY products.id ASC")) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $cid = $row['cid'];
        $user = $row['user'];
        $s_date = $row['createDate'];
        $d_arr = explode(" ", $s_date);
        $date = $d_arr[0];
        $product = $row['name'];
        $anonymous = $row['anonymous'];
        $comment = $row['comment'];
        if($comment!=""){
            if (($pre != $id) || $count == 0) {
                $html .= '<li>'
                    . '<div class="member_window_manage_comment_description">'
                    .    '<button type="button" onclick="moreinfo(this)">'
                    .        '<span>' . $id . '</span>'
                    .        '<span>' . $product . '</span>'
                    .        '<span>' . $date . '</span>'
                    .    '</button>'
                    . '</div>'
                    . '<div class="member_window_item_padding" style="display:none">'
                    .    '<div >'
                    .        '<div class="member_window_item_cutting"></div>'
                    .        '<div class="member_window_manage_comment_size">'
                    .            '<div class="member_window_manage_comment_poname">'
                    .                '<span>發布者：<span>' . $user . '</span></span>'
                    .                '<div><input type="checkbox" name="" id="" class="'.$anonymous.'" disabled>匿名</div>'
                    .                '<div class="member_window_manage_comment_btn">'
                    .                    '<button type="button" onclick="remove(this)">移除</button>'
                    .                '</div>'
                    .            '</div>'
                    .            '<div class="member_window_manage_comment_bottom">'
                    .                '<div class="member_window_manage_comment_comment">'
                    .                    '<p class="' . $cid . '" >' . $comment
                    .                    '</p>'
                    .                '</div>'
                    .            '</div>'
                    .        '</div>'
                    .    '</div>';
                $count = 1;
            } else if ($pre == $id) {
                // $count=1;
                $html .= '<div >'
                    .        '<div class="member_window_item_cutting"></div>'
                    .        '<div class="member_window_manage_comment_size">'
                    .            '<div class="member_window_manage_comment_poname">'
                    .                '<span>發布者：<span>' . $user . '</span></span>'
                    .                '<div><input type="checkbox" name="" id="" class="'.$anonymous.'" disabled>匿名</div>'
                    .                '<div class="member_window_manage_comment_btn">'
                    .                    '<button type="button" onclick="remove(this)">移除</button>'
                    .                '</div>'
                    .            '</div>'
                    .            '<div class="member_window_manage_comment_bottom">'
                    .                '<div class="member_window_manage_comment_comment">'
                    .                    '<p class="' . $cid . '">' . $comment
                    .                    '</p>'
                    .                '</div>'
                    .            '</div>'
                    .        '</div>'
                    .    '</div>';
                $count++;
                $pre = $id;
                continue;
            }
            if ($pre != $id && $count > 1) {
                $html .= '</div> </li>';
                $count = 0;
            }
            $pre = $id;
        }
        
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
    <title>Manage Comment to ADS</title>
    <link href="styles/member.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
</head>

<body>
    <?php include("./php/navNotSearch.php"); ?>
    <div class="page">
        <div class="member_window">
            <div class="member_window_list">
                <ul>
                    <li><a href="memberData.php">會員資料</a></li>
                    <li><a href="orderStatus.php">訂單進度</a></li>
                    <li><a href="browsingHistory.php">瀏覽紀錄</a></li>
                    <li><a href="buyHistory.php">購買紀錄</a></li>
                    <li><a href="manageMember.php">管理會員</a></li>
                    <li style="opacity: 1;"><a href="">管理評論</a></li>
                    <li><a href="manageOrder.php">管理訂單</a></li>
                    <li><a href="manageProduct.php">管理商品</a></li>
                    <li><a href="adSelect.php">廣告分類</a></li>
                    <li><button onclick="logout()">登出</button></li>
                </ul>
            </div>
            <div class="member_window_right">
                <div class="member_window_manage_search">
                    <form action="">
                        <input type="text" placeholder="Search" hidden>
                    </form>
                </div>
                <div class="member_window_manage_comment_bar">
                    <span>商品編號</span><span>商品名稱</span><span>建立日期</span>
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_manage_comment_list">
                    <ul>
                        <?php echo $html; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php");?>
    <script src="scripts/manageComment.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>