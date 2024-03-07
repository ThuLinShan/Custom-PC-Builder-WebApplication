<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/cooler/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
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
                    $_SESSION['edit-cooler'] = "img is too large";
                }
            } else {
                $_SESSION['edit-cooler'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-cooler'])) {
        header('location: ' . ROOT_URL . 'admin/edit_cooler.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE cooler SET 
                    cooler_name='$cooler_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    type='$type',
                    fan_speed='$fan_speed',
                    radiator_dimension='$radiator_dimension',
                    tube_length='$tube_length',
                    power = '$power',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-cooler-success'] = "cooler: $cooler_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_cooler.php');
            die();
        } else {
            $_SESSION['edit-cooler'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
