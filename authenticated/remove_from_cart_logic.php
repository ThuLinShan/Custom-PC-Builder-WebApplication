<?php
require 'config/database.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Fetch cart
    $query = "SELECT * FROM cart WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $cart = mysqli_fetch_assoc($result);

    if (isset($_SESSION['user-id']) && $_SESSION['user-id'] == $cart['userid']) {

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // Delete cart from database
        $delete_cart_query = "DELETE FROM cart WHERE id=$id";
        $delete_cart_result = mysqli_query($connection, $delete_cart_query);

        if (mysqli_errno($connection)) {
            $_SESSION['delete-cart'] = "Could not remove item from cart";
        } else {
            $_SESSION['delete-cart-success'] = "Cart: Item removed from cart succesfully";
        }
    }
}

header('location: ' . ROOT_URL . 'authenticated/cart.php');
die();
