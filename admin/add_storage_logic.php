<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $storage_name   = filter_var($_POST['storage_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $interface = filter_var($_POST['interface'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $capacity = filter_var($_POST['capacity'], FILTER_SANITIZE_NUMBER_INT);
    $capacity_format = filter_var($_POST['capacity_format'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$storage_name) {
        $_SESSION['add-storage'] = "Please enter a storage_name";
    } elseif (!$brand) {
        $_SESSION['add-storage'] = "Please select the brand for the storage";
    } elseif (!$interface) {
        $_SESSION['add-storage'] = "Please enter the interface of the storage drive";
    } elseif (!$capacity) {
        $_SESSION['add-storage'] = "Please enter the total number of capacity in the storage";
    } elseif (!$capacity_format) {
        $_SESSION['add-storage'] = "Please select the storage type of the drive";
    } elseif (!$price) {
        $_SESSION['add-storage'] = "Please enter the price of the storage";
    } elseif (!$link) {
        $_SESSION['add-storage'] = "Please enter the official link of the storage";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/storage/' . $img_name;

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
                $_SESSION['add-storage'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-storage'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-storage'])) {
        $_SESSION['add-storage-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_storage.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO storage (
                                storage_name,
                                img,
                                brand,
                                interface,
                                capacity,
                                capacity_format,
                                price,
                                link
                                ) VALUES (
                                '$storage_name',
                                '$img_name',
                                '$brand',
                                '$interface',
                                '$capacity',
                                '$capacity_format',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-storage-success'] = "New storage: $storage_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_storage.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-storage-data'] = $_POST;
            $_SESSION['add-storage'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_storage.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_storage.php');
    die();
}
