<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart in to ADS</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/member.css">
    <link href="styles/mobile.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
    <script src="./scripts/checklogin.js"></script>
    <style>
        .cart_checkout_page_bar {
            margin: 0px 50px;
            display: flex;
        }

        .cart_checkout_page_bar>span {
            color: rgb(152, 152, 152);
            font-size: 17px;
            text-align: center;
        }

        .cart_checkout_page_product {
            margin: 5px 50px 0px 50px;
            display: flex;
            align-items: center;
            border: #293757 1px solid;
            ;
        }

        .cart_checkout_page_product_item {
            display: flex;
            align-items: center;
            width: 50%;
        }

        .cart_checkout_page_product_price {
            width: 20%;
            text-align: center;
        }

        .cart_checkout_page_product_quanity {
            width: 20%;
            text-align: center;
        }

        .cart_checkout_page_product_totalprice {
            width: 20%;
            text-align: center;
        }

        .cart_checkout_method {
            display: flex;
            margin: 10px 50px;
            flex-direction: column;
        }

        .cart_checkout_method>div {
            margin-left: 30px;
            margin-top: 5px;
        }

        .cart_checkout_remark {
            display: flex;
            flex-direction: column;
            margin: 10px 50px;
        }

        .cart_checkout_remark>textarea {
            margin-left: 30px;
            max-width: 400px;
            width: 100%;
            height: 60px;
            margin-top: 5px;
            resize: none;
        }

        .cart_checkout_info {
            height: 40px;
            display: flex;
            margin-left: 50px;
            margin-right: 50px;
            justify-content: flex-end;
            align-items: center;
            background-color: rgb(191, 187, 187);
        }

        .cart_checkout_puchaser {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .cart_checkout_puchaser>div {
            margin-top: 5px;
            margin-left: 30px;
        }

        .cart_checkout_submit {
            display: flex;
            justify-content: flex-end;
            margin: 5px 50px;
        }

        .cart_checkout_submit>button {
            background-color: #293757;
            color: #F9FAF4;
            height: 40px;
            width: 85px;
            font-size: 16px;
        }

        @media (max-width:600px) {

            .cart_checkout_page_product_price,
            .cart_checkout_page_product_quanity,
            .cart_checkout_totalprice {
                display: none;
            }

            .cart_product_item_item_product {
                text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;
            }

            .cart_checkout {
                grid-template-columns: 50% 50%;
            }

            .cart_checkout_page_bar {
                justify-content: space-between;
            }

            .cart_checkout_page_bar>:nth-child(2),
            .cart_checkout_page_bar>:nth-child(3) {
                display: none;
            }

            .cart_checkout_page_product {
                margin: 5px 10px;
                justify-content: space-around;
            }
        }
    </style>
</head>

<body>
    <div>
        <?php include("./php/navNotSearch.php"); ?>

        <div class="cart_div">
            <div class="cart_menu">
                <div class="cart_menu_product">商 品</div>
                <div class="cart_menu_price">價 格</div>
                <div class="cart_menu_quality">數 量</div>
                <div class="cart_menu_totalprice">總 計</div>
                <div class="cart_menu_delete">刪 除</div>
            </div>
            <div class="cart_product_div">
                <div class="cart_product">
                    <!-- <div class="cart_product_item" id="1">
                        <div class="cart_product_item_item">
                            <input type="checkbox">
                            <div class="cart_product_item_item_product">
                                <a href="" target="_self">
                                    <div>
                                        <img src="images/product-svgrepo-com.svg" class="cart_product_item_img">
                                    </div>
                                </a>
                                <a href="" target="_self">商品敘述</a>
                            </div>
                        </div>

                        <div class="cart_product_item_price">
                            <span>$100</span>
                        </div>
                        <div class="cart_product_item_quality">
                            <div>
                                <button type="button" onclick="minus(this)"><img src="images/minus.svg"
                                        alt="minus"></button>
                                <input type="text" value="1" name="quanity" id="quanity">
                                <button type="button" onclick="plus(this)"><img src="images/plus.svg" alt="plus"></button>
                            </div>
                        </div>
                        <div class="cart_product_item_totalprice">
                            <span>$100</span>
                        </div>
                        <div class="cart_product_item_delete">
                            <button onclick="remove(this)">刪除</button>
                        </div>
                    </div>
                    <div class="cart_product_item">
                        <div class="cart_product_item_item">
                            <input type="checkbox">
                            <div class="cart_product_item_item_product">
                                <a href="" target="_self">
                                    <div>
                                        <img src="images/product-svgrepo-com.svg" class="cart_product_item_img">
                                    </div>
                                </a>
                                <a href="" target="_self">商品敘述</a>
                            </div>
                        </div>

                        <div class="cart_product_item_price">
                            <span>$100</span>
                        </div>
                        <div class="cart_product_item_quality">
                            <div>
                                <button type="button" onclick="minus(this)"><img src="images/minus.svg"
                                        alt="minus"></button>
                                <input type="text" value="1" name="quanity" id="quanity">
                                <button type="button" onclick="plus(this)"><img src="images/plus.svg" alt="plus"></button>
                            </div>
                        </div>
                        <div class="cart_product_item_totalprice">
                            <span>$100</span>
                        </div>
                        <div class="cart_product_item_delete">
                            <button onclick="remove(this)">刪除</button>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="cart_checkout">
                <div class="cart_checkout_choose_all">
                    <input type="checkbox" onchange="sel_all(this)">全選
                </div>
                <div class="cart_checkout_totalprice">
                    <span>　　　　　　　</span>
                    <!-- <span>總金額:</span>
                    <span>$200</span> -->
                </div>
                <div class="cart_checkout_button">
                    <button type="button" onclick="checkout()">結帳</button>
                </div>
            </div>
        </div>
    </div>
    <div class="cart_check" hidden>
        <div class="cart_checkout_page">
            <div class="cart_checkout_page_bar">
                <span style="width: 50%; text-align:left">訂單商品</span>
                <span style="width: 20%;">單價</span>
                <span style="width: 20%;">數量</span>
                <span style="width: 20%;">總價</span>
            </div>
        </div>
        <!-- <div class="cart_checkout_page_product">
                <div class="cart_checkout_page_product_item" >
                    <div>
                        <img src="images/product-svgrepo-com.svg" class="cart_product_item_img">
                    </div>
                    <div>商品敘述</div>
                </div>
                <div class="cart_checkout_page_product_price" >
                    <span>1</span>
                </div>
                <div class="cart_checkout_page_product_quanity" >
                    <span>2</span>
                </div>
                <div class="cart_checkout_page_product_totalprice">
                    <span>1</span>
                </div>
            </div>
            <div class="cart_checkout_page_product">
                <div class="cart_checkout_page_product_item" >
                    <div>
                        <img src="images/product-svgrepo-com.svg" class="cart_product_item_img">
                    </div>
                    <div>商品敘述</div>
                </div>
                <div class="cart_checkout_page_product_price" >
                    <span>1</span>
                </div>
                <div class="cart_checkout_page_product_quanity" >
                    <span>2</span>
                </div>
                <div class="cart_checkout_page_product_totalprice">
                    <span>1</span>
                </div>
            </div> -->
        <div class="cart_checkout_page">
            <div class="cart_checkout_info">
                <span>總金額：</span>
                <span></span>
                <span></span>
            </div>
            <div class="cart_checkout_puchaser">
                <span>訂購資訊：</span>
                <div><span>會員名稱：</span><input type="text"><span class="errormsg"></span></div>
                <div><span>　電話　：</span><input type="text"><span class="errormsg"></span></div>
                <div><span>電子郵件：</span><input type="text"><span class="errormsg"></span></div>

            </div>
            <div class="cart_checkout_method">
                <span>付款方式：</span>
                <div><input type="radio" name="payment" value="匯款">匯款</div>
                <div><input type="radio" name="payment" value="信用卡">信用卡</div>
                <div><input type="radio" name="payment" value="超商繳費">超商繳費</div>
                <span class="errormsg"></span>
            </div>
            <div class="cart_checkout_remark">
                <span> 備註 ： </span>
                <textarea name="remark" id="remark"></textarea>
            </div>
            <div class="cart_checkout_submit">
                <button type="button" onclick="submit()">送出訂單</button>
            </div>
        </div>
    </div>

    <?php include("./php/footer.php"); ?>
    <script src="scripts/cart.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>