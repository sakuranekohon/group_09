<?php 

session_start();
$pdo = new PDO("mysql:host=localhost;dbname=group_09;charset=utf8", "root", "root123456");

function query($cmd, $data = [])
{
    global $pdo;
    $a = $pdo->prepare($cmd);
    $a->execute($data);
    return $a->fetchAll(2);
}

function checkLogin()
{
    if (!isset($_SESSION["login"]) || !$_SESSION["login"]) {
        echo json_encode(["success" => false, "message" => "請先登入"]);
        exit;
    }
}
?>