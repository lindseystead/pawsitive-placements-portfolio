<?php
/**
 * Pawsitive Placements
 * 
 * @file       view/sidebar_admin.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Shared sidebar component for administrators. Displays admin login status,
 *              admin dashboard links, and admin-specific navigation. Used across all admin pages.
 */

// Determine login status and admin information
global $username, $logged_in, $is_admin;

// Check if admin is logged in
if (isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin']) {
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
    <div class="sidebar-section" style="background: <?php echo $logged_in ? '#d1ecf1' : '#fff3cd'; ?>; border-left: 4px solid <?php echo $logged_in ? '#0066cc' : '#ffc107'; ?>; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
        <?php if ($logged_in): ?>
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-user-shield text-primary mr-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong class="text-dark">Admin Logged In</strong>
                    <span class="badge badge-primary ml-1"><i class="fas fa-shield-alt mr-1"></i>Admin</span>
                </div>
            </div>
            <p class="mb-2 text-dark" style="font-size: 0.9rem;">
                <i class="fas fa-user-shield mr-1"></i>
                <strong><?php echo htmlspecialchars($username ?? 'Admin'); ?></strong>
            </p>
            <a href="<?php echo $base_path; ?>admins/index.php?action=show-menu" class="btn btn-sm btn-primary btn-block mb-2">
                <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
            </a>
            <a href="<?php echo $base_path; ?>admins/index.php?action=logout" class="btn btn-sm btn-outline-danger btn-block">
                <i class="fas fa-sign-out-alt mr-1"></i>Logout
            </a>
        <?php else: ?>
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-user-times text-warning mr-2" style="font-size: 1.5rem;"></i>
                <strong class="text-dark">Not Logged In</strong>
            </div>
            <p class="mb-2 text-muted" style="font-size: 0.85rem;">Please log in to access admin features</p>
            <a href="<?php echo $base_path; ?>admins/index.php?action=display_login" class="btn btn-sm btn-primary btn-block mb-2">
                <i class="fas fa-sign-in-alt mr-1"></i>Admin Login
            </a>
        <?php endif; ?>
    </div>

    <!-- Quick Links Section -->
    <div class="sidebar-section">
        <h3><i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard</h3>
        <ul class="sidebar-links">
            <li><a href="<?php echo $base_path; ?>index.php"><i class="fas fa-home mr-2"></i>Home</a></li>
            <li><a href="<?php echo $base_path; ?>forum/index.php"><i class="fas fa-comments mr-2"></i>Community Forum</a></li>
            <?php if ($logged_in && $is_admin): ?>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=show-menu"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=view_applications"><i class="fas fa-file-alt mr-2"></i>Applications</a></li>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=view_pets"><i class="fas fa-paw mr-2"></i>Manage Pets</a></li>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=view_users"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=view_messages"><i class="fas fa-envelope mr-2"></i>Messages</a></li>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=view_administrators"><i class="fas fa-user-shield mr-2"></i>Administrators</a></li>
                <li><a href="<?php echo $base_path; ?>admins/index.php?action=add-administrator"><i class="fas fa-user-plus mr-2"></i>Add Administrator</a></li>
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
