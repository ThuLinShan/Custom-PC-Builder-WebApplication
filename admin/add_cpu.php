<?php
require 'partials/header.php';

//get back form data if anything went wrong
$cpu_name = $_SESSION['add-cpu-data']['cpu_name'] ?? null;
$description = $_SESSION['add-cpu-data']['description'] ?? null;
$generation = $_SESSION['add-cpu-data']['generation'] ?? null;
$frequency = $_SESSION['add-cpu-data']['frequency'] ?? null;
$cores = $_SESSION['add-cpu-data']['cores'] ?? null;
$threads = $_SESSION['add-cpu-data']['threads'] ?? null;
$power = $_SESSION['add-cpu-data']['power'] ?? null;
$price = $_SESSION['add-cpu-data']['price'] ?? null;
$link = $_SESSION['add-cpu-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-cpu-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add CPU</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add CPU</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add CPU</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-cpu'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-cpu'];
                    unset($_SESSION['add-cpu']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_cpu_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <a href="<?= ROOT_URL ?>admin/add_brand.php">Add new brand</a>
                <select class="form-select mb-3" name="brand">
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <?php
                        $products = explode(' ', $brand['products']);
                        ?>
                        <?php if (in_array("CPU", $products)) : ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php endif ?>
                    <?php endwhile; ?>
                </select>

                <input name="cpu_name" value="<?= $cpu_name ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $description ?></textarea>

                <label for="">Generation</label>
                <input name="generation" value="<?= $generation ?>" class="mb-3 form-control" type="number" placeholder="Generation" required>

                <label for="">Frequency(GHz)</label>
                <input name="frequency" value="<?= $frequency ?>" class="mb-3 form-control" type="text" placeholder="Frequency" required>

                <label for="">Cores</label>
                <input name="cores" value="<?= $cores ?>" class="mb-3 form-control" type="number" placeholder="Cores" required>

                <label for="">Threads</label>
                <input name="threads" value="<?= $threads ?>" class="mb-3 form-control" type="number" placeholder="Threads" required>

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