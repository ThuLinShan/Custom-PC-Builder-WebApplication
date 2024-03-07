<?php
include './partials/header.php';

$phone1          = $_SESSION['signup-data']['phone1'] ?? null;
$phone2           = $_SESSION['signup-data']['phone2'] ?? null;
$username           = $_SESSION['signup-data']['username'] ?? null;
$email              = $_SESSION['signup-data']['email'] ?? null;
$address              = $_SESSION['signup-data']['address'] ?? null;
$createpassword     = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword    = $_SESSION['signup-data']['confirmpassword'] ?? null;

// Delete signup data session
unset($_SESSION['signup-data']);
?>
<!-- main start here -->
<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Signup</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Sign</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container my-5">
        <div>
            <?php if (isset($_SESSION['signup'])) : ?>
                <div class="text-center py-3 bg-danger text-white opacity-75">
                    <p>
                        <?= $_SESSION['signup'];
                        unset($_SESSION['signup']); ?>
                    </p>
                </div>
            <?php endif ?>
        </div>
        <form class="form-control px-3 py-5 shadow" enctype="multipart/form-data" action="./signup_logic.php" method="post">
            <input class="form-control mb-3" type="text" value="<?= $username ?>" name="username" placeholder="Username" required>
            <input class="form-control mb-3" type="email" value="<?= $email ?>" name="email" placeholder="Email" required>
            <input class="form-control mb-3" type="number" value="<?= $phone1 ?>" name="phone1" placeholder="Phone-1" required>
            <input class="form-control mb-3" type="number" value="<?= $phone2 ?>" name="phone2" placeholder="Phone-2 *Optional*">
            <input class="form-control mb-3" type="text" value="<?= $address ?>" name="address" placeholder="Address">
            <input class="form-control mb-3" type="password" value="<?= $createpassword ?>" name="password" placeholder="Password" required>
            <input class="form-control mb-3" type="password" value="<?= $confirmpassword ?>" name="confirmpassword" placeholder="Confirm Password" required>
            <div>
                <label for="avatar">User Avatar</label>
                <input class="form-control mb-4" type="file" name="img" id="avatar" required>
            </div>

            <button class="form-control mb-2 btn btn-primary" type="submit" name="submit">Create Account</button>
        </form>
        <div class="mt-4 d-flex gap-2">
            <p class="p-0 m-0">Already have an account? </p>
            <a href="./signin.php">Proceed to Signin</a>
        </div>
    </div>
</main>
<!-- main end here -->

<?php
include './partials/footer.php';
?>