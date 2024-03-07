<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $operating_system_name   = filter_var($_POST['operating_system_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$operating_system_name) {
        $_SESSION['add-operating_system'] = "Please enter a operating_system_name";
    } elseif (!$brand) {
        $_SESSION['add-operating_system'] = "Please select the brand for the operating_system";
    } elseif (!$description) {
        $_SESSION['add-operating_system'] = "Please enter the description of the operating_system";
    } elseif (!$price) {
        $_SESSION['add-operating_system'] = "Please enter the price of the operating_system";
    } elseif (!$link) {
        $_SESSION['add-operating_system'] = "Please enter the official link of the operating_system";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/operating_system/' . $img_name;

        // Validate file format
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $img_name);
        $extension = end($extension);
        if (in_array($extension, $allowed_files)) {
            // Validate file size
            if ($img['size'] < 2_000_000) {
                // Upload image
                move_uploaded_file($img_tmp_name, $img_destination_path);
            } else {
                $_SESSION['add-operating_system'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-operating_system'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-operating_system'])) {
        $_SESSION['add-operating_system-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_operating_system.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO operating_system (
                                operating_system_name,
                                img,
                                brand,
                                description,
                                price,
                                link
                                ) VALUES (
                                '$operating_system_name',
                                '$img_name',
                                '$brand',
                                '$description',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-operating_system-success'] = "New operating_system: $operating_system_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_operating_system.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-operating_system-data'] = $_POST;
            $_SESSION['add-operating_system'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_operating_system.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_operating_system.php');
    die();
}
