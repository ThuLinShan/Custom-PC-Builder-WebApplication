<?php
require 'partials/header.php';

//get back form data if anything went wrong
$gpu_name = $_SESSION['add-gpu-data']['gpu_name'] ?? null;
$vram = $_SESSION['add-gpu-data']['vram$vram'] ?? null;
$memory_type = $_SESSION['add-gpu-data']['mem$memory_type'] ?? null;
$power = $_SESSION['add-gpu-data']['power'] ?? null;
$price = $_SESSION['add-gpu-data']['price'] ?? null;
$link = $_SESSION['add-gpu-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-gpu-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add GPU</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add GPU</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add GPU</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-gpu'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-gpu'];
                    unset($_SESSION['add-gpu']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_gpu_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <a href="<?= ROOT_URL ?>admin/add_brand.php">Add new brand</a>
                <select class="form-select mb-3" name="brand">
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <?php
                        $products = explode(' ', $brand['products']);
                        ?>
                        <?php if (in_array("GPU", $products)) : ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php endif ?>
                    <?php endwhile; ?>
                </select>

                <input name="gpu_name" value="<?= $gpu_name ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <label for="">VRam (GB)</label>
                <input name="vram" value="<?= $vram ?>" class="mb-3 form-control" type="number" placeholder="VRam" required>

                <label for="">Memory Type</label>
                <input name="memory_type" value="<?= $memory_type ?>" class="mb-3 form-control" type="text" step=".1" placeholder="memory_type" required>

                <label for="">Power (Watt)</label>
                <input name="power" value="<?= $power ?>" class="mb-3 form-control" type="number" placeholder="Power" required>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $price ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <input name="link" value="<?= $link ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Add</button>
            </form>
        </div>
    </div>

</main>

<?php
require './partials/footer.php';
?>