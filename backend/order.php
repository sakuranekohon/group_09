<?php

include("mysql.php");

$ac = $_GET["ac"];
$id = random_int(1,99999999);

if ($ac == "buyorder") {
    $user = $_SESSION["user"];
    $purchaser = $_POST["purchaser"];
    $product_name = explode(",", $_POST["product_name"]);
    $quanity = explode(",", $_POST["quanity"]);
    $totalprice = $_POST["totalprice"];
    $payment = $_POST["payment"];
    $remark = $_POST["remark"];
    $status = $_POST["status"];
    $id = $id +1;
    
    for ($i = 0; $i < count($product_name)-1; $i++) {
        // echo $product_name[$i];
        query(
            'INSERT IGNORE INTO orders (`id`,`user`, `purchaser`, `product_name`, `quanity`, `totalprice`, `payment`, `remark`, `status`) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)',
            [$id,$user, $purchaser, $product_name[$i], $quanity[$i], $totalprice, $payment, $remark, $status]
        );
        query('INSERT IGNORE INTO `comment`(`user`,`cid`, `product`, `quanity`, `totalprice`) VALUES (?,?,?,?,?)',
        [$user,$id,$product_name[$i],$quanity[$i],$totalprice]);
    }
    echo json_encode(["success" => true, "message" => "下單成功"]);
    exit;
} else if ($ac == "get") {
    $user = $_SESSION['user'];
    $results = query('SELECT o.*, p.price,p.image FROM orders o JOIN products p ON o.product_name = p.name WHERE o.user = ? ORDER BY id ASC', [$user]);
    $order_id = 0;
    $orders = [[]];
    $orders[$order_id][] = [
        'id' => $results[$order_id]['id'],
        'name' => $results[$order_id]['product_name'],
        'buyDate' => $results[$order_id]['buyDate'],
        'image' => $results[$order_id]['image'],
        'price' => $results[$order_id]['price'],
        'quanity' => $results[$order_id]['quanity'],
        'payment' => $results[$order_id]['payment'],
        'remark' => $results[$order_id]['remark'],
        'state' => $results[$order_id]['status'],
        'totalprice' => $results[$order_id]['totalprice']
    ];

    for ($i = 1; $i < count($results); $i++) {
        if ($results[$i]['id'] == $orders[$order_id][0]['id']) {
            $orders[$order_id][] = [
                'id' => $results[$i]['id'],
                'name' => $results[$i]['product_name'],
                'buyDate' => $results[$i]['buyDate'],
                'image' => $results[$i]['image'],
                'price' => $results[$order_id]['price'],
                'quanity' => $results[$i]['quanity'],
                'payment' => $results[$i]['payment'],
                'remark' => $results[$i]['remark'],
                'state' => $results[$i]['status'],
                'totalprice' => $results[$order_id]['totalprice']
            ];
        } else {
            $order_id++;
            $orders[$order_id] = [];
            $orders[$order_id][] = [
                'id' => $results[$i]['id'],
                'name' => $results[$i]['product_name'],
                'buyDate' => $results[$i]['buyDate'],
                'image' => $results[$i]['image'],
                'price' => $results[$order_id]['price'],
                'quanity' => $results[$i]['quanity'],
                'payment' => $results[$i]['payment'],
                'remark' => $results[$i]['remark'],
                'state' => $results[$i]['status'],
                'totalprice' => $results[$order_id]['totalprice']
            ];
        }
    }
    echo json_encode(["success" => true, "data" => $results]);
    exit;
} else if ($ac == "updata_order") {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $status = $_POST['state'];
    query('UPDATE orders set status = ? where id = ? AND product_name = ?', [$status, $id,$product_name]);
    echo json_encode(["success" => true, "message" => $id . "修改成功"]);
    exit;
} else if ($ac == "deldect_order") {
    $id = $_POST['id'];
    $data = query('SELECT * FROM orders WHERE id = ?', [$id]);
    if (count($data) == 0) {
        echo json_encode(["success" => false, "message" => "找不到指定的訂單"]);
        exit;
    }
    for($i =0;$i<count($data);$i++){
        if($data[$i]["status"] != 3){
            query('DELETE FROM comment WHERE cid  = ? AND product = ?',[$id,$data[$i]["product_name"]]);
        }
    }
    query('DELETE FROM orders WHERE id = ?', [$id]);
    echo json_encode(["success" => false, "message" => $id . "訂單已移除"]);
    exit;
}
