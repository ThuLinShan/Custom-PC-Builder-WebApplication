<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $prebuilt_name   = filter_var($_POST['prebuilt_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($_POST['free_shipping'])) {
        $free_shipping = filter_var($_POST['free_shipping'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        $free_shipping = 0;
    }
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
    $default_price = filter_var($_POST['default_price'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $motherboard = filter_var($_POST['motherboard'], FILTER_SANITIZE_NUMBER_INT);
    $cpu = filter_var($_POST['cpu'], FILTER_SANITIZE_NUMBER_INT);
    $gpu = filter_var($_POST['gpu'], FILTER_SANITIZE_NUMBER_INT);
    $operating_system = filter_var($_POST['operating_system'], FILTER_SANITIZE_NUMBER_INT);
    $ram = filter_var($_POST['ram'], FILTER_SANITIZE_NUMBER_INT);
    $primary_storage = filter_var($_POST['primary_storage'], FILTER_SANITIZE_NUMBER_INT);
    $secondary_storage = filter_var($_POST['secondary_storage'], FILTER_SANITIZE_NUMBER_INT);
    $power_supply = filter_var($_POST['power_supply'], FILTER_SANITIZE_NUMBER_INT);
    $desktop_case = filter_var($_POST['desktop_case'], FILTER_SANITIZE_NUMBER_INT);
    $cooler = filter_var($_POST['cooler'], FILTER_SANITIZE_NUMBER_INT);
    $img    = $_FILES['img'];

    $free_shipping = $free_shipping == 1 ?: 0;

    if (!$prebuilt_name) {
        $_SESSION['add-prebuilt'] = "Please enter the name for Prebuilt Desktop";
    } elseif (!$description) {
        $_SESSION['add-prebuilt'] = "Please enter the description of the prebuilt";
    } elseif (!$status) {
        $_SESSION['add-prebuilt'] = "Please select a valid status";
    } elseif (!$stock) {
        $_SESSION['add-prebuilt'] = "Please enter the current stock of the prebuilt desktop";
    } elseif (!$default_price) {
        $_SESSION['add-prebuilt'] = "Please enter the original price of the prebuilt desktop";
    } elseif (!$price) {
        $_SESSION['add-prebuilt'] = "Please enter the price of the prebuilt";
    } elseif (!$motherboard) {
        $_SESSION['add-prebuilt'] = "Please select a motherboard";
    } elseif (!$cpu) {
        $_SESSION['add-prebuilt'] = "Please select a cpu";
    } elseif (!$gpu) {
        $_SESSION['add-prebuilt'] = "Please select a gpu";
    } elseif (!$operating_system) {
        $_SESSION['add-prebuilt'] = "Please select an operation system";
    } elseif (!$ram) {
        $_SESSION['add-prebuilt'] = "Please select a ram";
    } elseif (!$primary_storage) {
        $_SESSION['add-prebuilt'] = "Please select a primary_storage";
    } elseif (!$secondary_storage) {
        $secondary_storage = null;
    } elseif (!$power_supply) {
        $_SESSION['add-prebuilt'] = "Please select a power_supply";
    } elseif (!$desktop_case) {
        $_SESSION['add-prebuilt'] = "Please select a desktop_case";
    } elseif (!$cooler) {
        $_SESSION['add-prebuilt'] = "Please select a cooler";
    }

    if (isset($_SESSION['add-prebuilt'])) {
        header('location: ' . ROOT_URL . 'admin/add_prebuilt.php?config=intel');
        die();
    } else {

        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/prebuilt/' . $img_name;

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

        if (isset($_SESSION['add-prebuilt'])) {
            header('location: ' . ROOT_URL . 'admin/add_prebuilt.php?config=intel');
            die();
        }

        //check if components are valid
        $check_query = "SELECT * FROM prebuilt WHERE os =  $operating_system ";

        //check end

        $insert_post_query = "INSERT INTO prebuilt (
                                prebuilt_name,
                                img,
                                description,
                                os,
                                cpu,
                                gpu,
                                ram,
                                primary_storage,
                                secondary_storage,
                                motherboard,
                                desktop_case,
                                power_supply,
                                default_price,
                                price,
                                free_shipping,
                                status,
                                stock
                                ) VALUES (
                                '$prebuilt_name',
                                '$img_name',
                                '$description',
                                '$operating_system',
                                '$cpu',
                                '$gpu',
                                '$ram',
                                '$primary_storage',
                                '$secondary_storage',
                                '$motherboard',
                                '$desktop_case',
                                '$power_supply',
                                '$default_price',                                  
                                '$price',
                                '$free_shipping',
                                '$status',
                                '$stock'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-prebuilt-success'] = "New prebuilt: $prebuilt_name successfully added.";
            header('location: ' . ROOT_URL . 'admin/manage_prebuilt.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-prebuilt'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_prebuilt.php?config=intel');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_prebuilt.php?config=intel');
    die();
}
