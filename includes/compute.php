<?php
$dsn = 'mysql:host=localhost;dbname=carlink';
$dbusername = 'root';
$dbpassword = '';


try{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
}

    $query_product_count = "SELECT COUNT(*) as product_count FROM product";
    $stmt_product_count = $pdo->prepare($query_product_count);
    $stmt_product_count->execute();
    $product_count = $stmt_product_count->fetch(PDO::FETCH_ASSOC)['product_count'];

    $query_total_supplier = "SELECT COUNT(supplier_name) as supplier_count FROM supplier";
    $stmt_supplier_count = $pdo->prepare($query_total_supplier);
    $stmt_supplier_count->execute();
    $supplier_count = $stmt_supplier_count->fetch(PDO::FETCH_ASSOC)['supplier_count'];

    $query_total_category = "SELECT COUNT(category_name) as category_count FROM category";
    $stmt_category_count = $pdo->prepare($query_total_category);
    $stmt_category_count->execute();
    $category_count = $stmt_category_count->fetch(PDO::FETCH_ASSOC)['category_count'];

    $query_total_price = "SELECT SUM(price) as price_count FROM product";
    $stmt_price_count = $pdo->prepare($query_total_price);
    $stmt_price_count->execute();
    $price_count = $stmt_price_count->fetch(PDO::FETCH_ASSOC)['price_count'];   

?>