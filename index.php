<?php

$link = mysqli_connect("localhost", "root", "root123456", "group_09") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$product_link = "";
$count = 0;
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, "SELECT * FROM products")) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $image = $row['image'];
        $price = $row['price'];
        $content = $row['content'];

        $html = '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Product to ADS</title>
            <link rel="stylesheet" type="text/css" href="../styles/style.css">
            <link href="../styles/mobile.css" rel="stylesheet">
            <link rel="icon" href="../images/favicon.ico">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
        </head>
        
        <body>
            <nav class="bar">
                <div class="bar_div">
                    <div class="bar_left">
                        <a href="../index.php" target="_parent"><img src="../images/logo.svg"></a>
                    </div>
                    <div class="bar_middle">
                        <form>
                        <a href="../search.php" target=_parent><input type="text" placeholder="搜尋"></a>
                            <button type="submit"><img src="../images/search.svg" alt="Search" class="bar_img_size"></button>
                        </form>
                    </div>
        
                    <div class="bar_right">
                        <button type="button" class="bar_button"><a href="../cart.php" target="_parent">
                                <img src="../images/cart.svg" alt="Cart" class="bar_img_size"></a></button>
                        <span style="width: 100%;max-width: 15px;"></span>
                        <button type="button" class="bar_button" onclick="intoMemberInfo()"><img src="../images/user.svg" alt="Log in" class="bar_img_size"></button>
                    </div>
                </div>
            </nav>
            <nav class="mobilebar">
        <div class="mobile_div">
            <div class="mobile_logo">
                <a href="../index.php"><img src="../images/logo.svg" alt="logo"></a>
            </div>
            <div class="mobile_menu">
                <button type="button" id="menubtn" onclick="openlist(this)">
                    <div class="more_line"></div>
                    <div class="more_line"></div>
                    <div class="more_line"></div>
                </button>
                <div class="mobile_menuInfo">
                    <ul class="mobile_menuInfo_list">
                        <li>
                            <!-- <input type="text" id="search" placeholder="關鍵字"> -->
                            <a href="../search.php">搜尋</a>
                        </li>
                        <li>
                            <span id="taglistbtn" onclick="openlist(this)">商品分類</span>
                            <ul class="mobile_menuInfo_tag_list" id="tag_list">
                                <!-- <li>少女</li>
                                <li>血腥</li>
                                <li>黑暗</li> -->
                            </ul>
                        </li>
                        <li><a href="../cart.php">購物車</a></li>
                        <li>
                            <span id="memberlistbtn" onclick="openlist(this)">會員</span>
                            <ul class="mobile_menuInfo_member_list">
                                <li><a href="../memberData.php">會員資料</a></li>
                                <li><a href="../orderStatus.php">訂單進度</a></li>
                                <li><a href="../browsingHistory.php">瀏覽紀錄</a></li>
                                <li><a href="../buyHistory.php">購買紀錄</a></li>
                                <li><a href="../manageMember.php">管理會員</a></li>
                                <li><a href="../manageComment.php">管理評論</a></li>
                                <li><a href="../manageOrder.php">管理訂單</a></li>
                                <li><a href="../manageProduct.php">管理商品</a></li>
                                <li><a href="../adSelect.php">廣告分類</a></li>
                            </ul>
                        </li>
                        <li><button onclick="logout()">登出</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
            <div class="product_window">
                <div class="home_sp_select">
                    <h3>商品分類</h3>
                    <ul class="home_sp_sel" id="tag_list">
                    </ul>
                </div>
                <div class="product">
                    <div>
                        <div class="product_item">
                            <div id ="product_id" hidden>' . $id . '</div>
                            <div class="product_item_img"><img src="../backend/images/' . $image . '" alt="product"></div>
                            <div class="product_item_item">
                                <span>' . $name . '</span>
                                <div class="product_item_price"><span>價格</span><span>$' . $price . '</span></div>
                                <form action="" >
                                    <div class="product_item_quality">
                                        <span>數量</span>
                                        <div class="product_item_quality_item">
                                            <button type="button" onclick="minus()"><img src="../images/minus.svg" alt="minus" ></button>
                                            <input type="text" value="1" name="quanity" id="quanity">
                                            <button type="button" onclick="plus()"><img src="../images/plus.svg" alt="plus" ></button>
                                        </div>
                                    </div>
                                    <div class="product_item_add"><button type="button" onclick="add_cart()"><img src="../images/cart.svg"
                                                alt=""><span>加入購物車</span></button></div>
                                </form>
                            </div>
                        </div>
                        <div class="product_describe">
                            <p>' . $content . '</p>
                        </div>
                        <div class="product_comment">
                            <h2>商品評論</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="copyright_line">
                    <span>sakuranekohon and yufang © 2023</span>
                </div>
            </div>
            <script src="../scripts/product.js"></script>
            <script src="../scripts/search.js"></script>
            <script src="../scripts/logSignInOut.js"></script>
            <script src="../scripts/tagSearch.js"></script>
            <script src="../scripts/mobileBar.js"></script>
        </body>
        
        </html>';
        $file = "./product_page/" . $name . '.html';
        file_put_contents($file, $html);

        $product_link .= '<a href="./product_page/' . $name . '.html" target="_self" class="product_size">
            <div>
                <img src="backend/images/' . $image . '" alt="product">
            </div>
            <div class="product_name_money">
                <span>' . $name . '</span>
                <span>$' . $price . '</span>
            </div>
        </a>';
        $count++;
    }
}

mysqli_close($link); // 關閉資料庫連結
// echo ' HTML 檔案已生成！';
?>
<?php
$n = 0;
$i;
while ($n != 5) {
    $r = rand(1, $count);
    for ($i = 0; $i < $n; $i++) {
        if ($num[$i] == $r) {
            break;
        }
    }
    if ($i == $n) {
        $num[$n] = $r;
        $n++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADS</title>
    <link rel="stylesheet" href="styles/member.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/slideshow.css">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
</head>

<body>
    <div>
        <?php include("./php/nav.php"); ?>
        <div class="home_add">
            <div class="slideshow" id="slideshow">
                <!-- <img class="active" src="images/product_picture/00007-2943484054.png">
                <img src="images/product_picture/00010-723932546.png">
                <img src="images/product_picture/00012-2586532077.png">
                <img src="images/product_picture/00050-2268550364.png">
                <img src="images/product_picture/00066-2837206823.png"> -->
                <div class="prev">&#10094;</div>
                <div class="next">&#10095;</div>
                <div class="dots" id="dots">
                    <!-- <div class="dot active"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div> -->
                </div>
            </div>
        </div>
        <div class="home_sp">
            <div class="home_sp_select">
                <h3>商品分類</h3>
                <ul class="home_sp_sel">
                </ul>
            </div>
            <div class="home_sp_product">
                <div class="home_product">
                    <div>
                        <h1>推薦商品</h1>
                        <div class="recommend_product">
                            <!-- <a href="product_page/product10.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00010-723932546.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>Shannon's glance back</span><span>$120</span>
                                </div>
                            </a>
                            <a href="product_page/product9.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00012-2586532077.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>Lyraen's fetters</span><span>$150</span></div>
                            </a>
                            <a href="product_page/product8.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00230-3600779683.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>Fuzzball and Wiggles</span><span>$150</span></div>
                            </a>
                            <a href="product_page/product7.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00007-2943484054.png" alt="product">
                                </div>
                                <div class="product_name_money"><span> Gate of Destiny</span><span>$150</span></div>
                            </a>
                            <a href="product_page/product6.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00050-2268550364.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>Koroko with Adorable Bunny Ears on a Wooden
                                        Crate</span><span>$150</span></div>
                            </a> -->
                        </div>
                        <h1>全部商品</h1>
                        <div class="recommend_product">
                            <?php echo $product_link; ?>
                            <!-- <a href="product_page/product5.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00066-2837206823.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>Deep-seated fear</span><span>$150</span></div>
                            </a>
                            <a href="product_page/product4.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00451-2036282004.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>Blood chainsaw demon</span><span>$160</span></div>
                            </a>
                            <a href="product_page/product3.html" target="_self" class="product_size">
                                <div class="product_name_money">
                                    <img src="images/product_picture/00157-11122.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>The gaze of the rainbow-haired
                                        officer</span><span>$200</span></div>
                            </a>
                            <a href="product_page/product2.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00158-1947708128.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>The Care of the Blue-Haired
                                        Lady</span><span>$170</span></div>
                            </a>
                            <a href="product_page/product1.html" target="_self" class="product_size">
                                <div>
                                    <img src="images/product_picture/00198-3625088706.png" alt="product">
                                </div>
                                <div class="product_name_money"><span>The Girl on the Frozen
                                        Surface</span><span>$210</span></div>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php"); ?>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/search.js"></script>
    <script src="scripts/index.js"></script>
    <script src="scripts/sliideshow.js"></script>
    <script src="scripts/tagSearch.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>