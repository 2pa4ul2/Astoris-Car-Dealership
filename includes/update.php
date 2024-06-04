<?php

class SupplierManager {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect('localhost', 'root', '', 'carlink');

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getSupplierById($supplier_id) {
        $result = mysqli_query($this->conn, "SELECT * FROM `supplier` WHERE `supplier_id`='$supplier_id'");

        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        } else {
            return mysqli_fetch_assoc($result);
        }
    }

    public function updateSupplier($new_supplier_id, $supplier_name, $contact_person, $contact_number) {
        // Check for duplicate supplier name
        $check_query = mysqli_query($this->conn, "SELECT * FROM `supplier` WHERE `supplier_name`='$supplier_name' AND `supplier_id` != '$new_supplier_id'");
        if (mysqli_num_rows($check_query) > 0) {
            die("Update failed: Duplicate supplier name found.");
        }

        $query = mysqli_query($this->conn, "UPDATE `supplier` SET `supplier_name`='$supplier_name', `contact_person`='$contact_person', `contact_number`='$contact_number' WHERE `supplier_id` = '$new_supplier_id'");

        if (!$query) {
            die("Query failed: " . mysqli_error($this->conn));
        } else {
            header('location: success.php?update_msg=success.');
        }
    }
}

class CategoryManager {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect('localhost', 'root', '', 'carlink');

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getCategoryById($category_id) {
        $result = mysqli_query($this->conn, "SELECT * FROM `category` WHERE `category_id`='$category_id'");

        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        } else {
            return mysqli_fetch_assoc($result);
        }
    }

    public function updateCategory($new_category_id, $category_name) {
        // Check for duplicate category name
        $check_query = mysqli_query($this->conn, "SELECT * FROM `category` WHERE `category_name`='$category_name' AND `category_id` != '$new_category_id'");
        if (mysqli_num_rows($check_query) > 0) {
            header('location: failed.php?update_msg=failed.');
        }

        $query = mysqli_query($this->conn, "UPDATE `category` SET `category_name`='$category_name' WHERE `category_id` = '$new_category_id'");

        if (!$query) {
            die("Query failed: " . mysqli_error($this->conn));
        } else {
            header('location: success.php?update_msg=success.');
        }
    }
}

$supplierManager = new SupplierManager();
$categoryManager = new CategoryManager();

if (isset($_GET['supplier_id'])) {
    $supplier_id = $_GET['supplier_id'];
    $row = $supplierManager->getSupplierById($supplier_id);
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $row = $categoryManager->getCategoryById($category_id);
}

if (isset($_GET['new_supplier_id'])) {
    $new_supplier_id = $_GET['new_supplier_id'];
}

if (isset($_GET['new_category_id'])) {
    $new_category_id = $_GET['new_category_id'];
}

if (isset($_POST['update_supplier'])) { 
    $supplier_name = $_POST['supplier_name'];
    $contact_person = $_POST['contact_person'];
    $contact_number = $_POST['contact_number'];

    $supplierManager->updateSupplier($new_supplier_id, $supplier_name, $contact_person, $contact_number);
}

if (isset($_POST['update_category'])) { 
    $category_name = $_POST['category_name'];

    $categoryManager->updateCategory($new_category_id, $category_name);
}

?>
