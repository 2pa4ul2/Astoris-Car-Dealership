
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
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
                    <a data-switcher data-tab="3">About Us</a>
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
                <div class="top-bar">
                    <h1>Admin Dashboard</h1>
                    <div class="profile"><a href=""></a></div>
                </div>  

                <div class="box-container">
                    <div class="box-data">
                        <h1>ab</h1>
                    </div>
                    <div class="box-data">
                        <h1>cs</h1>
                    </div>
                    <div class="box-data">
                        <h1>we</h1>
                    </div>
                    <div class="box-data">
                        <h1>te</h1>
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