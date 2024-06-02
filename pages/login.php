<?php
session_start();

$servername = "localhost"; // Change to your database server
$username = "root";        // Change to your database username
$password = "";            // Change to your database password
$dbname = "carlink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // Validate inputs
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if (empty($role) || !in_array($role, ['admin', 'manager', 'user'])) {
        $errors[] = "Invalid role specified.";
    }

    if (empty($errors)) {
        if ($role == 'admin') {
            $table = 'admn';
        } elseif ($role == 'manager') {
            $table = 'manager';
        } else {
            $table = 'customer';
        }

        $sql = "SELECT * FROM $table WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch user details
            $user = $result->fetch_assoc();
        
            // Store user details in session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $role;
        
            // Redirect based on role
            if ($role == 'admin') {
                header("Location: admin.php");
                exit();
            } elseif ($role == 'manager') {
                header("Location: manager.php");
                exit();
            } elseif($role == 'user') {
                header("Location: customer.php");
                exit();
            }
        } else {
            $errors[] = "Invalid username or password.";
        }

        $stmt->close();
    }
}

$conn->close();
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
        <div class="form-container">
            <a class="back-button" href="../index.php"></a>
            <h1>Welcome Back</h1>
            <p>Please login to your account</p>
            <div class="select-container">
                <select id="category-select" onchange="showCategory()">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="user">User</option>
                </select>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div id="admin" class="category-section">
                <form action="login.php" method="post">
                    <label for="admin-id">Username</label>
                    <input type="text" id="admin-id" name="username" placeholder="Enter your Username">
                    <label for="admin-password">Password:</label>
                    <input type="password" id="admin-password" name="password" placeholder="Enter your Password">
                    <input type="hidden" name="role" value="admin">
                    <input type="submit" value="Submit" name="login">
                    <a href="signin.php">Don't have an account yet?</a>
                </form>
            </div>

            <div id="manager" class="category-section">
                <form action="login.php" method="post">
                    <label for="manager-id">Username</label>
                    <input type="text" id="manager-id" name="username" placeholder="Enter your Username">
                    <label for="manager-password">Password:</label>
                    <input type="password" id="manager-password" name="password" placeholder="Enter your Password">
                    <input type="hidden" name="role" value="manager">
                    <input type="submit" value="Submit" name="login">
                    <a href="signin.php">Don't have an account yet?</a>
                </form>
            </div>

            <div id="user" class="category-section">
                <form action="login.php" method="post">
                    <label for="user-id">Username</label>
                    <input type="text" id="user-id" name="username" placeholder="Enter your Username">
                    <label for="user-password">Password:</label>
                    <input type="password" id="user-password" name="password" placeholder="Enter your Password">
                    <input type="hidden" name="role" value="user">
                    <input type="submit" value="Submit" name="login">
                    <a href="signin.php">Don't have an account yet?</a>
                </form>
            </div>
        </div>
        <div class="video-container">
            <video autoplay loop muted plays-inline class="video-bg">
                <source src="../assets/images/login.mp4" type="video/mp4">
            </video>
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
