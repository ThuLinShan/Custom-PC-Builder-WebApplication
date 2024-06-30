<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == false) {
    $user_id = $_SESSION['user-id'];
    $product_id = $_GET['product_id'];
    $category = $_GET['category'];
    $count = $_GET['count'];
    $price = $_GET['price'];

    if (isset($_POST['price'])) {
        $price = $_POST['price'];
    }
    if (isset($_POST['count'])) {
        $count = $_POST['count'];
    }
    if (isset($_POST['category'])) {
        $category = $_POST['category'];
    }

    if (!isset($user_id)) {
        header('location: ' . ROOT_URL . 'signin.php');
    }
    if (!isset($category) || !isset($count) || !isset($price)) {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header('Location: ' . ROOT_URL);
            exit;
        }
    }
    if (!isset($product_id)) {
        if ($category == 'custom_order') {

            function generateRandomString($length = 12)
            {
                return substr(bin2hex(random_bytes($length)), 0, $length);
            }

            $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
            $name = generateRandomString();
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

            $insert_query = "INSERT INTO custom_order (
            os,
            name,
            cpu,
            gpu,
            ram,
            primary_storage,
            secondary_storage,
            motherboard,
            desktop_case,
            power_supply,
            price
            ) VALUES (
            '$operating_system',
            '$name',
            '$cpu',
            '$gpu',
            '$ram',
            '$primary_storage',
            '$secondary_storage',
            '$motherboard',
            '$desktop_case',
            '$power_supply',                                  
            '$price'
            )";
            if ($connection->query($insert_query) === TRUE) {
                // Get the ID of the last inserted row
                $product_id = $connection->insert_id;
            }
        } else {
            if (isset($_SERVER['HTTP_REFERER'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                header('Location: ' . ROOT_URL);
                exit;
            }
        }
    }

    $insert_query = "INSERT INTO cart (
        userid,
        product_id,
        product_type,
        count,
        price
        ) VALUES (
        '$user_id',
        '$product_id',
        '$category',
        '$count',
        '$price'
        )";
    $insert_result = mysqli_query($connection, $insert_query);

    $insert_query = "INSERT INTO notification (
    userid,
    header,
    description,
    link
    ) VALUES (
    '$user_id',
    'Added to Cart',
    'New item has be added to cart successfully',
    'authenticated/cart.php'
    )";
    $insert_result = mysqli_query($connection, $insert_query);

    if (!mysqli_errno($connection)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
} else {
    header('location: ' . ROOT_URL);
    die();
}
