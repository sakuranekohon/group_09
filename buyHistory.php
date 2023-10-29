<?php
include("backend/mysql.php");
if (isset($_SESSION['user']))
    $user = $_SESSION['user'];
else{
    header('Location: ./login.php');
    exit();
}

    // $user = "admin";
    checkLogin();
$html = "";
$count = 0;
$pre = "";
$data = query('SELECT c.*,p.price,p.image FROM comment c JOIN products p ON c.product = p.name  WHERE user = ? ORDER BY id ASC', [$user]);
for ($i = 0; $i < count($data); $i++) {
    $id = $data[$i]['cid'];
    $product = $data[$i]['product'];
    $quanity = $data[$i]['quanity'];
    $price = $data[$i]['price'];
    $total_p = $data[$i]['totalprice'];
    $date = explode(" ", $data[$i]['buyDate'])[0];
    $anonymous = $data[$i]['anonymous'];
    $commemt = $data[$i]['comment'];
    $image = $data[$i]['image'];
    if (($pre != $id) || $count == 0) {
        $html .= '<li>
            <div class="member_window_buyhistory_product">
                <div>
                    <div class="member_window_buyhistory_product_number">
                        <button type="button" onclick="moreinfo(this)">
                            <span>' . $id . '</span>
                            <span>' . $total_p . '元</span>
                            <span>' . $date . '</span>
                        </button>
                    </div>
                    <div class="member_window_item_padding" style="display: none;">
                        <div class="member_window_item_cutting"></div>
                        <div class="member_window_status_product_details">
                            <div class="member_window_status_product_details_image">
                                <img src="backend/images/' . $image . '" alt="product_image">
                            </div>
                            <div class="member_window_status_product_details_right">
                                <div class="member_window_buyhistory_product_details_price">
                                    <div class="member_window_buyhistory_product_details_price_name">
                                        <span>商品名：</span><span>' . $product . '</span>
                                    </div>
                                    <div class="member_window_status_product_details_price_number">
                                        <span>數量：</span><span>' . $quanity . '</span>
                                    </div>
                                    <div class="member_window_status_product_details_price_totalprice">
                                        <span>總價格：</span><span>' . $quanity * $price . '</span><span>元</span>
                                    </div>
                                    <div class="member_window_status_product_details_price_buyday">
                                        <span>購買日期：</span><span>' . $date . '</span>
                                    </div>
                                </div>
                                <form name="form" action="" method="post" >
                                    <div class="member_window_buyhistory_product_details_progress">
                                        <div
                                            class="member_window_buyhistory_product_details_progress_top">
                                            <div>
                                                <span>商品評論</span>
                                                <div>
                                                    <input type="checkbox" class="buyHistory_anonymous" onclick="c(this)">
                                                    <span class="' . $anonymous . '">匿名</span>
                                                </div>
                                            </div>
                                            <span id="contenttxt" class="errormsg"></span>
                                            <input value="送出" type="button" onclick="submit_comment(this)">
                                        </div>
                                        <div
                                            class="member_window_status_product_details_progress_image">
                                            <textarea name="content" id="content" >' . $commemt . '</textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>';
        $count = 1;
    } else if ($pre == $id) {
        // $count=1;
        $html .= '<div class="member_window_item_cutting"></div>
            <div class="member_window_status_product_details">
                <div class="member_window_status_product_details_image">
                    <img src="backend/images/' . $image . '" alt="product_image">
                </div>
                <div class="member_window_status_product_details_right">
                    <div class="member_window_buyhistory_product_details_price">
                        <div class="member_window_buyhistory_product_details_price_name">
                            <span>商品名：</span><span>' . $product . '</span>
                        </div>
                        <div class="member_window_status_product_details_price_number">
                            <span>數量：</span><span>' . $quanity . '</span>
                        </div>
                        <div class="member_window_status_product_details_price_totalprice">
                            <span>總價格：</span><span>' . $total_p . '</span><span>元</span>
                        </div>
                        <div class="member_window_status_product_details_price_buyday">
                            <span>購買日期：</span><span>' . $date . '</span>
                        </div>
                    </div>
                    <form name="form" action="" method="post" >
                        <div class="member_window_buyhistory_product_details_progress">
                            <div
                                class="member_window_buyhistory_product_details_progress_top">
                                <div>
                                    <span>商品評論</span>
                                    <div>
                                        <input type="checkbox" class="buyHistory_anonymous" onclick="c(this)">
                                        <span class="' . $anonymous . '">匿名</span>
                                    </div>
                                </div>
                                <span id="contenttxt" class="errormsg"></span>
                                <input value="送出" type="button" onclick="submit_comment(this)">
                            </div>
                            <div
                                class="member_window_status_product_details_progress_image">
                                <textarea name="content" id="content" >' . $commemt . '</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>';
        $count++;
        $pre = $id;
        continue;
    }
    if ($pre != $id && $count > 1) {
        $html .= '        </div>
                        </div>
                    </div>
                </div>
            </li>';
        $count = 0;
    }
    $pre = $id;
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
    <title>Buy History to ADS</title>
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
                    <li><a href="browsingHistory.php">瀏覽紀錄</a></li>
                    <li style="opacity: 1;"><a href="">購買紀錄</a></li>
                    <?php echo $li; ?>
                    <li><button onclick="logout()">登出</button></li>
                </ul>
            </div>

            <div class="member_window_right">
                <div class="member_window_buyhistory_bar">
                    <span>訂單編號</span><span>總金額</span><span>購買日期</span>
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_buyhistory_list">
                    <ul>
                        <?php echo $html; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php"); ?>
    <script src="scripts/buyHistory.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>