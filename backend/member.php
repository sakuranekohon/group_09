<?php

include("mysql.php");

$ac = $_GET["ac"];
if ($ac == "get") {
    $user = $_SESSION["user"];
    $data = query("SELECT * FROM member WHERE user = ?", [$user]);
    if (count($data) == 0) {
        echo json_encode(["success" => false, "message" => "查無此帳號"]);
        exit;
    }
    $data = $data[0];
    echo json_encode(["success" => true, "data" => $data]);
    exit;
} else if ($ac == "all") {
    $data = query("SELECT * FROM member");
    echo json_encode(["success" => true, "data" => $data]);
    exit;
} else if ($ac == "update_account") {
    $id = $_POST["id"];
    $password = $_POST["password"];
    $user = query("SELECT * FROM member WHERE id = ?", [$id]);
    if (count($user) == 0) {
        echo json_encode(["success" => false, "message" => "查無此帳號"]);
        exit;
    }
    if($password == ""){
        query("UPDATE member SET user = ?, mail = ?,phone = ?,sex = ?,address = ? WHERE id = ?", [$_POST["user"], $_POST["mail"],$_POST["phone"],$_POST["sex"],$_POST["address"], $id]);
        echo json_encode(["success" => true, "message" => "修改成功"]);
    }else{
        query("UPDATE member SET user = ?, mail = ?,password = ?,phone = ?,sex = ?,address = ? WHERE id = ?", [$_POST["user"], $_POST["mail"],$_POST["password"],$_POST["phone"],$_POST["sex"],$_POST["address"], $id]);
        echo json_encode(["success" => true, "message" => "修改成功"]);
    }
    
    exit;
}else if ($ac == "delete_account") {
    $id = $_POST["id"];
    $user = query("SELECT * FROM member WHERE id = ?", [$id]);
    if (count($user) == 0) {
        echo json_encode(["success" => false, "message" => "查無此帳號"]);
        exit;
    }
    $user = $user[0];
    query("DELETE FROM member WHERE id = ?", [$id]);
    echo json_encode(["success" => true, "message" => "刪除成功"]);
    exit;
}
?>