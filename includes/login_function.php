<?php
include 'db.php';

if(isset($_POST['admin-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        header("Location: ../pages/login.php?error=Username is required");
        exit();
    } else if(empty($password)){
        header("Location: ../pages/login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['username'] === $username && $row['password'] === $password) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../pages/admin.php");
                exit();
            } else {
                header("Location: ../pages/login.php?error=Incorrect Username or Password");
                exit();
            }
        } else {
            header("Location: ../pages/login.php?error=Incorrect Username or Password");
            exit();
        }
    }
}