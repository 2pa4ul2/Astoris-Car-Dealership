<?php
session_start();
include '../includes/db.php';

// Clear Cart
if (isset($_POST['clear-cart'])) {
    unset($_SESSION['cart']);
    $cartEmptyAlert = true;

}

// Checkout
if (isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        $conn = mysqli_connect("localhost", "root", "", "carlink");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        foreach ($_SESSION['cart'] as $key => $value) {
            $product_id = $value['product_id'];
            $product_name = $value['product_name'];
            $price = $value['price'];
            $quantity = $value['quantity'];
            $total = $price * $quantity;

            $sql = "INSERT INTO orders (product_id, product_name, price, quantity, total) VALUES ('$product_id', '$product_name', '$price', '$quantity', '$total')";

            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
        unset($_SESSION['cart']);
        $cartClearedAlert = true;
    } else {
        $cartEmptyAlert = true;
    }
}

// Existing code for adding to cart
if (isset($_POST['add-to-table'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        if (!in_array($_POST['product_id'], $item_array_id)) {
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            );
            $_SESSION['cart'][$count] = $item_array;
        } else {
            $alreadyadded = true;
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );
        $_SESSION['cart'][0] = $item_array;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/customer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <a data-switcher data-tab="1">Overview</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="2">Collections</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="3">Reservation</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="4">about</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="4">Contacts</a>
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
                <div>
                    <div class="hero">
                        <div class="hero-text">
                            <h1>Premiere Brand Recognized by the world</h1>
                            <h3>Discover More</h3>
                            <a href="">Learn more</a>
                        </div>
                        <img src="../assets/images/lewis.jpg" alt="">
                    </div>
                    <div class="video-container">
                        <div class="text-container">
                            <h3>Sports Car</h3>
                            <h1>Start Your Engine</h1>
                            <a href="#">Go To Collection</a>
                        </div>
                        <video autoplay loop muted plays-inline class="video-bg">
                            <source src="../assets/images/bgvid.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
            <div class="page" data-page="2">
                <div class="collections-container">
                    <h1>OUR BRAND PARTNERS</h1>
                    <div class="container">
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/audi.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/bmw.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/buick.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/chevy.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/dodge.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/ferrari.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/ford.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/infiniti.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo//kia.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/lexus.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/lincoln.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/maserati.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/maybach.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/mercedes.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/mini.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/nissan.png" alt=""></div>
                        <div class="cards"><img id="logo-img" src="../assets/images/brandlogo/oldsmobile.png" alt=""></div>
                    </div>
                </div>
            </div>
            <div class="page" data-page="3">
                    <div class="page3">
                        <div class="order-container">
                            <h2>Order Form</h2>
                            <div class="table-form-order">
                                <table>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    <?php
                                        if (!empty($_SESSION['cart'])) {
                                            $total = 0;
                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                echo "<tr>";
                                                echo "<td>".$value['product_name']."</td>";
                                                echo "<td>".$value['price']."</td>";
                                                echo "<td>".$value['quantity']."</td>";
                                                echo "<td>".$value['quantity'] * $value['price']."</td>";
                                                echo "</tr>";
                                                $total = $total + ($value['quantity'] * $value['price']);
                                            }
                                            echo "<tr>";
                                            echo "<td colspan='3' align='right'>Total</td>";
                                            echo "<td>".$total."</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </table>
                            </div>
                            <form action="customer.php" method="post">
                                <button class="cart-btn-clear" type="submit" name="clear-cart">Clear Cart</button>
                                <button class="cart-btn-checkout" type="submit" name="checkout">Checkout</button>
                            </form>
                        </div>

                        <div class="product-container-order">
                            <h1>OUR BRAND PARTNERS</h1>
                            <div class="product-container">
                                <?php
                                    // Establish database connection
                                    $conn = mysqli_connect("localhost", "root", "", "carlink");

                                    // Check connection
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    // Define SQL query with LIMIT clause
                                    $sql = "SELECT * FROM product LIMIT 25";

                                    // Execute the query
                                    $result = mysqli_query($conn, $sql);

                                    // Check if there are results and display products
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<div class='prod-cards'>";
                                                echo "<div class='prod-cards-title'>";
                                                echo    "<h3>".$row['product_name']."</h3>";
                                                echo    "<p class=descriptiondate>2024</p>";
                                                echo "</div>";
                                                echo "<form action='customer.php' method='post'>";
                                                echo "<img id='car-img' class = 'car-img' src='../assets/images/carimages/".$row['img_filename']."' alt='".$row['product_name']."style='width:150px; height:auto;''>";
                                                echo "<p class='car-price'>$ ".number_format($row['price'], 2)."</p>";
                                                echo "<input type='hidden' name='product_id' value='".$row['product_id']."'>";
                                                echo "<input type='hidden' name='product_name' value='".$row['product_name']."'>";
                                                echo "<input type='hidden' name='price' value='".$row['price']."'>";
                                                echo "<input type='number' name='quantity' value='1' min='1' max='10'>";
                                                echo "<button class='cart-btn-submit' type='submit' name='add-to-table'>Reserve</button>";
                                                echo "</form>";
                                            echo "</div>";
                                        }
                                    } else {
                                        echo "No products found.";
                                    }

                                    // Close the database connection
                                    mysqli_close($conn);
                                ?>

                        </div>  
                    </div>
                </div>
            </div>
            <div class="page" data-page="4">
                <h2>About</h2>
                <p>d</p>
            </div>
            <div class="page" data-page="5">
                <h2>Contact</h2>
                <p>d</p>
            </div>
        </section>
    </main>

    <script src="../assets/js/switch.js" defer></script>
    <?php if(isset($cartClearedAlert) && $cartClearedAlert): ?>
        <script>
            Swal.fire({
                title: 'Checkout Success!',
                icon: 'success',
                showConfirmButton: false,
                color:'#fff',
                background: '#142d39',
                timer: 2000
            });
        </script>
    <?php endif; ?>
    <?php if(isset($cartEmptyAlert) && $cartEmptyAlert): ?>
        <script>
            Swal.fire({          
                title: 'Cart Empty!',
                icon: 'success',
                showConfirmButton: false,
                color:'#fff',
                background: '#142d39',
                timer: 2000
            });
        </script>
    <?php endif; ?>
    <?php if(isset($alreadyadded) && $alreadyadded): ?>
        <script>
            Swal.fire({
                title: 'Item already added to cart!',
                icon: 'error',
                showConfirmButton: false,
                color:'#fff',
                background: '#142d39',
                timer: 2000
            });
        </script>
    <?php endif; ?>
</body>
</html>