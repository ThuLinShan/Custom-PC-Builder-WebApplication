<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/gpu/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
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
                    $_SESSION['edit-gpu'] = "img is too large";
                }
            } else {
                $_SESSION['edit-gpu'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-gpu'])) {
        header('location: ' . ROOT_URL . 'admin/edit_gpu.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE gpu SET 
                    gpu_name='$gpu_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    memory_type='$memory_type',
                    vram='$vram',
                    power='$power',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-gpu-success'] = "GPU: $gpu_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_gpu.php');
            die();
        } else {
            $_SESSION['edit-gpu'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
