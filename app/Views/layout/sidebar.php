<?php

use App\Helpers\authHelpers;
use App\Libraries\menuList;

$menus = menuList::getMenu(authHelpers::getRole());
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">PT Hegar Mulya</div>
    </a>



    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php foreach ($menus as $menuitem) :  ?>
        <li class="nav-item <?= $menu === $menuitem['activeTrigger'] ? 'active' : ''; ?>">
            <a class="nav-link" href="/<?= $menuitem['menuTarget']; ?>">
                <i class="fas <?= $menuitem['menuIcon']; ?>"></i>
                <span><?= $menuitem['menuName']; ?></span></a>
        </li>
    <?php endforeach; ?>

</ul>
<!-- End of Sidebar -->