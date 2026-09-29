<?php if ($this->session->flashdata('incorrect_error')) { ?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#portalModal').modal('show');
        });
    </script>
<?php } else if ($this->session->flashdata('mismatch_error')) { ?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#portalModal').modal('show');
        });
    </script>
<?php } else { ?>

<?php } ?>
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Profile</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('Home') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active text-white">Profile</li>
            </ol>
    </div>
</div>
<!-- Header End -->

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-4"> <a class="btn btn-danger float-end" href="<?= base_url('Logout') ?>">Logout</a></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <button data-bs-toggle="modal" data-bs-target="#profileModal"><img src="<?= base_url($imagePath); ?>" class="img-fluid rounded-start" alt="Profile Picture" /></button>
                        </div>

                        <div class="col-md-8">
                            <h5 class="card-title">Personal Information</h5>

                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" value="<?= $name; ?>" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <input type="text" class="form-control" id="gender" value="<?= $gender; ?>" readonly />
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" value="<?= $address; ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Account Status</label>
                                            <input type="text" class="form-control" id="status" value="<?= $AccountStat; ?>" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="age" value="<?= $age; ?>" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Date of Birth</label>
                                            <input type="text" class="form-control" id="status" value="<?= $birthDate; ?>" readonly />
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#accModal">
                                Edit Account Information
                            </button>

                            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#portalModal">
                                View Portal Account
                            </button>
                        </div>


                        <hr class="mt-3 mb-3">
                        <div class="col-md-2 mb-3"></div>
                        <div class="col-md-8">
                            <h5 class="card-title">Saved Places</h5>
                            <div id="calendar"></div>
                        </div>

                        <div class="modal fade" id="placeDetailsModal" tabindex="-1" aria-labelledby="placeDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="placeDetailsModalLabel">Place Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                                        <p><strong>Type:</strong> <span id="eventType"></span></p>
                                        <p><strong>Date:</strong> <span id="eventDate"></span></p>
                                        <p><strong>Location:</strong> <span id="eventLocation"></span></p>
                                        <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="portalModal" tabindex="-1" aria-labelledby="portalModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" class="modal-content" action="<?= base_url('Profile/update') ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="portalModalLabel">
                                            Portal Account Information
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="username" required name="username" value="<?= $username ?>" readonly />
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email" required name="username" value="<?= $email ?>" readonly />
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="text" class="form-control" id="password" required name="username" value="<?= $password ?>" readonly />
                                                    <input type="hidden" class="form-control" name="user_id" id="selectedUserId" value="" />
                                                </div>
                                                <div class="mb-3">
                                                    <?php if ($this->session->flashdata('incorrect_error')): ?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <?= $this->session->flashdata('incorrect_error'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <label for="oldPass" class="form-label">Old Password</label>
                                                    <input type="password" class="form-control" name="oldPass" id="oldPass" placeholder="Enter Old Password" />
                                                </div>
                                                <div class="mb-3">
                                                    <?php if ($this->session->flashdata('mismatch_error')): ?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <?= $this->session->flashdata('mismatch_error'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <label for="newPass" class="form-label">New Password</label>
                                                    <input type="password" class="form-control" name="newPass" id="newPass" required placeholder="Enter New Password" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="confirmPass" class="form-label">Confirm New Password</label>
                                                    <input type="password" class="form-control" name="confirmPass" id='"confirmPass' required placeholder="Confirm New Password" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" class="modal-content" action="<?= base_url('Profile/update_img'); ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="profileModalLabel">
                                            Change Profile
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="newPhoto"><i class="fa fa-user"></i> Upload Photo:</label>
                                                    <input type="file" id="newPhoto" name="newPhoto" class="form-control" placeholder="Add an attachment" accept="image/*" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade" id="accModal" tabindex="-1" aria-labelledby="accModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" class="modal-content" action="<?= base_url('Profile/update_acc') ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="accModalLabel">
                                            Personal Account Information
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="username" required name="username" value="<?= $username ?>" />
                                                    <label for="birthdate" class="form-label">Birth Date</label>
                                                    <input type="date" class="form-control" id="birthdate" required name="birthdate" value="<?= $birthDate ?>" />
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-control" id="gender" name="gender" required>
                                                        <?php if (is_null($gender)) { ?>
                                                            <option value="" selected disabled>Please Select</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Non-binary">Non-binary</option>
                                                        <?php } else { ?>
                                                            <option selected disabled value="<?= $gender ?>"><?= $gender ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let events = [];

        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            height: 'auto',
            initialView: 'dayGridMonth',
            selectable: true,
            events: function(fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: '../Recommendations/get_places_db',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            successCallback(response.data);
                        } else {
                            // alert('Failed to load events: ' + response.message);
                            successCallback(response.data);
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching events.');
                    }
                });
            },
            dateClick: function(info) {
                const selectedDate = info.dateStr;
                $('#calendarDate').val(selectedDate);
            },
            eventClick: function(info) {
                showEventDetails(info.event);
            }
        });

        calendar.render();

        function showEventDetails(event) {
            $('#eventTitle').text(event.title);
            $('#eventDate').text(event.start.toLocaleDateString());
            $('#eventDescription').text(event.extendedProps.description || 'No description available.');
            $('#eventLocation').text(event.extendedProps.location || 'No location available.');
            $('#eventType').text(event.extendedProps.type || 'No type available');

            $('#placeDetailsModal').modal('show');
        }
    });
</script>