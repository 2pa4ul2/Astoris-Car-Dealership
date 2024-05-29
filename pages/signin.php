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
                    <form>
                        <label for="admin-id">Username</label>
                        <input type="text" id="admin-id" name="admin-id" placeholder="Enter your Username">
                        <label for="admin-password">Password:</label>
                        <input type="password" id="admin-password" name="admin-password" placeholder="Enter your Password">
                        <input type="submit" value="Submit">
                        <a>don't have an account yet?</a>
                    </form>
                </div>

                <div id="manager" class="category-section">
                    <form>
                        <label for="manager-id">Username</label>
                        <input type="text" id="manager-id" name="manager-id" placeholder="Enter your Username">
                        <label for="manager-password">Password:</label>
                        <input type="password" id="manager-password" name="manager-password" placeholder="Enter your Password">
                        <input type="submit" value="Submit">
                        <a>don't have an account yet?</a>
                    </form>
                </div>

                <div id="user" class="category-section">
                    <form>
                        <label for="user-id">Username</label>
                        <input type="text" id="user-id" name="user-id" placeholder="Enter your Username">
                        <label for="user-password">Password:</label>
                        <input type="password" id="user-password" name="user-password" placeholder="Enter your Password">
                        <input type="submit" value="Submit">
                        <a>don't have an account yet?</a>
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
