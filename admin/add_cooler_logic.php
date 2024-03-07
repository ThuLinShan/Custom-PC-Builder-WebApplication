<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $cooler_name   = filter_var($_POST['cooler_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $type = filter_var($_POST['type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fan_speed = filter_var($_POST['fan_speed'], FILTER_SANITIZE_NUMBER_INT);
    $tube_length = filter_var($_POST['tube_length'], FILTER_SANITIZE_NUMBER_INT);
    $radiator_dimension = filter_var($_POST['radiator_dimension'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $power = filter_var($_POST['power'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$cooler_name) {
        $_SESSION['add-cooler'] = "Please enter a cooler_name";
    } elseif (!$brand) {
        $_SESSION['add-cooler'] = "Please select the brand for the cooler";
    } elseif (!$type) {
        $_SESSION['add-cooler'] = "Please enter the type of the cooler";
    } elseif (!$fan_speed) {
        $_SESSION['add-cooler'] = "Please enter the fan speed of the cooler";
    } elseif (!$tube_length) {
        $_SESSION['add-cooler'] = "Please enter the tube length of the cooler";
    } elseif (!$power) {
        $_SESSION['add-cooler'] = "Please enter the power consumption of the cooler in Watt";
    } elseif (!$price) {
        $_SESSION['add-cooler'] = "Please enter the price of the cooler";
    } elseif (!$link) {
        $_SESSION['add-cooler'] = "Please enter the official link of the cooler";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/cooler/' . $img_name;

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
                $_SESSION['add-cooler'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-cooler'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-cooler'])) {
        $_SESSION['add-cooler-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_cooler.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO cooler (
                                cooler_name,
                                img,
                                brand,
                                type,
                                fan_speed,
                                radiator_dimension,
                                tube_length,
                                power,
                                price,
                                link
                                ) VALUES (
                                '$cooler_name',
                                '$img_name',
                                '$brand',
                                '$type',
                                '$fan_speed',
                                '$radiator_dimension',
                                '$tube_length',
                                '$power',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-cooler-success'] = "New cooler: $cooler_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_cooler.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-cooler-data'] = $_POST;
            $_SESSION['add-cooler'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_cooler.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_cooler.php');
    die();
}
