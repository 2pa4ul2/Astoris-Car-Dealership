<?php
session_start();
include "../includes/createconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['supplier_name'], $_POST['contact_person'], $_POST['contact_number'])) {
        $supplier_name = $_POST['supplier_name'];
        $contact_person = $_POST['contact_person'];
        $contact_number = $_POST['contact_number'];

        if (empty($supplier_name) || empty($contact_person) || empty($contact_number)) {
            die("Please fill in all fields");
        }

        try {
            $check_query = "SELECT * FROM supplier WHERE supplier_name = :supplier_name";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':supplier_name', $supplier_name);
            $check_stmt->execute();
            $existing_supplier = $check_stmt->fetch();

            if ($existing_supplier) {
                header("Location: failed.php?message=failed");
                exit();
            }

            $query = "INSERT INTO supplier(supplier_name, contact_person, contact_number) VALUES(:supplier_name, :contact_person, :contact_number)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':supplier_name', $supplier_name);
            $stmt->bindParam(':contact_person', $contact_person);
            $stmt->bindParam(':contact_number', $contact_number);
            $stmt->execute();

            $pdo = null;
            $stmt = null;

            header("Location: success.php?message=success");
            exit();

        } catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    } elseif (isset($_POST['category_name'])) {
        $category_name = $_POST['category_name'];

        if (empty($category_name)) {
            die("Please fill in all fields");
        }

        try {
            $check_query = "SELECT * FROM category WHERE category_name = :category_name";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':category_name', $category_name);
            $check_stmt->execute();
            $existing_category = $check_stmt->fetch();

            if ($existing_category) {
                header("Location: failed.php?message=failed");
                exit();
            }

            $query = "INSERT INTO category(category_name) VALUES(:category_name)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':category_name', $category_name);
            $stmt->execute();

            $pdo = null;
            $stmt = null;

            header("Location: success.php?message=success");
            exit();

        } catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    } elseif (isset($_POST['product_name'], $_POST['supplier_id'], $_POST['category_id'], $_POST['price'])) {
        $product_name = $_POST['product_name'];
        $supplier_id = $_POST['supplier_id'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];

        if (empty($product_name) || empty($supplier_id) || empty($category_id) || empty($price)) {
            die("Please fill in all fields");
        }

        try {
            $check_query = "SELECT * FROM product WHERE product_name = :product_name";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':product_name', $product_name);
            $check_stmt->execute();
            $existing_product = $check_stmt->fetch();

            if ($existing_product) {
                header("Location: failed.php?message=failed");
                exit();
            }

            $query = "INSERT INTO product(product_name, supplier_id, category_id, price) VALUES(:product_name, :supplier_id, :category_id, :price)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':supplier_id', $supplier_id);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':price', $price);
            $stmt->execute();

            $pdo = null;
            $stmt = null;

            header("Location: success.php?message=success");
            exit();

        } catch (PDOException $e) {
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    // Redirect to success page if no valid POST data is found
    header("Location: success.php?message=success");
    exit();

} else {
    // Redirect to the form page if accessed directly
    header("Location: form.php");
    exit();
}
