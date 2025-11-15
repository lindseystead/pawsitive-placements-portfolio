<?php
/**
 * Pawsitive Placements
 * 
 * @file       pets/pet_list.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Pet listing view. Displays all available pets with search and filter
 *              functionality. Shows pet images, names, and descriptions. No login required.
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

// Fetch available cities and pet types for filter dropdowns
$cities = get_available_cities();
$pet_types = get_available_pet_types();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once('../util/seo.php');
    $site_url = get_site_url();
    echo generate_seo_meta_tags(
        'Available Pets for Adoption in British Columbia',
        'Browse hundreds of pets available for adoption in British Columbia. Find dogs, cats, birds, and more. Search by location, type, and breed. Ethical pet adoption platform connecting pets with loving families.',
        'available pets, pets for adoption, adopt a pet BC, British Columbia pets, pet adoption listings, find a pet, adopt dogs, adopt cats, pet adoption search',
        $site_url . '/images/pawsitive_pets2.png',
        $site_url . '/pets/index.php',
        'website'
    );
    echo generate_breadcrumb_schema([
        ['name' => 'Home', 'url' => '/index.php'],
        ['name' => 'Available Pets', 'url' => '/pets/index.php']
    ]);
    ?>
    <title>Available Pets for Adoption in BC | Pawsitive Placements</title>
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
            <section class="section-header text-center my-4">
                <h1 class="section-title">Available Pets for Adoption</h1>
                <p class="section-subtitle">Find your furry friend today!</p>
            </section>

            <section class="about-section-modern mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h3 class="mb-3"><i class="fas fa-search text-primary mr-2"></i>Search & Filter</h3>
                        <form action="index.php" method="GET" class="search-form">
                            <input type="hidden" name="action" value="list_pets">

                            <!-- SEARCH BAR -->
                            <div class="form-group">
                                <label for="search"><i class="fas fa-paw mr-2 text-primary"></i>Pet Name</label>
                                <input type="text" 
                                       name="search" 
                                       id="search" 
                                       class="form-control" 
                                       placeholder="Enter pet name..." 
                                       <?php if (!empty($search)): ?>value="<?php echo htmlspecialchars($search, ENT_QUOTES); ?>"<?php endif; ?>>
                            </div>

                            <div class="row">
                                <!-- CITY DROPDOWN - FIXED -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city"><i class="fas fa-map-marker-alt mr-2 text-primary"></i>City</label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="" <?= empty($city) ? 'selected hidden' : ''; ?>>Select a city...</option>
                                            <?php foreach ($cities as $city_option): ?>
                                                <option value="<?php echo htmlspecialchars($city_option, ENT_QUOTES); ?>"
                                                    <?php echo htmlspecialchars($city ?? '') == $city_option ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($city_option, ENT_QUOTES); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pet_type"><i class="fas fa-paw mr-2 text-primary"></i>Pet Type</label>
                                        <select name="pet_type" id="pet_type" class="form-control">
                                            <option value="" <?= empty($pet_type) ? 'selected hidden' : ''; ?>>Select a pet type...</option>
                                            <?php foreach ($pet_types as $pet_type_option): ?>
                                                <option value="<?php echo htmlspecialchars($pet_type_option, ENT_QUOTES); ?>"
                                                    <?php echo htmlspecialchars($pet_type ?? '') == $pet_type_option ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($pet_type_option, ENT_QUOTES); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search mr-2"></i>Search Pets
                            </button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <div class="about-image-wrapper">
                            <img src="../images/dog_and_cat.png" alt="Pets for Adoption" class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </section>

            <section class="about-section-modern">
                <?php if (isset($pagination) && $pagination['total_pets'] > 0): ?>
                    <div class="mb-3">
                        <p class="text-muted">
                            Showing <?= $pagination['start']; ?>-<?= $pagination['end']; ?> 
                            of <?= $pagination['total_pets']; ?> pet<?= $pagination['total_pets'] != 1 ? 's' : ''; ?>
                        </p>
                    </div>
                <?php endif; ?>
                
                <div class="row">
                    <?php
                    if (!empty($pets)) {
                        foreach ($pets as $pet) {

                            // Normalize image path
                            $image_path = $pet['image_path'] ?? '../images/default_image.png';
                            if (strpos($image_path, '../images/') !== 0 && strpos($image_path, 'images/') !== 0) {
                                $image_path = '../images/' . basename($image_path);
                            } elseif (strpos($image_path, 'images/') === 0) {
                                $image_path = '../' . $image_path;
                            }
                            $image_url = htmlspecialchars($image_path, ENT_QUOTES);
                            $alt_text = htmlspecialchars($pet['pet_name'] ?? 'No Name Available', ENT_QUOTES);
                            ?>
                            
                            <div class="col-md-4 mb-4">
                                <div class="pet-card">
                                    <div class="pet-card-image">
                                        <img src="<?= $image_url; ?>" alt="<?= $alt_text; ?>" class="img-fluid">
                                        
                                        <?php if (strpos($pet['description'] ?? '', '[SAMPLE PET]') !== false): ?>
                                            <span class="badge badge-info position-absolute" style="top: 10px; right: 10px; font-size: 0.75rem;">Sample Pet</span>
                                        <?php endif; ?>

                                        <div class="pet-card-overlay">
                                            <a href="index.php?action=pet_detail&pet_id=<?= htmlspecialchars($pet['pet_id'], ENT_QUOTES); ?>" class="btn btn-light">
                                                <i class="fas fa-eye mr-2"></i>View Details
                                            </a>
                                        </div>
                                    </div>

                                    <div class="pet-card-body">
                                        <h5 class="pet-card-title"><?= htmlspecialchars($pet['pet_name'], ENT_QUOTES); ?></h5>

                                        <?php 
                                        $description = $pet['description'] ?? '';
                                        $display_description = str_replace('[SAMPLE PET] ', '', $description);
                                        ?>

                                        <p class="pet-card-text">
                                            <?= htmlspecialchars(mb_substr($display_description, 0, 100)) . (mb_strlen($display_description) > 100 ? '...' : ''); ?>
                                        </p>

                                        <div class="d-flex pet-card-actions">
                                            <a href="index.php?action=pet_detail&pet_id=<?= htmlspecialchars($pet['pet_id'], ENT_QUOTES); ?>" class="btn btn-secondary">
                                                <i class="fas fa-eye mr-2"></i>View Details
                                            </a>

                                            <?php if (isset($_SESSION['is_valid_user']) && $_SESSION['is_valid_user']): ?>
                                                <a href="../application/form.php?pet_id=<?= htmlspecialchars($pet['pet_id'], ENT_QUOTES); ?>" class="btn btn-primary">
                                                    <i class="fas fa-heart mr-2"></i>Adopt
                                                </a>
                                            <?php else: ?>
                                                <a href="../user/index.php?action=display_login&pet_id=<?= htmlspecialchars($pet['pet_id'], ENT_QUOTES); ?>" class="btn btn-primary">
                                                    <i class="fas fa-sign-in-alt mr-2"></i>Login to Adopt
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <h4>No pets found</h4>
                                <p>Try adjusting your search criteria or check back later for new pets.</p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
                <?php if (isset($pagination) && $pagination['total_pages'] > 1): ?>
                    <nav aria-label="Pet listing pagination" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php
                            // Build query string for pagination links (preserve filters)
                            $query_params = [];
                            if (!empty($search)) $query_params['search'] = $search;
                            if (!empty($city)) $query_params['city'] = $city;
                            if (!empty($pet_type)) $query_params['pet_type'] = $pet_type;
                            $query_string = !empty($query_params) ? '&' . http_build_query($query_params) : '';
                            
                            // Previous button
                            if ($pagination['current_page'] > 1):
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?action=list_pets&page=<?= $pagination['current_page'] - 1; ?><?= $query_string; ?>">Previous</a>
                                </li>
                                <?php
                            else:
                                ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <?php
                            endif;
                            
                            // Page numbers
                            $start_page = max(1, $pagination['current_page'] - 2);
                            $end_page = min($pagination['total_pages'], $pagination['current_page'] + 2);
                            
                            if ($start_page > 1):
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?action=list_pets&page=1<?= $query_string; ?>">1</a>
                                </li>
                                <?php
                                if ($start_page > 2):
                                    ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                    <?php
                                endif;
                            endif;
                            
                            for ($i = $start_page; $i <= $end_page; $i++):
                                ?>
                                <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : ''; ?>">
                                    <a class="page-link" href="index.php?action=list_pets&page=<?= $i; ?><?= $query_string; ?>"><?= $i; ?></a>
                                </li>
                                <?php
                            endfor;
                            
                            if ($end_page < $pagination['total_pages']):
                                if ($end_page < $pagination['total_pages'] - 1):
                                    ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                    <?php
                                endif;
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?action=list_pets&page=<?= $pagination['total_pages']; ?><?= $query_string; ?>"><?= $pagination['total_pages']; ?></a>
                                </li>
                                <?php
                            endif;
                            
                            // Next button
                            if ($pagination['current_page'] < $pagination['total_pages']):
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?action=list_pets&page=<?= $pagination['current_page'] + 1; ?><?= $query_string; ?>">Next</a>
                                </li>
                                <?php
                            else:
                                ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                                <?php
                            endif;
                            ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </section>

        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Removed select manipulation - Bootstrap handles styling -->
</body>
</html>
