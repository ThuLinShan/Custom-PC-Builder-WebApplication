<?php
include './partials/header.php';

$query =    "UPDATE notification SET 
             status = 1
             WHERE header = 'Added to Cart' ";

$result = mysqli_query($connection, $query);

?>
<!-- main start here -->
<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">My Shopping Cart</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">My Cart</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-3 my-5 text-center">
        <!-- total price for cart calculation -->
        <?php
        $total_price = 0;
        ?>

        <?php if (isset($_SESSION['delete-cart'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-cart'];
                    unset($_SESSION['delete-cart']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-cart-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-cart-success'];
                    unset($_SESSION['delete-cart-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <div class="row p-3 mb-2 shadow-sm rounded fw-bold">
            <div class="col">
                Item Name
            </div>
            <div class="col-md-1">
                Qty
            </div>
            <div class="col-md-3">Price</div>
            <div class="col-md-2">
                Remove
            </div>
        </div>
        <?php while ($cart_assoc = mysqli_fetch_assoc($cart_assocs)) : ?>
            <?php
            $query = "SELECT * FROM " . $cart_assoc['product_type'] . " WHERE id=" . $cart_assoc['product_id'] . ";";
            $result = mysqli_query($connection, $query);
            $cart_item = mysqli_fetch_assoc($result);
            $index = $cart_assoc['product_type'] . "_name";
            $total_price = $total_price + $cart_item['price'];
            ?>
            <div class="row p-3 mb-2 shadow-sm rounded">
                <div class="col">
                    <h5><span class="text-uppercase text-info"><?= $cart_assoc['product_type'] ?></span> <?= $cart_item[$index] ?></h5>
                    <p class="text-secondary"><?= $cart_assoc['date'] ?></p>
                </div>
                <div class="col-md-1">
                    <?= $cart_assoc['count'] ?>
                </div>
                <div class="col-md-3">£<?= $cart_item['price'] ?></div>
                <div class="col-md-2">
                    <a class="btn btn-danger" href="<?= ROOT_URL ?>authenticated/remove_from_cart_logic.php?id=<?= $cart_assoc['id'] ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
            </div>
        <?php endwhile ?>

        <?php
        $query = "SELECT * FROM cart WHERE userid=$id and bought=0";
        $cart_assocs = mysqli_query($connection, $query);

        $tax = $total_price * 0.005;
        $total_price = $total_price + $tax;
        ?>

        <div class="row bg-dark p-3 mb-2 shadow-sm rounded">
            <div class="col text-center">
                <h5 class="text-white">Total Price: <span class="text-info"> £<?= $total_price ?> </span> .</h5>
            </div>
            <div class="col text-center">
                <span class="text-secondary">(0.5% tax rate included)</span>
            </div>
        </div>

        <?php if (mysqli_num_rows($cart_assocs) > 0) : ?>
            <div class="my-2">
                <a href="<?= ROOT_URL ?>authenticated/order_logic.php?userid=<?= $_SESSION['user-id'] ?>" class="btn btn-primary text-decoration-underline shadow border-1 px-5">Order Now</a>
            </div>
        <?php endif ?>


    </div>
</main>
<!-- main end here -->

<?php
include '../partials/footer.php';
?>