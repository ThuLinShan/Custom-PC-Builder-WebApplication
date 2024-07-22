<?php
include './partials/header.php';

$query =    "UPDATE notification SET 
             status = 1
             WHERE header = 'Order submitted' ";

$result = mysqli_query($connection, $query);

$query = "SELECT * from user_order WHERE userid=$id";
$orders = mysqli_query($connection, $query);

?>
<!-- main start here -->
<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Orders</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">My Orders</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container p-3 my-5 text-center shadow">

        <div class="row pb-1 bg-dark text-white mb-1">
            <div class="col-2 border-end border-white border-2">
                Status
            </div>
            <div class="col border-end border-white border-2">
                Details
            </div>
            <div class="col-2 border-white border-2">
                Total
            </div>
        </div>
        <?php while ($order = mysqli_fetch_assoc($orders)) : ?>
            <div class="row mb-2 border-bottom border-dark">
                <?php
                switch ($order['status']) {
                    case 'ORDERED':
                        $statusClass = 'bg-info text-white';
                        break;
                    case 'DELIVERED':
                        $statusClass = 'bg-success text-white';
                        break;
                    case 'REJECTED':
                        $statusClass = 'bg-danger text-white';
                        break;
                    default:
                        $statusClass = 'bg-secondary-subtle text-dark';
                        break;
                }
                ?>


                <div class="col-2 d-flex flex-column justify-content-center">
                    <p class="text-center rounded <?= $statusClass ?>">
                        <?= $order['status'] ?>
                    </p>
                    <?php if (isset($order['note']) && $order['note'] != '') : ?>
                        <p class="text-secondary small">
                            Note: <?= $order['note'] ?>
                        </p>
                    <?php endif ?>
                </div>

                <div class="col">
                    <?php
                    $order_id = $order['id'];
                    $query = "SELECT * from order_cart WHERE order_id=$order_id";
                    $carts = mysqli_query($connection, $query);
                    ?>
                    <?php while ($cart = mysqli_fetch_assoc($carts)) : ?>
                        <!-- total price for order calculation -->
                        <?php
                        $total_price = 0;
                        $cart_id = $cart['cart_id'];
                        $query = "SELECT * FROM cart WHERE id=$cart_id";
                        $cart_result = mysqli_query($connection, $query);
                        $cart_item = mysqli_fetch_assoc($cart_result);
                        ?>

                        <?php
                        $query = "SELECT * FROM " . $cart_item['product_type'] . " WHERE id=" . $cart_item['product_id'] . ";";
                        $cart_product_result = mysqli_query($connection, $query);
                        $order_item = mysqli_fetch_assoc($cart_product_result);
                        $index = $cart_item['product_type'] . "_name";
                        $total_price = $total_price + $order_item['price'];
                        ?>
                        <div class="row p-2">
                            <div class="col">
                                <p><span class="text-uppercase text-info"><?= $cart_item['product_type'] ?></span> <?= $order_item[$index] ?></p>
                            </div>
                            <div class="col-md-3">£<?= $order_item['price'] ?></div>
                        </div>

                        <?php
                        $query = "SELECT * FROM cart WHERE userid=$id and bought=0";
                        $cart_assocs = mysqli_query($connection, $query);
                        ?>

                    <?php endwhile ?>
                </div>
                <div class="col-2 d-flex flex-column justify-content-center align-items-center bg-secondary-subtle py-3">
                    <p>£ <?= $order['final_price'] ?></p>
                    <small>Tax included</small>
                </div>
            </div>
        <?php endwhile ?>

    </div>
</main>
<!-- main end here -->

<?php
include '../partials/footer.php';
?>