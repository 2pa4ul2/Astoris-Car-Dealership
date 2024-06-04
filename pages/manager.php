<?php
session_start();
include "../includes/compute.php";
include "../includes/extract_data.php";
include "../includes/signin_function.php";
// Check if user is logged in and has manager role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'manager') {
    // Redirect to login page or show an error message
    header("Location: login.php");
    exit();

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
                $check_query = "SELECT * FROM supplier WHERE supplier_name = :supplier_name";
                $check_stmt = $pdo->prepare($check_query);
                $check_stmt->bindParam(':supplier_name', $supplier_name);
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
    
                $success = true;
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
    
                $success = true;
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
                
                $check_query = "SELECT * FROM product WHERE product_name = :product_name";
                $check_stmt = $pdo->prepare($check_query);
                $check_stmt->bindParam(':product_name', $product_name);
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
    
                $success = true;
                exit();
    
            } catch(PDOException $e){
                die("Could not connect to the database $dbname :" . $e->getMessage());
            }
        }
    
        $success = true;
        exit();
    
    } else {
        $success = true;
    }
}

// Get username from session
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/images/astorisfav.png" />
    <title>Astoris</title>
</head>
<body>
    <header>
        <nav>
            <img class="logo" src="../assets/images/AstorisLogo.png" alt="">
            <ul class="tabs">
                <li class="tab-item is-active">
                    <a data-switcher data-tab="1"><i class='bx bx-list-plus'></i>Overview</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="2"><i class='bx bx-smile'></i>Supplier</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="3"><i class='bx bx-category'></i>Category</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="4"><i class='bx bx-store-alt' ></i>Products</a>
                </li>
            </ul>
            <div class="logout">
                <a class="logout-btn" href="logout.php">Logout</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="pages">
            <!-- page 1 -->
            <div class="page is-active" data-page="1">
                <div class="top-bar">
                    <h1 class="title"><?php echo htmlspecialchars($username); ?>'s, Dashboard</h1>
                    <div class="profile"><a href=""></a></div>
                </div>  
                <div class="first-container">
                    <div class="box-container">
                        <div class="text-description">
                            <h3 class="text-title">Total data</h3>
                            <p class="text-sub">Data Summary</p>
                        </div>
                        <div class="box-container-main">
                            <div class="box-data">
                                <div class="text-data">
                                    <h1>Total Products</h1>
                                    <h1 class="data-count"><?php echo $product_count; ?></h1>
                                </div>
                            </div>
                            <div class="box-data2">
                                <div class="text-data">
                                    <h1>Suppliers</h1>
                                    <h1 class="data-count"><?php echo $supplier_count; ?></h1>
                                </div>    
                            </div>
                            <div class="box-data3">
                                <div class="text-data">
                                    <h1>Car Categories</h1>
                                    <h1 class="data-count"><?php echo $category_count; ?></h1>
                                </div>
                            </div>
                            <div class="box-data4">
                                <div class="text-data">
                                    <h1>Total Revenue</h1>
                                    <h1 class="data-count">$<?php echo number_format($price_count,2); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <div>
                            <canvas id="top3"></canvas>
                        </div>
                    </div>
                </div>
                <!-- <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div> -->
                <div class="table-container">
                    <div class="table-content">
                        <h1 class="summary">Full Data</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Supplier Name</th>
                                    <th>Category Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($tblproduct_id); $i++) {
                                    echo "<tr>";
                                    echo "<td>" . $tblproduct_id[$i] . "</td>";
                                    echo "<td>" . $tblproduct_name[$i] . "</td>";
                                    echo "<td>" . $tblsupplier_name[$i] . "</td>";
                                    echo "<td>" . $tblcategory_name[$i] . "</td>";
                                    echo "<td> $ " . number_format($tblprice[$i],2) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="page" data-page="2">
                <div class="top-bar">
                    <h1 class="title">Suppliers Data</h1>
                    <div class="profile"><a href=""></a></div>
                </div>  
                <div class="table-container">
                    <div class="table-content">
                            <div class="table-top">
                                <h1 class="summary">Full Data Summary</h1>
                                <!-- Modal toggle -->
                                <button data-modal-target="supplier-modal" data-modal-toggle="supplier-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-5" type="button">
                                Add Product
                                </button>                            
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Supplier Id</th>
                                        <th>Supplier Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact Number</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $num = mysqli_num_rows($query);
                                        if($num > 0){
                                            while($result = mysqli_fetch_assoc($query)){
                                                echo"
                                                <tr>
                                                    <td>".$result['supplier_id']."</td>
                                                    <td>".$result['supplier_name']."</td>
                                                    <td>".$result['contact_person']."</td>
                                                    <td>+".$result['contact_number']."</td>
                                                    <td>
                                                        <a href='../includes/supplier.php?supplier_id=".$result['supplier_id']."' class='update-btn'>Update</a>
                                                    </td>
                                                    <td>
                                                        <a href='../includes/delete.php?supplier_id=".$result['supplier_id']."' class='delete-btn'>Delete</a>
                                                    </td>
                                                ";
                                            }
                                            
                                        }
                                            
                                    ?>
                                </tbody>
                            </table>
                        </div>
                            <div id="supplier-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Create New Supplier
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="../includes/create.php" method="post" class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="supplier_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier Name</label>
                                                    <input type="text" name="supplier_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Sebastian Vettel" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="contact_person" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Person</label>
                                                    <input type="text" name="contact_person" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex.Kimi Raikonnen" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="contact_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                                                    <input type="number" name="contact_number" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. 9273423430" required="">
                                                </div>
                                            </div>
                                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                Add new product
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                </div>
            </div>









            
            
            <div class="page" data-page="3">
                <div class="top-bar">
                    <h1 class="title">Category Data</h1>
                    <div class="profile"><a href=""></a></div>
                </div>  
                <div class="table-container">
                    <div class="table-content">
                            <div class="table-top">
                                <h1 class="summary">Full Data Summary</h1>
                                <!-- Modal toggle -->
                                <button data-modal-target="category-modal" data-modal-toggle="category-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-5" type="button">
                                Add Product
                                </button>                            
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Category Id</th>
                                        <th>Category Name</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $num = mysqli_num_rows($query);
                                        if($num > 0){
                                            while($result = mysqli_fetch_assoc($querycat)){
                                                echo"
                                                <tr>
                                                    <td>".$result['category_id']."</td>
                                                    <td>".$result['category_name']."</td>
                                                    <td>
                                                        <a href='../includes/category.php?category_id=".$result['category_id']."' class='update-btn'>Update</a>
                                                    </td>
                                                    <td>
                                                        <a href='../includes/delete.php?category_id=".$result['category_id']."' class='delete-btn'>Delete</a>
                                                    </td>
                                                ";
                                            }
                                            
                                        }
                                            
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="category-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Create New Category
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="../includes/create.php" method="post" class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
                                                    <input type="text" name="category_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Subaru" required="">
                                                </div>
                                            </div>
                                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                Add new product
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                </div>
            </div>



            <div class="page" data-page="4">
                <div class="top-bar">
                    <h1 class="title">Product Data</h1>
                    <div class="profile"><a href=""></a></div>
                </div>  
                <div class="table-container">
                <div class="table-content">
                        <div class="table-top">
                            <h1 class="summary">Full Data Summary</h1>
                            <!-- Modal toggle -->
                            <button data-modal-target="product-modal" data-modal-toggle="product-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-5" type="button">
                            Add Product
                            </button>                            
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Supplier Id</th>
                                    <th>Category Id</th>
                                    <th>Price</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $num = mysqli_num_rows($queryprod);
                                    if($num > 0){
                                        while($result = mysqli_fetch_assoc($queryprod)){
                                            echo"
                                            <tr>
                                                <td>".$result['product_id']."</td>
                                                <td>".$result['product_name']."</td>
                                                <td>".$result['supplier_id']."</td>
                                                <td>".$result['category_id']."</td>
                                                <td>$".number_format($result['price'],2)."</td>
                                                <td>
                                                    <a href='../includes/product.php?product_id=".$result['product_id']."' class='update-btn'>Update</a>
                                                </td>
                                                <td>
                                                    <a href='../includes/delete.php?product_id=".$result['product_id']."' class='delete-btn'>Delete</a>
                                                </td>
                                            ";
                                        }
                                        
                                    }
                                        
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Create New Product
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="../includes/create.php" method="post" class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                                                    <input type="text" name="product_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Amg-20" required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                                    <select name="supplier_id" id="supplier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected="">Select supplier</option>
                                                        <?php
                                                            require_once "../includes/createconnect.php";
                                                            $query = "SELECT * FROM supplier";
                                                            $stmt = $pdo -> prepare($query);
                                                            $stmt -> execute();
                                                            while($row = $stmt -> fetch()){
                                                                echo "<option value='" . $row['supplier_id'] . "'>" . $row['supplier_id'] . " - " . $row['supplier_name'] . "</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                                    <select name="category_id" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected="">Select category</option>
                                                        <?php
                                                            require_once "../includes/createconnect.php";
                                                            $query = "SELECT * FROM category";
                                                            $stmt = $pdo -> prepare($query);
                                                            $stmt -> execute();
                                                            while($row = $stmt -> fetch()){
                                                                echo "<option value='" . $row['category_id'] . "'>" . $row['category_id'] . " - " .$row['category_name'] . "</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                                    <input type="number" name="price" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. 200000" required="">
                                                </div>
                                            </div>
                                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                Add new product
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                </div>
            </div>
        </section>
    </main>

    

    <script src="../assets/js/switch.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        // PHP data to JavaScript variables
        const productNames = <?php echo json_encode($productNames); ?>;
        const quantities = <?php echo json_encode($quantities); ?>;
        
        const ctx = document.getElementById('top3').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line', // or 'line', 'pie', etc.
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Quantity Reserved',
                    data: quantities,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255, 0.3)',
                        'rgba(255, 159, 64, 0.3)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php if(isset($success) && $success): ?>
        <script src="../assets/js/alertempty.js"></script>
    <?php endif; ?>
    <?php if(isset($alreadyadded) && $alreadyadded): ?>
        <script src="../assets/js/alertadded.js"></script>
    <?php endif; ?>
</body>
</html>