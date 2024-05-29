<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/guest.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/images/astorisfav.png" />
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
                    <a data-switcher data-tab="3">About Us</a>
                </li>
                <li class="tab-item">
                    <a data-switcher data-tab="4">Contacts</a>
                </li>
            </ul>
            <div class="login">
                <a class="login-btn" href="">Login</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="pages">
            <!-- page 1 -->
            <div class="page is-active" data-page="1">
                <div>
                    <div class="hero">
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
                <h2>page2</h2>
                <p>b</p>
            </div>
            <div class="page" data-page="3">
                <h2>page3</h2>
                <p>c</p>
            </div>
            <div class="page" data-page="4">
                <h2>page4</h2>
                <p>d</p>
            </div>
        </section>
    </main>

    <script src="../assets/js/switch.js" defer></script>

</body>
</html>