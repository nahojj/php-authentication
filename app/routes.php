<?php
    /*
     * Get all our routes.
     *
     */

    // Home
    require INC_ROOT . '/app/routes/home.php';
    // Register
    require INC_ROOT . '/app/routes/auth/register.php';
    // Login
    require INC_ROOT . '/app/routes/auth/login.php';
    // Activate
    require INC_ROOT . '/app/routes/auth/activate.php';
    // Log Out
    require INC_ROOT . '/app/routes/auth/logout.php';
    // User Profile
    require INC_ROOT . '/app/routes/user/profile.php';
    // List users
    require INC_ROOT . '/app/routes/user/all.php';
?>
