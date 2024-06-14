<?php
session_start();
include "../includes/compute.php";
include "../includes/extract_data.php";
include "../includes/signin_function.php";
include "../includes/update.php";
// Check if user is logged in and has admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Redirect to login page or show an error message
    header("Location: login.php");
    exit();
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
                <li class="tab-item">
                    <a data-switcher data-tab="5"><i class='bx bxs-user-detail'></i>Accounts</a>
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
                <div class="table-container">
                    <div class="table-content">
                        <h1 class="summary">Order data</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                        $num = mysqli_num_rows($queryord);
                                        if($num > 0){
                                            while($result = mysqli_fetch_assoc($queryord)){
                                                echo"
                                                <tr>
                                                    <td>".$result['order_id']."</td>
                                                    <td>".$result['product_id']."</td>
                                                    <td>".$result['product_name']."</td>
                                                    <td>$".number_format($result['price'],2)."</td>
                                                    <td>+".$result['quantity']."</td>
                                                ";
                                            }
                                            
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
            
            
            
            <div class="page" data-page="5">
                <div class="top-bar">
                    <h1 class="title">Accounts Data</h1>
                    <div class="profile"><a href=""></a></div>
                </div>  
                <div class="table-container">
                    <div class="table-content">
                            <div class="table-top">
                            <h1 class="summary">Admin Accounts</h1>
                                <!-- Modal toggle -->
                                <button data-modal-target="admin-modal" data-modal-toggle="admin-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-5" type="button">
                                Add Admin
                                </button>                            
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Admin ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $num = mysqli_num_rows($queryad);
                                            if($num > 0){
                                                while($result = mysqli_fetch_assoc($queryad)){
                                                    echo"
                                                    <tr>
                                                        <td>".$result['admin_id']."</td>
                                                        <td>".$result['first_name']."</td>
                                                        <td>".$result['last_name']."</td>
                                                        <td>".$result['username']."</td>
                                                        <td>".$result['password']."</td>
                                                        <td>
                                                            <a href='../includes/supplier.php?admin_id=".$result['admin_id']."' class='update-btn'>Update</a>
                                                        </td>
                                                        <td>
                                                            <a href='../includes/delete.php?admin_id=".$result['admin_id']."' class='delete-btn'>Delete</a>
                                                        </td>
                                                    ";
                                                }
                                                
                                            }
                                                
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="admin-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Create New Account
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form name="admin-form" action="../pages/admin.php" method="post" class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <?php 
                                                $errors = validate_input($_POST);
                                                if (isset($_POST['admin-signup'])) {
                                                    if (empty($errors) && create_account($conn, $_POST, 'admin')) {
                                                        header("Location: ../includes/success.php");
                                                    } else {
                                                        if (!empty($errors)) {
                                                            foreach ($errors as $error) {
                                                                echo '<div class="error_display" style="display: block;">' . $error . '</div>';
                                                            }
                                                        } else {
                                                            header("Location: ../includes/failed.php");
                                                        }
                                                    }
                                                }
                                                ?>
                                                <div class="col-span-2">
                                                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                                    <input type="text" name="first_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Sebastian Vettel" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                                    <input type="text" name="last_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Charles Leclerc" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                    <input type="text" name="username" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. L4ndorris" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                    <input type="password" name="password" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Enter password" required="">
                                                </div>
                                            </div>
                                            <button type="submit" name="admin-signup" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                Add new product
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div> 


                        <div class="table-content">
                            <div class="table-top">
                                <h1 class="summary">Customer Accounts</h1>
                                <!-- Modal toggle -->
                                <button data-modal-target="customer-modal" data-modal-toggle="customer-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-5" type="button">
                                Add Customer
                                </button>                            
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $num = mysqli_num_rows($querycus);
                                            if($num > 0){
                                                while($result = mysqli_fetch_assoc($querycus)){
                                                    echo"
                                                    <tr>
                                                        <td>".$result['customer_id']."</td>
                                                        <td>".$result['first_name']."</td>
                                                        <td>".$result['last_name']."</td>
                                                        <td>".$result['username']."</td>
                                                        <td>".$result['password']."</td>
                                                        <td>
                                                            <a href='../includes/supplier.php?customer_id=".$result['customer_id']."' class='update-btn'>Update</a>
                                                        </td>
                                                        <td>
                                                            <a href='../includes/delete.php?customer_id=".$result['customer_id']."' class='delete-btn'>Delete</a>
                                                        </td>
                                                    ";
                                                }
                                                
                                            }
                                                
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="customer-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Create New Account
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form name="customer-form" action="../pages/admin.php" method="post" class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                            <?php
                                                $errors = validate_input($_POST);  
                                                if (isset($_POST['customer-signup'])) {
                                                    if (empty($errors) && create_account($conn, $_POST, 'customer')) {
                                                        header("Location: ../includes/success.php");
                                                    } else {
                                                        if (!empty($errors)) {
                                                            foreach ($errors as $error) {
                                                                echo '<div class="error_display" style="display: block;">' . $error . '</div>';
                                                            }
                                                        } else {
                                                            header("Location: ../includes/failed.php");
                                                        }
                                                    }
                                                    die();
                                                }
                                                ?>
                                                                        <div class="col-span-2">
                                                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                                    <input type="text" name="first_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Sebastian Vettel" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                                    <input type="text" name="last_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Charles Leclerc" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                    <input type="text" name="username" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. L4ndorris" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                    <input type="password" name="password" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Enter password" required="">
                                                </div>
                                            </div>
                                            <button type="submit" name="customer-signup" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                Add new product
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div> 



                        <div class="table-content">
                            <div class="table-top">
                                <h1 class="summary">Manager Accounts</h1>
                                <!-- Modal toggle -->
                                <button data-modal-target="manager-modal" data-modal-toggle="manager-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-5" type="button">
                                Add Manager
                                </button>                            
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Manager ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $num = mysqli_num_rows($queryman);
                                            if($num > 0){
                                                while($result = mysqli_fetch_assoc($queryman)){
                                                    echo"
                                                    <tr>
                                                        <td>".$result['manager_id']."</td>
                                                        <td>".$result['first_name']."</td>
                                                        <td>".$result['last_name']."</td>
                                                        <td>".$result['username']."</td>
                                                        <td>".$result['password']."</td>
                                                        <td>
                                                            <a href='../includes/supplier.php?manager_id=".$result['manager_id']."' class='update-btn'>Update</a>
                                                        </td>
                                                        <td>
                                                            <a href='../includes/delete.php?manager_id=".$result['manager_id']."' class='delete-btn'>Delete</a>
                                                        </td>
                                                    ";
                                                }
                                                
                                            }
                                                
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="manager-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Create New Account
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form name="manager-form" action="../includes/accountcreate.php" method="post" class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                            <?php
                                            $errors = validate_input($_POST);  
                                            if (isset($_POST['manager-signup'])) {
                                                if (empty($errors) && create_account($conn, $_POST, 'manager')) {
                                                    echo '<div class="success_display" style="display: block;">Account created successfully</div>';
                                                } else {
                                                    if (!empty($errors)) {
                                                        foreach ($errors as $error) {
                                                            header("Location: ../includes/success.php");
                                                        }
                                                    } else {
                                                        header("Location: ../includes/failed.php");
                                                    }
                                                }
                                                die();
                                            }
                                            ?>
                                                <div class="col-span-2">
                                                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                                    <input type="text" name="first_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Sebastian Vettel" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                                    <input type="text" name="last_name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Charles Leclerc" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                    <input type="text" name="username" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. L4ndorris" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                    <input type="password" name="password" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Enter password" required="">
                                                </div>
                                            </div>
                                            <button type="submit" name="manager-signup" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
            type: 'bar', // or 'line', 'pie', etc.
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
    <script>
        var product_count = JSON.parse('<?php echo json_encode($product_count); ?>');
        var category_id = JSON.parse('<?php echo json_encode($category_id); ?>');
        var category_name = JSON.parse('<?php echo json_encode($category_name); ?>');
        var car_count = JSON.parse('<?php echo json_encode($car_count); ?>');

        console.log(product_count);
        console.log(category_id);
        console.log(category_name);
        console.log(car_count);

        for (var i = 0; i < category_id.length; i++) {
            console.log('Category ID: ' + category_id[i] + ', Category Name: ' + category_name[i]);
        }

        //setup block
        const data = {
        labels: category_name,
        datasets: [{
            label: 'Car Count per Category',
            data: car_count,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: [    '#7469B6',
                    '#E8D4F5',
                    '#DBC0F2',
                    '#CEACED',
                    '#C197E9',
                    '#B483E6',
                    '#A76FE2',
                    '#996ADB',
                    '#8C56D8',
                    '#7F42D4',
                    '#713ED1',
                    '#643ACD',
                    '#5736CA',
                    '#4A32C6',
                    '#3D2EC3',
                    '#302ABF',
                    '#2226BC',
                    '#1522B8',
                    '#081EB5',
                    '#001AAF',
                    '#00139E'
],

            borderRadius: 100,
            color:'#fff',
            tension: 0.1
        }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                
            }
        }
    }
    
    const catergory = new Chart(
        document.getElementById('myChart'),
        config
    );
    </script>

</body>
</html>