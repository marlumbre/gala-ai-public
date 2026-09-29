<!-- Spinner Start -->
<!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> -->
<!-- Spinner End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="<?= base_url('Home') ?>" class="navbar-brand p-0">
            <h1 class="m-0"><img src="<?= base_url('assets/img/loggo.png') ?>">G A L A .a i</h1>
            <!-- <img src="assets/img/loggo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="<?= base_url('Home') ?>" class="nav-item nav-link">Home</a>
                <!-- <a href="<?= base_url('About') ?>" class="nav-item nav-link">About</a> -->
                <!--<a href="<?= base_url('Services') ?>" class="nav-item nav-link">Developer</a>-->
                <!-- <a href="<?= base_url('Packages') ?>" class="nav-item nav-link">Packages</a> -->
                <!-- <a href="<?= base_url('Blog') ?>" class="nav-item nav-link">Blog</a> -->



                <div class="nav-item dropdown">
                    <!--<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>-->
                    <div class="dropdown-menu m-0">
                        <a href="<?= base_url('Home/destination') ?>" class="dropdown-item">Destination</a>
                        <a href="<?= base_url('Home/tour') ?>" class="dropdown-item">Explore Tour</a>
                        <a href="<?= base_url('Home/booking') ?>" class="dropdown-item">Travel Booking</a>
                        <a href="<?= base_url('Home/gallery') ?>" class="dropdown-item">Our Gallery</a>
                        <a href="<?= base_url('Home/guides') ?>" class="dropdown-item">Travel Guides</a>
                        <a href="<?= base_url('Home/testimonial') ?>" class="dropdown-item">Testimonial</a>
                    </div>
                </div>



                <!-- <a href="<?= base_url('Contact') ?>" class="nav-item nav-link">Contact</a> -->


                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        My Dashboard
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if ($this->session->userdata('log') != 'logged') { ?>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Create an Account</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="<?= base_url('Profile/index?id=' . $this->session->userdata('id')) ?>">My Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('Logout') ?>">Log Out</a></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
            <!--
            <a href="<?= base_url('Booking') ?>" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Plan a Trip</a>
            -->
        </div>
    </nav>