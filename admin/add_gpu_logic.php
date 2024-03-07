<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $gpu_name   = filter_var($_POST['gpu_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $memory_type = filter_var($_POST['memory_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vram = filter_var($_POST['vram'], FILTER_SANITIZE_NUMBER_INT);
    $power = filter_var($_POST['power'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$gpu_name) {
        $_SESSION['add-gpu'] = "Please enter a gpu_name";
    } elseif (!$brand) {
        $_SESSION['add-gpu'] = "Please select the brand for the gpu";
    } elseif (!$memory_type) {
        $_SESSION['add-gpu'] = "Please enter the memory_type of the gpu";
    } elseif (!$vram) {
        $_SESSION['add-gpu'] = "Please enter the vram of the gpu";
    } elseif (!$power) {
        $_SESSION['add-gpu'] = "Please enter the power consumption of the gpu in Watt";
    } elseif (!$price) {
        $_SESSION['add-gpu'] = "Please enter the price of the gpu";
    } elseif (!$link) {
        $_SESSION['add-gpu'] = "Please enter the official link of the gpu";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/gpu/' . $img_name;

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
                $_SESSION['add-gpu'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-gpu'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-gpu'])) {
        $_SESSION['add-gpu-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_gpu.php');
        die();
    } else {


        $insert_post_query = "INSERT INTO gpu (
                                gpu_name,
                                img,
                                brand,
                                memory_type,
                                vram,
                                power,
                                price,
                                link
                                ) VALUES (
                                '$gpu_name',
                                '$img_name',
                                '$brand',
                                '$memory_type',
                                '$vram',
                                '$power',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-gpu-success'] = "New GPU: $gpu_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_gpu.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-gpu-data'] = $_POST;
            $_SESSION['add-gpu'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_gpu.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_gpu.php');
    die();
}
