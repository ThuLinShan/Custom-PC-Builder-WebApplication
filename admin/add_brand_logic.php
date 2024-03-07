<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $brand_name    = filter_var($_POST['brand_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description   = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $link          = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img           = $_FILES['img'];
    $products_arr      = $_POST['products'];


    if (!$brand_name) {
        $_SESSION['add-brand'] = "Please enter a brand_name";
    } elseif (!$description) {
        $_SESSION['add-brand'] = "Please enter brand description";
    } elseif (!$link) {
        $_SESSION['add-brand'] = "Please enter official link for the brand";
    } elseif (!$products_arr) {
        $_SESSION['add-brand'] = "Please select the product types of the brand";
    } elseif (!$img['name']) {
        $_SESSION['add-brand'] = "Please add an img";
    } else {
        $time = time();
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
                $_SESSION['add-brand'] = "img is too large";
            }
        } else {
            $_SESSION['add-brand'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-brand'])) {
        $_SESSION['add-brand-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_brand.php');
        die();
    } else {

        $products = '';
        foreach ($products_arr as $product) {
            $products = $products . ' ' . $product;
        }

        $insert_post_query = "INSERT INTO brand (
                                brand_name,
                                description,
                                products,
                                img,
                                link
                                ) VALUES (
                                '$brand_name',
                                '$description',
                                '$products',
                                '$img_name',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-brand-success'] = "New Brand: $brand_name successfully added";
            header('location: ' . ROOT_URL . 'admin/index.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-brand-data'] = $_POST;
            $_SESSION['add-brand'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_brand.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_brand.php');
    die();
}
