<?php

$link = mysqli_connect("localhost", "root", "root123456", "group_09") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$html = "";
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, "SELECT * FROM products")) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $s_date = $row['createDate'];
        $d_arr = explode(" ", $s_date);
        $date = $d_arr[0];
        $price = $row['price'];
        $quanity = $row['quanity'];
        $content = $row['content'];
        $tag = $row['tag'];
        $img = $row['image'];

        $html .= '<li>'
            . '<div class="member_window_manage_order_description">'
            . '<button type="button" onclick="moreinfo(this)">'
            . '<span>' . $id . '</span>'
            . '<span>' . $name . '</span>'
            . '<span>' . $date . '</span>'
            . '</button>'
            . '</div>'
            . '<div class="member_window_item_padding" style="display: none;">'
            . '<div class="member_window_item_cutting"></div>'
            . '<form action="" method="post" name="form">'
            . '<div class="member_window_manage_product_product">'
            . '<div class="member_window_manage_product_product_image">'
            . '<img src="./backend/images/' . $img . '" alt="" class="pre_img">'
            . '<div class="member_window_create_image_upload" style="display: none;">'
            . '<div>'
            . '<label for="' . $id . '">'
            . '<span>上傳圖片</span>'
            . '</label>'
            . '<input type="file" id="' . $id . '" class="fileInput" accept="image/*">'
            . '</div>'
            . '</div>'
            . '<span class="errormsg"></span>'
            . '</div>'
            . '<div class="member_window_manage_product_product_attr">'
            . '<div class="member_window_manage_product_product_attr_name">'
            . '<span>商品名稱：</span><input type="text" name="name" id="name" value="' . $name . '" disabled>'
            . '<span id="nametxt" class="errormsg"></span>'
            . '</div>'
            . '<div class="member_window_manage_product_product_attr_price">'
            . '<span>商品售價：</span><input type="text" name="price" id="price" value="' . $price . '" disabled>'
            . '<span id="pricetxt" class="errormsg"></span>'
            . ' </div>'
            . '<div class="member_window_manage_product_product_attr_total">'
            . '<span>商品數量：</span><input type="text" name="quanity" id="quanity" value="' . $quanity . '" disabled>'
            . '<span class="errormsg" id="quanitytxt"></span>'
            . '</div>'
            . '<div class="member_window_manage_product_product_attr_tag">'
            . '<span>商品標籤：</span><input type="text" name="tag" id="tag" value="' . $tag . '" disabled>'
            . '<span class="errormsg" id="tagtxt"></span>'
            . '</div>'
            . '<div class="member_window_manage_product_product_attr_summary">'
            . '<span>商品簡介：</span>'
            . '<textarea name="content" id="content" disabled>' . $content . '</textarea>'
            . '<span id="contenttxt" class="errormsg"></span>'
            . '</div>'
            . '</div>'
            . '</div>'
            . '<div class="member_window_item_cutting"></div>'
            . '<div class="member_window_member_btn">'
            . '<div class="member_window_member_accept"><button type="button" onclick="modify(this)">修改內容</button></div>'
            . '<div class="member_window_member_delete"><button type="button" onclick="remove(this)">移除商品</button>'
            . '</div>'
            . '</div>'
            . '</form>'
            . '</div>'
            . ' </li>';
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
    <title>Manage Product to ADS</title>
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
                    <li><a href="manageComment.php">管理評論</a></li>
                    <li><a href="manageOrder.php">管理訂單</a></li>
                    <li style="opacity: 1;"><a href="">管理商品</a></li>
                    <li><a href="adSelect.php">廣告分類</a></li>
                    <li><button onclick="logout()">登出</button></li>
                </ul>
            </div>
            <div class="member_window_right">
                <div class="member_window_manage_search">
                    <button type="button"><a href="createProduct.php">新增商品</a></button>
                    <form action="">
                        <input type="text" placeholder="Search" accept="image/*" hidden>
                    </form>
                </div>
                <div class="member_window_manage_order_bar">
                    <span>商品編號</span><span>商品名稱</span><span>新增日期</span>
                </div>
                <div class="member_window_cutting"></div>
                <div class="member_window_manage_order_list">
                    <ul>
                        <?php echo $html; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php");?>
    <script src="scripts/manageProduct.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>