<!--
  Pawsitive Placements
  
  @file       view/header.php
  @author     Lindsey D. Stead
  @date       November 7, 2025
  @description Shared page header component. Includes navigation, logo, and
                global CSS/JS assets. Used across all pages for consistent branding.
-->
<?php
// Determine the base path based on where the header is being included from
// If we're in the root directory, use empty string, otherwise use ../
$base_path = (strpos($_SERVER['PHP_SELF'], '/view/') === false && strpos($_SERVER['PHP_SELF'], '/user/') === false && strpos($_SERVER['PHP_SELF'], '/admins/') === false && strpos($_SERVER['PHP_SELF'], '/pet-rehome/') === false && strpos($_SERVER['PHP_SELF'], '/contact/') === false && strpos($_SERVER['PHP_SELF'], '/application/') === false && strpos($_SERVER['PHP_SELF'], '/forum/') === false && strpos($_SERVER['PHP_SELF'], '/about/') === false && strpos($_SERVER['PHP_SELF'], '/pets/') === false && strpos($_SERVER['PHP_SELF'], '/errors/') === false && strpos($_SERVER['PHP_SELF'], '/api/') === false) ? '' : '../';

// Determine login status and user information
global $username, $logged_in, $is_admin;

// Check if user is logged in
if (isset($_SESSION['is_valid_user']) && $_SESSION['is_valid_user']) {
    $logged_in = true;
    $is_admin = false;
    // Get user name from session or database
    if (isset($_SESSION['user_id'])) {
        require_once(__DIR__ . '/../model/users_db.php');
        $user = get_user_by_id($_SESSION['user_id']);
        $username = $user['name'] ?? 'User';
    } else {
        $username = 'User';
    }
} elseif (isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin']) {
    $logged_in = true;
    $is_admin = true;
    $username = $_SESSION['admin_first_name'] ?? 'Admin';
} else {
    $logged_in = false;
    $is_admin = false;
    $username = null;
}
?>
<header class="bg-light shadow-sm sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo $base_path; ?>index.php">
                <img src="<?php echo $base_path; ?>images/logo.png" alt="Pawsitive Placements Logo" class="logo-img mr-2">
                <span class="d-none d-md-inline h4 m-0 text-dark font-weight-bold">Pawsitive Placements</span>
                <span class="d-md-none h5 m-0 text-dark font-weight-bold">Pawsitive</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>index.php">
                            <i class="fas fa-home mr-1 text-primary"></i><span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>about/about.php">
                            <i class="fas fa-info-circle mr-1 text-primary"></i><span>About Us</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>pets/index.php">
                            <i class="fas fa-paw mr-1 text-primary"></i><span>View Pets</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>pet-rehome/index.php">
                            <i class="fas fa-heart mr-1 text-primary"></i><span>Rehome Pet</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>forum/index.php">
                            <i class="fas fa-comments mr-1 text-primary"></i><span>Forum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>contact/index.php">
                            <i class="fas fa-envelope mr-1 text-primary"></i><span>Contact Us</span>
                        </a>
                    </li>
                </ul>
                <!-- User/Login Section - Top Right -->
                <ul class="navbar-nav ml-auto">
                    <?php if ($logged_in): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-<?php echo $is_admin ? 'user-shield' : 'user'; ?> mr-2 text-primary"></i>
                                <span class="d-none d-md-inline"><?php echo htmlspecialchars($username); ?></span>
                                <?php if ($is_admin): ?>
                                    <span class="badge badge-primary ml-2 d-none d-md-inline">Admin</span>
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo $base_path; ?>user/index.php"><i class="fas fa-user mr-2"></i>My Account</a>
                                <?php if ($is_admin): ?>
                                    <a class="dropdown-item" href="<?php echo $base_path; ?>admins/index.php"><i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?php echo $is_admin ? $base_path . 'admins/index.php?action=logout' : $base_path . 'user/index.php?action=logout'; ?>"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>user/index.php?action=display_login"><i class="fas fa-sign-in-alt mr-1 text-primary"></i><span class="d-none d-md-inline">Login</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>user/create_account.php"><i class="fas fa-user-plus mr-1 text-primary"></i><span class="d-none d-md-inline">Sign Up</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-semibold text-dark" href="<?php echo $base_path; ?>admins/index.php?action=display_login" title="Admin Login"><i class="fas fa-shield-alt mr-1 text-warning"></i><span class="d-none d-md-inline">Admin Login</span></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="navbar-highlight"></div>
</header>
