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
    color: #D8315B;
    font-size: 48px;
    }

    .animation {
    width: 100px;
    height: 100px;
    background-color: #D8315B;
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
        <p>Redirecting in <span id="countdown">3</span> seconds...</p>
    </div>
    </div>

    <script>
    // Countdown timer to redirect after 5 seconds
    var countdown = 3;
    var timer = setInterval(function() {
    countdown--;
    document.getElementById("countdown").textContent = countdown;
    if (countdown <= 0) {
        clearInterval(timer);
        window.location.href = "../pages/admin.php"; // Redirect to another page
    }
}, 1000);
</script>
</body>
</html>
