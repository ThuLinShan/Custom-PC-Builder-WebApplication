<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $prebuilt_name   = filter_var($_POST['prebuilt_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $generation = filter_var($_POST['generation'], FILTER_SANITIZE_NUMBER_INT);
    $frequency = filter_var($_POST['frequency'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cores = filter_var($_POST['cores'], FILTER_SANITIZE_NUMBER_INT);
    $threads = filter_var($_POST['threads'], FILTER_SANITIZE_NUMBER_INT);
    $power = filter_var($_POST['power'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$prebuilt_name) {
        $_SESSION['add-prebuilt'] = "Please enter a prebuilt_name";
    } elseif (!$brand) {
        $_SESSION['add-prebuilt'] = "Please select the brand for the prebuilt";
    } elseif (!$description) {
        $_SESSION['add-prebuilt'] = "Please enter the description of the prebuilt";
    } elseif (!$generation) {
        $_SESSION['add-prebuilt'] = "Please enter the generation of the prebuilt";
    } elseif (!$frequency) {
        $_SESSION['add-prebuilt'] = "Please enter the frequency of the prebuilt";
    } elseif (!$cores) {
        $_SESSION['add-prebuilt'] = "Please enter the total number of physical cores in the prebuilt";
    } elseif (!$threads) {
        $_SESSION['add-prebuilt'] = "Please enter the total number of virtual threads in the prebuilt";
    } elseif (!$power) {
        $_SESSION['add-prebuilt'] = "Please enter the power consumption of the prebuilt in Watt";
    } elseif (!$price) {
        $_SESSION['add-prebuilt'] = "Please enter the price of the prebuilt";
    } elseif (!$link) {
        $_SESSION['add-prebuilt'] = "Please enter the official link of the prebuilt";
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
                $_SESSION['add-prebuilt'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-prebuilt'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-prebuilt'])) {
        $_SESSION['add-prebuilt-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_prebuilt.php?config=intel');
        die();
    } else {

        $insert_post_query = "INSERT INTO prebuilt (
                                prebuilt_name,
                                img,
                                brand,
                                description,
                                generation,
                                frequency,
                                cores,
                                threads,
                                power,
                                price,
                                link
                                ) VALUES (
                                '$prebuilt_name',
                                '$img_name',
                                '$brand',
                                '$description',
                                '$generation',
                                '$frequency',
                                '$cores',
                                '$threads',
                                '$power',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-prebuilt-success'] = "New prebuilt: $prebuilt_name successfully added";
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
