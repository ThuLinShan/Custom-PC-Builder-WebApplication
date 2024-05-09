<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $ram_name   = filter_var($_POST['ram_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_NUMBER_INT);
    $img                = $_FILES['img'];
    $capacity = filter_var($_POST['capacity'], FILTER_SANITIZE_NUMBER_INT);
    $frequency = filter_var($_POST['frequency'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $combo = filter_var($_POST['combo'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$ram_name) {
        $_SESSION['add-ram'] = "Please enter a ram_name";
    } elseif (!$brand) {
        $_SESSION['add-ram'] = "Please select the brand for the ram";
    } elseif (!$capacity) {
        $_SESSION['add-ram'] = "Please enter the capacity of the ram";
    } elseif (!$frequency) {
        $_SESSION['add-ram'] = "Please enter the frequency of the ram";
    } elseif (!$combo) {
        $_SESSION['add-ram'] = "Please enter the total number of physical combo in the ram";
    } elseif (!$price) {
        $_SESSION['add-ram'] = "Please enter the price of the ram";
    } elseif (!$link) {
        $_SESSION['add-ram'] = "Please enter the official link of the ram";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/ram/' . $img_name;

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
                $_SESSION['add-ram'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-ram'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-ram'])) {
        $_SESSION['add-ram-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_ram.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO memory (
                                ram_name,
                                img,
                                brand,
                                capacity,
                                frequency,
                                combo,
                                price,
                                link
                                ) VALUES (
                                '$ram_name',
                                '$img_name',
                                '$brand',
                                '$capacity',
                                '$frequency',
                                '$combo',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-ram-success'] = "New ram: $ram_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_ram.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-ram-data'] = $_POST;
            $_SESSION['add-ram'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_ram.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_ram.php');
    die();
}
