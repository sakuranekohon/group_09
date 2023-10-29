<?php
include("backend/mysql.php");
if (isset($_SESSION['user']))
    $user = $_SESSION['user'];
else {
    header('Location: ./login.php');
    exit();
}
// $user = "admin";
checkLogin();
$html = "";
$data = query('SELECT p.image, p.name, p.price FROM browse b join products p on b.product_id = p.id WHERE b.user = ?', [$user]);
for ($i = count($data)-1; $i >=0; $i--) {
    $image = $data[$i]['image'];
    $name = $data[$i]['name'];
    $price = $data[$i]['price'];
    $html .= '<li>
            <div class="member_window_bhistory_product">
                <div><a href="product_page/' . $name . '.html"><img src="backend/images/' . $image . '" alt="product_image"></a></div>
                <div><a href="product_page/' . $name . '.html">' . $name . '</a></div>
                <div><span>' . $price . '</span><span>元</span></div>
            </div>
        </li>';
}

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
    <title>Browsing History to ADS</title>
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
                    <li><a href="memberData.php">會員資料</a></li>
                    <li><a href="orderStatus.php">訂單進度</a></li>
                    <li style="opacity: 1;"><a href="">瀏覽紀錄</a></li>
                    <li><a href="buyHistory.php">購買紀錄</a></li>
                    <?php echo $li; ?>
                    <li><button onclick="logout()">登出</button></li>
                </ul>
            </div>

            <div class="member_window_right">
                <div class="member_window_bhistory_bar">
                    <span>商品圖</span><span>名稱</span><span>售價</span>
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_bhistory_list">
                    <ul>
                        <?php echo $html; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php"); ?>
    <script src="scripts/browseHistory.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>