<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $laptop_name   = filter_var($_POST['laptop_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_NUMBER_INT);
    $img                = $_FILES['img'];
    $category = filter_var($_POST['category'], FILTER_SANITIZE_SPECIAL_CHARS);
    $os = filter_var($_POST['os'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpu = filter_var($_POST['cpu'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gpu = filter_var($_POST['gpu'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ram = filter_var($_POST['ram'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $primary_storage = filter_var($_POST['primary_storage'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $secondary_storage = filter_var($_POST['secondary_storage'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $io_ports = filter_var($_POST['io_ports'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $internet = filter_var($_POST['internet'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $display = filter_var($_POST['display'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $battery = filter_var($_POST['battery'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dimensions = filter_var($_POST['dimensions'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bonus = filter_var($_POST['bonus'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $free_shipping = filter_var($_POST['free_shipping'], FILTER_SANITIZE_NUMBER_INT);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //set free shipping 1 if checked
    $free_shipping = $free_shipping == 1 ?: 0;

    if (!$laptop_name) {
        $_SESSION['add-laptop'] = "Please enter a laptop_name";
    } elseif (!$brand) {
        $_SESSION['add-laptop'] = "Please select the brand for the laptop";
    } elseif (!$os) {
        $_SESSION['add-laptop'] = "Please enter the operating system for the laptop";
    } elseif (!$cpu) {
        $_SESSION['add-laptop'] = "Please enter the cpu of the laptop";
    } elseif (!$gpu) {
        $_SESSION['add-laptop'] = "Please enter the gpu of the laptop";
    } elseif (!$ram) {
        $_SESSION['add-laptop'] = "Please enter the total number of physical ram in the laptop";
    } elseif (!$primary_storage) {
        $_SESSION['add-laptop'] = "Please enter the total primary storage in the laptop";
    } elseif (!$io_ports) {
        $_SESSION['add-laptop'] = "Please enter the I/O ports of the laptop";
    } elseif (!$internet) {
        $_SESSION['add-laptop'] = "Please enter the internet of the laptop";
    } elseif (!$display) {
        $_SESSION['add-laptop'] = "Please enter the display of the laptop";
    } elseif (!$battery) {
        $_SESSION['add-laptop'] = "Please enter the battery of the laptop in Watt";
    } elseif (!$dimensions) {
        $_SESSION['add-laptop'] = "Please enter the dimensions of the laptop";
    } elseif (!$stock) {
        $_SESSION['add-laptop'] = "Please enter the stock of the laptop";
    } elseif (!$description) {
        $_SESSION['add-laptop'] = "Please enter the descrp$description of the laptop";
    } elseif (!$price) {
        $_SESSION['add-laptop'] = "Please enter the price of the laptop";
    } elseif (!$link) {
        $_SESSION['add-laptop'] = "Please enter the official link of the laptop";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/laptop/' . $img_name;

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
                $_SESSION['add-laptop'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-laptop'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-laptop'])) {
        $_SESSION['add-laptop-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_laptop.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO laptop (
                                laptop_name,
                                img,
                                brand,
                                description,
                                category,
                                os,
                                cpu,
                                gpu,
                                ram,
                                primary_storage,
                                secondary_storage,
                                io_ports,
                                internet,
                                display,
                                battery,
                                dimensions,
                                bonus,
                                stock,
                                free_shipping,
                                price,
                                link
                                ) VALUES (
                                '$laptop_name',
                                '$img_name',
                                '$brand',
                                '$description',
                                '$category',
                                '$os',
                                '$cpu',
                                '$gpu',
                                '$ram',
                                '$primary_storage',
                                '$secondary_storage',
                                '$io_ports',
                                '$internet',
                                '$display',
                                '$battery',
                                '$dimensions',
                                '$bonus',
                                '$stock',
                                '$free_shipping',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-laptop-success'] = "New laptop: $laptop_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_laptop.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-laptop-data'] = $_POST;
            $_SESSION['add-laptop'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_laptop.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_laptop.php');
    die();
}
