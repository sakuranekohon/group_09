<?php
include("mysql.php");

$ac = $_GET['ac'];
if ($ac == "signup") {
    $mail = $_POST["mail"];
    $user = $_POST["username"];
    $password = $_POST["password"];

    $data = query("SELECT * FROM member WHERE user = ? OR mail = ?", [$user, $mail]);
    if (count($data) > 0) {
        echo json_encode(["success" => false, "message" => "使用者名稱或電子信箱重複"]);
        exit;
    }
    query("INSERT INTO member(user,mail,password,level) VALUES (?,?,?,?)", [$user, $mail, $password, "1"]);
    $_SESSION["user"] = $user;
    $_SESSION["login"] = true;
    $_SESSION['level'] = 1;
    echo json_encode(["success" => true, "message" => "註冊成功"]);
    exit;
} else if ($ac == "login") {
    $user = $_POST["account"];
    $password = $_POST["password"];

    $data = query("SELECT * FROM member WHERE user = ? OR mail = ?", [$user, $user]);
    if (count($data) == 0) {
        echo json_encode(["success" => false, "message" => "登入失敗，請檢查帳號或密碼錯誤"]);
        exit;
    }
    $data = $data[0];
    if ($password != $data["password"]) {
        echo json_encode(["success" => false, "message" => "登入失敗，請檢查帳號或密碼錯誤"]);
        exit;
    }
    $_SESSION["user"] = $user;
    $_SESSION["login"] = true;
    $_SESSION['level'] = $data['level'];
    echo json_encode(["success" => true, "message" => "登入成功"]);
    exit;
} else if ($ac == "forgot") {
    $mail = $_POST["mail"];
    $user = $_POST["usermane"];
    $data = query("SELECT * FROM member WHERE mail = ? AND user = ?", [$mail, $user]);
    if (count($data) == 0) {
        echo json_encode(["success" => false, "message" => "查無此帳號"]);
        exit;
    } else {
        $data = $data[0];
        $_SESSION["user"] = $user;
        $_SESSION["login"] = true;
        $_SESSION['level'] = $data['level'];
        echo json_encode(["success" => true, "message" => "登入成功"]);
        exit;
    }
} else if ($ac == "logout") {
    unset($_SESSION["user"]);
    unset($_SESSION["login"]);
    unset($_SESSION["level"]);
    echo json_encode(["success" => true, "message" => "登出成功"]);
    exit;
} else if ($ac == "checklogin") {
    checkLogin();
    echo json_encode(["success" => true, "message" => "已登入"]);
    exit;
} else if ($ac == "checklevel") {
    checkLogin();
    echo json_encode(["success" => true, "level" => $_SESSION['level']]);
}
