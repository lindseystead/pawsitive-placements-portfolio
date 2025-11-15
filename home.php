<?php
/**
 * Pawsitive Placements
 * 
 * @file       home.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Home page view. Displays the landing page with navigation,
 *              featured pets, and information about the platform.
 */

require_once('util/session.php');
global $username, $logged_in, $is_admin;

if (isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin']) {
    $logged_in = true;
    $username = $_SESSION['admin_first_name'] ?? 'Admin';
} else {
    $logged_in = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once('util/seo.php');
    $site_url = get_site_url();
    echo generate_seo_meta_tags(
        'Ethical Pet Adoption & Rehoming Platform in British Columbia',
        'Pawsitive Placements is British Columbia\'s trusted pet adoption and rehoming platform. Connect with loving families, find your perfect pet companion, or responsibly rehome your pet. Ethical, secure, and community-driven.',
        'pet adoption BC, British Columbia pet adoption, adopt a pet, pet rehoming, ethical pet adoption, rescue pets, adopt dogs BC, adopt cats BC, pet adoption platform, find a pet, rehome pet, pet adoption Canada',
        $site_url . '/images/pawsitive_pets2.png',
        $site_url . '/index.php',
        'website'
    );
    echo generate_organization_schema();
    echo generate_website_schema();
    ?>
    <title>Ethical Pet Adoption & Rehoming Platform in BC | Pawsitive Placements</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<?php include 'view/header.php'; ?>

<!-- Hero Section - Full Width -->
<section class="modern-hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-content">
                    <h1 class="hero-title">Ethical Pet Rehoming Platform</h1>
                    <p class="hero-subtitle">Pawsitive Placements connects pets who need new homes with loving families ethically. We ensure you can stay in touch and contact your pets in the future, making rehoming a positive experience for everyone involved.</p>
                    <div class="hero-buttons">
                        <a href="pets/index.php" class="btn btn-primary btn-lg mr-3 mb-3">
                            <i class="fas fa-paw mr-2"></i>Adopt Today
                        </a>
                        <a href="pet-rehome/index.php" class="btn btn-outline-light btn-lg mb-3">
                            <i class="fas fa-heart mr-2"></i>Rehome a Pet
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar - Hidden on mobile, shown on desktop -->
        <div class="col-lg-3 d-none d-lg-block">
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
                            <a href="admins/index.php" class="btn btn-sm btn-primary btn-block mb-2">
                                <i class="fas fa-tachometer-alt mr-1"></i>Admin Dashboard
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo $is_admin ? 'admins/index.php?action=logout' : 'user/index.php?action=logout'; ?>" class="btn btn-sm btn-outline-danger btn-block">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </a>
                    <?php else: ?>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-times text-warning mr-2" style="font-size: 1.5rem;"></i>
                            <strong class="text-dark">Not Logged In</strong>
                        </div>
                        <p class="mb-2 text-muted" style="font-size: 0.85rem;">Please log in to access all features</p>
                        <a href="user/index.php?action=display_login" class="btn btn-sm btn-primary btn-block mb-2">
                            <i class="fas fa-sign-in-alt mr-1"></i>User Login
                        </a>
                        <a href="user/create_account.php" class="btn btn-sm btn-outline-primary btn-block mb-2">
                            <i class="fas fa-user-plus mr-1"></i>Sign Up
                        </a>
                        <a href="admins/index.php?action=display_login" class="btn btn-sm btn-outline-warning btn-block">
                            <i class="fas fa-shield-alt mr-1"></i>Admin Login
                        </a>
                    <?php endif; ?>
                </div>

                <div class="sidebar-section">
                    <h3><i class="fas fa-home mr-2"></i>Quick Links</h3>
                    <ul class="sidebar-links">
                        <li><a href="index.php"><i class="fas fa-home mr-2"></i>Home</a></li>
                        <li><a href="forum/index.php"><i class="fas fa-comments mr-2"></i>Community Forum</a></li>
                        <?php if ($logged_in): ?>
                            <li><a href="user/index.php"><i class="fas fa-user mr-2"></i>My Account</a></li>
                            <?php if ($is_admin): ?>
                                <li><a href="admins/index.php"><i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li><a href="user/index.php?action=display_login"><i class="fas fa-sign-in-alt mr-2"></i>User Login</a></li>
                            <li><a href="user/create_account.php"><i class="fas fa-user-plus mr-2"></i>Create Account</a></li>
                            <li><a href="admins/index.php?action=display_login"><i class="fas fa-shield-alt mr-2"></i>Admin Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="sidebar-section">
                    <h3><i class="fas fa-info-circle mr-2"></i>Quick Info</h3>
                    <ul class="sidebar-info">
                        <li><i class="fas fa-heart text-primary mr-2"></i><strong>Our Mission:</strong> To find loving homes for every pet.</li>
                        <li><i class="fas fa-dollar-sign text-primary mr-2"></i><strong>Adoption Fees:</strong> Affordable fees for adopting.</li>
                        <li><i class="fas fa-hands-helping text-primary mr-2"></i><strong>Volunteer:</strong> Join us in making a difference!</li>
                    </ul>
                </div>

                <div class="sidebar-section">
                    <h3><i class="fas fa-lightbulb mr-2"></i>Pet Care Tips</h3>
                    <ul class="sidebar-tips">
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Regular Vet Visits</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Proper Nutrition</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Daily Exercise</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Socialization</li>
                    </ul>
                </div>
            </aside>
        </div>

        <div class="col-lg-9">
            <!-- About Section -->
            <section class="about-section-modern">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="about-content">
                            <h2 class="section-title">About Pawsitive Placements</h2>
                            <p class="lead">We believe that every animal deserves a loving home. Our mission is to connect all kinds of pets who need new homes ethically, ensuring they find loving families who will cherish them for life.</p>
                            <p>We provide resources and support to help both pets and their new families adjust and thrive together. Most importantly, we enable you to stay in touch and contact your pets in the future, making rehoming a positive and ethical experience.</p>
                            
                            <div class="about-features mt-4">
                                <div class="feature-item">
                                    <i class="fas fa-shield-alt text-primary"></i>
                                    <div>
                                        <h5>Ethical Rehoming</h5>
                                        <p>We ensure all pet rehoming is done ethically and transparently, connecting pets with the right families.</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-comments text-primary"></i>
                                    <div>
                                        <h5>Stay Connected</h5>
                                        <p>Our platform allows you to stay in touch and contact your pets after rehoming, ensuring peace of mind.</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-heart text-primary"></i>
                                    <div>
                                        <h5>Our Values</h5>
                                        <p>We value animal welfare, responsible pet ownership, and ethical practices in pet rehoming.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-image-wrapper">
                            <img src="images/kitten_image.png" alt="About Us" class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Featured Pets Section -->
            <section class="featured-pets-section">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">Featured Pets</h2>
                    <p class="section-subtitle">Meet some of our amazing pets looking for their forever homes</p>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="pet-card">
                            <div class="pet-card-image">
                                <img src="images/max.png" alt="Max - Labrador Puppy" class="img-fluid">
                                <div class="pet-card-overlay">
                                    <a href="pets/index.php?action=pet_detail&pet_id=1" class="btn btn-light">
                                        <i class="fas fa-eye mr-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                            <div class="pet-card-body">
                                <h5 class="pet-card-title">Max</h5>
                                <p class="pet-card-text">Max is a playful Labrador puppy. He is quiet and cuddly. He is hoping to find a new forever home with a loving family.</p>
                                <a href="pets/index.php?action=pet_detail&pet_id=1" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw mr-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pet-card">
                            <div class="pet-card-image">
                                <img src="images/buddy.png" alt="Buddy - Golden Retriever Puppy" class="img-fluid">
                                <div class="pet-card-overlay">
                                    <a href="pets/index.php?action=pet_detail&pet_id=2" class="btn btn-light">
                                        <i class="fas fa-eye mr-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                            <div class="pet-card-body">
                                <h5 class="pet-card-title">Buddy</h5>
                                <p class="pet-card-text">A friendly and adorable golden retriever puppy who loves to play fetch and sleep with his owner. He loves walks and gets along well with kids.</p>
                                <a href="pets/index.php?action=pet_detail&pet_id=2" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw mr-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pet-card">
                            <div class="pet-card-image">
                                <img src="images/bird.jpg" alt="Charlie - Parakeet" class="img-fluid">
                                <div class="pet-card-overlay">
                                    <a href="pets/index.php?action=pet_detail&pet_id=3" class="btn btn-light">
                                        <i class="fas fa-eye mr-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                            <div class="pet-card-body">
                                <h5 class="pet-card-title">Charlie</h5>
                                <p class="pet-card-text">A calm and affectionate parakeet. A low maintenance and fun new pet for your family to enjoy. Looking for a new forever home.</p>
                                <a href="pets/index.php?action=pet_detail&pet_id=3" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw mr-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Rehome Section -->
            <section class="rehome-section-modern">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="rehome-image-wrapper">
                            <img src="images/pawsitive_placements.png" alt="Rehome Your Pet" class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rehome-content">
                            <h2 class="section-title">Rehome Your Pet Ethically</h2>
                            <p class="lead">Need to find a new home for your beloved pet? We're here to help! Our ethical rehoming process ensures your pet finds a loving family, and you can stay in touch with your pet in the future.</p>
                            
                            <div class="rehome-features mt-4">
                                <div class="feature-item">
                                    <i class="fas fa-shield-alt text-primary"></i>
                                    <div>
                                        <h5>Ethical Rehoming</h5>
                                        <p>We provide a safe, ethical, and transparent platform for rehoming pets, ensuring the best outcome for everyone.</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-comments text-primary"></i>
                                    <div>
                                        <h5>Stay in Touch</h5>
                                        <p>Our platform allows you to stay connected and contact your pets after rehoming, giving you peace of mind.</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-heart text-primary"></i>
                                    <div>
                                        <h5>Compassionate Process</h5>
                                        <p>We understand the difficulty of parting with your pet. Our team guides you through a compassionate, stress-free process.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="pet-rehome/index.php" class="btn btn-primary btn-lg mt-4">
                                <i class="fas fa-heart mr-2"></i>Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php include 'view/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
