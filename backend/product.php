<?php

include("mysql.php");

$ac = $_GET["ac"];

if ($ac == "create") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quanity = $_POST['quanity'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];
    $image = $_FILES['image'];

    $data = query("SELECT * FROM products WHERE name = ?", [$name]);
    if (count($data) > 0) {
        echo json_encode(["success" => false, "message" => "商品名稱重複請修改"]);
        exit;
    }

    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $image_name = $name . '.' . $extension;
    $targetFile = "images/" . $name . '.' . $extension;

    if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
        echo json_encode(["success" => false, "message" => "圖片上傳失敗"]);
        exit;
    }
    query("INSERT INTO products (name, price, quanity, content, tag, image) VALUES (?, ?, ?, ?, ?, ?)", [$name, $price, $quanity, $content, $tag, $image_name]);
    echo json_encode(["success" => true, "message" => "成功新增資料"]);
    exit;
} else if ($ac == 'get') {
    $id = $_POST['id'];
    $data = query('SELECT* from products where id = ?', [$id]);
    if ($data == 0) {
        echo json_encode(["success" => false, "message" => "查無此資料"]);
        exit;
    }
    echo json_encode(["success" => true, "data" => $data]);
    exit;
} else if ($ac == "search") {
    $search = $_POST['search'];
    $_SESSION['tag'] = $search;
    $data = query('SELECT * FROM products WHERE name LIKE ? OR tag LIKE ?', ['%' . $search . '%','%' . $search . '%']);
    echo json_encode(["success" => true, "data" => $data]);
    exit;
}else if($ac == "searchTag"){
    $tag = $_POST['search'];
    $_SESSION['tag'] = $tag;
    $data = query('SELECT * FROM products WHERE tag like ?', ["%".$tag."%"]);
    echo json_encode(["success" => true, "data" => $data]);
    exit;
}else if ($ac == "all") {
    $data = query("SELECT * FROM products");
    echo json_encode(["success" => true, "data" => $data]);
    exit;
} else if ($ac == "updata_prodcut") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quanity = $_POST['quanity'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];

    $data = query('SELECT * from products where id = ? OR name = ?', [$id, $name]);
    if (count($data) == 0) {
        echo json_encode(["success" => false, "message" => "查無此資料"]);
        exit;
    }
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $delete_img = $data[0]['image'];
        unlink("./images/" . $delete_img);

        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $image_name = $name . '.' . $extension;
        $targetFile = "images/" . $name . '.' . $extension;

        if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
            echo json_encode(["success" => false, "message" => "圖片上傳失敗"]);
            exit;
        }
        query('UPDATE products SET name = ?,price = ?,quanity = ?,content = ?,tag = ?,image = ? WHERE id = ?', [$name, $price, $quanity, $content, $tag, $image, $id]);
        echo json_encode(["success" => true, "message" => "商品更新成功"]);
        exit;
    }else{
        $extension = pathinfo($data[0]['image'], PATHINFO_EXTENSION);
        $rename_img = $data[0]['image'];
        $newname_img = $name .'.'. $extension;
        rename("images/".$rename_img,"images/".$newname_img);
        query('UPDATE products SET name = ?,price = ?,quanity = ?,content = ?,tag = ?,image = ? WHERE id = ?', [$name, $price, $quanity, $content, $tag,$newname_img, $id]);
        echo json_encode(["success" => true, "message" => "商品更新成功"]);
        exit;
    }
} else if ($ac == 'delete_product') {
    $id = $_POST['id'];
    $data = query('SELECT * from products where id = ?', [$id]);
    if (count($data) == 0) {
        echo json_encode(["success" => false, "message" => "查無此資料"]);
        exit;
    }
    $image = $data[0]['image'];
    unlink("./images/" . $image);
    unlink("../product_page".$image."html");
    query('DELETE from products where id =?', [$id]);
    echo json_encode(["success" => true, "message" => "商品移除成功"]);
    exit;
}
?>