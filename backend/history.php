<?php 

include("mysql.php");

$ac = $_GET["ac"];

if($ac == "postbrowse"){
    $user = $_SESSION['user'];
    if($user != null){
        $id = $_POST['id'];
        $data = query("SELECT * FROM browse WHERE product_id = ? AND user = ?",[$id,$user]);
        if(count($data) == 1){
            query("DELETE FROM browse WHERE product_id = ? AND user = ?",[$id,$user]);
        }
        query('INSERT INTO browse(user,product_id) VALUES (?,?)',[$user,$id]);
        echo json_encode(["success" => true, "message" => "資料已新增"]);
        exit;
    }else{
        exit;
    }
    
}else if($ac == "getbrowse"){
    $user = $_SESSION['user'];
    checkLogin();
    $data = query('SELECT p.image, p.name, p.price FROM browse b join products p on b.product_id = p.id WHERE b.user = ?',[$user]);
    echo json_encode(["success" => true, "message" => "查詢成功","data" =>$data]);
    exit;
}else if($ac == "getbuy"){
    $user = $_SESSION['user'];
    checkLogin();
    $data = query('SELECT * FROM comment WHERE user = ?',[$user]);
    echo json_encode(["success" => true, "message" => "成功取得資料","data" =>$data]);
    exit;
}else if($ac == "getcomment"){
    $product =$_POST['product_name'];
    $data = query('SELECT user,anonymous,comment FROM comment WHERE product = ?',[$product]);
    echo json_encode(["success" => true,"data" => $data]);
    exit;
}else if($ac == "updata_buy"){
    $user = $_SESSION['user'];
    $id = $_POST['id'];
    $product = $_POST['product'];
    $anonymous = $_POST['anonymous'];
    $comment = $_POST['comment'];
    if($anonymous == true)
        $anonymous = 1;
    else
        $anonymous =0;
    query('UPDATE comment SET `anonymous` = ?, `comment` = ? WHERE product = ? AND user = ? AND cid = ?', 
    [$anonymous, $comment, $product, $user,$id]);
    echo json_encode(["success" => true, "message" => "成功修改資料"]);
    exit;
}else if($ac == "updata_buy2"){
    $user = $_POST['purchaser'];
    $id = $_POST['id'];
    $product = $_POST['product'];
    $anonymous = $_POST['anonymous'];
    $comment = $_POST['comment'];
    if($anonymous == true)
        $anonymous = 1;
    else
        $anonymous =0;
    query('UPDATE comment SET `comment` = ?,`anonymous` = ? WHERE cid = ? AND product = ?', 
    [$comment,0,$id,$product]);
    echo json_encode(["success" => true, "message" => "成功修改資料"]);
    exit;
}else if($ac == "delete_buy"){
    $id = $_POST['id'];
    $product = $_POST['product'];
    $purchaser = $_POST['purchaser'];
    echo $id;
    echo $product;
    echo $purchaser;
    query('DELETE FROM comment WHERE id =? AND product = ? AND purchaser = ?',[$id,$product,$purchaser]);
    echo json_encode(["success" => true, "message" => "成功刪除資料"]);
    exit;
}
