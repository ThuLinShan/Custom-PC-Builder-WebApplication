<?php
require 'config/database.php';
$previousPage = $_SERVER['HTTP_REFERER'];

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $id                         = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $status                     = filter_var($_POST['status'], FILTER_SANITIZE_SPECIAL_CHARS);
    $note                       = filter_var($_POST['note'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (!isset($note)) {
        $note = '';
    }

    $insert_post_query = "UPDATE user_order SET 
                                status = '$status',
                                note = '$note'
                                WHERE
                                id = $id
                                ";
    $insert_post_result = mysqli_query($connection, $insert_post_query);

    if (!mysqli_errno($connection)) {
        // Redirect to manage posts page
        $_SESSION['message-order'] = "Order Status Updated";
        header("Location: $previousPage");
        die();
    } else {
        // Return form data back to edit post page
        $_SESSION['message-order'] = $_POST;
        $_SESSION['message-order'] = "Something went wrong";
        header("Location: $previousPage");
        die();
    }
} else {
    header("Location: $previousPage");
    die();
}
