<?php

include("./backend/mysql.php");
if (isset($_SESSION['tag'])) {
    $tag = $_SESSION['tag'];
    unset($_SESSION['tag']);
} else {
    $tag = "";
}
$row = query('SELECT * FROM products WHERE name LIKE ? OR tag LIKE ?', ['%' . $tag . '%', '%' . $tag . '%']);
$row1 = query('SELECT * FROM products');
if ($tag != "") {

    $html = "";
    for ($i = 0; $i < count($row); $i++) {
        $name = $row[$i]['name'];
        $image = $row[$i]['image'];
        $price = $row[$i]['price'];
        $html .= '<a href="./product_page/' . $name . '.html" target="_self" class="product_size">
                <div>
                    <img src="backend/images/' . $image . '" alt="product">
                </div>
                <div class="product_name_money">
                    <span>' . $name . '</span>
                    <span>$' . $price . '</span>
                </div>
            </a>';
    }
} else {
    $html = "";
    for ($i = 0; $i < count($row1); $i++) {
        $name = $row1[$i]['name'];
        $image = $row1[$i]['image'];
        $price = $row1[$i]['price'];
        $html .= '<a href="./product_page/' . $name . '.html" target="_self" class="product_size">
                <div>
                    <img src="backend/images/' . $image . '" alt="product">
                </div>
                <div class="product_name_money">
                    <span>' . $name . '</span>
                    <span>$' . $price . '</span>
                </div>
            </a>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search to ADS</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic&display=swap');

        body>div:first-child {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        body>div:first-child>input {
            font-family: 'Zen Maru Gothic', sans-serif;
            margin-top: 10px;
            width: 80%;
            height: 2rem;
            border: 1px black solid;
            border-radius: 1rem;
            font-size: 1.25rem;
            text-align: center;
            display: none;
        }

        @media (max-width:600px) {
            body>div:first-child>input {
                display: block;
            }  
        }
    </style>
</head>

<body>
    <div>
        <nav class="bar">
            <div class="bar_div">
                <div class="bar_left">
                    <a href="index.php" target="_parent"><img src="images/logo.svg"></a>
                </div>
                <div class="bar_middle">
                    <form>
                        <input type="text" placeholder="搜尋" onkeyup="search_k(event)">
                        <button type="button" onclick="search_k(event)"><a><img src="images/search.svg" alt="Search" class="bar_img_size"></a></button>
                    </form>
                </div>

                <div class="bar_right">
                    <button type="button" class="bar_button"><a href="cart.php">
                            <img src="images/cart.svg" alt="Cart" class="bar_img_size"></a></button>
                    <span style="width: 100%;max-width: 20px;"></span>
                    <button type="button" class="bar_button" onclick="intoMemberInfo()"><img src="images/user.svg" alt="Log in" class="bar_img_size"></button>
                </div>
            </div>
        </nav>
        <nav class="mobilebar">
            <div class="mobile_div">
                <div class="mobile_logo">
                    <a href="index.php"><img src="images/logo.svg" alt="logo"></a>
                </div>
                <div class="mobile_menu">
                    <button type="button" id="menubtn" id = "innSearch" onclick="openlist(this)">
                        <div class="more_line"></div>
                        <div class="more_line"></div>
                        <div class="more_line"></div>
                    </button>
                    <div class="mobile_menuInfo">
                        <ul class="mobile_menuInfo_list">
                            <li>
                                <!-- <input type="text" id="search" placeholder="關鍵字"> -->
                                <a href="search.php">搜尋</a>
                            </li>
                            <li>
                                <span id="taglistbtn" onclick="openlist(this)">商品分類</span>
                                <ul class="mobile_menuInfo_tag_list" id="tag_list">
                                </ul>
                            </li>
                            <li onclick="mobile_cart(this)">購物車</li>
                            <li>
                                <span id="memberlistbtn" onclick="openlist(this)">會員</span>
                                <ul class="mobile_menuInfo_member_list">
                                    <li><a href="memberData.php">會員資料</a></li>
                                    <li><a href="orderStatus.php">訂單進度</a></li>
                                    <li><a href="browsingHistory.php">瀏覽紀錄</a></li>
                                    <li><a href="buyHistory.php">購買紀錄</a></li>
                                    <li><a href="manageMember.php">管理會員</a></li>
                                    <li><a href="manageComment.php">管理評論</a></li>
                                    <li><a href="manageOrder.php">管理訂單</a></li>
                                    <li><a href="manageProduct.php">管理商品</a></li>
                                    <li><a href="adSelect.php">廣告分類</a></li>
                                </ul>
                            </li>
                            <li><button onclick="logout()">登出</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <input type="text" placeholder="搜尋" id="innSearch" onkeyup="search_k(event)">
        <div class="home_sp">
            <div class="home_sp_select">
                <h3>商品分類</h3>
                <ul class="home_sp_sel">
                </ul>
            </div>
            <div class="home_sp_product">
                <div class="home_product">
                    <div>
                        <h1>全部商品</h1>
                        <div class="recommend_product">
                            <?php echo $html; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php"); ?>
    <script src="scripts/search.js"></script>
    <script src="scripts/tagSearch.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>