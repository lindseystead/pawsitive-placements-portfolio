<?php
/**
 * Pawsitive Placements
 * 
 * @file       pets/pet_detail.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Pet detail view. Displays detailed information about a single pet
 *              including image, description, breed, age, and adoption fee. No login required.
 */

require_once('../util/session.php');
require_once('../model/pet_db.php');

// Determine login status
global $username, $logged_in, $is_admin;

if (isset($_SESSION['is_valid_admin']) && $_SESSION['is_valid_admin']) {
    $logged_in = true;
    $username = $_SESSION['admin_first_name'] ?? 'Admin';
    $is_admin = true;
} elseif (isset($_SESSION['is_valid_user']) && $_SESSION['is_valid_user']) {
    $logged_in = true;
    $is_admin = false;
    if (isset($_SESSION['user_id'])) {
        require_once('../model/users_db.php');
        $user = get_user_by_id($_SESSION['user_id']);
        $username = $user['name'] ?? 'User';
    } else {
        $username = 'User';
    }
} else {
    $logged_in = false;
    $username = null;
    $is_admin = false;
}

// If $pet is not already set by the controller, fetch it
// This allows pet_detail.php to be used standalone or via controller
if (!isset($pet)) {
    $pet_id = filter_input(INPUT_GET, 'pet_id', FILTER_VALIDATE_INT);
    if (!$pet_id) {
        $pet_id = filter_input(INPUT_POST, 'pet_id', FILTER_VALIDATE_INT);
    }
    
    if ($pet_id) {
        $pet = get_pet($pet_id);
    }
    
    if (!$pet) {
        $error = "Pet not found.";
        include('../errors/error.php');
        exit();
    }
}

// Get pet_id from the pet array if not already set
if (!isset($pet_id) && isset($pet['pet_id'])) {
    $pet_id = $pet['pet_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once('../util/seo.php');
    $site_url = get_site_url();
    $pet_name = htmlspecialchars($pet['pet_name']);
    $pet_type = htmlspecialchars($pet['pet_type'] ?? 'Pet');
    $pet_description = strip_tags($pet['description'] ?? '');
    $pet_description = mb_substr($pet_description, 0, 155);
    $pet_url = $site_url . '/pets/index.php?action=pet_detail&pet_id=' . $pet['pet_id'];
    $pet_image = $site_url . '/' . ($pet['image_path'] ?? 'images/default_image.png');
    
    $keywords = $pet_name . ', ' . $pet_type . ' adoption, ' . ($pet['breed'] ?? '') . ', pet adoption BC, ' . ($pet['city'] ?? 'British Columbia') . ' pet adoption';
    
    echo generate_seo_meta_tags(
        $pet_name . ' - ' . $pet_type . ' for Adoption in ' . ($pet['city'] ?? 'BC'),
        $pet_description ?: $pet_name . ' is a ' . $pet_type . ' available for adoption in ' . ($pet['city'] ?? 'British Columbia') . '. ' . ($pet['age'] ?? '') . ' years old, ' . ($pet['gender'] ?? '') . '. Adoption fee: $' . ($pet['fee'] ?? '0') . '. Find your perfect pet companion today!',
        $keywords,
        $pet_image,
        $pet_url,
        'product'
    );
    echo generate_pet_schema($pet);
    echo generate_breadcrumb_schema([
        ['name' => 'Home', 'url' => '/index.php'],
        ['name' => 'View Pets', 'url' => '/pets/index.php'],
        ['name' => $pet_name, 'url' => '/pets/index.php?action=pet_detail&pet_id=' . $pet['pet_id']]
    ]);
    ?>
    <title><?php echo $pet_name; ?> - <?php echo $pet_type; ?> for Adoption in <?php echo htmlspecialchars($pet['city'] ?? 'BC'); ?> | Pawsitive Placements</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>

<?php include '../view/header.php'; ?>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar - Hidden on mobile, shown on desktop -->
        <div class="col-lg-3 d-none d-lg-block">
            <?php include '../view/sidebar.php'; ?>
        </div>
        <div class="col-lg-9">
            <!-- Pet Name Header -->
            <section class="section-header text-center my-4">
                <h1 class="section-title">
                    <i class="fas fa-paw text-primary mr-2"></i><?php echo htmlspecialchars($pet['pet_name']); ?>
                </h1>
                <?php if (strpos($pet['description'] ?? '', '[SAMPLE PET]') !== false): ?>
                    <span class="badge badge-info mt-2" style="font-size: 0.875rem;">Sample Pet</span>
                <?php endif; ?>
            </section>

            <!-- Main Content: Image and Details -->
            <section class="about-section-modern my-4">
                <div class="row">
                    <!-- Pet Image - Top Left -->
                    <div class="col-lg-4 col-md-5 mb-4 mb-lg-0">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-0">
                                <?php
                                // Normalize image path - handle both '../images/' and 'images/' formats
                                $image_path = $pet['image_path'] ?? '../images/default_image.png';
                                // If path starts with '../images/', keep it (works from pets/ directory)
                                if (strpos($image_path, '../images/') === 0) {
                                    // Already correct for this directory
                                } elseif (strpos($image_path, 'images/') === 0) {
                                    // Convert to relative path from pets/ directory
                                    $image_path = '../' . $image_path;
                                } else {
                                    // Ensure it's relative to root
                                    $image_path = '../images/' . basename($image_path);
                                }
                                ?>
                                <img src="<?php echo htmlspecialchars($image_path); ?>"
                                     alt="<?php echo htmlspecialchars($pet['pet_name']); ?>"
                                     class="img-fluid rounded-top"
                                     style="width: 100%; height: 400px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pet Details - Right Side -->
                    <div class="col-lg-8 col-md-7">
                        <!-- Description Card -->
                        <div class="card shadow-sm mb-4 border-0">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">
                                    <i class="fas fa-info-circle mr-2"></i>About
                                </h5>
                                <?php 
                                $description = $pet['description'] ?? '';
                                // Remove [SAMPLE PET] from display but keep it in database
                                $display_description = str_replace('[SAMPLE PET] ', '', $description);
                                ?>
                                <p class="card-text lead mb-0"><?php echo nl2br(htmlspecialchars($display_description)); ?></p>
                            </div>
                        </div>

                        <!-- Pet Information Grid -->
                        <div class="row">
                            <!-- Breed -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-dog text-primary fa-2x mr-3"></i>
                                            <div>
                                                <h6 class="card-subtitle text-muted mb-1">Breed</h6>
                                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($pet['breed'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Age -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-birthday-cake text-primary fa-2x mr-3"></i>
                                            <div>
                                                <h6 class="card-subtitle text-muted mb-1">Age</h6>
                                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($pet['age'] ?? 'N/A'); ?> years old</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-venus-mars text-primary fa-2x mr-3"></i>
                                            <div>
                                                <h6 class="card-subtitle text-muted mb-1">Gender</h6>
                                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($pet['gender'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-primary fa-2x mr-3"></i>
                                            <div>
                                                <h6 class="card-subtitle text-muted mb-1">Location</h6>
                                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($pet['city'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Vaccination Status -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-syringe text-primary fa-2x mr-3"></i>
                                            <div>
                                                <h6 class="card-subtitle text-muted mb-1">Vaccination Status</h6>
                                                <?php
                                                $vaccination_status = $pet['vaccination_status'] ?? 'unknown';
                                                $status_labels = [
                                                    'up_to_date' => 'Up to Date',
                                                    'partial' => 'Partial',
                                                    'not_vaccinated' => 'Not Vaccinated',
                                                    'unknown' => 'Unknown'
                                                ];
                                                $status_label = $status_labels[$vaccination_status] ?? 'Unknown';
                                                $status_class = [
                                                    'up_to_date' => 'badge-success',
                                                    'partial' => 'badge-warning',
                                                    'not_vaccinated' => 'badge-danger',
                                                    'unknown' => 'badge-secondary'
                                                ];
                                                $badge_class = $status_class[$vaccination_status] ?? 'badge-secondary';
                                                ?>
                                                <span class="badge <?php echo $badge_class; ?> badge-lg"><?php echo htmlspecialchars($status_label); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pet Type -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-paw text-primary fa-2x mr-3"></i>
                                            <div>
                                                <h6 class="card-subtitle text-muted mb-1">Type</h6>
                                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($pet['pet_type'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Adoption Fee and Action Button -->
                        <div class="card shadow-sm mt-4 border-0 bg-primary text-white adoption-fee-card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-dollar-sign mr-2"></i>Adoption Fee
                                </h5>
                                <h2 class="mb-4">$<?php echo htmlspecialchars($pet['fee'] ?? '0'); ?></h2>
                                
                                <?php if (isset($_SESSION['is_valid_user']) && $_SESSION['is_valid_user']): ?>
                                    <a href="../application/form.php?pet_id=<?php echo htmlspecialchars($pet['pet_id']); ?>" class="btn btn-light btn-lg btn-block">
                                        <i class="fas fa-heart mr-2"></i>Adopt This Pet
                                    </a>
                                <?php else: ?>
                                    <a href="../user/index.php?action=display_login&pet_id=<?php echo htmlspecialchars($pet['pet_id']); ?>" class="btn btn-light btn-lg btn-block">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Login to Adopt
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Social Sharing Section -->
            <div class="card shadow-sm mt-4 border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-share-alt text-primary mr-2"></i>Share This Pet
                    </h5>
                    <?php
                    $share_url = get_site_url() . '/pets/index.php?action=pet_detail&pet_id=' . $pet['pet_id'];
                    $share_title = $pet_name . ' - ' . $pet_type . ' for Adoption';
                    $share_description = $pet_description ?: $pet_name . ' is available for adoption!';
                    $share_image = get_site_url() . '/' . ($pet['image_path'] ?? 'images/default_image.png');
                    echo generate_social_sharing_buttons($share_url, $share_title, $share_description, $share_image);
                    ?>
                </div>
            </div>
            
            <!-- Internal Linking for SEO -->
            <div class="card shadow-sm mt-4 border-0 bg-light">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-link text-primary mr-2"></i>Related Resources
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <a href="../pets/index.php" class="text-decoration-none">
                                <i class="fas fa-paw text-primary mr-2"></i>View More Pets
                            </a>
                        </div>
                        <div class="col-md-4 mb-2">
                            <a href="../forum/index.php?category=adoption_tips" class="text-decoration-none">
                                <i class="fas fa-lightbulb text-primary mr-2"></i>Adoption Tips
                            </a>
                        </div>
                        <div class="col-md-4 mb-2">
                            <a href="../forum/index.php?category=pet_care" class="text-decoration-none">
                                <i class="fas fa-heart text-primary mr-2"></i>Pet Care Resources
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Back Button -->
            <div class="text-center mt-4 mb-4">
                <a href="index.php?action=list_pets" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Pets
                </a>
            </div>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
