<?php
include './partials/header.php';

if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
if (!isset($_GET['size'])) {
    $_GET['size'] = 8;
}
$page = $_GET['page'];
$size = $_GET['size'];
$skip = ($page - 1) * $size;

// Fetch orders
$query = "SELECT * FROM user_order ORDER BY date LIMIT $skip,$size";
$orders = mysqli_query($connection, $query);

//count and total pages
$count = 0;
$total = 0;
$query = "SELECT COUNT(*) AS count FROM user_order";
$result = mysqli_query($connection, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
    $total_pages = ceil($count / $size);
}

?>

<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Manage Order</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>admin" class="text-warning">Admin</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Manage Order</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row p-4 rounded">
            <div class="col-md-6 ">
                <h3>Orders</h3>
                <p class="text-danger">Total Orders: <span><?= $count ?></span></p>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="page_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Items per page
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="page_dropdown">
                            <li><a class="dropdown-item <?php if ($size == 4) echo 'active'; ?>" href="?page=<?= $page ?>&size=4">4</a></li>
                            <li><a class="dropdown-item <?php if ($size == 8) echo 'active'; ?>" href="?page=<?= $page ?>&size=8">8</a></li>
                            <li><a class="dropdown-item <?php if ($size == 10) echo 'active'; ?>" href="?page=<?= $page ?>&size=10">10</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- alet message -->
        <?php if (isset($_SESSION['message-order'])) : ?>
            <div class="bg-warning border rounded d-flex justify-content-center align-items-center text-white p-3 mb-2">
                <p class="m-0 text-dark">
                    <?= $_SESSION['message-order'];
                    unset($_SESSION['message-order']); ?>
                </p>
            </div>
        <?php endif ?>
        <?php if (mysqli_num_rows($orders) > 0) : ?>

            <div class="row pb-1 bg-dark text-white mb-1">
                <div class="col-2 border-end border-white border-2">
                    Manage
                </div>
                <div class="col border-end border-white border-2">
                    Details
                </div>
                <div class="col text-center border-end border-white border-2">
                    Customer
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
                        <form action="<?= ROOT_URL ?>admin/manage_order_logic.php" class="form-control" method="post">
                            <input type="number" name="id" hidden value="<?= $order['id'] ?>">
                            <select name="status" class="form-select <?= $statusClass ?>">
                                <option class="bg-white text-dark" value="ORDERED" <?= $order['status'] == 'ORDERED' ? 'selected' : '' ?>>ORDERED</option>
                                <option class="bg-white text-dark" value="DELIVERED" <?= $order['status'] == 'DELIVERED' ? 'selected' : '' ?>>DELIVERED</option>
                                <option class="bg-white text-dark" value="REJECTED" <?= $order['status'] == 'REJECTED' ? 'selected' : '' ?>>REJECTED</option>
                            </select>
                            <textarea class="form-control mt-2" name="note" id="" placeholder="Note (no more than 256 characters)"></textarea>
                            <button class="btn btn-sm btn-secondary form-control mt-2" type="submit" name="submit">Update Order</button>
                        </form>
                    </div>

                    <div class="col border-end">
                        <?php
                        $order_id = $order['id'];
                        $query = "SELECT * from order_cart WHERE order_id=$order_id";
                        $carts = mysqli_query($connection, $query);
                        ?>
                        <div class="row bg-secondary-subtle">
                            <div class="col">
                                <p class="m-0 p-0">Product Name</p>
                            </div>
                            <div class="col-md-3">
                                <p class="m-0 p-0">Price</p>
                            </div>
                        </div>
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
                    <div class="col d-flex flex-column align-items-center text-center">
                        <?php
                        $user_id = $order['userid'];
                        $query = "SELECT * from users WHERE id=$user_id LIMIT 1";
                        $result = mysqli_query($connection, $query);
                        $user = mysqli_fetch_assoc($result);
                        ?>
                        <div class="my-auto">
                            <p class="fw-bold m-0 p-0"><?= $user['username'] ?></p>
                            <p class="text-secondary"><?= $user['email'] ?></p>
                        </div>
                        <p class="mt-auto badge bg-primary bg-opacity-75">Ordered At: <?= $order['date'] ?></p>
                    </div>
                    <div class="col-2 d-flex flex-column justify-content-center align-items-center bg-secondary-subtle py-3">
                        <p>£ <?= $order['final_price'] ?></p>
                        <small class="text-secondary">Tax included</small>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="alert__message error d-flex justify-content-center align-items-center py-5 my-5">
                <h4> "No orders found" </h4>
            </div>
        <?php endif ?>

        <!-- Pagination -->
        <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Previous button -->
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page > 1) echo '?page=' . ($page - 1) . '&size=' . $size;
                                                    else echo '#'; ?>" aria-label="Previous">
                            <span aria-hidden="true">&#11164;</span>
                        </a>
                    </li>

                    <!-- First page -->
                    <?php if ($page > 3) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=1&size=<?= $size; ?>">1</a>
                        </li>
                        <?php if ($page > 4) : ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Current page and nearby pages -->
                    <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++) : ?>
                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>&size=<?= $size; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Last page -->
                    <?php if ($page < $total_pages - 2) : ?>
                        <?php if ($page < $total_pages - 3) : ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $total_pages; ?>&size=<?= $size; ?>"><?= $total_pages; ?></a>
                        </li>
                    <?php endif; ?>

                    <!-- Next button -->
                    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page < $total_pages) echo '?page=' . ($page + 1) . '&size=' . $size;
                                                    else echo '#'; ?>" aria-label="Next">
                            <span aria-hidden="true">&#11166;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</main>


<?php
include './partials/footer.php';
?>