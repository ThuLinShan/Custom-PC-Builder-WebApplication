<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $id                         = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name    = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $header    = filter_var($_POST['header'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description   = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_featured    = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $author = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $img           = $_FILES['img'];


    //Set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;


    if (!$header) {
        $_SESSION['edit-blog'] = "Please enter a header";
    } elseif (!$description) {
        $_SESSION['edit-blog'] = "Please enter blog description";
    } else {
        if ($img['name']) {
            $previous_img_name = '../assets/images/blogs/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/blogs/' . $img_name;

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

    if (isset($_SESSION['edit-blog'])) {
        header('location: ' . ROOT_URL . 'admin/edit_blog.php');
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        if ($is_featured == 1) {
            $update_post_query = "UPDATE blog SET is_featured = 0 WHERE is_featured = 1";
            $update_post_result = mysqli_query($connection, $update_post_query);
        }

        $insert_post_query = "UPDATE blog SET 
                                header = '$header',
                                description = '$description',
                                img = '$img_to_insert',
                                is_featured = '$is_featured'
                                
                                WHERE
                                id = $id
                                ";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['edit-blog-success'] = "New blog: $header successfully edited";
            header('location: ' . ROOT_URL . 'admin/index.php');
            die();
        } else {
            // Return form data back to edit post page
            $_SESSION['edit-blog-data'] = $_POST;
            $_SESSION['edit-blog'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/edit_blog.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin.php');
    die();
}
