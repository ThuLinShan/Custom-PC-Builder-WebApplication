<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                         = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name    = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand_name                      = filter_var($_POST['brand_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description                       = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $link                = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                  = $_FILES['img'];
    $products_arr      = $_POST['products'];


    if (!$brand_name) {
        $_SESSION['edit-brand'] = "Please enter a brand_name";
    } elseif (!$link) {
        $_SESSION['edit-brand'] = "Please enter official link of the brand";
    } elseif (!$description) {
        $_SESSION['edit-brand'] = "Please enter the description";
    } elseif (!$products_arr) {
        $_SESSION['edit-brand'] = "Please select the product types of the brand";
    } else {
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/brands/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/brands/' . $img_name;

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
                    $_SESSION['edit-brand'] = "img is too large";
                }
            } else {
                $_SESSION['edit-brand'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-brand'])) {
        header('location: ' . ROOT_URL . 'admin/edit_brand.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $products = '';
        foreach ($products_arr as $product) {
            $products = $products . ' ' . $product;
        }

        $query =    "UPDATE brand SET 
                    brand_name='$brand_name', 
                    description='$description', 
                    img='$img_to_insert', 
                    products = '$products',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-brand-success'] = "Brand: $brand_name successfully updated";
            header('location: ' . ROOT_URL . 'admin');
            die();
        } else {
            $_SESSION['edit-brand'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
