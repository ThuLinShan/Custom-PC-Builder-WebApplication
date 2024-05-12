<?php
include './partials/header.php';

// Fetch prebuilts
$query = "SELECT id,prebuilt_name,stock, motherboard FROM prebuilt ORDER BY prebuilt_name";
$prebuilts = mysqli_query($connection, $query);

?>

<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Manage Pre-built PC</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>admin" class="text-warning">Admin</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Manage Pre-built PCs</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row p-4 rounded shadow-lg">
            <div class="col-md-6 ">
                <h3>Pre-built PCs</h3>
            </div>
            <a class="col-md-6 btn btn-dark px-4" href="./add_prebuilt.php?config=intel">Add new prebuilt</a>
        </div>

        <!-- alet message -->
        <?php if (isset($_SESSION['delete-prebuilt'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-prebuilt'];
                    unset($_SESSION['delete-prebuilt']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-prebuilt-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-prebuilt-success'];
                    unset($_SESSION['delete-prebuilt-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-prebuilt-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-prebuilt-success'];
                    unset($_SESSION['add-prebuilt-success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-prebuilt-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['edit-prebuilt-success'];
                    unset($_SESSION['edit-prebuilt-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alert message end -->
        <?php if (mysqli_num_rows($prebuilts) > 0) : ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Stock</th>
                        <th>Name</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($prebuilt = mysqli_fetch_assoc($prebuilts)) : ?>
                        <tr class="align-middle">

                            <?php if ($prebuilt['stock'] <= 5) : ?>
                                <td class="text-danger fw-bold"><?= $prebuilt['stock'] ?></td>
                            <?php else : ?>
                                <td class="text-info fw-bold"><?= $prebuilt['stock'] ?></td>
                            <?php endif ?>
                            <td><?= $prebuilt['prebuilt_name'] ?></td>
                            <td>
                                <a class="btn btn-primary mb-1" style="width: 80px;" href="<?= ROOT_URL ?>details/prebuilt_details.php?id=<?= $prebuilt['id'] ?>">Details</a>
                                <?php
                                //motherboard
                                $motherboardid = $prebuilt['motherboard'];
                                $query = "SELECT * FROM motherboard WHERE id = $motherboardid";
                                $result = mysqli_query($connection, $query);
                                $motherboard = mysqli_fetch_assoc($result);
                                ?>
                                <a class="btn btn-secondary " style="width: 80px;" href="./edit_prebuilt.php?id=<?= $prebuilt['id'] ?>&config=<?= strtolower($motherboard['chipset']) ?>">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class=" alert__message error d-flex justify-content-center align-items-center py-5 my-5">
                <h4> "No prebuilts found" </h4>
            </div>
        <?php endif ?>

    </div>
</main>


<?php
include './partials/footer.php';
?>