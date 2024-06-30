<?php
include './partials/header.php';


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


$query = "SELECT * FROM blog ORDER BY date";
$blogs =  mysqli_query($connection, $query);

$query = "SELECT * FROM blog WHERE is_featured = 1 LIMIT 1";
$result =  mysqli_query($connection, $query);
$featured = mysqli_fetch_assoc($result);
if (isset($featured)) {
    $featured_description = htmlspecialchars_decode($featured['description'], ENT_QUOTES);
}


$query = "SELECT COUNT(*) AS count FROM blog";
$result = mysqli_query($connection, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
    $total_pages = ceil($count / $size);
}
?>
<main class="bg-white">

    <div class="row h-25 text-center d-flex flex-column justify-content-center py-4 mx-0" style="background-color: #2c2f31;">
        <h1 class="text-white-50 text-lg my-3">Blogs</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Blogs</li>
            </ol>
        </nav>
    </div>

    <div class="container my-5">

        <div class="row w-100">

            <?php if (isset($featured)) : ?>
                <?php
                //author
                $featured_author_id = $featured['author'];
                $query = "SELECT * FROM users WHERE id=$featured_author_id";
                $result = mysqli_query($connection, $query);
                $featured_author = mysqli_fetch_assoc($result);
                ?>
                <h3 class="text-secondary mx-3">Featured Post</h3>
                <div class="row mb-4 pb-5 mx-auto">
                    <div class="col-md-6 col-sm-12">
                        <a href="./blog.php"><img src="<?= ROOT_URL . '/assets/images/blogs/' . $featured['img'] ?>" alt="" class="img-fluid"></a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div>
                            <h5 class="card-title"> <?= $featured['header'] ?></h5>
                            <div>
                                <div class="d-flex align-items-center my-2">
                                    <p class="text-secondary mb-0 me-3">By <?= $featured_author['username'] ?> | </p>
                                    <img src="<?= ROOT_URL . '/assets/images/avatars/' . $featured_author['avatar'] ?>" style="border-radius: 50%; padding:2px; overflow:hidden;object-fit: cover;" alt="" width="40px" height="40px">
                                </div>

                                <?= date("M d, Y - h:i a", strtotime($featured['date'])) ?>
                            </div>
                        </div>
                        <p><?= substr($featured_description, 0, 500) ?>...</p>
                        <a href="./details/blog_details.php?id=<?= $featured['id'] ?>" class="btn btn-info shadow border border-white text-white mb-2">Read More
                            <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            <?php endif ?>
            <div class="d-flex justify-content-between align-items-center mb-2">
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
            <?php while ($blog = mysqli_fetch_assoc($blogs)) : ?>
                <?php
                $author_id = $blog['author'];
                $query = "SELECT * FROM users WHERE id=$author_id";
                $result =  mysqli_query($connection, $query);
                $author = mysqli_fetch_assoc($result);
                $description = htmlspecialchars_decode($blog['description'], ENT_QUOTES);
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 my-2">
                    <div class="card w-100 h-100">
                        <a href="./blog.php">
                            <img src="./assets/images/blogs/<?= $blog['img'] ?>" class="card-img-top w-100 img-fluid" alt="..."></a>
                        <div class="card-body">
                            <h5 class="card-title"><?= $blog['header'] ?></h5>
                            <div>
                                <img src="<?= ROOT_URL . '/assets/images/avatars/' . $author['avatar'] ?>" style="border-radius: 50%; padding:2px; overflow:hidden;object-fit: cover;" alt="" width="40px" height="40px">
                                <small class="text-secondary"><?= $author['username'] ?></small>

                                <small class="text-secondary"> <?= date("M d, Y - h:i a", strtotime($blog['date'])) ?></small>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <small class="text-secondary"><?= substr($description, 0, 300) ?>...</small>
                            </li>
                            <li class="list-group-item d-flex flex-column justify-content-center">
                                <a href="./details/blog_details.php?id=<?= $blog['id'] ?>" class="btn btn-outline-info mb-2">Read More <i class="fa fa-long-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php endwhile; ?>

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
        <!-- product row end -->
    </div>

</main>


<?php
include './partials/footer.php';
?>