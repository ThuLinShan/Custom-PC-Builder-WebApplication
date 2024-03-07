<?php
include '../partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM desktop_case WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $desktop_case = mysqli_fetch_assoc($result);

    // Fetch desktop_case from database
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
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit desktop_case</li>
            </ol>
        </nav>
    </div>

    <!-- alet message -->
    <?php if (isset($_SESSION['edit-desktop_case'])) : ?>
        <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
            <h3>
                <?= $_SESSION['edit-desktop_case'];
                unset($_SESSION['edit-desktop_case']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- alert message end -->

    <?php if (isset($_GET['id']) && isset($desktop_case)) : ?>
        <div class="container my-5">
            <form action="./edit_desktop_case_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <!-- hidden id -->
                <input type="hidden" value="<?= $desktop_case['id'] ?>" name="id">
                <!-- Previous Thumbnail -->
                <input type="hidden" value="<?= $desktop_case['img'] ?>" name="previous_img_name">

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

                <input name="desktop_case_name" value="<?= $desktop_case['desktop_case_name'] ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file">

                <select name="type" id="" class="mb-3 form-select">
                    <option value="Mini Tower">Mini Tower</option>
                    <option value="Mid Tower">Mid Tower</option>
                    <option value="Full Tower">Full Tower</option>
                </select>

                <label for="">Color</label>
                <input name="color" value="<?= $desktop_case['color'] ?>" class="mb-3 form-control" type="text" placeholder="Color" required>

                <label for="">Cooling Support</label>
                <input name="cooling" value="<?= $desktop_case['cooling'] ?>" class="mb-3 form-control" type="text" step=".1" placeholder="Cooling Support" required>

                <label for="">Dimensions</label>
                <input name="dimensions" value="<?= $desktop_case['dimensions'] ?>" class="mb-3 form-control" type="text" placeholder="Dimensions" required>

                <label for="">IO Panel</label>
                <input name="io_panel" value="<?= $desktop_case['io_panel'] ?>" class="mb-3 form-control" type="text" placeholder="IO Panel" required>

                <label for="">Radiator Support</label>
                <input name="radiator_support" value="<?= $desktop_case['radiator_support'] ?>" class="mb-3 form-control" type="text" placeholder="Radiator Support" required>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $desktop_case['price'] ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <input name="link" value="<?= $desktop_case['link'] ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Edit</button>
            </form>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No desktop_case found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
include '../partials/footer.php';
?>