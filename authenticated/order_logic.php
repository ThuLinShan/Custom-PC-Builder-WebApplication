<?php
require 'config/database.php';

if (isset($_GET['userid'])) {

    $userid = $_GET['userid'];

    if (isset($_SESSION['user-id']) && $_SESSION['user-id'] == $userid) {

        $query = "SELECT * from cart where userid=$userid AND bought = 0";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            // Calculate the final price from the cart items
            $final_price = 0;
            while ($row = $result->fetch_assoc()) {
                $final_price += $row['price']; // Adjust this to your actual column name for price
            }
            echo $final_price;

            // Reset result pointer and fetch data again
            $result->data_seek(0);
            // Start a transaction

            $connection->begin_transaction();

            try {
                // Insert into user_order table
                $user_order_query = "INSERT INTO user_order (final_price, userid) VALUES ($final_price, $userid)";
                $connection->query($user_order_query);

                // Get the inserted order_id
                $order_id = $connection->insert_id;

                // Loop through the result set and insert into order_cart table
                while ($row = $result->fetch_assoc()) {
                    $cart_id = $row['id'];
                    $order_cart_query = "INSERT INTO order_cart (cart_id, order_id) VALUES ($cart_id, $order_id)";
                    $connection->query($order_cart_query);

                    // Update the 'bought' status of the cart row
                    $update_cart_query = "UPDATE cart SET bought = 1 WHERE id = $cart_id";
                    $connection->query($update_cart_query);
                }


                $insert_query = "INSERT INTO notification (
                    userid,
                    header,
                    description,
                    link
                    ) VALUES (
                    '$userid',
                    'Order submitted',
                    'Your order has been submitted successfully.',
                    'authenticated/orders.php'
                    )";
                $insert_result = mysqli_query($connection, $insert_query);

                // Commit the transaction
                $connection->commit();
            } catch (Exception $e) {
                // Rollback the transaction in case of error
                $connection->rollback();
                echo "Failed to insert data: " . $e->getMessage();
            }
        }
    }
}

header('location: ' . ROOT_URL . 'authenticated/cart.php');
die();
