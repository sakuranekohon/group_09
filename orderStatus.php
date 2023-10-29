<?php
include("backend/mysql.php");
if (isset($_SESSION['user']))
    $user = $_SESSION['user'];
else {
    header('Location: ./login.php');
    exit();
}
checkLogin();
// $user = "admin";
$html = "";
$count = 0;
$pre = "";
$data = query('SELECT o.*, p.price,p.image FROM orders o JOIN products p ON o.product_name = p.name WHERE o.user = ? ORDER BY id ASC', [$user]);
for ($i = 0; $i < count($data); $i++) {
    $id = $data[$i]['id'];
    $product = $data[$i]['product_name'];
    $quanity = $data[$i]['quanity'];
    $price = $data[$i]['price'];
    // $total_p = $data[$i]['totalprice'];
    $date = explode(" ", $data[$i]['buyDate'])[0];
    $payment = $data[$i]['payment'];
    $remark = $data[$i]['remark'];
    $status = $data[$i]['status'];
    $image = $data[$i]['image'];
    if (($pre != $id) || $count == 0) {
        $html .= '<li>
            <div class="member_window_status_product">
                <div>
                    <div class="member_window_status_product_description">
                        <button type="button" onclick="moreinfo(this)">
                            <span>' . $id . '</span>
                            <span>' . $date . '</span>
                            <span><p onclick="remove(this)">移除</p></span>
                        </button>
                    </div>
                    <div class="member_window_item_padding" style="display:none;">
                        <div class="member_window_item_cutting"></div>
                        <div class="member_window_status_product_details">
                            <div class="member_window_status_product_details_image">
                                <img src="backend/images/' . $image . '" alt="product_image">
                            </div>
                            <div class="member_window_status_product_details_right">
                                <div class="member_window_status_product_details_price">
                                    <div class="member_window_status_product_details_price_number">
                                        <span>數量：</span><span>' . $quanity . '</span>
                                    </div>
                                    <div class="member_window_status_product_details_price_totalprice">
                                        <span>總價格：</span><span>' . $quanity * $price . '</span><span>元</span>
                                    </div>
                                    <div class="member_window_status_product_details_price_buyday">
                                        <span>購買日期：</span><span>' . $date . '</span>
                                    </div>
                                    <div class="member_window_status_product_details_price_method">
                                        <span>付款方式：</span><span>' . $payment . '</span>
                                    </div>
                                </div>
                                <div class="member_window_status_product_details_progress">
                                    <span>訂單狀態</span>
                                    <div class="member_window_status_product_details_progress_image" style="margin-top:20px;">
                                        <div class="progress-bar">
                                            <div class="progress">
                                                <input type="text" value="' . $status . '" hidden>
                                            </div>
                                        </div>
                                        <div class="circle">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                        <div class="state">
                                            <div>未付款</div>
                                            <div>審查中</div>
                                            <div>備貨中</div>
                                            <div>已出貨</div>
                                            <div>送達</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>';
        $count = 1;
    } else if ($pre == $id) {
        $html .= '<div class="member_window_item_cutting"></div>
            <div class="member_window_status_product_details">
                <div class="member_window_status_product_details_image">
                    <img src="backend/images/' . $image . '" alt="product_image">
                </div>
                <div class="member_window_status_product_details_right">
                    <div class="member_window_status_product_details_price">
                        <div class="member_window_status_product_details_price_number">
                            <span>數量：</span><span>' . $quanity . '</span>
                        </div>
                        <div class="member_window_status_product_details_price_totalprice">
                            <span>總價格：</span><span>' . $quanity * $price . '</span><span>元</span>
                        </div>
                        <div class="member_window_status_product_details_price_buyday">
                            <span>購買日期：</span><span>' . $date . '</span>
                        </div>
                        <div class="member_window_status_product_details_price_method">
                            <span>付款方式：</span><span>' . $payment . '</span>
                        </div>
                    </div>
                    <div class="member_window_status_product_details_progress">
                        <span>訂單狀態</span>
                        <div class="member_window_status_product_details_progress_image" style="margin-top:20px;">
                            <div class="progress-bar">
                                <div class="progress">
                                    <input type="text" value="' . $status . '" hidden>
                                </div>
                            </div>
                            <div class="circle">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <div class="state">
                                <div>審查中</div>
                                <div>備貨中</div>
                                <div>出貨中</div>
                                <div>宅配中</div>
                                <div>送達</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        $count++;
        $pre = $id;
        continue;
    }
    if ($pre != $id && $count > 1) {
        $html .= ' </div>
                </li';
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
    <title>Order Status to ADS</title>
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
                    <li style="opacity: 1;"><a href="">訂單進度</a></li>
                    <li><a href="browsingHistory.php">瀏覽紀錄</a></li>
                    <li><a href="buyHistory.php">購買紀錄</a></li>
                    <?php echo $li; ?>
                    <li><button onclick="logout()">登出</button></li>
                </ul>
            </div>

            <div class="member_window_right">
                <div class="member_window_status_bar">
                    <span>訂單編號</span><span>購買日期</span><span>刪除訂單</span>
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_status_list">
                    <ul>
                        <?php echo $html; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php"); ?>
    <script src="scripts/orderStatus.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>