<?php
require '../partials/header.php';
//Get prebuilt data with id
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM prebuilt WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $prebuilt = mysqli_fetch_assoc($result);

    if (isset($prebuilt)) {

        //os
        $id = $prebuilt['os'];
        $query = "SELECT * FROM operating_system WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $os = mysqli_fetch_assoc($result);

        //cpu
        $id = $prebuilt['cpu'];
        $query = "SELECT * FROM cpu WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $cpu = mysqli_fetch_assoc($result);

        //gpu
        $id = $prebuilt['gpu'];
        $query = "SELECT * FROM gpu WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $gpu = mysqli_fetch_assoc($result);

        //ram
        $id = $prebuilt['ram'];
        $query = "SELECT * FROM memory WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $ram = mysqli_fetch_assoc($result);

        //primary
        $id = $prebuilt['primary_storage'];
        $query = "SELECT * FROM storage WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $primary_storage = mysqli_fetch_assoc($result);

        //secondary
        $id = $prebuilt['secondary_storage'];
        $query = "SELECT * FROM storage WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $secondary_storage = mysqli_fetch_assoc($result);

        //motherboard
        $id = $prebuilt['motherboard'];
        $query = "SELECT * FROM motherboard WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $motherboard = mysqli_fetch_assoc($result);

        //case
        $id = $prebuilt['desktop_case'];
        $query = "SELECT * FROM desktop_case WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $desktop_case = mysqli_fetch_assoc($result);

        //power supply
        $id = $prebuilt['power_supply'];
        $query = "SELECT * FROM power_supply WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $power_supply = mysqli_fetch_assoc($result);
    }
}
?>

<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Pre-built Desktop Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Pre-built Details</li>
            </ol>
        </nav>
    </div>

    <?php if (isset($_GET['id']) && isset($prebuilt)) : ?>
        <div class="container my-5 p-5 border rounded">
            <div class="row">
                <div class="col-lg-7">
                    <img src="<?= ROOT_URL ?>assets/images/products/prebuilt/<?= $prebuilt['img'] ?>" alt="" class="w-100 py-5 bg-secondary-subtle img-fluid">
                    <?php if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) : ?>
                        <div class="container d-flex justify-content-center ms-0 px-0 mt-3">
                            <a href="<?= ROOT_URL ?>admin/edit_prebuilt.php?id=<?= $prebuilt['id'] ?>&config=<?= strtolower($motherboard['chipset']) ?>" class="btn form-control mx-1 btn-dark">Edit</a>
                            <a href="<?= ROOT_URL ?>admin/delete_prebuilt.php?id=<?= $prebuilt['id'] ?>" class="btn form-control mx-1 btn-danger">Delete</a>
                        </div>
                    <?php endif ?>
                    <div class="container d-flex flex-column justify-content-center text-center border align-items-center mt-5 p-2">
                        <h4 class="pt-2 small">
                            Certified by Thu Lin Shan standard specifications <img src="../assets/images/logos/logo.png" width="50px" alt="">
                        </h4>
                    </div>
                    <div class="container d-flex flex-column justify-content-center text-center border align-items-center bg-secondary-subtle p-2">
                        <p class="small">
                            This product is built with quality components which meet the ideal standard of <code>thulinshan</code> standard qualifications.
                        <ul class="small text-start">
                            <li>Reliable</li>
                            <li>Great Performance</li>
                            <li>Durable</li>
                            <li>User requirements met</li>
                        </ul>
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 d-flex px-4">
                    <div class="mt-3 d-flex flex-column border-1 border-start ps-3">
                        <div class="pb-3 border-1 border-bottom">
                            <h3 class="mb-3 text-info-emphasis"><?= $prebuilt['prebuilt_name'] ?></h3>

                            <p class="d-flex gap-3 mb-3 pb-0">
                                <?= $prebuilt['description'] ?>
                            </p>
                            <p class="text-white p-1 bg-secondary">| Built Date: <span><?= $prebuilt['date'] ?></span></p>
                            <?php if ($prebuilt['status'] !== "None") : ?>
                                <p class="text-white w-25 p-1 bg-info">
                                    <?= $prebuilt['status'] ?>
                                </p>
                            <?php endif; ?>
                            <h5 class="text-success p-1">Stock: <span><?= $prebuilt['stock'] ?></span> </h5>

                        </div>
                        <div class="py-2 mb-3 border-1 border-bottom">
                            <h4>Price: $ <?= $prebuilt['price'] ?></h4>
                        </div>
                        <div>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-wrench"></i>_
                                <?= $os['operating_system_name'] ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-microchip"></i>_
                                <?= $cpu['cpu_name'] ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 fa-microchip bg-secondary text-white"></i>_
                                <?= $gpu['gpu_name'] ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-memory"></i>_
                                <?= $ram['ram_name'] ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-server"></i>
                                <?= $primary_storage['storage_name'] ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-server"></i>
                                <?= !empty($secondary_storage['storage_name']) ? $secondary_storage['storage_name'] : 'Na' ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-microchip"></i>_
                                <?= $motherboard['motherboard_name'] ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-plug"></i>_
                                <?= $power_supply['power_supply_name'] ?>
                            </p>
                            <p><i class="fa-solid fs-4 m-1 text-secondary fa-computer"></i>_
                                <?= $desktop_case['desktop_case_name'] ?>
                            </p>
                        </div>
                        <div class="d-flex flex-column justify-content-end" style="flex:auto;">
                            <a href="<?= ROOT_URL ?>authenticated/add_to_cart_logic.php?product_id=<?= $prebuilt['id'] ?>&category=prebuilt&count=1&price=<?= $prebuilt['price'] ?>" class="btn btn-secondary">Add to Cart</a>
                            <a class="form-control mb-3 btn btn-dark" href="">Buy Now <i class="text-info fa-solid fa-dollar"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No prebuilt desktop found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
require '../partials/footer.php';
?>