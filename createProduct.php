<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product to ADS</title>
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
                    <li style="opacity: 1;"><a href="manageProduct.php">管理商品</a></li>
                    <li><a href="adSelect.php">廣告分類</a></li>
                    <li><a href="">登出</a></li>
                </ul>
            </div>
            <div class="member_window_right">
                <div class="member_window_create_text">
                    <h3>新增商品</h3>
                </div>
                <div class="member_window_cutting"></div>
                <form name="form" action="" method="post">
                    <div class="member_window_create_size">
                        <div class="member_window_create_image">
                            <div class="member_window_create_image_image">
                                <img src="#" alt="" id="img">
                            </div>
                            <div class="member_window_create_image_upload">
                                <div>
                                    <label for="product_image">
                                        <span id="img_name">上傳圖片</span>
                                    </label>
                                    <input type="file" name="product_image" id="product_image" accept="image/*">
                                </div>
                            </div>
                            <span id="imgtxt" class="errormsg"></span>
                        </div>
                        <div class="member_window_manage_product_product_attr">
                            <div class="member_window_manage_product_product_attr_name">
                                <span>商品名稱：</span><input type="text" name="name" id="name" value="">
                                <span class="errormsg" id="nametxt"></span>
                            </div>
                            <div class="member_window_manage_product_product_attr_price">
                                <span>商品售價：</span><input type="text" name="price" id="price" value="">
                                <span class="errormsg" id="pricetxt"></span>
                            </div>
                            <div class="member_window_manage_product_product_attr_total">
                                <span>商品數量：</span><input type="text" name="quanity" id="quanity" value="">
                                <span class="errormsg" id="quanitytxt"></span>
                            </div>
                            <div class="member_window_manage_product_product_attr_tag">
                                <span>商品標籤：</span><input type="text" name="tag" id="tag" value="">
                                <span class="errormsg" id="tagtxt"></span>
                            </div>
                            <div class="member_window_manage_product_product_attr_summary">
                                <span>商品簡介：</span>
                                <textarea name="content" id="content"></textarea>
                                <span class="errormsg" id="contenttxt"></span>
                            </div>
                        </div>
                    </div>
                    <div class="member_window_cutting"></div>
                    <div class="member_window_member_btn">
                        <div class="member_window_member_accept"><button type="button" onclick="validateForm(this)" id="accept">新增商品</button></div>
                        <div class="member_window_member_delete"><button type="button" onclick="remove()" id="clear">清除內容</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php");?>
    <script src="scripts/createProduct.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>