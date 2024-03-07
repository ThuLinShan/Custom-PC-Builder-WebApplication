<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $desktop_case_name   = filter_var($_POST['desktop_case_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $type = filter_var($_POST['type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $color = filter_var($_POST['color'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cooling = filter_var($_POST['cooling'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dimensions = filter_var($_POST['dimensions'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $io_panel = filter_var($_POST['io_panel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $radiator_support = filter_var($_POST['radiator_support'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$desktop_case_name) {
        $_SESSION['add-desktop_case'] = "Please enter a desktop_case_name";
    } elseif (!$brand) {
        $_SESSION['add-desktop_case'] = "Please select the brand for the desktop_case";
    } elseif (!$color) {
        $_SESSION['add-desktop_case'] = "Please enter the color for the desktop_case";
    } elseif (!$cooling) {
        $_SESSION['add-desktop_case'] = "Please enter the supported liquid cooling system for the desktop_case";
    } elseif (!$dimensions) {
        $_SESSION['add-desktop_case'] = "Please enter the dimensions of the desktop_case";
    } elseif (!$io_panel) {
        $_SESSION['add-desktop_case'] = "Please enter the IO panels of the desktop_case";
    } elseif (!$radiator_support) {
        $_SESSION['add-desktop_case'] = "Please enter the supported radiator for the desktop_case";
    } elseif (!$link) {
        $_SESSION['add-desktop_case'] = "Please enter the official link for the desktop_case";
    } elseif (!$price) {
        $_SESSION['add-desktop_case'] = "Please enter the price for the desktop_case";
    } else {
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/desktop_case/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/products/desktop_case/' . $img_name;

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
                    $_SESSION['edit-desktop_case'] = "img is too large";
                }
            } else {
                $_SESSION['edit-desktop_case'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-desktop_case'])) {
        header('location: ' . ROOT_URL . 'admin/edit_desktop_case.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE desktop_case SET 
                    desktop_case_name='$desktop_case_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    type='$type',
                    color='$color',
                    cooling='$cooling',
                    dimensions='$dimensions',
                    io_panel = '$io_panel',
                    radiator_support = '$radiator_support',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-desktop_case-success'] = "desktop_case: $desktop_case_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_desktop_case.php');
            die();
        } else {
            $_SESSION['edit-desktop_case'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
