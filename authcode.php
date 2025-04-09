<?php
session_start();
include('../config/dbcon.php');
include('myfunctions.php');

if (isset($_POST['register_btn'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);

    // Basic Validations
    if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($cpassword)) {
        $_SESSION['message'] = "All fields are required!";
        header('Location: ../register.php');
        exit(0);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format!";
        header('Location: ../register.php');
        exit(0);
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $_SESSION['message'] = "Invalid phone number format!";
        header('Location: ../register.php');
        exit(0);
    }

    if ($password !== $cpassword) {
        $_SESSION['message'] = "Passwords do not match!";
        header('Location: ../register.php');
        exit(0);
    }

    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $_SESSION['message'] = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one digit!";
        header('Location: ../register.php');
        exit(0);
    }

    // Sanitize Inputs
    $email = mysqli_real_escape_string($con, $email);
    $phone = mysqli_real_escape_string($con, $phone);
    $name = mysqli_real_escape_string($con, $name);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Secure password storage

    // Check if email already registered
    $check_email_query = "SELECT email FROM users WHERE email = '$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "Email already registered!";
        header('Location: ../register.php');
        exit(0);
    }

    // Insert user data
    $insert_query = "INSERT INTO users(name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";
    $insert_query_run = mysqli_query($con, $insert_query);

    if ($insert_query_run) {
        $_SESSION['message'] = "Registration Successful! Please login.";
        header('Location: ../login.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong. Please try again!";
        header('Location: ../register.php');
        exit(0);
    }
}

// Login Handler
else if (isset($_POST['login_btn'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['message'] = "Email and Password are required!";
        header('Location: ../login.php');
        exit(0);
    }

    $email = mysqli_real_escape_string($con, $email);

    // Check if email exists
    $login_query = "SELECT * FROM users WHERE email='$email'";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $userdata = mysqli_fetch_array($login_query_run);
        $stored_password = $userdata['password'];

        if (password_verify($password, $stored_password)) {
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $userdata['id'],
                'name' => $userdata['name'],
                'email' => $userdata['email']
            ];
            $_SESSION['role_as'] = $userdata['role_as'];

            if ($userdata['role_as'] == 1) {
                redirect("../admin/index.php", "Welcome to the dashboard!");
            } else {
                redirect("../index.php", "Welcome to Pappu Mobile Shop!");
            }
        } else {
            $_SESSION['message'] = "Incorrect password!";
            header('Location: ../login.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Email not found!";
        header('Location: ../login.php');
        exit(0);
    }
}
?>