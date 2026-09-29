<main class="form-signin-container d-flex flex-wrap">
    <!-- Left Section: Form -->
    <!-- Right Section: Logo -->
    <div class="logo-container d-flex flex-column align-items-center justify-content-center">
        <a href="<?= base_url('Home') ?>">
            <img src="<?= base_url('assets/img/logo1.png') ?>" alt="Logo" class="logo-img">
        </a>
        <p class="logo-tagline mt-3">Explore more, Stress less</p>
    </div>
    <section class="form-signin" style="background-color: #D4EBF8">
        <?= form_open('Register/register'); ?>
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 fw-normal">REGISTER</h1>
            <p class="text-muted">Fill in the form to register your account.</p>
        </div>

        <div class="center-container">
            <div class="form-content">
                <?php if ($this->session->flashdata('register_error')): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?= $this->session->flashdata('register_error'); ?>
                    </div>
                <?php endif; ?>

                <!-- Name Field -->
                <div class="form-floating mb-3">
                    <input type="text"
                        class="form-control"
                        id="name"
                        name="username"
                        placeholder="Your full name"
                        aria-label="Full Name"
                        required>
                    <label for="name">Full Name</label>
                </div>

                <!-- Sex Field -->
                <div class="form-floating mb-3">
                    <select class="form-control" id="sex" name="sex" aria-label="Sex" required>
                        <option value="" selected disabled>Select your sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="sex">Sex</label>
                </div>

                <!-- Gender Field -->
                <div class="form-floating mb-3">
                    <select class="form-control"
                        id="gender"
                        name="gender"
                        aria-label="Gender"
                        required>
                        <option value="" selected disabled>Select your gender</option>
                        <option value="Straight">Straight</option>
                        <option value="Lesbian">Lesbian</option>
                        <option value="Gay">Gay</option>
                        <option value="Bisexual">Bisexual</option>
                        <option value="Transgender">Transgender</option>
                        <option value="Queer">Queer</option>
                        <option value="Non-Binary">Non-Binary</option>
                        <option value="Non-Binary">Prefer not to say</option>
                    </select>
                    <label for="gender">Gender</label>
                </div>


                <!-- Birthdate Field -->
                <div class="form-floating mb-3">
                    <input type="date"
                        class="form-control"
                        id="birthdate"
                        name="birthdate"
                        placeholder="Your birthdate"
                        aria-label="Birthdate"
                        required>
                    <label for="birthdate">Birthdate</label>
                </div>

                <!-- Email Field -->
                <div class="form-floating mb-3">
                    <input type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Your email address"
                        aria-label="Email Address"
                        required>
                    <label for="email">Email Address</label>
                </div>


                <!-- Phone Field -->
                <div class="form-floating mb-3">
                    <div class="d-flex">
                        <span class="input-group-text">+63</span>
                        <input type="tel"
                            class="form-control"
                            id="phone"
                            name="phone"
                            placeholder="Your phone number"
                            pattern="[9][0-9]{9}"
                            maxlength="10"
                            aria-label="Phone Number"
                            required>
                    </div>
                    <small class="text-muted">Enter a 10-digit mobile number (e.g., 9123456789).</small>
                </div>


                <!-- Password Field -->
                <div class="form-floating mb-4">
                    <input type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Your password"
                        aria-label="Password"
                        required>
                    <label for="password">Password</label>
                </div>

                <!-- Submit Button -->
                <button class="btn btn-lg w-100" type="submit">Sign up</button>
            </div>

            <div class="text-center mt-3">
                <p>Already have an account? <a href="<?= base_url("Login") ?>">Sign in.</a></p>
            </div>
        </div>
        <?= form_close(); ?>
    </section>
</main>

<style>
    .form-signin-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
        flex-wrap: wrap;
        /* Allows wrapping for mobile view */
    }

    .form-section,
    .logo-container {
        width: 50%;
    }

    .logo-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .logo-img {
        max-width: 100%;
        /* Adjust the size of the logo */
        height: auto;
    }

    .logo-tagline {
        font-size: 1.2rem;
        color: #555;
        /* Use a muted color for the tagline */
        text-align: center;
        font-weight: 500;
    }

    /* Mobile View */
    @media (max-width: 768px) {

        .form-section,
        .logo-container {
            width: 100%;
            /* Full-width for mobile */
            text-align: center;
            /* Center-align content */
        }

        .logo-container {
            order: -1;
            /* Move the logo above the form */
            margin-bottom: 20px;
        }

        .logo-img {
            max-width: 80%;
            /* Make logo larger for better visibility */
        }

        .logo-tagline {
            font-size: 1rem;
        }
    }
</style>