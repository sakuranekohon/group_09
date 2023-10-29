<?php
// <a href="search.php"><input type="text" placeholder="搜尋"></a>
    echo 
    '<nav class="bar">
        <div class="bar_div">
            <div class="bar_left">
                <a href="index.php" target="_parent"><img src="images/logo.svg"></a>
            </div>
            <div class="bar_middle">
                <form>
                 <a href="search.php"><input type="text" placeholder="搜尋"></a>
                    <button type="button" ><a href="search.php"><img src="images/search.svg" alt="Search"
                                class="bar_img_size"></a></button>
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
                <button type="button" id="menubtn" onclick="openlist(this)">
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
                                <!-- <li>少女</li>
                                <li>血腥</li>
                                <li>黑暗</li> -->
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
    </nav>'
?>