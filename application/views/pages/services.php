        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Testing Area</h1>
            </div>
        </div>
        <!-- Header End -->

        <!-- Services Start -->
        <div class="container-fluid bg-light service py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <!-- <h5 class="section-title px-3">Searvices</h5> -->

                    <h1 class="mb-0">Search for places</h1>

                    <form id="searchForm">
                        <input type="text" id="searchQuery" name="searchQuery" placeholder="" required>
                        <button type="submit" class="btn btn-primary">Search Locations</button>
                    </form>

                    <div id="results"></div>

                </div>



                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <!-- <h5 class="section-title px-3">Searvices</h5> -->

                    <form id="locationIdForm">
                        <input type="text" id="searchLocationQuery" name="searchQuery" placeholder="Enter Location ID" required>
                        <button type="submit" class="btn btn-primary">Search Location ID</button>
                    </form>
                    <div id="results"></div>

                </div>


            </div>
        </div>
        <!-- Services End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#searchForm').on('submit', function(e) {
                    e.preventDefault();

                    const searchQuery = $('#searchQuery').val();

                    $.ajax({
                        url: "<?php echo base_url('services/searchLocations'); ?>",
                        type: "GET",
                        data: {
                            searchQuery: searchQuery
                        },
                        success: function(response) {
                            $('#results').html(response);

                            // Update the map dynamically
                            if (typeof locations !== "undefined" && locations.length > 0) {
                                initMap(); // Reinitialize the map with updated locations
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#results').html('<p>An error occurred: ' + error + '</p>');
                        }
                    });
                });
            });



            $(document).ready(function() {
                $('#locationIdForm').on('submit', function(e) {
                    e.preventDefault(); // Prevent form from submitting normally

                    const searchLocation = $('#searchLocationQuery').val();

                    $.ajax({
                        url: "<?php echo base_url('services/searchLocationId'); ?>",
                        type: "GET",
                        data: {
                            searchLocation: searchLocation
                        },
                        success: function(response) {
                            $('#results').html(response);
                        },
                        error: function(xhr, status, error) {
                            $('#results').html('<p>An error occurred: ' + error + '</p>');
                        }
                    });
                });
            });
        </script>
        <script>
            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 8,
                    center: {
                        lat: 0,
                        lng: 0
                    }, // Initial center, will update dynamically
                });

                // Check if `locations` is available globally
                if (typeof locations !== "undefined" && locations.length > 0) {
                    const bounds = new google.maps.LatLngBounds();

                    locations.forEach(location => {
                        const marker = new google.maps.Marker({
                            position: {
                                lat: parseFloat(location.latitude),
                                lng: parseFloat(location.longitude)
                            },
                            map: map,
                            title: location.name,
                        });

                        const infoWindow = new google.maps.InfoWindow({
                            content: `<h3>${location.name}</h3><p>${location.address}</p>`,
                        });

                        marker.addListener("click", () => {
                            infoWindow.open(map, marker);
                        });

                        bounds.extend(marker.getPosition());
                    });

                    map.fitBounds(bounds); // Adjust the map to fit all markers
                } else {
                    console.error("No locations available for the map.");
                }
            }


            window.onload = initMap;
        </script>