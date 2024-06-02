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


//LIST OF CATEGORIES
    $query = "SELECT * FROM category";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $category_id = array();
    $category_name = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $category_id[] = $row['category_id'];
        $category_name[] = $row['category_name'];
    }
//LIST OF CATEGORIES
    $supplier_query = "SELECT * FROM supplier";
    $stmt = $pdo->prepare($supplier_query);
    $stmt->execute();
    $supplier_id = array();
    $supplier_name = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $supplier_id[] = $row['supplier_id'];
        $supplier_name[] = $row['supplier_name'];
    }

//COUNT OF CARS PER CATEGORY
    $prodquery = "SELECT category.category_name, COUNT(product.product_id) AS car_count
    FROM category
    LEFT JOIN product ON category.category_id = product.category_id
    GROUP BY category.category_id
    ORDER BY category.category_name
    ";
    $stmt = $pdo->prepare($prodquery);
    $stmt->execute();
    $car_count = array();
    while($row2 = $stmt->fetch(PDO::FETCH_ASSOC)){
        $car_count[] = $row2['car_count'];
    }

    $full_data = "SELECT product.product_id, product.product_name, supplier.supplier_name, category.category_name, product.price
                    FROM product
                    INNER JOIN supplier ON product.supplier_id = supplier.supplier_id
                    INNER JOIN category ON product.category_id = category.category_id";
    $stmt = $pdo->prepare($full_data);
    $stmt->execute();
    $tblproduct_id = array();
    $tblproduct_name = array();
    $tblsupplier_name = array();
    $tblcategory_name = array();
    $tblprice = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tblproduct_id[] = $row['product_id'];
        $tblproduct_name[] = $row['product_name'];
        $tblsupplier_name[] = $row['supplier_name'];
        $tblcategory_name[] = $row['category_name'];
        $tblprice[] = $row['price'];
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
