<main class="form-signin">
    <br>
    <h1 class="h3 mb-3 fw-normal text-center">GALA.AI</h1>
    <div class="center-container">
        <div class="form-content">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <?php if ($this->session->flashdata('login_error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('login_error'); ?>
                </div>
            <?php endif; ?>
            <?= form_open('Admin/admin_login'); ?>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="">
                <label for="email">Email address</label>
            </div>
            <div><br></div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="">
                <label for="password">Password</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn-lg btn-primary" type="submit">Sign in</button>
            <?= form_close(); ?>
            <p class="mt-5 mb-3 text-muted">&copy; 2024–2025</p>
        </div>
    </div>
</main>