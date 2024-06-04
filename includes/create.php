<?php
include "../includes/createconnect.php";


if ($_SERVER["REQUEST_METHOD"]== "POST") { 
    if(isset($_POST['supplier_name'], $_POST['contact_person'], $_POST['contact_number'])){
        
        $supplier_name = $_POST['supplier_name']; 
        $contact_person = $_POST['contact_person']; 
        $contact_number = $_POST['contact_number'];
        
        if (empty($_POST['supplier_name']) || empty($_POST['contact_person']) || empty($_POST['contact_number'])) {
            die("Please fill in all fields");
        }        

        try{
            $check_query = "SELECT * FROM supplier WHERE supplier_name = :supplier_name AND contact_person = :contact_person AND contact_number = :contact_number";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':supplier_name', $supplier_name);
            $check_stmt->bindParam(':contact_person', $contact_person);
            $check_stmt->bindParam(':contact_number', $contact_number);
            $check_stmt->execute();
            $existing_supplier = $check_stmt->fetch();

            if($existing_supplier) {
                die("Supplier already exists");
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

        } catch(PDOException $e){
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }

    elseif(isset($_POST['category_name'])){
        
        $category_name = $_POST['category_name']; 

        if (empty($_POST['category_name'])) {
            die("Please fill in all fields");
        }      
        
        try{
            
            $check_query = "SELECT * FROM category WHERE category_name = :category_name";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':category_name', $category_name);
            $check_stmt->execute();
            $existing_category = $check_stmt->fetch();

            if($existing_category) {
                die("Category already exists");
            }

            // If the category doesn't exist, insert it
            $query = "INSERT INTO category(category_name) VALUES(:category_name)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':category_name', $category_name);
            $stmt->execute();

            $pdo = null;
            $stmt = null;

            header("Location: success.php?message=success");
            exit();

        } catch(PDOException $e){
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }
    elseif(isset($_POST['product_name'], $_POST['supplier_id'], $_POST['category_id'], $_POST['price'])){
        
        $product_name = $_POST['product_name']; 
        $supplier_id = $_POST['supplier_id']; 
        $category_id = $_POST['category_id'];  
        $price = $_POST['price']; 
        
        if (empty($_POST['product_name']) || empty($_POST['supplier_id']) || empty($_POST['category_id']) || empty($_POST['price'])) {
            die("Please fill in all fields");
        }      

        try{
            
            $check_query = "SELECT * FROM product WHERE product_name = :product_name AND supplier_id = :supplier_id AND category_id = :category_id AND price = :price";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':product_name', $product_name);
            $check_stmt->bindParam(':supplier_id', $supplier_id);
            $check_stmt->bindParam(':category_id', $category_id);
            $check_stmt->bindParam(':price', $price);
            $check_stmt->execute();
            $existing_product = $check_stmt->fetch();

            if($existing_product) {
                die("Product already exists");
            }

            // If the product doesn't exist, insert it
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

        } catch(PDOException $e){
            die("Could not connect to the database $dbname :" . $e->getMessage());
        }
    }
    elseif(isset($_POST['admin-form'])){
        if(isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['password'])){
                
                $first_name = $_POST['first_name']; 
                $last_name = $_POST['last_name']; 
                $username = $_POST['username']; 
                $password = $_POST['password']; 
                
                if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['username']) || empty($_POST['password'])) {
                    die("Please fill in all fields");
                }      
                
                try{
                    
                    $check_query = "SELECT * FROM admn WHERE username = :username";
                    $check_stmt = $pdo->prepare($check_query);
                    $check_stmt->bindParam(':username', $username);
                    $check_stmt->execute();
                    $existing_admin = $check_stmt->fetch();
        
                    if($existing_admin) {
                        die("Admin already exists");
                    }
        
                    // If the admin doesn't exist, insert it
                    $query = "INSERT INTO admn(first_name, last_name, username, password) VALUES(:first_name, :last_name, :username, :password)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();
        
                    $pdo = null;
                    $stmt = null;
        
                    header("Location: success.php?message=success");
                    exit();
        
                } catch(PDOException $e){
                    die("Could not connect to the database $dbname :" . $e->getMessage());
                }
            
        }
    }
    elseif(isset($_POST['customer-form'])){
        if(isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['password'])){
                
                $first_name = $_POST['first_name']; 
                $last_name = $_POST['last_name']; 
                $username = $_POST['username']; 
                $password = $_POST['password']; 
                
                if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['username']) || empty($_POST['password'])) {
                    die("Please fill in all fields");
                }      
                
                try{
                    
                    $check_query = "SELECT * FROM customer WHERE username = :username";
                    $check_stmt = $pdo->prepare($check_query);
                    $check_stmt->bindParam(':username', $username);
                    $check_stmt->execute();
                    $existing_customer = $check_stmt->fetch();
        
                    if($existing_customer) {
                        die("Customer already exists");
                    }
        
                    // If the customer doesn't exist, insert it
                    $query = "INSERT INTO customer(first_name, last_name, username, password) VALUES(:first_name, :last_name, :username, :password)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();
        
                    $pdo = null;
                    $stmt = null;
        
                    header("Location: success.php?message=success");
                    exit();
        
                } catch(PDOException $e){
                    die("Could not connect to the database $dbname :" . $e->getMessage());
                }
            
        }
    }
    elseif(isset($_POST['manager-form'])){
        if(isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['password'])){
                
                $first_name = $_POST['first_name']; 
                $last_name = $_POST['last_name']; 
                $username = $_POST['username']; 
                $password = $_POST['password']; 
                
                if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['username']) || empty($_POST['password'])) {
                    die("Please fill in all fields");
                }      
                
                try{
                    
                    $check_query = "SELECT * FROM manager WHERE username = :username";
                    $check_stmt = $pdo->prepare($check_query);
                    $check_stmt->bindParam(':username', $username);
                    $check_stmt->execute();
                    $existing_manager = $check_stmt->fetch();
        
                    if($existing_manager) {
                        die("Manager already exists");
                    }
        
                    // If the manager doesn't exist, insert it
                    $query = "INSERT INTO manager(first_name, last_name, username, password) VALUES(:first_name, :last_name, :username, :password)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();
        
                    $pdo = null;
                    $stmt = null;
        
                    header("Location: success.php?message=success");
                    exit();
        
                } catch(PDOException $e){
                    die("Could not connect to the database $dbname :" . $e->getMessage());
                }
            
        }
    }

    header("Location: success.php?message=success");
    exit();

} else {
    header("Location: success.php?message=success");
}
?>
