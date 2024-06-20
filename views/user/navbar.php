<!-- views/user/navbar.php -->

<nav class="top-bar" data-topbar role="navigation">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">User Panel</li>
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=dashboard">Dashboard</a></li>
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=browseVideos">Browse Videos</a></li>
            <!-- Add more links as needed -->
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <li><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=logout">Logout</a></li>
        </ul>
    </div>
</nav>

<style>
    .top-bar {
        background-color: #2c3e50;
    }
    .top-bar .menu-text, .top-bar a {
        color: #ecf0f1;
    }
    .top-bar a:hover {
        background-color: #34495e;
        color: #ecf0f1;
    }
    .top-bar-right .menu a {
        color: #ecf0f1;
    }
</style>
