<?php

// Determine current page from URL parameter, default to 'home'
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';

// Query menu items from the database using dbConnect() from functions.php
$dbNav = dbConnect("cms");
$navSql = "SELECT `location`, `title`, `status` FROM `menu` WHERE `status` = 'active' order by `position` asc";
$navResult = $dbNav->query($navSql) or die("<h3>Error loading navigation:</h3> " . $dbNav->error);

echo '<div class="btn-group font-sans" style="margin-top: 30px; margin-bottom: 25px; display: flex; flex-wrap: wrap; gap: 5px;">';

while ($navRow = $navResult->fetch_array(MYSQLI_ASSOC)) {
    $loc = $navRow['location'];
    $title = $navRow['title'];
    
    // Check if this menu item corresponds to the current page to apply active styling
    $isActive = ($currentPage == $loc);
    $activeStyle = $isActive ? ' style="background-color: #bb9e7d; color: #fff;"' : '';
    $activeClass = $isActive ? ' active' : '';

    echo '<a href="index.php?page=' . htmlspecialchars($loc) . '" class="btn btn-rabbit btn-sm' . $activeClass . '"' . $activeStyle . '>' . htmlspecialchars($title) . '</a>';
}

echo '</div>';
?>