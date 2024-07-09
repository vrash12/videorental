<nav class="top-bar" data-topbar role="navigation">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Admin Panel</li>
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageVideos">Manage Videos</a></li>
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageUsers">Manage Users</a></li>
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageReports">All Reports</a></li>
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=profile">Profile</a></li> 
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=logout">Logout</a></li>
        </ul>
    </div>
</nav>
