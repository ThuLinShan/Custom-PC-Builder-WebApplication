<?php
require 'config/database.php';

// Get Signup form data if signup button was clicked
if (isset($_POST['submit'])) {
    // Get form data
    $username           = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email              = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone1             = filter_var($_POST['phone1'], FILTER_SANITIZE_NUMBER_INT);
    $phone2             = filter_var($_POST['phone2'], FILTER_SANITIZE_NUMBER_INT);
    $address            = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword     = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword    = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];

    //another bitch comment
    // Check if inputs are there
    if (!$phone1) {
        $_SESSION['signup'] = "Please enter your Phone number";
    } elseif (!$address) {
        $_SESSION['signup'] = "Please enter your Address";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter your Username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be more than eight characters";
    } elseif (!$img['name']) {
        $_SESSION['signup'] = "Please add an avatar";
    } else {
        // Check if passwords dont match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // Hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // Check if username/email already exist
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or Email already exist";
            } else {
                // Manage img
                $time = time();
                $img_name = $time . $img['name'];
                $img_tmp_name = $img['tmp_name'];
                $img_destination_path = 'assets/images/avatar/' . $img_name;

                // Validate file format
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $img_name);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    // Validate image is not too large
                    if ($img['size'] <= 200000) {
                        // Upload image
                        move_uploaded_file($img_tmp_name, $img_destination_path);
                    } else {
                        $_SESSION['signup'] = 'File size should not be larger than 2 MB';
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }

    if (isset($_SESSION['signup'])) {
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        $insert_query = "INSERT INTO users (
                                phone1,
                                phone2,
                                address,
                                username,
                                email,
                                password,
                                avatar,
                                is_admin
                                ) VALUES (
                                '$phone1',
                                '$phone2',
                                '$address',
                                '$username',
                                '$email',
                                '$hashed_password',
                                '$img_name',
                                0
                                )";
        $insert_user_result = mysqli_query($connection, $insert_query);
        if (!mysqli_errno($connection)) {
            $_SESSION['signup-success'] = "Regisration succesful.";
            header('location:' . ROOT_URL . 'signin.php');
            die();
        } else {
            $_SESSION['signup-data'] = $_POST;
            $_SESSION['signup'] = 'Database error occured';
            header('location: ' . ROOT_URL . 'signup.php');
        }
    }
} else {
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
