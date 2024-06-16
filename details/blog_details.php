<?php
require '../partials/header.php';
//Get blog data with id
if (isset($_GET['id'])) {
    //blog
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM blog WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $blog = mysqli_fetch_assoc($result);
    $description = htmlspecialchars_decode($blog['description'], ENT_QUOTES);

    //author
    $author_id = $blog['author'];
    $query = "SELECT * FROM users WHERE id=$author_id";
    $result = mysqli_query($connection, $query);
    $author = mysqli_fetch_assoc($result);
}
?>

<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h2 class="text-white fw-light"><?= $blog['header'] ?></h2>
    </div>

    <?php if (isset($_GET['id']) && isset($blog)) : ?>
        <div class="row w-100 d-flex justify-content-center my-5">
            <div class="col-11 col-sm-11 col-md-8 col-lg-6 mb-5">
                <div class="d-flex mb-3 bg-dark text-white p-2 rounded">
                    <div class="d-flex align-items-center">
                        <img src="<?= ROOT_URL . '/assets/images/avatars/' . $author['avatar'] ?>" style="border-radius: 50%; padding:2px; overflow:hidden;object-fit: cover;" alt="" width="40px" height="40px">
                        <div class="ms-3">
                            <h5 class="mb-1">By: <?= $author['username'] ?></h5>
                            <p class="mb-1 text-warning">
                                <?= date("M d, Y - h:i a", strtotime($blog['date'])) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <img src="<?= ROOT_URL ?>assets/images/blogs/<?= $blog['img'] ?>" alt="" class="w-100 img-thumbnail rounded mb-5">
                <div class="mt-3">

                    <div class="mb-3 pb-0" style="text-align: justify;">
                        <?= $description ?>
                    </div>

                </div>
            </div>
            <div>

            </div>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No blog found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
require '../partials/footer.php';
?>