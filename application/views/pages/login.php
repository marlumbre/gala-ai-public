<body>
    <div class="container">
        <div class="logo-container">
            <a href="<?= base_url('Home') ?>">
                <img src="<?= base_url('assets/img/logo1.png') ?>" alt="Logo">
            </a>
        </div>
        <main class="form-signin" style="background-color: #D4EBF8">
            <h1 class="h3 mb-3 fw-normal text-center">WELCOME</h1>

            <?php if ($this->session->flashdata('login_error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('login_error'); ?>
                </div>
            <?php endif; ?>

            <?= form_open('Login/login'); ?>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="">
                <label for="email">Email address</label>
            </div>
            <div><br></div>
            <div class="form-floating position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="">
                <label for="password">Password</label>
                <span id="toggle-password" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                    <i class="bi bi-eye-slash" id="password-icon"></i>
                </span>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn w-100" type="submit">Sign in</button>
            <?= form_close(); ?>

            <!-- Social Login Buttons -->
            <div class="social-login text-center mt-3">
                <p>Or sign in with</p>
                <div class="d-flex justify-content-center">
                    <a href="<?= base_url('auth/google') ?>" class="social-btn google-btn me-2">
                        <i class="bi bi-google"></i>
                    </a>
                    <a href="<?= base_url('auth/yahoo') ?>" class="social-btn yahoo-btn">
                        <i class="bi bi-envelope"></i>
                    </a>
                </div>
            </div>

            <div class="signup-link mt-3">
                <span>Don't have an account?</span>
                <a href="<?= base_url("Register") ?>">Sign up</a>
            </div>
        </main>
    </div>
</body>

<style>
    .social-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        text-decoration: none;
        color: white;
    }

    /* Google Button */
    .google-btn {
        background-color: #DB4437;
        /* Google's red */
    }

    .google-btn:hover {
        background-color: #C1351D;
    }

    /* Yahoo Button */
    .yahoo-btn {
        background-color: #430297;
        /* Yahoo's purple */
    }

    .yahoo-btn:hover {
        background-color: #330174;
    }
</style>