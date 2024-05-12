<?php
include 'partials/header.php';

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
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit Pre-built</li>
            </ol>
        </nav>
    </div>

    <?php if (isset($_GET['config']) && $_GET['config'] != "" && ($_GET['config'] == 'intel' || $_GET['config'] == 'amd')) : ?>

        <div class="container my-5" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
            <h2 class="text-center text-dark bg-dark text-white py-3 my-0">Chipset</h2>
            <div class="pb-2 d-flex justify-content-around align-items-center justify-content-center">
                <?php if (isset($_GET['config']) && $_GET['config'] == 'intel') : ?>
                    <a href="./edit_prebuilt.php?id=<?= $_GET['id'] ?>&config=intel" class="btn btn-primary rounded-0 form-control">Intel</a>
                    <a href="./edit_prebuilt.php?id=<?= $_GET['id'] ?>&config=amd" class="btn btn-outline-danger rounded-0 form-control">AMD</a>
                <?php elseif (isset($_GET['config']) && $_GET['config'] == 'amd') : ?>
                    <a href="./edit_prebuilt.php?id=<?= $_GET['id'] ?>&config=intel" class="btn btn-outline-primary rounded-0 form-control">Intel</a>
                    <a href="./edit_prebuilt.php?id=<?= $_GET['id'] ?>&config=amd" class="btn btn-danger rounded-0 form-control">AMD</a>
                <?php endif ?>
            </div>
            <div class="w-100 d-flex justify-content-center align-items-center">
                <?php if (isset($_GET['config']) && $_GET['config'] == 'intel') : ?>
                    <img src="<?= ROOT_URL ?>assets/images/logos/intel.png" class="img-fluid rounded shadow rounded-4 my-2" style="width:25rem; height: 12rem; object-fit: contain;" alt="">
                <?php elseif (isset($_GET['config']) && $_GET['config'] == 'amd') : ?>
                    <img src="<?= ROOT_URL ?>assets/images/logos/amdRyzen.png" class="img-fluid rounded shadow rounded-4 my-2" style="width:25rem; height: 12rem; object-fit: contain;" alt="">
                <?php endif ?>
            </div>

            <!-- alet message -->
            <?php if (isset($_SESSION['edit-prebuilt'])) : ?>
                <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                    <h3>
                        <?= $_SESSION['edit-prebuilt'];
                        unset($_SESSION['edit-prebuilt']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>
            <!-- alert message end -->

            <?php if (isset($_GET['id']) && isset($prebuilt)) : ?>
                <div class="container my-5">
                    <form action="./edit_prebuilt_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                        <!-- hidden id -->
                        <input type="hidden" value="<?= $prebuilt['id'] ?>" name="id">
                        <!-- Previous Thumbnail -->
                        <input type="hidden" value="<?= $prebuilt['img'] ?>" name="previous_img_name">
                        <!-- chipset -->
                        <input type="hidden" value="<?= $_GET['config'] ?>" name="chipset">

                        <label for="" class="fw-bold">Name</label>
                        <input type="text" class="form-control mb-3 " name="prebuilt_name" placeholder="Name" value="<?= $prebuilt['prebuilt_name'] ?>" required>

                        <label for="thumbnail" class="fw-bold">Thumbnail</label>
                        <input type="file" id="thumbnail" class="form-control mb-3 " name="img">

                        <label for="" class="fw-bold">Description</label>
                        <textarea name="description" id="" rows="5" class="form-control mb-3 " required><?= $prebuilt['description'] ?></textarea>

                        <label for=" free_shipping" class="fw-bold">Free Shipping</label>
                        <input id="free_shipping" name="free_shipping" class="mb-3 form-check" type="checkbox" value="1" checked>

                        <label for="" class="fw-bold">Status</label>
                        <select name="status" class="form-select  mb-3" id="">
                            <option value="None">None</option>
                            <option value="New">New</option>
                            <option value="Hot">Hot</option>
                            <option value="Discount">Discount</option>
                        </select>

                        <label for="" class="fw-bold">Stock</label>
                        <input type="number" class="form-control mb-3 " name="stock" placeholder="Stock" value="<?= $prebuilt['stock'] ?>" required>

                        <label for="" class="fw-bold">Price (£)</label>
                        <p class="p-2 text-info mb-1 rounded opacity-75">Default Price: £<span id="default_price"></span></p>
                        <input hidden name="default_price" id="default_price_input" value="<?= $prebuilt['default_price'] ?>" type="number">
                        <input type="number" class="form-control mb-3 " name="price" value="<?= $prebuilt['price'] ?>" placeholder="Official Price">

                        <!-- Motherboard -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">Motherboard</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="motherboard_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="motherboard_name">Product Name</h4>
                                <p class="p-0 m-0">From factor: <span id="motherboard_form_factor"></span></p>
                                <p class="p-0 m-0">Price: £<span class="price" id="motherboard_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="motherboard_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>

                                <?php if (isset($_GET['config']) && $_GET['config'] == 'intel') : ?>
                                    <?php
                                    // Fetch motherboards
                                    $query = "SELECT id,motherboard_name,img FROM motherboard WHERE chipset='Intel'";
                                    $motherboards = mysqli_query($connection, $query);
                                    ?>
                                    <select class="form-select" name="motherboard" id="motherboard">
                                        <?php while ($motherboard = mysqli_fetch_assoc($motherboards)) : ?>
                                            <option value="<?= $motherboard['id'] ?>"><?= $motherboard['motherboard_name'] ?></option>
                                        <?php endwhile ?>
                                    </select>

                                <?php elseif (isset($_GET['config']) && $_GET['config'] == 'amd') : ?>
                                    <?php
                                    // Fetch motherboards
                                    $query = "SELECT id,motherboard_name,img FROM motherboard WHERE chipset='AMD'";
                                    $motherboards = mysqli_query($connection, $query);
                                    ?>
                                    <select class="form-select" name="motherboard" id="motherboard">
                                        <?php while ($motherboard = mysqli_fetch_assoc($motherboards)) : ?>
                                            <option value="<?= $motherboard['id'] ?>"><?= $motherboard['motherboard_name'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                <?php endif ?>
                            </div>
                        </div>
                        <!-- Motherboard end -->


                        <!-- CPU -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">CPU</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="cpu_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="cpu_name">Product Name</h4>
                                <p class="p-0 m-0">Frequency: <span id="cpu_frequency"></span>GHz</p>
                                <p class="p-0 m-0">Power: <span id="cpu_power"></span>Watt</p>
                                <p class="p-0 m-0">Price: £<span class="price" id="cpu_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="cpu_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php if (isset($_GET['config']) && $_GET['config'] == 'intel') : ?>
                                    <?php
                                    // Fetch cpus
                                    $query = "SELECT cpu.id, cpu.cpu_name, cpu.img
                        FROM cpu
                        INNER JOIN brand ON cpu.brand=brand.id WHERE brand.brand_name='intel'";
                                    $cpus = mysqli_query($connection, $query);
                                    ?>
                                    <select class="form-select" name="cpu" id="cpu">
                                        <?php while ($cpu = mysqli_fetch_assoc($cpus)) : ?>
                                            <option value="<?= $cpu['id'] ?>"><?= $cpu['cpu_name'] ?></option>
                                        <?php endwhile ?>
                                    </select>

                                <?php elseif (isset($_GET['config']) && $_GET['config'] == 'amd') : ?>
                                    <?php
                                    // Fetch cpus
                                    $query = "SELECT cpu.id, cpu.cpu_name, cpu.img
                        FROM cpu
                        INNER JOIN brand ON cpu.brand=brand.id WHERE brand.brand_name='AMD'";
                                    $cpus = mysqli_query($connection, $query);
                                    ?>
                                    <select class="form-select" name="cpu" id="cpu">
                                        <?php while ($cpu = mysqli_fetch_assoc($cpus)) : ?>
                                            <option value="<?= $cpu['id'] ?>"><?= $cpu['cpu_name'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                <?php endif ?>
                            </div>
                        </div>
                        <!-- CPU end -->


                        <!-- gpu -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">GPU</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="gpu_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="gpu_name">Product Name</h4>
                                <p class="p-0 m-0">VRAM: <span id="gpu_capacity"></span> GB</p>
                                <p class="p-0 m-0">Power: <span id="gpu_power"></span> Watt</p>
                                <p class="p-0 m-0">Price: £<span class="price" id="gpu_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="gpu_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch gpus
                                $query = "SELECT gpu.id, gpu.gpu_name, gpu.img
                        FROM gpu";
                                $gpus = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="gpu" id="gpu">
                                    <?php while ($gpu = mysqli_fetch_assoc($gpus)) : ?>
                                        <option value="<?= $gpu['id'] ?>"><?= $gpu['gpu_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- gpu end -->

                        <!-- operating_system -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">Operating System</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="operating_system_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="operating_system_name">Product Name</h4>
                                <p class="p-0 m-0">Price: £<span class="price" id="operating_system_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="operating_system_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch operating_systems
                                $query = "SELECT operating_system.id, operating_system.operating_system_name, operating_system.img
                        FROM operating_system";
                                $operating_systems = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="operating_system" id="operating_system">
                                    <?php while ($operating_system = mysqli_fetch_assoc($operating_systems)) : ?>
                                        <option value="<?= $operating_system['id'] ?>"><?= $operating_system['operating_system_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- operating_system end -->

                        <!-- ram -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">RAM</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="ram_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="ram_name">Product Name</h4>
                                <p class="p-0 m-0">Capacity: <span id="ram_capacity"></span> GB</p>
                                <p class="p-0 m-0">Price: £<span class="price" id="ram_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="ram_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch rams
                                $query = "SELECT id, ram_name, img 
                        FROM memory";
                                $rams = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="ram" id="ram">
                                    <?php while ($ram = mysqli_fetch_assoc($rams)) : ?>
                                        <option value="<?= $ram['id'] ?>"><?= $ram['ram_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- ram end -->

                        <!-- primary_storage -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">Primary Storage</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="primary_storage_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="primary_storage_name">Product Name</h4>
                                <p class="p-0 m-0">Capacity: <span id="primary_storage_capacity"></span> <span id="primary_storage_format"></span></p>
                                <p class="p-0 m-0">Price: £<span class="price" id="primary_storage_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="primary_storage_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch primary_storages
                                $query = "SELECT id, storage_name, img 
                        FROM storage";
                                $primary_storages = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="primary_storage" id="primary_storage">
                                    <?php while ($primary_storage = mysqli_fetch_assoc($primary_storages)) : ?>
                                        <option value="<?= $primary_storage['id'] ?>"><?= $primary_storage['storage_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- primary_storage end -->

                        <!-- secondary_storage -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">Secondary Storage</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="secondary_storage_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="secondary_storage_name">Product Name</h4>
                                <p class="p-0 m-0">Capacity: <span id="secondary_storage_capacity"></span> <span id="secondary_storage_format"></span></p>
                                <p class="p-0 m-0">Price: £<span class="price" id="secondary_storage_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="secondary_storage_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch secondary_storages
                                $query = "SELECT id, storage_name, img 
                        FROM storage";
                                $secondary_storages = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="secondary_storage" id="secondary_storage">
                                    <option value="">None</option>
                                    <?php while ($secondary_storage = mysqli_fetch_assoc($secondary_storages)) : ?>
                                        <option value="<?= $secondary_storage['id'] ?>"><?= $secondary_storage['storage_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- secondary_storage end -->

                        <!-- power_supply -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">Power Supply</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="power_supply_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="power_supply_name">Product Name</h4>
                                <p class="p-0 m-0">Power: <span id="power_supply_power"></span> Watt</p>
                                <p class="p-0 m-0">Price: £<span class="price" id="power_supply_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="power_supply_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch power_supplys
                                $query = "SELECT power_supply.id, power_supply.power_supply_name, power_supply.img
                        FROM power_supply";
                                $power_supplys = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="power_supply" id="power_supply">
                                    <?php while ($power_supply = mysqli_fetch_assoc($power_supplys)) : ?>
                                        <option value="<?= $power_supply['id'] ?>"><?= $power_supply['power_supply_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- power_supply end -->


                        <!-- desktop_case -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">Desktop Case</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="desktop_case_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="desktop_case_name">Product Name</h4>
                                <p class="p-0 m-0">Color: <span id="desktop_case_color"></span></p>
                                <p class="p-0 m-0">Dimensions: <span id="desktop_case_dimensions"></span></p>
                                <p class="p-0 m-0">Price: £<span class="price" id="desktop_case_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="desktop_case_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch desktop_cases
                                $query = "SELECT desktop_case.id, desktop_case.desktop_case_name, desktop_case.img
                        FROM desktop_case";
                                $desktop_cases = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="desktop_case" id="desktop_case">
                                    <?php while ($desktop_case = mysqli_fetch_assoc($desktop_cases)) : ?>
                                        <option value="<?= $desktop_case['id'] ?>"><?= $desktop_case['desktop_case_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- desktop_case end -->

                        <!-- cooler -->
                        <div class="row pb-3 mt-4 rounded border ">
                            <h5 class="text-white bg-secondary px-3 py-1 mx-0 mb-3">Cooler</h5>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center">
                                <img id="cooler_img" src="<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png" style="width:22rem; height: 10rem; object-fit: contain" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-4 col-md-6 my-3">
                                <h4 class="mb-3 text-info-emphasis" id="cooler_name">Product Name</h4>
                                <p class="p-0 m-0">Fan Speed: <span id="cooler_fan_speed"></span> RPM</p>
                                <p class="p-0 m-0">Price: £<span class="price" id="cooler_price"></span></p>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-3">
                                <a id="cooler_details" href="" class="form-control btn btn-outline-info mb-3">Details</a>
                                <?php
                                // Fetch coolers
                                $query = "SELECT id, cooler_name, img
                        FROM cooler";
                                $coolers = mysqli_query($connection, $query);
                                ?>
                                <select class="form-select" name="cooler" id="cooler">
                                    <?php while ($cooler = mysqli_fetch_assoc($coolers)) : ?>
                                        <option value="<?= $cooler['id'] ?>"><?= $cooler['cooler_name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <!-- cooler end -->
                        <div class="row mt-5">
                            <button name="submit" type="submit" class="btn btn-lg btn-dark text-white rounded-0 border-1 form-control mt-2">Edit</button>
                        </div>
                    </form>
                </div>

            <?php else : ?>
                <div class="container my-5 py-5 text-danger text-center">
                    <h3>No prebuilt found with current id.</h3>
                    <p>Please check the url and try again</p>
                </div>
            <?php endif ?>


        <?php else : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    Something went wrong. Please select valid a chipset.
                </h3>
            </div>
        <?php endif ?>

        <!-- Modal HTML -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Warning</h5>
                    </div>
                    <div class="modal-body">
                        Please select a power supply with more Wattage for better experience.
                    </div>
                    <div class="modal-footer">
                        <p>Press 'Esc' to close the message popup.</p>
                    </div>
                </div>
            </div>
        </div>


</main>


<!-- Javascript queries -->
<script>
    $('#default_price').ready(function() {
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#motherboard').ready(function() {
        onmotherboardChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get motherboard on select change
    $('#motherboard').change(function() {
        onmotherboardChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#cpu').ready(function() {
        oncpuChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get cpu on select change
    $('#cpu').change(function() {
        oncpuChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#gpu').ready(function() {
        ongpuChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get gpu on select change
    $('#gpu').change(function() {
        ongpuChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#operating_system').ready(function() {
        onoperating_systemChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get operating_system on select change
    $('#operating_system').change(function() {
        onoperating_systemChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#ram').ready(function() {
        onramChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get ram on select change
    $('#ram').change(function() {
        onramChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#primary_storage').ready(function() {
        onprimary_storageChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get primary_storage on select change
    $('#primary_storage').change(function() {
        onprimary_storageChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#secondary_storage').ready(function() {
        onsecondary_storageChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get secondary_storage on select change
    $('#secondary_storage').change(function() {
        onsecondary_storageChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#power_supply').ready(function() {
        onpower_supplyChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get power_supply on select change
    $('#power_supply').change(function() {
        onpower_supplyChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#desktop_case').ready(function() {
        ondesktop_caseChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get desktop_case on select change
    $('#desktop_case').change(function() {
        ondesktop_caseChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get data on load
    $('#cooler').ready(function() {
        oncoolerChange();
        calculateTotal();
        updateDefaultPriceInput();
    });
    // get cooler on select change
    $('#cooler').change(function() {
        oncoolerChange();
        calculateTotal();
        updateDefaultPriceInput();
    });



    //check power
    $(document).ready(function() {
        // Function to calculate the total power consumption
        function calculateTotalPower() {
            var cpuPower = parseInt($('#cpu_power').text());
            var gpuPower = parseInt($('#gpu_power').text());

            var totalPower = cpuPower + gpuPower;
            return totalPower;
        }

        // Function to compare total power consumption with power supply power
        function checkPowerConsumption() {
            var totalPower = calculateTotalPower();
            var powerSupplyPower = parseInt($('#power_supply_power').text());

            var threshold = 0.7; // 70%
            if (totalPower > threshold * powerSupplyPower) {
                $('#myModal').modal('show'); // Show the modal
            }
        }

        // Initial check
        checkPowerConsumption();

        // Observe changes to spans
        var observer = new MutationObserver(function(mutationsList, observer) {
            checkPowerConsumption();
        });

        observer.observe(document.getElementById('cpu_power'), {
            subtree: true,
            characterData: true,
            childList: true
        });
        observer.observe(document.getElementById('gpu_power'), {
            subtree: true,
            characterData: true,
            childList: true
        });
        observer.observe(document.getElementById('power_supply_power'), {
            subtree: true,
            characterData: true,
            childList: true
        });
    });
    //check power end

    function calculateTotal() {
        var sum = 0;
        $('.price').each(function() {
            sum += +$(this).text() || 0;
        });
        $("#default_price").text(sum);
        $('#default_price').ready(function() {
            calculateTotal()
        });
    }

    function onmotherboardChange() {
        var selectedmotherboard = $("#motherboard option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_motherboard.php",
            data: {
                motherboard_id: selectedmotherboard
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#motherboard_name").text(data.motherboard_name);
            $("#motherboard_form_factor").text(data.form_factor);
            $("#motherboard_price").text(data.price);
            $("#motherboard_img").attr("src", "<?= ROOT_URL ?>assets/images/products/motherboard/" + data.img)
            $("#motherboard_details").attr("href", "<?= ROOT_URL ?>details/motherboard_details.php?id=" + data.id)

            $('#motherboard').change(function() {
                onmotherboardChange()
            });
        });
    }

    function oncpuChange() {
        var selectedcpu = $("#cpu option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_cpu.php",
            data: {
                cpu_id: selectedcpu
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#cpu_name").html(data.cpu_name);
            $("#cpu_frequency").html(data.frequency);
            $("#cpu_power").html(data.power);
            $("#cpu_price").text(data.price);
            $("#cpu_img").attr("src", "<?= ROOT_URL ?>assets/images/products/cpu/" + data.img)
            $("#cpu_details").attr("href", "<?= ROOT_URL ?>details/cpu_details.php?id=" + data.id)

            $('#cpu').change(function() {
                oncpuChange();
            });
        });
    }

    function ongpuChange() {
        var selectedgpu = $("#gpu option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_gpu.php",
            data: {
                gpu_id: selectedgpu
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#gpu_name").html(data.gpu_name);
            $("#gpu_capacity").html(data.vram);
            $("#gpu_power").html(data.power);
            $("#gpu_price").text(data.price);
            $("#gpu_img").attr("src", "<?= ROOT_URL ?>assets/images/products/gpu/" + data.img)
            $("#gpu_details").attr("href", "<?= ROOT_URL ?>details/gpu_details.php?id=" + data.id)

            $('#gpu').change(function() {
                ongpuChange();
            });
        });
    }

    function onoperating_systemChange() {
        var selectedoperating_system = $("#operating_system option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_operating_system.php",
            data: {
                operating_system_id: selectedoperating_system
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#operating_system_name").html(data.operating_system_name);
            $("#operating_system_price").text(data.price);
            $("#operating_system_img").attr("src", "<?= ROOT_URL ?>assets/images/products/operating_system/" + data.img)
            $("#operating_system_details").attr("href", "<?= ROOT_URL ?>details/operating_system_details.php?id=" + data.id)

            $('#operating_system').change(function() {
                onoperating_systemChange()
            });
        });
    }

    function onramChange() {
        var selectedram = $("#ram option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_ram.php",
            data: {
                ram_id: selectedram
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#ram_name").html(data.ram_name);
            $("#ram_capacity").html(data.capacity);
            $("#ram_price").text(data.price);
            $("#ram_img").attr("src", "<?= ROOT_URL ?>assets/images/products/ram/" + data.img)
            $("#ram_details").attr("href", "<?= ROOT_URL ?>details/ram_details.php?id=" + data.id)

            $('#ram').change(function() {
                onramChange()
            });
        });
    }

    function onprimary_storageChange() {
        var selectedprimary_storage = $("#primary_storage option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_storage.php",
            data: {
                storage_id: selectedprimary_storage
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#primary_storage_name").html(data.storage_name);
            $("#primary_storage_capacity").html(data.capacity);
            $("#primary_storage_format").html(data.capacity_format);
            $("#primary_storage_price").text(data.price);
            $("#primary_storage_img").attr("src", "<?= ROOT_URL ?>assets/images/products/storage/" + data.img)
            $("#primary_storage_details").attr("href", "<?= ROOT_URL ?>details/storage_details.php?id=" + data.id)

            $('#primary_storage').change(function() {
                onprimary_storageChange()
            });
        });
    }

    function onsecondary_storageChange() {
        var selectedsecondary_storage = $("#secondary_storage option:selected").val();
        if (selectedsecondary_storage != "") {
            $.ajax({
                type: "POST",
                url: "../get_storage.php",
                data: {
                    storage_id: selectedsecondary_storage
                }
            }).done(function(data) {
                data = JSON.parse(data);
                $("#secondary_storage_name").html(data.storage_name);
                $("#secondary_storage_capacity").html(data.capacity);
                $("#secondary_storage_format").html(data.capacity_format);
                $("#secondary_storage_price").text(data.price);
                $("#secondary_storage_img").attr("src", "<?= ROOT_URL ?>assets/images/products/storage/" + data.img)
                $("#secondary_storage_details").attr("href", "<?= ROOT_URL ?>details/storage_details.php?id=" + data.id)

                $('#secondary_storage').change(function() {
                    onsecondary_storageChange()
                });
            });
        } else {
            $("#secondary_storage_name").html("None");
            $("#secondary_storage_capacity").html("null");
            $("#secondary_storage_format").html(" ");
            $("#secondary_storage_price").html(0);
            $("#secondary_storage_img").attr("src", "<?= ROOT_URL ?>assets/images/logos/thumbnail1x1.png")
            $("#secondary_storage_details").attr("href", "./")
        }
    }

    function onpower_supplyChange() {
        var selectedpower_supply = $("#power_supply option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_power_supply.php",
            data: {
                power_supply_id: selectedpower_supply
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#power_supply_name").html(data.power_supply_name);
            $("#power_supply_power").html(data.power);
            $("#power_supply_price").text(data.price);
            $("#power_supply_img").attr("src", "<?= ROOT_URL ?>assets/images/products/powersupply/" + data.img)
            $("#power_supply_details").attr("href", "<?= ROOT_URL ?>details/power_supply_details.php?id=" + data.id)

            $('#power_supply').change(function() {
                onpower_supplyChange()
            });
        });
    }

    function ondesktop_caseChange() {
        var selecteddesktop_case = $("#desktop_case option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_desktop_case.php",
            data: {
                desktop_case_id: selecteddesktop_case
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#desktop_case_name").html(data.desktop_case_name);
            $("#desktop_case_color").html(data.color);
            $("#desktop_case_dimensions").html(data.dimensions);
            $("#desktop_case_price").text(data.price);
            $("#desktop_case_img").attr("src", "<?= ROOT_URL ?>assets/images/products/desktop_case/" + data.img)
            $("#desktop_case_details").attr("href", "<?= ROOT_URL ?>details/desktop_case_details.php?id=" + data.id)

            $('#desktop_case').change(function() {
                ondesktop_caseChange()
            });
        });
    }

    function oncoolerChange() {
        var selectedcooler = $("#cooler option:selected").val();
        $.ajax({
            type: "POST",
            url: "../get_cooler.php",
            data: {
                cooler_id: selectedcooler
            }
        }).done(function(data) {
            data = JSON.parse(data);
            $("#cooler_name").html(data.cooler_name);
            $("#cooler_fan_speed").html(data.fan_speed);
            $("#cooler_price").text(data.price);
            $("#cooler_img").attr("src", "<?= ROOT_URL ?>assets/images/products/cooler/" + data.img)
            $("#cooler_details").attr("href", "<?= ROOT_URL ?>details/cooler_details.php?id=" + data.id)

            $('#cooler').change(function() {
                oncoolerChange()
            });
        });
    }

    // Function to update default_price_input value
    function updateDefaultPriceInput() {
        var defaultPriceValue = document.getElementById('default_price').innerText;
        document.getElementById('default_price_input').value = defaultPriceValue;
        $('#default_price_input').ready(function() {
            updateDefaultPriceInput()
        });
    }

    // Initial update
    updateDefaultPriceInput();
</script>

<!-- Javascript queries end -->

<?php
include '../partials/footer.php';
?>