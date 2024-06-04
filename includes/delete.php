<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carlink";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['supplier_id'])) {
    $supplier_id = $_GET['supplier_id'];
    $delete = mysqli_query($conn, "DELETE FROM `supplier` WHERE `supplier_id`='$supplier_id'");
    header('location: success.php?delete_msg=success.');
} elseif (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $delete = mysqli_query($conn, "DELETE FROM `product` WHERE `product_id`='$product_id'");
    header('location: success.php?delete_msg=success.');
} elseif (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $delete = mysqli_query($conn, "DELETE FROM `category` WHERE `category_id`='$category_id'");
    header('location: success.php?delete_msg=success.');
}elseif(isset($_GET['admin_id'])){
    $admin_id = $_GET['admin_id'];
    $delete = mysqli_query($conn, "DELETE FROM `admin` WHERE `admin_id`='$admin_id'");
    header('location: success.php?delete_msg=success.');
}elseif(isset($_GET['customer_id'])){
    $customer_id = $_GET['customer_id'];
    $delete = mysqli_query($conn, "DELETE FROM `customer` WHERE `customer_id`='$customer_id'");
    header('location: success.php?delete_msg=success.');
}elseif(isset($_GET['manager_id'])){
    $manager_id = $_GET['manager_id'];
    $delete = mysqli_query($conn, "DELETE FROM `manager` WHERE `manager_id`='$manager_id'");
    header('location: success.php?delete_msg=success.');
}
else{
    header('location: failed.php?delete_msg=failed.');
}
?>