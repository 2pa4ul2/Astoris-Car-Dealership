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

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $query = "SELECT * FROM product WHERE product_id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['product_id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM supplier";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM category";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
        $product_name = $_POST['product_name'];
        $supplier_id = $_POST['supplier_id'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];

        $update_query = "UPDATE product SET product_name = :product_name, supplier_id = :supplier_id, category_id = :category_id, price = :price WHERE product_id = :product_id";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute([
            'product_name' => $product_name,
            'supplier_id' => $supplier_id,
            'category_id' => $category_id,
            'price' => $price,
            'product_id' => $product_id
        ]);

        header("Location: success.php");
        exit();
    }
} else {
    header("Location: ../includes/admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/update.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Carlink</title>
</head>
<body>

    <main>
        <div class="container">
            <div class="content-btn">
                    <button class="tab-btn-secondary">Modify Product</button>
                    <div class="line"></div>
            </div>    


            <div class="content-box">
                <div class="content">
                        <div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?product_id=' . $product_id; ?>" method="post">
                                <label for="product_name">Product Name</label>
                                <input class="form-input" type="text" name="product_name" value="<?php echo isset($product['product_name']) ? $product['product_name'] : ''; ?>">

                                <label for="supplier_id">Supplier</label>
                                <select class="select" name="supplier_id">
                                    <?php foreach ($suppliers as $supplier): ?>
                                        <option value="<?php echo $supplier['supplier_id']; ?>" <?php echo ($product['supplier_id'] == $supplier['supplier_id']) ? 'selected' : ''; ?>>
                                            <?php echo $supplier['supplier_id']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="category_id">Category</label>
                                <select class="select" name="category_id">
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['category_id']; ?>" <?php echo ($product['category_id'] == $category['category_id']) ? 'selected' : ''; ?>>
                                            <?php echo $category['category_id']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="price">Price</label>
                                <input class="form-input" type="number" name="price" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>">

                                <button class="submit-btn" type="submit" name="update_product">Submit</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
