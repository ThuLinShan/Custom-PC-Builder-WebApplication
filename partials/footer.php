<!-- footer start here -->
<footer class="card-footer">
    <!-- footer -->
    <div class="justify-content-center" style="background: linear-gradient(rgb(5, 5, 48),rgb(14, 13, 13)); font-family:Arial, Helvetica, sans-serif;">
        <div class="row h-100 w-100">
            <div class="col-lg-4 justify-content-center border-end border-secondary">
                <div class="container px-5 justify-content-center text-center">
                    <img src="<?php echo ROOT_URL ?>assets/images/logos/white-logo.png" class="img-fluid my-4" alt="">

                    <div class="mt-4">
                        <p class="text-secondary text-sm">Assignment Project for Computing Subject.</p>
                        <p class="text-secondary text-sm">The logo image for this project is designed using
                            open-source
                            software
                            called 'Inkscape'.</p>
                    </div>

                    <div class="text-start pb-3 d-flex justify-content-around">
                        <a href="https://facebook.com" target="_blank"><i class="fa-brands fs-4 fa-facebook"></i></a>
                        <a href="https://youtube.com" target="_blank"><i class="fa-brands fs-4 fa-youtube"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fa-brands fs-4 fa-instagram"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="fa-brands fs-4 fa-linkedin"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="fa-brands fs-4 fa-twitter"></i></a>

                    </div>
                </div>
            </div>
            <div class="col-lg-8" style="height: max-content;">
                <div class="row h-25 border-bottom border-secondary p-3 text-center">
                    <p class="text-secondary text-sm my-auto">
                        Copyright © Computing Assignment. All Rights Reserved
                    </p>
                    <p class="text-secondary text-sm my-auto">
                        By Thu Lin Shan
                    </p>
                </div>
                <div class="row px-5 mx-5">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex flex-column py-5">
                        <h5 class="text-secondary text-sm mb-3">Quick Links</h5>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>index.php">Home</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>blogs.php">Blog</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>other/about_us.php">About us</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>other/FAQs.php">FaQs</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>other/contact.php">Contact</a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex flex-column py-5">
                        <h5 class="text-secondary text-sm mb-3">Help Links</h5>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>autheticated/myaccount.php">Account</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>signup.php">Register</a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex flex-column py-5">
                        <h5 class="text-secondary text-sm mb-3">Shop Link</h5>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>components.php">Components</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>accessories.php">Accessories</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>prebuilt.php">Pre-built</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>custom_pc.php">Customize</a>
                        <a class="link-t mb-1" href="<?php echo ROOT_URL ?>autheticated/cart.php">Cart</a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-flex flex-column py-5">
                        <h5 class="text-secondary text-sm mb-3">Contact Information</h5>
                        <p class="text-secondary mb-1">No 00 Street Street 100/1,
                            City, Country</p>
                        <a href="tel:+0123456789" class="link-t mb-1">(+01) 123 456
                            789</a>
                        <a href="mailto:info@example.com" class="link-t mb-1">example@example.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer end -->

    <!-- toast notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3 shadow-lg">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header p-3 bg-dark text-white">
                <i class="fa-solid fa-bell"></i>
                <strong class="me-auto mx-3">Notifications</strong>
                <small>Total: <span><?= $noti_count ?></span></small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body py-2" style="overflow-y: scroll; height: 50vh; opacity: 100%; background-color: white;">

                <?php if (isset(($_SESSION['user-id']))) : ?>
                    <?php while ($noti_assoc = mysqli_fetch_assoc($noti_assocs)) : ?>
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold"><?= $noti_assoc['header'] ?></p>
                            <small>
                                <?= date("M d, Y - h:i a", strtotime($noti_assoc['date'])) ?>
                            </small>
                        </div>
                        <div class="d-flex justify-content-between mb-2 border-1 border-bottom border-secondary-subtle">
                            <p><?= $noti_assoc['description'] ?></p>
                            <a class="link-info" href="<?= ROOT_URL . $noti_assoc['link'] ?>">View</a>
                        </div>
                    <?php endwhile ?>
                <?php endif ?>
            </div>
        </div>
    </div>
    <!-- toast notification end-->

    <!-- cart start  -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header bg-dark border-2 border-bottom ">
            <h5 class="offcanvas-title  text-white fs-4" id="offcanvasExampleLabel"> <i class="fa-solid fa-cart-shopping me-2 fs-2"></i> Just Your Cart___</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between">

            <div class="p-2 bg-dark rounded">
                <p class="m-0 p-0 fw-lighter text-white">List of cart items</p>
            </div>

            <div class="mt-2 row text-center">
                <div class="col fw-bold">Item Name</div>
                <div class="col fw-bold">Qty</div>
            </div>

            <div class="mt-2 bg-secondary-subtle py-3" style="flex: 1;" style="overflow-y: scroll; overflow-x: hidden;">
                <!-- total price for cart calculation -->
                <?php
                $total_price = 0;
                ?>

                <?php if (isset(($_SESSION['user-id']))) : ?>
                    <?php while ($cart_assoc = mysqli_fetch_assoc($cart_assocs)) : ?>
                        <?php
                        $query = "SELECT * FROM " . $cart_assoc['product_type'] . " WHERE id=" . $cart_assoc['product_id'] . ";";
                        $result = mysqli_query($connection, $query);
                        $cart_item = mysqli_fetch_assoc($result);
                        $index = $cart_assoc['product_type'] . "_name";
                        $total_price = $total_price + $cart_item['price'];
                        ?>
                        <div class="row mb-1  px-3">
                            <div class="col border-1 border-bottom border-dark">
                                <p class=""><?= $cart_item[$index] ?></p>
                            </div>
                            <div class="col-3 border-1 border-bottom border-dark text-end">
                                <p><?= $cart_assoc['count'] ?></p>
                            </div>
                        </div>
                    <?php endwhile ?>
                <?php endif ?>

            </div>


            <?php if (isset(($_SESSION['user-id']))) : ?>
                <div class="d-flex justify-content-between">
                    <p class="text-primary p-0 m-0">Total items in the cart: <span><?= $cart_count ?></span></p>
                    <strong>Price: £<?= $total_price ?></strong>
                </div>
            <?php endif ?>
        </div>
        <div class="offcanvas-bottom d-flex flex-column justify-content-end" style="height: 10vh;">
            <?php if (isset(($_SESSION['user-id']))) : ?>
                <a class="form-control rounded-0 btn btn-primary border-top py-4 fw-bold fs-4" href="<?= ROOT_URL ?>authenticated/cart.php?userid=<?= $id ?>">View Cart <i class="fa-solid fa-cart-shopping"></i> </a>
            <?php endif ?>
        </div>
    </div>
    <!-- cart end -->

</footer>
</body>

<script src="<?php echo ROOT_URL ?>/assets/js/index.js"></script>
<script src="<?php echo ROOT_URL ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')

    if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
            toastBootstrap.show()
        })
    }
</script>

</html>