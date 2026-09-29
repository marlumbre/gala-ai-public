<main class="main-content">
    <div class="main-content">
        <div class="welcome-container">
            <h2 class="welcome-header">Welcome, <?= $this->session->userdata('username'); ?>!</h2>
            <p class="welcome-text">Here is today's brief overview of data for the queue.</p>
        </div>
    </div>
</main>

<div class="container-fluid animate-from-bottom ">
    <div class="main-container  d-flex justify-content-center align-items-center">
        <div class="title-card">
            <div class="metrics">
                <div class="metric mt-served">&nbsp;
                    <i class="fas fa-users metric-icon" style="font-size: 2.5rem; color: white; margin-bottom: 10px;"></i>
                    <div class="metric-content">
                        <h3>Users</h3>
                        <p><b><?= $totalUsers; ?></b></p>
                    </div>
                </div>
                <div class="metric mt-show">&nbsp;
                    <i class="fas fa-clock-rotate-left metric-icon" style="font-size: 2.5rem; color: white; margin-bottom: 10px;"></i>
                    <div class="metric-content">
                        <h5>Most Searched</h5>
                        <p><b><?= $mostSearched; ?></b></p>
                    </div>
                </div>
                <div class="metric mt-queue">&nbsp;
                    <i class="fas fa-user-clock metric-icon" style="font-size: 2.5rem; color: white; margin-bottom: 10px;"></i>
                    <div class="metric-content">
                        <h3>Users</h3>
                        <p><b><?= $totalUsers; ?></b></p>
                    </div>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>