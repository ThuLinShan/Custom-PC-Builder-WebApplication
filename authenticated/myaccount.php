<?php
include './partials/header.php';
?>
<!-- main start here -->
<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">My account</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">My account</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container shadow rounded py-3 my-5">
        <div class="d-flex flex-column justify-content-around align-items-center">
            <img src="<?= ROOT_URL . '/assets/images/avatars/' . $avatar ?>" style="border-radius: 50%; border:solid black 2px; padding:2px; overflow:hidden; object-fit: cover;" alt="" width="250rem;" height="250rem;">
            <div class=" mt-3">
                <h4 class="text-start p-0 m-0 text-center">Hello <span class="text-primary"> <?= $current_user['username'] ?></span></h4>
                <p class="text-secondary text-center fs-6"><?= $current_user['email'] ?></p>
            </div>
            <div class="mt-3">
                <h5>You personal Details</h5>
                <div class="row">
                    <div class="col">Phone 1: </div>
                    <div class="col"><?= $current_user['phone1'] ?></div>
                </div>
                <div class="row">
                    <div class="col">Phone 2: </div>
                    <div class="col"><?php if (isset($current_user['phone2'])) : ?><?= $current_user['phone2'] ?><?php else : ?><p>Na</p><?php endif ?></div>
                </div>
                <div class="row">
                    <div class="col">Address: </div>
                    <div class="col"><?php if (isset($current_user['address'])) : ?><?= $current_user['address'] ?><?php else : ?><p>Na</p><?php endif ?></div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main end here -->

<?php
include '../partials/footer.php';
?>