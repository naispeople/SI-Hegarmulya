<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <div class="d-flex w-100 justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <h6 id="jam" class=" d-none d-sm-inline text-primary mr-1"></h6>
            <div class="topbar-divider d-none d-sm-block bg-primary"></div>
            <h6 id="ttl" class="text-capitalize text-primary ml-1">Kamis, 20 Juni 2022</h6>
        </div>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize"><?= session()->nama; ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url(); ?>/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('/logout'); ?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>