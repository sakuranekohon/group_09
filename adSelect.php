<?php
$count_tag=1;
$count_ad=1;
$link = mysqli_connect("localhost", "root", "root123456", "group_09") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$html_tag = "";
$html_ad = "";
// // 資料庫查詢(送出查詢的SQL指令)
if ($result = mysqli_query($link, "SELECT * FROM adselect")) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ad_or_not = $row['isAD'];
        $name=$row['name'];
        if($ad_or_not=='1')
        {
            $html_ad.='<li>
                <div>
                    <form action="">
                        <img src="./backend/ADimages/'.$name.'" alt="" id="'.$name.'">
                        <button type="button" onclick="remove(this)">移除</button>
                    </form>
                </div>
            </li>';

        }
        else{
            $html_tag.='<li>
                <div>
                    <form><span>'.$name.'</span><button type="button" onclick="remove(this)">移除</button></form>
                </div>
            </li>';
        }
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
                    <li><a href="manageOrder.php">管理訂單</a></li>
                    <li><a href="manageProduct.php">管理商品</a></li>
                    <li style="opacity: 1;"><a href="">廣告分類</a></li>
                    <li ><button onclick="logout()">登出</button></li>
                </ul>
            </div>
            <div class="member_window_right">
                <div class="member_window_adSelect_text">
                    <button type="button" onclick="moreinfo_ad()">
                        <h3>輪播圖設定</h3>
                    </button>
                </div>
                <div class="member_window_ad">
                    <div class="member_window_cutting"></div>
                    <div class="member_window_ad_list">
                        <ul>
                            <?php echo $html_ad;?>
                            <!-- <li>
                                <div>
                                    <form action="">
                                        <img src="images/product_picture/00012-2586532077.png" alt="">
                                        <button type="button" onclick="remove(this)">移除</button>
                                    </form>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <form action="">
                                        <img src="images/product_picture/00012-2586532077.png" alt="">
                                        <button type="button" onclick="remove(this)">移除</button>
                                    </form>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                    <div class="member_window_ad_add">
                        <form action="" name="form_ad">
                            <div style="display: flex;align-items: center;">
                                <div class="member_window_ad_image_upload">
                                    <label for="uploadimg">
                                        <span>上傳圖片</span>
                                    </label>
                                    <input type="file" name="uploadimg" id="uploadimg"  class="fileInput" accept="images/*" onchange="ad_showname()">
                                </div>
                                <span id="img_name"></span>
                            </div>
                            <button type="button" id="new_ad" onclick="add_ad()">新增</button>
                            <span id="ad_error" class="errormsg">　　</span>
                        </form>
                    </div>
                    <div class="member_window_cutting"></div>
                </div>

                <div class="member_window_adSelect_text">
                    <button type="button" onclick="moreinfo_sel()">
                        <h3>分類器設定</h3>
                    </button>
                </div>
                <div class="member_window_select">
                    <div class="member_window_cutting"></div>
                    <div class="member_window_select_list">
                        <ul>
                            <?php echo $html_tag;?>
                            <!-- <li>
                                <div>
                                    <form action="" method=""><span>恐懼</span><button type="button" onclick="remove(this)">移除</button></form>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <form action="" method=""><span>悲傷</span><button type="button" onclick="remove(this)">移除</button></form>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <form action="" method=""><span>好累</span><button type="button" onclick="remove(this)">移除</button></form>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                    <div class="member_window_select_add">
                        <form action="" method="post" name="form_sel">
                            <input type="text" id="sel" placeholder="關鍵字">
                            <button type="button" id="new_sel" onclick="add_sel()">新增</button>
                            <span class="errormsg" id="seltxt">　　</span>
                        </form>
                    </div>
                    <div class="member_window_cutting"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./php/footer.php");?>
    <script src="scripts/adSelect.js"></script>
    <script src="scripts/logSignInOut.js"></script>
    <script src="scripts/mobileBar.js"></script>
</body>

</html>