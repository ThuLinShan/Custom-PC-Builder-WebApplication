<?php
require 'partials/header.php';

//get back form data if anything went wrong
$storage_name = $_SESSION['add-storage-data']['storage_name'] ?? null;
$capacity = $_SESSION['add-storage-data']['capacity'] ?? null;
$capacity_format = $_SESSION['add-storage-data']['capacity_format'] ?? null;
$price = $_SESSION['add-storage-data']['price'] ?? null;
$link = $_SESSION['add-storage-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-storage-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add storage</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add Storage</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add Storage</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-storage'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-storage'];
                    unset($_SESSION['add-storage']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_storage_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <a href="<?= ROOT_URL ?>admin/add_brand.php">Add new brand</a>
                <select class="form-select mb-3" name="brand">
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <?php
                        $products = explode(' ', $brand['products']);
                        ?>
                        <?php if (in_array("Components", $products)) : ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php endif ?>
                    <?php endwhile; ?>
                </select>

                <input name="storage_name" value="<?= $storage_name ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <label for="">Interface</label>
                <select name="interface" class="form-select mb-3" id="">
                    <option value="SATA">SATA</option>
                    <option value="PCIe">PCIe</option>
                </select>

                <label for="">Capacity</label>
                <input name="capacity" value="<?= $capacity ?>" class="mb-3 form-control" type="number" placeholder="Capacity" required>

                <label for="">Format</label>
                <select name="capacity_format" class="form-select mb-3" id="">
                    <option value="GB">GB</option>
                    <option value="TB">TB</option>
                </select>

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