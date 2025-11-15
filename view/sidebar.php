<?php
/**
 * Pawsitive Placements
 * 
 * @file       view/sidebar.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Shared sidebar component for regular users. Displays login status,
 *              quick links, and user-specific navigation. Used across all user pages.
 */

// Determine login status and user information
global $username, $logged_in, $is_admin;

// Check if user is logged in
if (isset($_SESSION['is_valid_user']) && $_SESSION['is_valid_user']) {
    $logged_in = true;
    $is_admin = false;
    // Get user name from session or database
    if (isset($_SESSION['user_id'])) {
        require_once('../model/users_db.php');
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

// Determine base path for links
$base_path = (strpos($_SERVER['PHP_SELF'], '/view/') === false && strpos($_SERVER['PHP_SELF'], '/user/') === false && strpos($_SERVER['PHP_SELF'], '/admins/') === false && strpos($_SERVER['PHP_SELF'], '/pet-rehome/') === false && strpos($_SERVER['PHP_SELF'], '/contact/') === false && strpos($_SERVER['PHP_SELF'], '/application/') === false && strpos($_SERVER['PHP_SELF'], '/forum/') === false && strpos($_SERVER['PHP_SELF'], '/about/') === false && strpos($_SERVER['PHP_SELF'], '/pets/') === false && strpos($_SERVER['PHP_SELF'], '/errors/') === false && strpos($_SERVER['PHP_SELF'], '/api/') === false) ? '' : '../';
?>

<aside class="modern-sidebar">
    <!-- Login Status Section -->
    <div class="sidebar-section" style="background: <?php 
        if ($logged_in && $is_admin) {
            echo '#d1ecf1'; // Light blue for admin
        } elseif ($logged_in) {
            echo '#d4edda'; // Light green for regular user
        } else {
            echo '#fff3cd'; // Light yellow for not logged in
        }
    ?>; border-left: 4px solid <?php 
        if ($logged_in && $is_admin) {
            echo '#0066cc'; // Blue for admin
        } elseif ($logged_in) {
            echo '#28a745'; // Green for regular user
        } else {
            echo '#ffc107'; // Yellow for not logged in
        }
    ?>; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
        <?php if ($logged_in): ?>
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-<?php echo $is_admin ? 'user-shield' : 'user-check'; ?> text-<?php echo $is_admin ? 'primary' : 'success'; ?> mr-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong class="text-dark"><?php echo $is_admin ? 'Admin Logged In' : 'Logged In'; ?></strong>
                    <?php if ($is_admin): ?>
                        <span class="badge badge-primary ml-1"><i class="fas fa-shield-alt mr-1"></i>Admin</span>
                    <?php endif; ?>
                </div>
            </div>
            <p class="mb-2 text-dark" style="font-size: 0.9rem;">
                <i class="fas fa-<?php echo $is_admin ? 'user-shield' : 'user'; ?> mr-1"></i>
                <strong><?php echo htmlspecialchars($username ?? ($is_admin ? 'Admin' : 'User')); ?></strong>
            </p>
            <?php if ($is_admin): ?>
                <a href="<?php echo $base_path; ?>admins/index.php" class="btn btn-sm btn-primary btn-block mb-2">
                    <i class="fas fa-tachometer-alt mr-1"></i>Admin Dashboard
                </a>
            <?php endif; ?>
            <a href="<?php echo $is_admin ? $base_path . 'admins/index.php?action=logout' : $base_path . 'user/index.php?action=logout'; ?>" class="btn btn-sm btn-outline-danger btn-block">
                <i class="fas fa-sign-out-alt mr-1"></i>Logout
            </a>
        <?php else: ?>
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-user-times text-warning mr-2" style="font-size: 1.5rem;"></i>
                <strong class="text-dark">Not Logged In</strong>
            </div>
            <p class="mb-2 text-muted" style="font-size: 0.85rem;">Please log in to access all features</p>
            <a href="<?php echo $base_path; ?>user/index.php?action=display_login" class="btn btn-sm btn-primary btn-block mb-2">
                <i class="fas fa-sign-in-alt mr-1"></i>User Login
            </a>
            <a href="<?php echo $base_path; ?>user/create_account.php" class="btn btn-sm btn-outline-primary btn-block mb-2">
                <i class="fas fa-user-plus mr-1"></i>Sign Up
            </a>
            <a href="<?php echo $base_path; ?>admins/index.php?action=display_login" class="btn btn-sm btn-outline-warning btn-block">
                <i class="fas fa-shield-alt mr-1"></i>Admin Login
            </a>
        <?php endif; ?>
    </div>

    <!-- Quick Links Section -->
    <div class="sidebar-section">
        <h3><i class="fas fa-home mr-2"></i>Quick Links</h3>
        <ul class="sidebar-links">
            <li><a href="<?php echo $base_path; ?>index.php"><i class="fas fa-home mr-2"></i>Home</a></li>
            <li><a href="<?php echo $base_path; ?>forum/index.php"><i class="fas fa-comments mr-2"></i>Community Forum</a></li>
            <?php if ($logged_in): ?>
                <li><a href="<?php echo $base_path; ?>user/index.php"><i class="fas fa-user mr-2"></i>My Account</a></li>
                <?php if ($is_admin): ?>
                    <li><a href="<?php echo $base_path; ?>admins/index.php"><i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li><a href="<?php echo $base_path; ?>user/index.php?action=display_login"><i class="fas fa-sign-in-alt mr-2"></i>User Login</a></li>
                <li><a href="<?php echo $base_path; ?>user/create_account.php"><i class="fas fa-user-plus mr-2"></i>Create Account</a></li>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=display_login"><i class="fas fa-shield-alt mr-2"></i>Admin Login</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Quick Info Section -->
    <div class="sidebar-section">
        <h3><i class="fas fa-info-circle mr-2"></i>Quick Info</h3>
        <ul class="sidebar-info">
            <li><i class="fas fa-heart text-primary mr-2"></i><span><strong>Our Mission:</strong> To find loving homes for every pet.</span></li>
            <li><i class="fas fa-dollar-sign text-primary mr-2"></i><span><strong>Adoption Fees:</strong> Affordable fees for adopting.</span></li>
            <li><i class="fas fa-hands-helping text-primary mr-2"></i><span><strong>Volunteer:</strong> Join us in making a difference!</span></li>
        </ul>
    </div>

    <!-- Pet Care Tips Section -->
    <div class="sidebar-section">
        <h3><i class="fas fa-lightbulb mr-2"></i>Pet Care Tips</h3>
        <ul class="sidebar-tips">
            <li><i class="fas fa-check-circle text-success mr-2"></i>Regular Vet Visits</li>
            <li><i class="fas fa-check-circle text-success mr-2"></i>Proper Nutrition</li>
            <li><i class="fas fa-check-circle text-success mr-2"></i>Daily Exercise</li>
            <li><i class="fas fa-check-circle text-success mr-2"></i>Socialization</li>
        </ul>
    </div>

    <!-- Stay Connected Section -->
    <div class="sidebar-section">
        <h3><i class="fas fa-share-alt mr-2"></i>Stay Connected</h3>
        <p>Follow us on social media for updates on pets and events!</p>
        <div class="socials mt-2">
            <a href="#" aria-label="Facebook" class="mr-2"><i class="fab fa-facebook"></i></a>
            <a href="#" aria-label="Twitter" class="mr-2"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</aside>
