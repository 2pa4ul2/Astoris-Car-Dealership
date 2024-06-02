<?php
session_start();
include '../includes/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/customer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                    <a data-switcher data-tab="3">Order</a>
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
                <h2>Order</h2>
                <p>c</p>
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

</body>
</html>