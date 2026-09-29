<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

<!-- Customized Bootstrap Stylesheet -->
<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="<?= base_url('assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">

<link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/loggo.png') ?>">


<style>
    /* General Reset */
    body,
    h1,
    p,
    div {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    /* Palette Colors */
    body {
        background-color: #000000;
        color: black;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    /* Logo Section */
    .logo-container img {
        width: 200px;
        height: auto;
        border-radius: 0;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }



    .logo-placeholder {
        width: 100px;
        height: 100px;
        background-color: #87cefa;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5em;
        font-weight: bold;
        color: white;
        border-radius: 50%;
        margin: 0 auto;
    }

    /* Form Container */
    .form-signin {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .form-signin h1 {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    /* Form Controls */
    .form-floating {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .checkbox {
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .btn {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        background-color: #87cefa;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #4682b4;
    }

    /* Signup Link */
    .signup-link {
        text-align: center;
        margin-top: 15px;
        font-size: 0.9rem;
    }

    .signup-link a {
        color: #4682b4;
        font-weight: bold;
        text-decoration: none;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-signin {
            width: 100%;
            padding: 15px;
        }

        .logo-placeholder {
            width: 80px;
            height: 80px;
            font-size: 1.2em;
        }
    }

    @media (max-width: 480px) {
        .btn {
            font-size: 0.9rem;
            padding: 8px;
        }
    }
</style>