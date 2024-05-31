<?php
include 'db.php'; // Include the database connection script

function validate_input($data) {
    $errors = [];
    
    if (empty($data['first_name']) && empty($data['last_name']) && empty($data['username']) && empty($data['password'])) {
        $errors[] = 'All fields are required';
    } else {
        if (empty($data['first_name'])) {
            $errors[] = 'First name is required';
        }
        
        if (empty($data['last_name'])) {
            $errors[] = 'Last name is required';
        }
        
        if (empty($data['username'])) {
            $errors[] = 'Username is required';
        }
        
        if (empty($data['password'])) {
            $errors[] = 'Password is required';
        }
    }

    // If there are multiple errors, consolidate them into one message
    if (count($errors) > 1) {
        $errors = ['Please fill in all required fields.'];
    }
    
    return $errors;
}


function create_account($conn, $data, $role) {
    $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
    $table = '';
    
    switch ($role) {
        case 'admin':
            $table = 'admn';
            break;
        case 'manager':
            $table = 'manager';
            break;
        case 'customer':
            $table = 'customer';
            break;
        default:
            return false;
    }
    
    // Check if the username already exists
    $existing_username_sql = "SELECT COUNT(*) FROM $table WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $existing_username_sql)) {
        mysqli_stmt_bind_param($stmt, 's', $data['username']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        
        if ($count > 0) {
            // Username already exists, return false
            return false;
        }
    } else {
        // Error preparing statement
        return false;
    }
    
    // Insert the new account
    $insert_sql = "INSERT INTO $table (first_name, last_name, username, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $insert_sql)) {
        mysqli_stmt_bind_param($stmt, 'ssss', $data['first_name'], $data['last_name'], $data['username'], $password_hash);
        return mysqli_stmt_execute($stmt);
    } else {
        // Error preparing statement
        return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roles = ['admin', 'manager', 'customer'];
    
    foreach ($roles as $role) {
        if (isset($_POST[$role . "-signup"])) {
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password'])
            ];
            
            $errors = validate_input($data);
        }
    }
}
?>
