<?php
require 'partials/header.php';

//get back form data if anything went wrong
$description = $_SESSION['add-banner-data']['description'] ?? null;

//delete from data session  
unset($_SESSION['add-banner-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add banner</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add Banner</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add a new banner</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-banner'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-banner'];
                    unset($_SESSION['add-banner']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->
        <?php if (isset($_GET['type'])) : ?>
            <div>
                <form action="./add_banner_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">

                    <label for="img">Choose an image</label>
                    <input name="img" class="mb-3 form-control" id="img" type="file" required>

                    <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $description ?></textarea>

                    <input type="text" name="type" hidden value="<?= $_GET['type'] ?>">

                    <button name="submit" type="submit" class="form-control mb-3 btn btn-primary text-white">Add</button>
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