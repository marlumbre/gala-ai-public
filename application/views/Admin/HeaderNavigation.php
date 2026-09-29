<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand white-text" href="<?= base_url('Admin'); ?>">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Admin'); ?>"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Admin/users'); ?>"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Admin/option_list'); ?>"><i class="fas fa-list"></i> Option List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Admin/home_data'); ?>"><i class="fas fa-list"></i> Home Data</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="<?= base_url('Admin/logout'); ?>"><button type="submit" name="logout" class="nav-link btn btn-link">Logout <i class="fas fa-sign-out-alt"></i></button></a>
            </li>
        </ul>
    </div>
</nav>