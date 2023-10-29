<?php

    include('mysql.php');

    $ac = $_GET["ac"];
    if($ac == "putcart"){
        $user = $_SESSION['user'];
        $id = $_POST['id'];
        $quanity = $_POST['quanity'];
        checkLogin();
        $data = query('SELECT * FROM cart WHERE user = ? AND product_id = ?',[$user,$id]);
        if(count($data) == 0){
            query('INSERT INTO cart(user,product_id,quanity) Values (?,?,?)',[$user,$id,$quanity]);
            echo json_encode(["success" => true, "message" => "成功放入購物車"]);
            exit;
        }else{
            $newQuanity =intval($data[0]['quanity'])+intval($quanity);
            query('UPDATE cart SET quanity = ? WHERE user = ? AND product_id = ?',[$newQuanity,$user,$id]);
            echo json_encode(["success" => true, "message" => "成功放入購物車"]);
            exit;
        }
    }else if($ac == "all"){
        $user = $_SESSION['user'];
        checkLogin();
        $data = query('select p.name,p.image,p.price,c.*  from cart c join products p on c.product_id = p.id where c.user = ?',[$user]);
        echo json_encode(["success" => true, "data" => $data]);
        exit;
    }else if($ac == "update_cart"){
        $user = $_SESSION['user'];
        $id = $_POST['id'];
        $quanity = $_POST['quanity'];
        query('UPDATE cart SET quanity = ? WHERE user = ? AND product_id = ?',[$quanity,$user,$id]);
        echo json_encode(["success" => true, "message" => "資料更新成功"]);
            exit;
    }else if($ac == "delete_cart"){
        $user = $_SESSION['user'];
        $id = $_POST['id'];
        query('DELETE FROM cart WHERE user = ? AND product_id = ?',[$user,$id]);
        echo json_encode(["success" => true, "message" => "資料刪除成功"]);
        exit;
    }
?>