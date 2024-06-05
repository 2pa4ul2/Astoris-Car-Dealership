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
            $cartClearedAlert = true;
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
                    <a data-switcher data-tab="5">Contacts</a>
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
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/audi.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/bmw.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/buick.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/chevy.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/dodge.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/ferrari.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/ford.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/infiniti.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/kia.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/lexus.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/lincoln.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/maserati.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/maybach.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/mercedes.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/mini.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/nissan.png" alt=""></a></div>
                    <div class="cards"><a href="login.php"><img id="logo-img" src="../assets/images/brandlogo/oldsmobile.png" alt=""></a></div>

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
                                                echo "<td>$".number_format($value['price'],2)."</td>";
                                                echo "<td>".$value['quantity']."</td>";
                                                echo "<td>$".number_format($value['quantity']* $value['price'],2)."</td>";
                                                echo "</tr>";
                                                $total = $total + ($value['quantity'] * $value['price']);
                                            }
                                            echo "<tr>";
                                            echo "<td colspan='3' align='right'>Total</td>";
                                            echo "<td>$".number_format($total,2)."</td>";
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
                            <h1>Models</h1>
                            <div class="product-container">
                                <?php
                                    $conn = mysqli_connect("localhost", "root", "", "carlink");

                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }

                                    // Define SQL query with Limit to 25 products
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
                                    mysqli_close($conn);
                                ?>

                        </div>  
                    </div>
                </div>
            </div>
            <div class="page" data-page="4">
                <div class="container">
                    <div class="about-container">
                        <div>
                            <h4 class="astoris">Astoris</h4>
                                <div class="mission-container">
                                    <p class="mission">Welcome to Astoris Car Dealership, your premier destination for quality vehicles and exceptional service. With a commitment to excellence, we offer a curated selection of new and pre-owned cars, backed by transparent pricing and financing options. Our dedicated team is here to make your car-buying experience seamless and enjoyable. Visit us today and discover the Astoris difference.</p>
                                </div>
                        </div>
                        <div>
                            <h4 class="astoris">Our Mission</h4>
                            <div class="mission-container">
                                <p class="mission">At Astoris Car Dealership, our mission is simple: to provide every customer with a seamless and enjoyable car-buying experience. We achieve this by offering a curated selection of quality vehicles, transparent pricing, and flexible financing options. Our commitment to excellence drives us to exceed expectations and ensure that every customer leaves satisfied. With Astoris, you're not just buying a car; you're joining a community built on trust, integrity, and exceptional service.</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="page" data-page="5">
                <div class="container">    
                    <div class="about-container">
                        <div class="contact-container">
                        <div>
                            <h4>Contact us</h4>
                        </div>
                        <div>
                            <h1>Astoris Car Dealership</h1>
                            <p>123 Main Street<br>
                            City, State, Zip Code</p>
                            <p>Phone: (123) 456-7890<br>
                            Email: <a href="mailto:info@astorisdealership.com">info@astorisdealership.com</a></p>
                            <p>Hours of Operation:<br>
                            Monday - Friday: 9:00 AM - 7:00 PM<br>
                            Saturday: 9:00 AM - 5:00 PM<br>
                            Sunday: Closed</p>
                            <p>Connect with us on social media:</p>
                            <p class="social-media-links">
                                <a href="https://www.facebook.com/astorisdealership">Facebook</a>
                                <a href="https://twitter.com/astorisdealership">Twitter</a>
                                <a href="https://instagram.com/astorisdealership">Instagram</a>
                            </p>
                            <p>For inquiries, appointments, or any assistance, please don't hesitate to <a href="contact.html">contact us</a>. We're here to help you every step of the way.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../assets/js/switch.js" defer></script>
    <?php if(isset($cartClearedAlert) && $cartClearedAlert): ?>
        <script src="../assets/js/alertcheckout.js"></script>
    <?php endif; ?>
    <?php if(isset($cartEmptyAlert) && $cartEmptyAlert): ?>
        <script src="../assets/js/alertempty.js"></script>
    <?php endif; ?>
    <?php if(isset($alreadyadded) && $alreadyadded): ?>
        <script src="../assets/js/alertadded.js"></script>
    <?php endif; ?>
</body>
</html>