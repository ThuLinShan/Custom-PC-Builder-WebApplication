<?php
require 'partials/header.php';

//get back form data if anything went wrong
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM blog WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $blog = mysqli_fetch_assoc($result);
    }
}

//delete from data session  
unset($_SESSION['blog-data']);
?>


<main>

    <div class="row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0" style="background-color: #2c2f31;">
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit Blog</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Modify/Edit blog</h3>
            <p>Recommended pixels ratio for thumbnail: 900x600</p>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['edit-blog'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['edit-blog'];
                    unset($_SESSION['edit-blog']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->


        <div>
            <?php if (isset($blog)) : ?>
                <form action="./edit_blog_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="<?= $blog['id'] ?>" name="id">
                    <input name="header" value="<?= $blog['header'] ?>" class="mb-3 form-control" type="text" placeholder="Header" required>

                    <!-- Previous Thumbnail -->
                    <input type="hidden" value="<?= $blog['img'] ?>" name="previous_img_name">

                    <label for="img">Choose an image</label>
                    <input name="img" class="mb-3 form-control" id="img" type="file">

                    <textarea name="description" rows="11" id="" placeholder="Description" class="form-control mb-4" required><?= $blog['description'] ?></textarea>

                    <div class="d-flex mb-2">
                        <input type="checkbox" id="is_featured" name="is_featured" class="me-2" value="1">
                        <label for="is_featured">Featured</label>
                    </div>

                    <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">edit</button>
                </form>
            <?php else : ?>
                <div class="text-center ">
                    <p>Blog Unavailable</p>
                </div>
            <?php endif ?>
        </div>
    </div>


</main>

<?php
require './partials/footer.php';
?>