<?php
include './partials/header.php';

$query = "SELECT * FROM blog ORDER BY date";
$blogs =  mysqli_query($connection, $query);

$query = "SELECT * FROM blog WHERE is_featured = 1 LIMIT 1";
$result =  mysqli_query($connection, $query);
$featured = mysqli_fetch_assoc($result);

$featured_description = htmlspecialchars_decode($featured['description'], ENT_QUOTES);

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

            <?php while ($blog = mysqli_fetch_assoc($blogs)) : ?>
                <?php
                $description = htmlspecialchars_decode($blog['description'], ENT_QUOTES);
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

        </div>
        <!-- product row end -->

        <div class="row my-4">
            <a href="" class="btn btn-secondary mx-auto col-lg-3 col-sm-5 col-6">Load More</a>
        </div>
    </div>

</main>


<?php
include './partials/footer.php';
?>