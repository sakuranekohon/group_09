<?php
$count=0;
$link = mysqli_connect("localhost", "root", "root123456", "group_09") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$html="";
$pre="";
// $first=true;
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, "SELECT orders.*,products.price,products.image FROM orders join products on orders.product_name=products.name ORDER BY orders.id ASC")) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id=$row['id'];
        $purchaser=$row['purchaser'];
        $s_date=$row['buyDate'];
        $d_arr=explode(" ",$s_date);
        $date=$d_arr[0];
        $product_name=$row['product_name'];
        $quanity=$row['quanity'];
        $price=$row['price'];
        $img=$row['image'];
        $totalprice=$row['totalprice'];
        $remark=$row['remark'];
        $payment=$row['payment'];
        $status=$row['status'];
        
        if (($pre != $id) || $count == 0) {
            $html.='<li>'
        .'<div class="member_window_manage_order_description">'
        .    '<button type="button" onclick="moreinfo(this)">'
        .        '<span>'.$id.'</span>'
        .        '<span>'.$purchaser.'</span>'
        .        '<span>'.$date.'</span>'
        .    '</button>'
        .'</div>'
        .'<div class="member_window_item_padding" style="display:none">'
        .    '<div class="member_window_item_cutting"></div>'
        .    '<div>'
        .        '<div class="member_window_manage_order_product">'
        .            '<div class="member_window_manage_order_product_image">'
        .                '<img src="backend/images/'.$img.'" alt="product_image">'
        .            '</div>'
        .            '<div class="member_window_manage_order_product_price">'
        .                '<span>商品名　：<span>'.$product_name.'</span></span>'
        .                '<span>數　　量：<span>'.$quanity.'</span></span>'
        .                '<span>價　　格：<span>'.$price.'</span></span>'
        .                '<span>付款方式：<span>'.$payment.'</span></span>'
        .                '<span>備　　註：<span>'.$remark.'</span></span>'
        .         '<form action="" class="'.$status.'">'
        .            '<select onchange="statusChange(this)">'
        .                '<option value="0">未付款</option>'
        .                '<option value="1">審查中</option>'
        .                '<option value="2">備貨中</option>'
        .                '<option value="3">出貨</option>'
        .                '<option value="4">送達</option>'
        .            '</select>'
        .        '</form>'
        .            '</div>'
        .        '</div>';
        $count=1;
        } else if ($pre == $id) {
            $html.='<div class="member_window_manage_order_product">'
            .            '<div class="member_window_manage_order_product_image">'
            .                '<img src="backend/images/'.$img.'" alt="product_image">'
            .            '</div>'
            .            '<div class="member_window_manage_order_product_price">'
            .                '<span>商品名　：<span>'.$product_name.'</span></span>'
            .                '<span>數　　量：<span>'.$quanity.'</span></span>'
            .                '<span>價　　格：<span>'.$price.'</span></span>'
            .                '<span>付款方式：<span>'.$payment.'</span></span>'
            .                '<span>備　　註：<span>'.$remark.'</span></span>'
            .         '<form action="" class="'.$status.'">'
            .            '<select onchange="statusChange(this)">'
            .                '<option value="0">未付款</option>'
            .                '<option value="1">審查中</option>'
            .                '<option value="2">備貨中</option>'
            .                '<option value="3">出貨</option>'
            .                '<option value="4">送達</option>'
            .            '</select>'
            .        '</form>'
            .            '</div>'
            .        '</div>';
            $count++;
            continue;
        }
        if ($pre != $id && $count > 1) {
                $html.='</div>'
        .    '<div class="member_window_item_cutting"></div>'
        .    '<div class="member_window_manage_order_product_totalprice">'
        .        '<form action="">'
        .            '<select name="" class="'.$status.'">'
        .                '<option value="0">未付款</option>'
        .                '<option value="1">審查中</option>'
        .                '<option value="2">備貨中</option>'
        .                '<option value="3">已出貨</option>'
        .                '<option value="4">送達</option>'
        .            '</select>'
        .        '</form>'
        .        '<span>總金額：<span>'.$totalprice.'</span><span>元</span></span>'
        .    '</div>'
        .'</div>'
        .'</li>';

        $count=0;
        }
        $pre = $id;
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
    <title>Manage Order to ADS</title>
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
                    <li><a href="manageMember.php">管理會員</a></li>
                    <li><a href="manageComment.php">管理評論</a></li>
                    <li style="opacity: 1;"><a href="">管理訂單</a></li>
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
                <div class="member_window_manage_order_bar">
                    <span>訂單編號</span><span>購買者</span><span>下單日期</span>
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_manage_order_list">
                    <ul>
                        <?php echo $html;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php");?>
    <script src="scripts/orderStatus.js"></script>
    <script src="scripts/manageOrder.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>