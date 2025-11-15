<!--
  Pawsitive Placements
  
  @file       view/footer.php
  @author     Lindsey D. Stead
  @date       November 7, 2025
  @description Shared page footer component. Includes quick links, contact
                information, and copyright notice. Used across all pages.
-->
<?php
// Determine the base path based on where the footer is being included from
// If we're in the root directory, use empty string, otherwise use ../
$base_path = (strpos($_SERVER['PHP_SELF'], '/view/') === false && strpos($_SERVER['PHP_SELF'], '/user/') === false && strpos($_SERVER['PHP_SELF'], '/admins/') === false && strpos($_SERVER['PHP_SELF'], '/pet-rehome/') === false && strpos($_SERVER['PHP_SELF'], '/contact/') === false && strpos($_SERVER['PHP_SELF'], '/application/') === false && strpos($_SERVER['PHP_SELF'], '/forum/') === false && strpos($_SERVER['PHP_SELF'], '/about/') === false && strpos($_SERVER['PHP_SELF'], '/pets/') === false && strpos($_SERVER['PHP_SELF'], '/errors/') === false && strpos($_SERVER['PHP_SELF'], '/api/') === false) ? '' : '../';
?>
<footer class="footer bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- Column 1 - Brand -->
            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0 text-center text-md-left">
                <h5 class="mb-3">Pawsitive Placements</h5>
                <p class="mb-0">Helping pets find loving homes across BC.</p>
            </div>

            <!-- Column 2 - Quick Links -->
            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0 text-center text-md-left">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="<?php echo $base_path; ?>index.php" class="text-white-50"><i class="fas fa-home mr-2"></i>Home</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>about/about.php" class="text-white-50"><i class="fas fa-info-circle mr-2"></i>About</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>pet-rehome/upload.php" class="text-white-50"><i class="fas fa-heart mr-2"></i>Rehome a Pet</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>pets/index.php" class="text-white-50"><i class="fas fa-paw mr-2"></i>Search Pets</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>forum/index.php" class="text-white-50"><i class="fas fa-comments mr-2"></i>Forum</a></li>
                </ul>
            </div>

            <!-- Column 3 - Support -->
            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0 text-center text-md-left">
                <h5 class="mb-3">Support</h5>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="<?php echo $base_path; ?>contact/index.php" class="text-white-50"><i class="fas fa-envelope mr-2"></i>Contact Us</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>view/terms-of-use.php" class="text-white-50"><i class="fas fa-file-contract mr-2"></i>Terms of Use</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>view/privacy-policy.php" class="text-white-50"><i class="fas fa-user-shield mr-2"></i>Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Column 4 - Newsletter/Follow -->
            <div class="col-12 col-md-6 col-lg-3 text-center text-md-left">
                <h5 class="mb-3">Stay Connected</h5>
                <!-- Newsletter Signup Form -->
                <form class="footer-newsletter-form mb-4" method="POST" action="<?php echo $base_path; ?>contact/index.php">
                    <?php require_once(__DIR__ . '/../util/csrf.php'); ?>
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="Your email" aria-label="Email address" required>
                        <input type="hidden" name="action" value="newsletter_signup">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-block mb-3">
                        <i class="fas fa-paper-plane mr-1"></i>Subscribe
                    </button>
                </form>
                <!-- Social Media -->
                <div class="d-flex justify-content-center justify-content-md-start align-items-center">
                    <a href="#" aria-label="Facebook" class="text-white mr-3 social-icon" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Instagram" class="text-white mr-3 social-icon" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter" class="text-white social-icon" title="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <hr class="border-secondary mt-4 mb-3">

        <div class="text-center">
            <p class="mb-2">&copy; <?php echo date("Y"); ?> Pawsitive Placements. All rights reserved.</p>
            <?php
            // Display visit counter
            require_once(__DIR__ . '/../util/visit_counter.php');
            $visit_count = increment_visit_count();
            ?>
            <p class="mb-2 text-white-50 small">
                <i class="fas fa-eye mr-1"></i>Total Visits: <strong><?php echo format_visit_count($visit_count); ?></strong>
            </p>
            <p class="mb-0 text-white-50 small">
                Web Design and Development by <a href="#" class="text-white-50" style="text-decoration: underline;">Lifesaver Technology Services</a>
            </p>
        </div>
    </div>
</footer>
<!-- Bootstrap JS for responsive navigation -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>