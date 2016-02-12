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
    require INC_ROOT . '/app/views/auth/activate.php';
?>
