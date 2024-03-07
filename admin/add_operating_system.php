<?php
require 'partials/header.php';

//get back form data if anything went wrong
$operating_system_name = $_SESSION['add-operating_system-data']['operating_system_name'] ?? null;
$description = $_SESSION['add-operating_system-data']['description'] ?? null;
$generation = $_SESSION['add-operating_system-data']['generation'] ?? null;
$frequency = $_SESSION['add-operating_system-data']['frequency'] ?? null;
$cores = $_SESSION['add-operating_system-data']['cores'] ?? null;
$threads = $_SESSION['add-operating_system-data']['threads'] ?? null;
$power = $_SESSION['add-operating_system-data']['power'] ?? null;
$price = $_SESSION['add-operating_system-data']['price'] ?? null;
$link = $_SESSION['add-operating_system-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-operating_system-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add OS</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add OS</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add OS</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-operating_system'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-operating_system'];
                    unset($_SESSION['add-operating_system']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_operating_system_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <a href="<?= ROOT_URL ?>admin/add_brand.php">Add new brand</a>
                <select class="form-select mb-3" name="brand">
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <?php
                        $products = explode(' ', $brand['products']);
                        ?>
                        <?php if (in_array("operating_system", $products)) : ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php endif ?>
                    <?php endwhile; ?>
                </select>

                <input name="operating_system_name" value="<?= $operating_system_name ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <label for="">Description</label>
                <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $description ?></textarea>

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