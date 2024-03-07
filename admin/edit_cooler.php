<?php
include '../partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM cooler WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $cooler = mysqli_fetch_assoc($result);

    // Fetch cooler from database
    $query = "SELECT * FROM brand";
    $brands = mysqli_query($connection, $query);
}
?>
<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit Cooler</li>
            </ol>
        </nav>
    </div>

    <!-- alet message -->
    <?php if (isset($_SESSION['edit-cooler'])) : ?>
        <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
            <h3>
                <?= $_SESSION['edit-cooler'];
                unset($_SESSION['edit-cooler']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- alert message end -->

    <?php if (isset($_GET['id']) && isset($cooler)) : ?>
        <div class="container my-5">
            <form action="./edit_cooler_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <!-- hidden id -->
                <input type="hidden" value="<?= $cooler['id'] ?>" name="id">
                <!-- Previous Thumbnail -->
                <input type="hidden" value="<?= $cooler['img'] ?>" name="previous_img_name">

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

                <input name="cooler_name" value="<?= $cooler['cooler_name'] ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <label for="">Type</label>
                <input name="type" value="<?= $cooler['type'] ?>" class="mb-3 form-control" type="text" placeholder="Type" required>

                <label for="">Fan Speed (rpm)</label>
                <input name="fan_speed" value="<?= $cooler['fan_speed'] ?>" class="mb-3 form-control" type="number" placeholder="Fan Speed" required>

                <label for="">Power (Watt)</label>
                <input name="power" value="<?= $cooler['power'] ?>" class="mb-3 form-control" type="number" placeholder="Power" required>

                <label for="">Radiator Dimension</label>
                <input name="radiator_dimension" value="<?= $cooler['radiator_dimension'] ?>" class="mb-3 form-control" type="text" placeholder="Radiator Dimension" required>

                <label for="">Tube Length(mm)</label>
                <input name="tube_length" value="<?= $cooler['tube_length'] ?>" class="mb-3 form-control" type="number" placeholder="Tube Length" required>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $cooler['price'] ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <label for="">Link</label>
                <input name="link" value="<?= $cooler['link'] ?>" class="mb-3 form-control" type="text" placeholder="Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Edit</button>
            </form>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No cooler found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
include '../partials/footer.php';
?>