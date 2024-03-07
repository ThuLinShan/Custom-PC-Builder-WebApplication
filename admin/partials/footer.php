<footer class="card-footer">

    <!-- footer -->
    <div class="justify-content-center" style="background-color:rgb(13, 13, 37); font-family: Arial, Helvetica, sans-serif;">
        <div class="row h-100 w-100">
            <div class="col-lg-4 justify-content-center border-end border-secondary">
                <div class="container px-5 justify-content-center text-center">
                    <img src="<?php echo ROOT_URL ?>assets/images/logos/logo.png" class="img-fluid my-4" alt="">

                    <div class="mt-4">
                        <p class="text-secondary text-sm">Assignment Project for Computing Subject.</p>
                        <p class="text-secondary text-sm">The logo image for this project is designed using
                            open-source
                            software
                            called 'Inkscape'.</p>
                    </div>

                    <div class="text-start pb-3 d-flex justify-content-around">
                        <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook fs-4"></i></a>
                        <a href="https://youtube.com" target="_blank"><i class="fa-brands fa-youtube fs-4"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram fs-4"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="fa-brands fa-linkedin fs-4"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter fs-4"></i></a>

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
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="https://placehold.co/50x50" class="rounded me-2">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <!-- toast notification end-->
</footer>
</body>

<!-- toast pop up on page load -->
<script src="<?php echo ROOT_URL ?>assets/js/index.js"></script>
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