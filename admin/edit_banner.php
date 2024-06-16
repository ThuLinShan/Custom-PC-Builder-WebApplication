<?php
require 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM banners WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $banner = mysqli_fetch_assoc($result);
    }
}

//delete from data session  
unset($_SESSION['edit-banner-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Edit banner</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit Banner</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <!-- alet message -->
        <?php if (isset($_SESSION['edit-banner'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['edit-banner'];
                    unset($_SESSION['edit-banner']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->
        <?php if (isset($banner)) : ?>
            <div>
                <form action="./edit_banner_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="<?= $banner['id'] ?>" name="id">
                    <!-- Previous Thumbnail -->
                    <input type="hidden" value="<?= $banner['img'] ?>" name="previous_img_name">

                    <input type="hidden" value="<?= $banner['type'] ?>" name="type">

                    <div class="my-5 mx-auto">
                        <p class="text-center">Current Image</p>
                        <img src="<?= ROOT_URL . "assets/images/banners/" . $banner['img'] ?>" class="img-thumbnail img-fluid" alt="">
                    </div>

                    <label for="img">Choose an image</label>
                    <input name="img" class="mb-3 form-control" id="img" type="file">

                    <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $banner['description'] ?></textarea>

                    <button name="submit" type="submit" class="form-control mb-3 btn btn-primary text-white">edit</button>
                </form>
            </div>
        <?php else : ?>
            <div class="text-center text-danger">
                <h3>Error occured. Please redirect from a valid page.</h3>
            </div>
        <?php endif ?>
    </div>

</main>

<?php
require './partials/footer.php';
?>