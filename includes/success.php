<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0b1b22;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-message {
            text-align: center;
            color: white;
        }

        .success-icon {
            color: #4CAF50;
            font-size: 48px;
        }

        .animation {
            width: 100px;
            height: 100px;
            background-color: #4CAF50;
            margin: 20px auto;
            border-radius: 50%;
            animation: scale 1s infinite alternate;
        }

        @keyframes scale {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.1);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="success-message">
        <i class="fas fa-check-circle success-icon"></i>
        <h2>Record Deleted Successfully!</h2>
        <div class="animation"></div>
        <p>Redirecting...</p>
    </div>
</div>

<script>
    // Countdown timer to redirect after 3 seconds
    setTimeout(function() {
        // Redirect to the last page (either manager.php or admin.php)
        window.location.href = "<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../pages/admin.php'; ?>";
    }, 3000);
</script>
</body>
</html>
