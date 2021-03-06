<?php
header("Content-Type: application/json;Charset=UTF-8");
require '../database.php';

$Json = array();

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $data = explode(" ", $search);

    // 0 - id
    // 1 - brand
    // 2 - price

    $id = (isset($data[0]) ? $data[0] : '');
    $brand = (isset($data[1]) ? $data[1] : '');
    $price = (isset($data[2]) ? $data[2] : '');

    try {
        $stmt = $db->prepare("SELECT * FROM `tbl_products_a174485_pt2` WHERE fld_product_num LIKE ? OR fld_product_brand LIKE ? OR fld_product_price LIKE ?");
        $stmt->execute(["%{$search}%","%{$search}%", "%{$search}%"]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Json = array('status' => 200, 'data' => $res);
    } catch (PDOException $e) {
        $Json = array('status' => 400, 'data' => $e->getMessage());
    }

}

if (isset($Json))
    echo json_encode($Json);
