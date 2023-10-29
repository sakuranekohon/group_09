<?php
    include("mysql.php");

    $ac = $_GET["ac"];
    if($ac == 'createAD'){
        $image = $_FILES['image'];
        
        $extension = pathinfo($image['name'],PATHINFO_EXTENSION);
        $name = basename($image['tmp_name']);
        $image_name = explode('.',$name)[0].".".$extension;
        $targetFile = "ADimages/".$image_name;

        if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
            echo json_encode(["success" => false, "message" => "圖片上傳失敗"]);
            exit;
        }
        query('INSERT INTO adselect(`name`,`isAD`) VALUES (?,?)',[$image_name,true]);
        echo json_encode(["success" => true, "message" => "成功新增資料","img"=>$image_name]);
        exit;
    }else if($ac == 'getAD'){
        $data = query("SELECT * FROM adselect WHERE isAD = true");
        if ($data == 0) {
            echo json_encode(["success" => false, "message" => "無此內容"]);
            exit;
        }
        echo json_encode(["success" => true, "data" => $data]);
        exit;
    }else if($ac == 'deleteAD'){
        $name = $_POST['name'];
        unlink("./ADimages/".$name);
        query('DELETE from adselect where name =?',[$name]);
        echo json_encode(["success" => true, "message" => "移除成功"]);
        exit;
    }else if($ac == 'createSel'){
        $name = $_POST['name'];
        query('INSERT INTO adselect(`name`,`isAD`) VALUES (?,?)',[$name,false]);
        echo json_encode(["success" => true, "message" => "成功新增資料", "tag" =>$name]);
        exit;
    }else if($ac == 'getSel'){
        $data = query("SELECT * FROM adselect WHERE isAD = false");
        if ($data == 0) {
            echo json_encode(["success" => false, "message" => "無此內容"]);
            exit;
        }
        echo json_encode(["success" => true, "data" => $data]);
        exit;
    }else if($ac == 'deleteSel'){
        $name = $_POST['name'];
        query('DELETE FROM adselect where name =?',[$name]);
        echo json_encode(["success" => true, "message" => "移除成功"]);
        exit;
    }
?>