<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/operating_system/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
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
                    $_SESSION['edit-operating_system'] = "img is too large";
                }
            } else {
                $_SESSION['edit-operating_system'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-operating_system'])) {
        header('location: ' . ROOT_URL . 'admin/edit_operating_system.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE operating_system SET 
                    operating_system_name='$operating_system_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    description='$description',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-operating_system-success'] = "operating_system: $operating_system_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_operating_system.php');
            die();
        } else {
            $_SESSION['edit-operating_system'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
