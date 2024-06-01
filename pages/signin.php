<?php
session_start();

// Check if there are any success or error messages stored in session
if(isset($_SESSION['success_message'])) {
    echo '<div class="success_display" style="display: block;">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // unset the session variable after displaying
}

if(isset($_SESSION['error_message'])) {
    echo '<div class="error_display" style="display: block;">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // unset the session variable after displaying
}

session_unset(); // unset all other session variables
include "../includes/signin_function.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/images/astorisfav.png" />
    <title>Astoris</title>
</head>
<body>
    <main>
        <div class="video-container">
            <video autoplay loop muted plays-inline class="video-bg">
                <source src="../assets/images/signin.mp4" type="video/mp4">
            </video>
        </div>
        <div class="form-container">
            <a class="back-button-sign" href="../index.php"></a>
            <h1>Hello! Welcome</h1>
            <p>Choose a category to create an account</p>
            <div class="select-container">
                <select id="category-select" onchange="showCategory()">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="user">User</option>
                </select>
            </div>


                <div id="admin" class="category-section">
                    <form action="../pages/signin.php" method="POST">
                    <?php 
                    $errors = validate_input($_POST);
                    if (isset($_POST['admin-signup'])) {
                        if (empty($errors) && create_account($conn, $_POST, 'admin')) {
                            echo '<div class="success_display" style="display: block;">Account created successfully</div>';
                        } else {
                            if (!empty($errors)) {
                                foreach ($errors as $error) {
                                    echo '<div class="error_display" style="display: block;">' . $error . '</div>';
                                }
                            } else {
                                echo '<div class="error_display" style="display: block;">An error occurred. Please try again</div>';
                            }
                        }
                    }
                    ?>
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Enter First name">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Enter last name">
                        
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your Username">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password">
                        <input type="submit" value="Submit" name="admin-signup"> 
                        <a href="login.php">Already have an account?</a>
                    </form>
                </div>

                <div id="manager" class="category-section">
                    <form action="../pages/signin.php" method="POST">
                        <?php
                        $errors = validate_input($_POST);  
                        if (isset($_POST['manager-signup'])) {
                            if (empty($errors) && create_account($conn, $_POST, 'manager')) {
                                echo '<div class="success_display" style="display: block;">Account created successfully</div>';
                            } else {
                                if (!empty($errors)) {
                                    foreach ($errors as $error) {
                                        echo '<div class="error_display" style="display: block;">' . $error . '</div>';
                                    }
                                } else {
                                    echo '<div class="error_display" style="display: block;">An error occurred. Please try again</div>';
                                }
                            }
                            die();
                        }
                        ?>

                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Enter First name">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Enter last name">
                        
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your Username">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password">
                        <input type="submit" value="Submit" name="manager-signup"> 
                        <a href="login.php">Already have an account?</a>
                    </form>
                </div>

                <div id="user" class="category-section">
                    <form action="../pages/signin.php" method="POST">
                        <?php
                        $errors = validate_input($_POST);
                        if (isset($_POST['customer-signup'])) {
                            if (empty($errors) && create_account($conn, $_POST, 'customer')) {
                                echo '<div class="success_display" style="display: block;">Account created successfully</div>';
                            } else {
                                if (!empty($errors)) {
                                    foreach ($errors as $error) {
                                        echo '<div class="error_display" style="display: block;">' . $error . '</div>';
                                    }
                                } else {
                                    echo '<div class="error_display" style="display: block;">An error occurred. Please try again</div>';
                                }
                            }
                        }
                        ?>
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Enter First name">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Enter last name">
                        
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your Username">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password">
                        <input type="submit" value="Submit" name="customer-signup"> 
                        <a href="login.php">Already have an account?</a>
                    </form>
                </div>
        </div>
    </main>
    <script>
        function showCategory() {
            // Hide all sections
            document.querySelectorAll('.category-section').forEach(function(section) {
                section.style.display = 'none';
            });
            
            // Get the selected value
            var category = document.getElementById('category-select').value;
            
            // Show the selected section
            if (category) {
                document.getElementById(category).style.display = 'block';
            }
        }

        // Show the admin section by default
        document.getElementById('admin').style.display = 'block';
</script>
</body>
</html>
