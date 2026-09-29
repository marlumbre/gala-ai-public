    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('assets/lib/owlcarousel/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets/lib/lightbox/js/lightbox.min.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navItems = document.querySelectorAll(".nav-item.dropdown");

            navItems.forEach((item) => {
                const dropdownToggle = item.querySelector(".dropdown-toggle");
                const dropdownMenu = item.querySelector(".dropdown-menu");

                // Detect window resize and adjust behavior
                function updateDropdownBehavior() {
                    if (window.innerWidth <= 991.98) {
                        // Small screens: Add click event
                        dropdownToggle.addEventListener("click", function(e) {
                            e.preventDefault();
                            item.classList.toggle("show");
                            dropdownMenu.classList.toggle("show");
                        });
                    } else {
                        // Large screens: Remove click event
                        item.classList.remove("show");
                        dropdownMenu.classList.remove("show");
                        dropdownToggle.removeEventListener("click", null);
                    }
                }

                // Initial setup
                updateDropdownBehavior();

                // Reapply behavior on window resize
                window.addEventListener("resize", updateDropdownBehavior);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashdataModal = new bootstrap.Modal(document.getElementById('flashdataModal'));

            if (flashdataModal) {
                flashdataModal.show();
            }

            setTimeout(() => {
                if (flashdataModal) {
                    flashdataModal.hide();
                }
            }, 2000);
        });
    </script>