 <!-- Google Web Fonts -->

 <link rel="preconnect" href="https://fonts.googleapis.com">

 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

 <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">



 <!-- Icon Font Stylesheet -->

 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

 <!-- Libraries Stylesheet -->

 <link href="<?= base_url('assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

 <link href="<?= base_url('assets/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">





 <!-- Customized Bootstrap Stylesheet -->

 <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">



 <!-- Template Stylesheet -->

 <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

 <script src="https://maps.googleapis.com/maps/api/js?key=<?= $maps ?>"></script>

 <!-- calendar -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

 <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/loggo.png') ?>">

 <style>
     body.modal-open>*:not(.modal) {
         filter: blur(8px);
         background-color: rgba(0, 0, 0, 0.3);
         transition: filter 0.1s ease-in-out;
     }

     .modal {
         filter: none !important;
     }

     .modal.fade .modal-dialog {
         transform: translateY(-50px);
         opacity: 0;
         transition: opacity 0.1s ease-out, transform 0.1s ease-out;
     }

     .modal.show .modal-dialog {
         transform: translateY(0);
         opacity: 1;
     }

     .modal.fade.out .modal-dialog {
         transform: translateY(-50px);
         opacity: 0;
         transition: opacity 0.3s ease-in, transform 0.3s ease-in;
     }

     #toggle-password {
         position: absolute;
         top: 50%;
         right: 15px;
         transform: translateY(-50%);
         cursor: pointer;
     }

     #toggle-password-register {
         position: absolute;
         top: 50%;
         right: 15px;
         transform: translateY(-50%);
         cursor: pointer;
     }
 </style>