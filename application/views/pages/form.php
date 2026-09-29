<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        font-family: Arial, sans-serif;
    }

    .modal {
        position: fixed;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        top: -100%;
        opacity: 0;
        transition: top 0.2s, opacity 0.2s;
    }

    .modal.show {
        top: 0;
        opacity: 1;
    }

    .fullscreen-container {
        height: 100vh;
        width: 100vw;
        display: flex;
        /*flex-direction: column;*/
    }

    .top-bar {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding: 10px;
        background: transparent;
        z-index: 9999;
        display: flex;
        justify-content: flex-end;
        pointer-events: none;
    }

    .top-bar>* {
        pointer-events: auto;
    }


    .content-box {
        flex: 1;
        display: flex;
        position: relative;
    }

    #places-list {
        width: 30%;
        max-width: 100%;
        max-height: 100%;
        overflow-y: auto;
        padding: 10px;
        background: #fff;
        border-right: 1px solid #ccc;
        z-index: 1;
    }

    .container {
        padding: 20px;
    }

    .container .header .title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .form-select,
    .form-control {
        background-color: rgba(255, 255, 255, 0.8);
        color: #000;
    }

    .btn-secondary {
        background-color: rgba(0, 123, 255, 0.7);
        color: white;
        border: none;
    }

    #map {
        /*margin-top: 20px;*/
        width: 70%;
        border-radius: 10px;
        flex: 1;
        height: 100%;
    }

    #resultsSpinner {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, 0.75);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    #resultsSpinner.d-none {
        display: none;
    }

    #dateModal {
        overflow: hidden;
    }

    .modal-dialog .modal-lg {
        max-height: 80%;
    }

    #date {
        max-width: 90%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    .fc .fc-button {
        background-color: #fff !important;
        outline: none !important;
        color: black !important;
        border-radius: 6px !important;
        border: none !important;
        transition: 0.3s;
    }

    .fc .fc-button:hover {
        background-color: #292878 !important;
        color: white !important;
    }

    .fc-toolbar-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .fc-daygrid-day-number {
        text-decoration: none !important;
        color: inherit !important;
        pointer-events: none;
    }

    .fc-col-header-cell {
        background-color: rgba(41, 40, 120, 1) !important;
        color: white !important;
    }

    .fc-col-header-cell a {
        text-decoration: none !important;
        color: inherit !important;
        pointer-events: none;
    }

    .fc-daygrid-day {
        transition: 0.3s;
        cursor: pointer;
    }

    .fc-daygrid-day:hover {
        background-color: #f1f1f1 !important;
    }

    .fc-day-today {
        color: white !important;
        background: rgba(41, 40, 120, 0.75) !important;
        border-radius: 8px;
    }

    .fc-day-today:hover {
        color: black !important;
        background: rgba(41, 40, 120, 0.25) !important;
        border-radius: 8px;
    }

    .selected-date {
        background: linear-gradient(135deg, #007bff, #00c6ff) !important;
        color: white !important;
        font-weight: bold;
        border-radius: 8px;
    }

    .fc-event {
        background-color: #292878 !important;
        color: white !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 4px 6px;
        font-size: 0.9rem;
    }

    .selected-date-range {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.5), rgba(0, 198, 255, 0.5)) !important;
        color: white !important;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s ease-in-out;
    }
</style>

<!-- Spinner Start -->
<!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> -->
<!-- Spinner End -->

<br><br><br><br><br>
<div class="fullscreen-container">
    <div class="top-bar">
        <a href="<?= base_url('Home') ?>" class="btn btn-secondary">Back</a>
    </div>

    <form id="preferenceForm" class="content-box">
        <div id="resultsSpinner" class="d-none">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div id="places-list"></div>
        <div id="map"></div>
</div>

<!-- add modal -->
<div class="modal" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calendarModalLabel">Add to Calendar</h5>
                <button onclick="modalToggle();" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="calendar"></div>
                <input type="hidden" id="calendarDate">
                <input type="hidden" id="calendarData">
            </div>
            <div class="modal-footer">
                <button onclick="modalToggle()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveToCalendar" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="resultsModal" tabindex="-1" aria-labelledby="resultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultsModalLabel">Recommendations</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body" style="display: flex">

                <div id="resultsSpinner" class="d-none position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex align-items-center justify-content-center" style="z-index: 1051;">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>


                <div id="places-list" style="max-height: 500px; overflow-y: auto; padding: 10px; width: 300px;"></div>
                <div id="map" style="height: 500px; width: 100%;"></div>

            </div>
            <div class="modal-footer">
                <a href="<?= base_url('Booking') ?>"><button type="button" class="btn btn-secondary">Close</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header m-5">
                <h5 class="modal-title text-center w-100" id="locationModalLabel">Where do you wanna go?</h5>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="user-details">
                    <div class="input-box mb-3 text-center">
                        <span class="details">Province</span>
                        <select id="province" name="province" class="form-select" required>
                            <option value="" selected disabled>Select Province</option>
                            <?php foreach ($province as $prov) { ?>
                                <option value="<?= htmlspecialchars($prov['value']) ?>"><?= htmlspecialchars($prov['value']) ?></option>
                            <?php } ?>
                        </select>

                        <input type="text" id="country" placeholder="Enter country" value="Philippines" disabled required hidden>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="countModal" tabindex="-1" aria-labelledby="countModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header m-5">
                <button id="prevModalProv" class="btn btn-primary" style="flex: start;">Back</button>
                <h5 class="modal-title text-center w-100" id="countModalModal">Who's coming?</h5>
                <button id="nextModalPlace" class="btn btn-primary">Next</button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="place-details">
                    <div class="input-box mb-3">
                        <div class="btn-group" role="group" aria-label="Selectable People Count">
                            <?php foreach ($counts as $count) { ?>
                                <button type="button" class="btn btn-outline-primary toggle-btn" data-value="<?= htmlspecialchars($count['value']) ?>"><?= htmlspecialchars($count['value']) ?></button>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="selected_counts" id="selectedCounts" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal" id="placeModal" tabindex="-1" aria-labelledby="placeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header m-5">
                <button id="prevModalCount" class="btn btn-primary" style="flex: start;">Back</button>
                <h5 class="modal-title text-center w-100" id="placeModalLabel">Where do you wanna go?</h5>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="place-details">
                    <div class="input-box mb-3">
                        <span class="details">Place</span>
                        <select id="place" name="place" class="form-select" required>
                            <option value="" selected disabled>Select Place</option>
                            <?php foreach ($places as $place) { ?>
                                <option value="<?= htmlspecialchars($place['value']) ?>"><?= htmlspecialchars($place['value']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button id="prevModalPlace" class="btn btn-primary" style="flex: start;">Back</button>
                <h5 class="modal-title text-center w-100" id="dateModalLabel">Set the dates!</h5>
                <button type="button" id="nextModal" class="btn btn-primary" data-bs-dismiss="modal">Next</button>
            </div>
            <div class="modal-body">
                <div id="date"></div>

                <input type="hidden" id="start_date" name="start_date">
                <input type="hidden" id="end_date" name="end_date">
                <input type="hidden" id="total_days" name="total_days">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal" id="preferredModal" tabindex="-1" aria-labelledby="preferredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header m-5">
                <h5 class="modal-title text-center w-100" id="preferredModalLabel">Where do you wanna go?</h5>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="place-details">
                    <div class="input-box">
                        <span class="details">Budget</span>
                        <input type="text" id="budget" name="budget" class="form-control">
                        <!-- <select id="busget" name="budget" class="form-select">
                <option value="" selected disabled>Please Select</option>
                <?php foreach ($budgets as $budget) { ?>
                  <option value="<?= htmlspecialchars($budget['value']) ?>"><?= htmlspecialchars($budget['value']) ?></option>
                <?php } ?>
              </select> -->
                    </div>

                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Go</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Message -->
<div id="alertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 2000;"></div>

<!-- Itinerary Modal -->
<div class="modal fade" id="itineraryModal" tabindex="-1" aria-labelledby="itineraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="itineraryModalLabel">Your Personalized Itinerary</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="itineraryContent">
                <!-- Itinerary HTML injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit Info</button>
                <button type="button" class="btn btn-success" id="continueToRecommendations">
                    Continue to Recommendations
                </button>
            </div>
        </div>
    </div>
</div>


<!-- <div id="miniMap" style="
    position: absolute;
    bottom: 20px;
    right: 20px;
    width: 300px;
    height: 200px;
    border: 2px solid #ccc;
    z-index: 9999;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    border-radius: 10px;
    overflow: hidden;
"></div> -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?= $maps ?>&loading=async&libraries=maps,places,marker&callback=initMap"
    defer></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let locationModalEl = document.getElementById("locationModal");
        let dateModalEl = document.getElementById("dateModal");
        let placeModalEl = document.getElementById("placeModal");
        let preferredModalEl = document.getElementById("preferredModal");
        let countModalEl = document.getElementById("countModal");

        let locationModal = new bootstrap.Modal(locationModalEl, {
            keyboard: false,
            backdrop: 'static'
        });
        let dateModal = new bootstrap.Modal(dateModalEl, {
            keyboard: false,
            backdrop: 'static'
        });
        let placeModal = new bootstrap.Modal(placeModalEl, {
            keyboard: false,
            backdrop: 'static'
        });
        let preferredModal = new bootstrap.Modal(preferredModalEl, {
            keyboard: false,
            backdrop: 'static'
        });
        let countModal = new bootstrap.Modal(countModalEl, {
            keyboard: false,
            backdrop: 'static'
        });

        let selectedStartDate = null;
        let selectedEndDate = null;

        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));

                this.classList.add('active');
            });
        });

        locationModal.show();

        function removeBackdrops() {
            document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());
        }

        document.getElementById("province").addEventListener("change", function() {
            if (this.value) {
                locationModalEl.addEventListener("hidden.bs.modal", function() {
                    countModal.show();
                }, {
                    once: true
                });

                locationModal.hide();
            }
        });

        document.getElementById("nextModalPlace").addEventListener("click", function() {
            countModalEl.addEventListener("hidden.bs.modal", function() {
                placeModal.show();
            }, {
                once: true
            });

            countModal.hide();
        });

        document.getElementById("prevModalProv").addEventListener("click", function() {
            countModalEl.addEventListener("hidden.bs.modal", function() {
                locationModal.show();
            }, {
                once: true
            });

            countModal.hide();
        });

        document.getElementById("prevModalCount").addEventListener("click", function() {
            placeModalEl.addEventListener("hidden.bs.modal", function() {
                countModal.show();
            }, {
                once: true
            });

            placeModal.hide();
        });

        document.getElementById("prevModalPlace").addEventListener("click", function() {
            dateModalEl.addEventListener("hidden.bs.modal", function() {
                placeModal.show();
            }, {
                once: true
            });

            dateModal.hide();
        });

        document.getElementById("place").addEventListener("change", function() {
            if (this.value) {
                placeModalEl.addEventListener("hidden.bs.modal", function() {
                    dateModal.show();

                    setTimeout(() => {
                        let calendarEl = document.getElementById("date");

                        let calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            selectable: true,
                            headerToolbar: {
                                left: 'title',
                                center: '',
                                right: 'prev,next'
                            },
                            events: function(fetchInfo, successCallback, failureCallback) {
                                $.ajax({
                                    url: '<?= base_url('Recommendations/get_places_db') ?>',
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(response) {
                                        successCallback(response.data);
                                    },
                                    error: function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Something went wrong!',
                                            confirmButtonText: 'OK',
                                        });
                                    }
                                });
                            },
                            eventDidMount: function(info) {
                                new bootstrap.Tooltip(info.el, {
                                    title: info.event.extendedProps.description,
                                    placement: "top",
                                    trigger: "hover",
                                    container: "body"
                                });
                            },
                            dateClick: function(info) {
                                let clickedDate = new Date(info.dateStr);
                                let today = new Date();
                                today.setHours(0, 0, 0, 0); // Remove time part to compare only date

                                if (clickedDate <= today) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Invalid Date',
                                        text: 'You cannot select a date before today.',
                                        confirmButtonText: 'OK'
                                    });
                                    return;
                                }

                                if (!selectedStartDate) {
                                    selectedStartDate = clickedDate;
                                    selectedEndDate = null;
                                } else if (clickedDate >= selectedStartDate) {
                                    if (clickedDate <= selectedEndDate) {
                                        selectedStartDate = clickedDate;
                                        selectedEndDate = null;
                                    } else {
                                        selectedEndDate = clickedDate;
                                    }
                                } else {
                                    selectedStartDate = clickedDate;
                                    selectedEndDate = null;
                                }

                                highlightDateRange(calendar, selectedStartDate, selectedEndDate);

                                const formatDate = date => date.toISOString().split('T')[0];

                                if (selectedStartDate) {
                                    $('#start_date').val(formatDate(selectedStartDate));
                                }

                                if (selectedStartDate && selectedEndDate) {
                                    $('#end_date').val(formatDate(selectedEndDate));

                                    const diffTime = Math.abs(selectedEndDate - selectedStartDate);
                                    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
                                    $('#total_days').val(diffDays);
                                } else {
                                    $('#end_date').val('');
                                    $('#total_days').val('');
                                }
                            }
                        });

                        calendar.render();
                    }, 200);
                }, {
                    once: true
                });

                placeModal.hide();
            }
        });

        // document.getElementById("nextModal").addEventListener("click", function () {
        //     dateModalEl.addEventListener("hidden.bs.modal", function () {
        //         preferredModal.show();
        //     }, { once: true });

        //     dateModal.hide();
        // });

        document.getElementById("nextModal").addEventListener("click", function() {
            dateModal.hide();

            setTimeout(() => {
                var event = new Event("hidden.bs.modal", {
                    bubbles: true,
                    cancelable: false
                });
                dateModalEl.dispatchEvent(event);
            }, 100);
        });

        dateModalEl.addEventListener("hidden.bs.modal", function() {
            preferredModal.show();
        }, {
            once: true
        });

        function highlightDateRange(calendar, startDate, endDate) {
            document.querySelectorAll('.fc-daygrid-day').forEach(day => day.classList.remove('selected-date-range'));

            if (!startDate) return;

            let rangeStart = startDate.toISOString().split("T")[0];
            let rangeEnd = endDate ? endDate.toISOString().split("T")[0] : rangeStart;

            document.querySelectorAll('.fc-daygrid-day').forEach(day => {
                let date = day.getAttribute("data-date");
                if (date >= rangeStart && date <= rangeEnd) {
                    day.classList.add('selected-date-range');
                }
            });
        }

        locationModalEl.addEventListener("hidden.bs.modal", function() {
            locationModalEl.classList.remove("show");
            document.body.classList.remove("modal-open");
            removeBackdrops();
        });

        placeModalEl.addEventListener("hidden.bs.modal", function() {
            placeModalEl.classList.remove("show");
            document.body.classList.remove("modal-open");
            removeBackdrops();
        });

        function validatePositiveNumber(input) {
            let value = input.val().replace(/[^0-9]/g, '');

            if (value === '' || parseInt(value) <= 0) {
                value = '';
            }

            input.val(value);
        }

        $('#budget, #total_guest').on('input', function() {
            validatePositiveNumber($(this));
        });

        let retryCount = 0;

        $('#preferenceForm').on('submit', function(e) {
            e.preventDefault();

            let province = $('#province').val();
            let place = $('#place').val();
            let budget = $('#budget').val();
            let total_days = $('#total_days').val();
            // const activeBtn = document.querySelector('.toggle-btn.active');
            // const total_guest = activeBtn ? activeBtn.textContent.trim() : '';

            const total_guest = $('#guest-count-group .toggle-btn.active').text().trim() || '';


            if (!province || !place) {
                alert('Please fill out all fields before submitting.');
                return;
            }

            // $('#resultsModal').modal('show');
            $('#places-list').html(`
        <div id="loadingSpinner" class="text-center my-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Fetching your personalized itinerary...</p>
        </div>
`);


            // $.ajax({
            //     url: "<?= base_url('Home/show_itinerary') ?>",
            //     type: "POST",
            //     data: {
            //         location: province,
            //         total_days: total_days,
            //         place: place,
            //         total_guest: total_guest
            //     },
            //     dataType: 'json',
            //     success: function(response) {
            //         if (response.status === 'success') {
            //             $('#itineraryContent').html(response.html);
            //             $('#itineraryModal').modal('show');

            //             $('#continueToRecommendations').off('click').on('click', function() {
            //                 $('#itineraryModal').modal('hide');
            //                 submitForm();
            //             });
            //         } else {
            //             alert("No itinerary found.");
            //             submitForm();
            //         }
            //     },
            //     error: function() {
            //         alert("Error loading itinerary.");
            //         submitForm();
            //     }
            // });

            $.ajax({
                url: "<?= base_url('Home/show_itinerary') ?>",
                type: "POST",
                data: {
                    location: province,
                    total_days: total_days,
                    place: place,
                    total_guest: total_guest
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#continueToRecommendations').prop('disabled', true);
                    $('#loadingSpinner').removeClass('d-none');
                },
                success: function(response) {
                    $('#loadingSpinner').addClass('d-none');
                    $('#continueToRecommendations').prop('disabled', false);

                    if (response.status === 'success') {
                        $('#itineraryContent').html(response.html);
                        $('#itineraryModal').modal('show');

                        $('#continueToRecommendations').off('click').on('click', function() {
                            $('#itineraryModal').modal('hide');
                            submitForm();
                        });
                    } else {
                        showAlert("warning", "No itinerary found. Redirecting...");
                        setTimeout(() => submitForm(), 1500);
                    }
                },
                error: function() {
                    $('#loadingSpinner').addClass('d-none');
                    $('#continueToRecommendations').prop('disabled', false);
                    showAlert("danger", "Error loading itinerary. Redirecting...");
                    setTimeout(() => submitForm(), 1500);
                }
            });


            let retryCount = 0;

            function submitForm() {
                $('#resultsSpinner').removeClass('d-none');

                $.ajax({
                    url: "<?= base_url('Recommendations/query') ?>",
                    type: "POST",
                    data: {
                        province: province,
                        place: place,
                        budget: budget ?? '',
                        total_guest: total_guest ?? ''
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let resultsHtml = '<ul class="list-group">';
                            let placesListHtml = '<ul class="list-group">';

                            response.data.forEach(function(item) {
                                // resultsHtml += `
                                //     <li class="list-group-item">
                                //         <h5>${item.name}</h5>
                                //         <p><strong>Type:</strong> ${item.type}</p>
                                //         <p>${item.lat}</p>
                                //         <p>${item.lng}</p>
                                //         <a class="btn btn-primary" href="https://www.google.com/search?q=${encodeURIComponent(item.name)}" target="_blank">View Photos</a>
                                //         <button class="btn btn-primary mt-2">Make an Itinerary</button>
                                //     </li>
                                // `;

                                // resultsHtml += `
                                //     <li class="list-group-item">
                                //         <h5>${item.name}</h5>
                                //         <p><strong>Type:</strong> ${item.type}</p>
                                //         <p><strong>Location:</strong> ${item.location}</p>
                                //         <p>${item.description}</p>
                                //         <a class="btn btn-primary" href="https://www.google.com/search?q=${encodeURIComponent(item.name)}" target="_blank">View Photos</a>
                                //         <button class="btn btn-primary mt-2">Make an Itinerary</button>
                                //     </li>
                                // `;

                                placesListHtml += `
                            <li class="list-group-item place-item" data-lat="${item.lat}" data-lng="${item.lng}" style="cursor:pointer;">
                                <h5>${item.name}</h5>
                                <p><strong>Type:</strong> ${item.type}</p>
                                <p>${item.description}</p>
                                <a class="btn btn-primary" href="https://www.google.com/search?sca_esv=acc27629dfc230bb&sxsrf=AHTn8zqGpXW8e7uXk8_PqUoHtH9WvuEVDg:1746793836254&q=${encodeURIComponent(item.name)}&udm=2&fbs=ABzOT_CWdhQLP1FcmU5B0fn3xuWpA-dk4wpBWOGsoR7DG5zJBv10Kbgy3ptSBM6mMfaz8zDVX4b2W1tiDkb3uUgOX2bJ2QzqY7YDtO8TAA8HVJ835OEfAs0h1UaFvNoGY0SwrCcezhAGVmh_pDTiUuthS2Er5Qd7EoZu0_jND2l9Eouaz4DdATwllkGYsDxTp-MwVXdShrTGCzONq7uk3823XHqvNfqM3A&sa=X&ved=2ahUKEwjmiOyQspaNAxUN1zgGHQbBCZ0QtKgLegQIFhAB" target="_blank">View Photos</a>
                            </li>
                        `;
                            });

                            // resultsHtml += '</ul>';
                            // resultsHtml += `
                            //     <p class="disclaimer" style="font-size: 0.8em; color: #666;">
                            //         <strong>Disclaimer:</strong> The budget and accommodation details provided are estimates only. For accuracy, check official pages.
                            //     </p>
                            // `;

                            placesListHtml += '</ul>';

                            // $('#results').html(resultsHtml);
                            $('#places-list').html(placesListHtml);

                            $('.place-item').on('click', function() {
                                const lat = parseFloat($(this).data('lat'));
                                const lng = parseFloat($(this).data('lng'));
                                const name = $(this).text();
                                const category = $(this).data('type');

                                const position = {
                                    lat: lat,
                                    lng: lng
                                };
                                const add = $(this).data('address');

                                // function panToPositionSmoothly(latLng, targetZoom, delay) {

                                //     map.setZoom(targetZoom);

                                //     setTimeout(() => {
                                //         map.panTo(latLng);
                                //         map.setZoom(13);
                                //     }, delay);
                                // }

                                const geocoder = new google.maps.Geocoder();

                                function panToPositionSmoothly(name, targetZoom, delay) {
                                    geocoder.geocode({
                                        address: name
                                    }, function(results, status) {
                                        if (status === "OK") {
                                            const location = results[0].geometry.location;

                                            const distance = google.maps.geometry.spherical.computeDistanceBetween(
                                                new google.maps.LatLng(userLocation),
                                                location
                                            );

                                            let zoomOutLevel = 8;
                                            if (distance < 10000) zoomOutLevel = 15;
                                            else if (distance < 25000) zoomOutLevel = 13;
                                            else if (distance < 50000) zoomOutLevel = 11;
                                            else if (distance < 150000) zoomOutLevel = 9;
                                            else if (distance < 300000) zoomOutLevel = 7;
                                            else if (distanve < 450000) zoomOutLevel = 5;
                                            else zoomOutLevel = 6;

                                            map.setZoom(zoomOutLevel);

                                            function drawRoute(from, to) {
                                                const request = {
                                                    origin: from,
                                                    destination: to,
                                                    travelMode: google.maps.TravelMode.DRIVING
                                                };

                                                directionsService.route(request, (result, status) => {
                                                    if (status === google.maps.DirectionsStatus.OK) {
                                                        directionsRenderer.setOptions({
                                                            suppressMarkers: true,
                                                            preserveViewport: true
                                                        });
                                                        directionsRenderer.setDirections(result);

                                                        const route = result.routes[0].legs[0];
                                                        const distance = route.distance.text;
                                                        const duration = route.duration.text;

                                                        const infoBox = document.createElement('div');
                                                        infoBox.innerHTML = `
                                                        <div style="background: white; padding: 10px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.3);">
                                                            <strong>Distance:</strong> ${distance}<br>
                                                            <strong>Estimated Time:</strong> ${duration}
                                                        </div>
                                                        `;

                                                        infoBox.style.position = 'absolute';
                                                        infoBox.style.top = '10%';
                                                        infoBox.style.left = '35%';
                                                        infoBox.style.zIndex = '9999';

                                                        const existing = document.getElementById('distance-duration-box');
                                                        if (existing) existing.remove();

                                                        infoBox.id = 'distance-duration-box';
                                                        document.body.appendChild(infoBox);

                                                        const miniMapContainer = document.getElementById("miniMap");
                                                        miniMapContainer.style.display = "block";

                                                        const miniMap = new google.maps.Map(miniMapContainer, {
                                                            zoom: 13,
                                                            center: result.routes[0].overview_path[0],
                                                            disableDefaultUI: true,
                                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                                        });

                                                        const miniDirectionsRenderer = new google.maps.DirectionsRenderer({
                                                            map: miniMap,
                                                            suppressMarkers: false,
                                                            preserveViewport: false
                                                        });

                                                        miniDirectionsRenderer.setDirections(result);
                                                    } else {
                                                        console.error("Directions request failed:", status);
                                                    }
                                                });
                                            }

                                            drawRoute(userLocation, location);

                                            google.maps.event.addListenerOnce(map, 'tilesloaded', () => {
                                                setTimeout(() => {
                                                    map.panTo(location);

                                                    setTimeout(() => {
                                                        map.setZoom(targetZoom);

                                                        new google.maps.Marker({
                                                            map: map,
                                                            position: location,
                                                            title: name
                                                        });
                                                    }, 1000);
                                                }, delay);
                                            });
                                        } else {
                                            console.error("Geocode was not successful for the following reason: " + status);
                                        }
                                    });
                                }

                                panToPositionSmoothly(name, 15, 1500);
                                // searchNearbyCategory(position, category);
                                // google.maps.event.trigger(marker, 'click');
                                // marker.addListener('click', () => {
                                //     const position = marker.getPosition();
                                //     searchNearbyCategory(position, 'restaurant');
                                //     map.setCenter(position);
                                // });

                                if (window.selectedMarker) {
                                    window.selectedMarker.setMap(null);
                                }

                                window.selectedMarker = new google.maps.Marker({
                                    position: position,
                                    map: map,
                                    title: name
                                });
                            });

                            $('#resultsSpinner').addClass('d-none');
                        } else {
                            retryCount++;
                            if (retryCount < 5) {
                                setTimeout(submitForm, 2000);
                                $('#resultsSpinner').addClass('d-none');
                            } else {
                                $('#resultsSpinner').addClass('d-none');
                                $('#places-list').html('<p>Your AI Travel Assistant can\'t find any recommendations at the moment. Please try again later.</p>');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#places-list').html('<p style="color: red;">An error occurred. Please try again.</p>');
                        console.error(error);
                    }
                });
            }
        });

        $('#saveDates').on('click', function() {
            const itemDataString = $('#calendarData').val();
            const itemData = JSON.parse(itemDataString);

            if (!selectedDate) {
                alert('Please select a date from the calendar.');
                return;
            }

            const requestData = {
                name: itemData.name,
                type: itemData.type,
                location: itemData.location,
                description: itemData.description,
                dateStart: selectedStartDate,
                dateEnd: selectedEndDate
            };

            $.ajax({
                url: '<?= base_url('Recommendations/save') ?>',
                type: 'POST',
                data: requestData,
                success: function(response) {
                    response = JSON.parse(response)
                    console.log(response)
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Place saved successfully!',
                            confirmButtonText: 'OK',
                        });
                        calendar.refetchEvents();
                        $('#calendarModal').modal('hide');
                        $('#resultsModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            confirmButtonText: 'OK',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        confirmButtonText: 'OK',
                    });
                }
            });
        });
    });
</script>

<script>
    let map;
    let markers = [];
    let userLocation;
    let directionsService;
    let directionsRenderer;

    function initMap() {
        const fallbackCenter = {
            lat: 13.41,
            lng: 122.56
        };

        map = new google.maps.Map(document.getElementById("map"), {
            center: fallbackCenter,
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            styles: [{
                featureType: "all",
                elementType: "labels",
                stylers: [{
                    visibility: "off"
                }]
            }]
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map.setCenter(userLocation);
                    map.setZoom(13);

                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "You are here"
                    });
                },
                () => console.warn("Geolocation failed. Using fallback.")
            );
        }

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            suppressMarkers: false,
            map: map
        });
    }

    const service = new google.maps.places.PlacesService(map);

    function searchNearbyCategory(markerPosition, category) {
        const request = {
            location: markerPosition,
            radius: 1000,
            type: [category]
        };

        service.nearbySearch(request, (results, status) => {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                results.forEach((place) => {
                    new google.maps.Marker({
                        map: map,
                        position: place.geometry.location,
                        title: place.name,
                        icon: {
                            url: place.icon,
                            scaledSize: new google.maps.Size(25, 25)
                        }
                    });
                });
            } else {
                console.error("Nearby search failed: " + status);
            }
        });
    }
</script>