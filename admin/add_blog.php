<?php
require 'partials/header.php';

//get back form data if anything went wrong
$blog = $_SESSION['add-blog-data']['blog_name'] ?? null;
$description = $_SESSION['blog-data']['description'] ?? null;
$link = $_SESSION['add-blog-data']['link'] ?? null;

//delete from data session  
unset($_SESSION['add-blog-data']);
?>


<main>

    <div class="row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0" style="background-color: #2c2f31;">
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add Blog</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add a blog</h3>
            <p>Recommended pixels ratio for thumbnail: 900x600</p>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-blog'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-blog'];
                    unset($_SESSION['add-blog']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->


        <div>
            <form action="./add_blog_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <input name="header" value="<?= $blog ?>" class="mb-3 form-control" type="text" placeholder="Header" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <textarea name="description" rows="11" id="" placeholder="Description" class="form-control mb-4" required><?= $description ?></textarea>

                <div class="d-flex mb-2">
                    <input type="checkbox" id="is_featured" name="is_featured" class="me-2" value="1" checked>
                    <label for="is_featured">Featured</label>
                </div>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Add</button>
            </form>
        </div>
    </div>


</main>

<?php
require './partials/footer.php';
?>