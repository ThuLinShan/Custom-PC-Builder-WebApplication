<?php
include '../partials/header.php';

if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
if (!isset($_GET['size'])) {
    $_GET['size'] = 5;
}
$page = $_GET['page'];
$size = $_GET['size'];
$skip = ($page - 1) * $size;

// Fetch prebuilts
$query = "SELECT * FROM laptop ORDER BY date LIMIT $skip,$size";
$laptops = mysqli_query($connection, $query);

//count and total pages
$count = 0;
$total = 0;
$query = "SELECT COUNT(*) AS count FROM laptop";
$result = mysqli_query($connection, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
    $total_pages = ceil($count / $size);
}

?>
<!-- main start here -->
<main>
    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Laptop Computers</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Laptop Computers</li>
            </ol>
        </nav>
    </div>

    <div class="container my-5">
        <h2 class="text-center">
            Products Browse
        </h2>
        <div class="row mb-5">
            <img src="https://placehold.co/1000x300" class="img-fluid" alt="">
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="text-danger">Total results: <span><?= $count ?></span></p>
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
        <div class="row">

            <?php while ($laptop = mysqli_fetch_assoc($laptops)) : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3 py-4 rounded">
                    <div class="card mx-auto" style="width: 18rem;">
                        <h5 class="card-title py-3 text-center bg-warning-subtle"><?= substr($laptop['laptop_name'], 0, 20) ?></h5>
                        <img src="<?= ROOT_URL . "assets/images/products/laptop/" . $laptop['img'] ?>" class="card-img-top" alt="..." style="height: 200px;">
                        <div class="card-body bg-secondary-subtle">
                            <p class="card-text d-flex justify-content-between">
                                Price: $<?= $laptop['price'] ?>
                                <?php if ($laptop['free_shipping'] == 1) : ?>
                                    <span class="px-1 rounded bg-white">Free Shipping</span>
                                <?php endif; ?>

                            </p>
                        </div>
                        <ul class="list-group border-0 list-group-flush">
                            <li class="list-group-item small py-1 border-0"><span class="fw-bold">OS:</span> <?= substr($laptop['os'], 0, 25) ?>...</li>
                            <li class="list-group-item small py-1 border-0"><span class="fw-bold">CPU:</span><?= substr($laptop['cpu'], 0, 25) ?>...</li>
                            <li class="list-group-item small py-1 border-0"><span class="fw-bold">GPU:</span><?= substr($laptop['gpu'], 0, 25) ?>...</li>
                            <li class="list-group-item small py-1 border-0"><span class="fw-bold">RAM:</span> <?= substr($laptop['ram'], 0, 25) ?>...</li>
                        </ul>
                        <div class="card-body">
                            <a href="<?= ROOT_URL . "details/laptop_details.php?id=" . $laptop['id'] ?>" class="btn rounded-5 btn-outline-info ">Details</a>
                            <a href="#" class="btn rounded-5 btn-secondary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>

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
<!-- main end here -->

<?php
include '../partials/footer.php';
?>