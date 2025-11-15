<?php
/**
 * Pawsitive Placements
 * 
 * @file       view/privacy-policy.php
 * @author     Lindsey D. Stead
 * @date       November 2025
 * @description Privacy Policy for the platform (BC PIPA compliant).
 */

require_once('../util/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Pawsitive Placements</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-3 d-none d-lg-block">
            <?php include 'sidebar.php'; ?>
        </div>

        <div class="col-lg-9">
            <section class="section-header text-center my-4">
                <h1 class="section-title"><i class="fas fa-user-shield text-primary mr-2"></i>Privacy Policy</h1>
                <p class="section-subtitle">Protecting your personal information and creating a safe, ethical environment for pet adoption.</p>
            </section>

            <section class="about-section-modern mt-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="about-image-wrapper">
                            <img src="../images/hamster.png" alt="Privacy Policy" class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-content">
                            <div class="feature-item mb-4">
                                <h3 class="h5 mb-3"><i class="fas fa-info-circle text-primary mr-2"></i>1. Overview</h3>
                                <p>
                                    This Privacy Policy explains how Pawsitive Placements ("we", "our", "the platform") collects, uses, 
                                    stores, discloses, and protects personal information in accordance with the 
                                    <strong>British Columbia Personal Information Protection Act (PIPA)</strong>.
                                </p>
                                <p class="mb-0">
                                    By using our website, creating an account, listing a pet, submitting an adoption application, or
                                    participating in the forum, you agree to the terms of this Privacy Policy.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="about-section-modern mt-4 mb-4">
                <div class="about-content">

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-database text-primary mr-2"></i>2. Information We Collect</h3>
                        <p>We collect only the information necessary to provide safe, fair, and ethical pet adoption services.</p>
                        <p class="font-weight-bold">Information collected from all users:</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-check text-success mr-2"></i>Name</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Email address</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Phone number (optional)</li>
                            <li><i class="fas fa-check text-success mr-2"></i>City and province</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Account credentials (passwords hashed securely)</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Forum posts and comments</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Contact form submissions</li>
                        </ul>

                        <p class="font-weight-bold">Information collected from pet owners (rehoming):</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-check text-success mr-2"></i>Pet information (name, breed, age, gender, description)</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Pet health and vaccination status (as supplied by owner)</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Uploaded pet photos</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Adoption fee (if applicable)</li>
                            <li><i class="fas fa-check text-success mr-2"></i>User ID associated with pet listing</li>
                        </ul>

                        <p class="font-weight-bold">Information collected from adopters:</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-check text-success mr-2"></i>Adoption application details</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Messages sent to pet owners</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Interest history (pets viewed, applied for)</li>
                        </ul>

                        <p class="font-weight-bold">Automatically collected data:</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-check text-success mr-2"></i>IP address</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Browser type and device information</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Standard cookies for login sessions</li>
                        </ul>

                        <p class="text-muted small mb-0">
                            We do NOT collect government ID, credit card information, date of birth, or sensitive medical data.
                        </p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-clipboard-check text-primary mr-2"></i>3. How We Use This Information</h3>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-paw text-success mr-2"></i>To list pets for adoption and match adopters with owners</li>
                            <li><i class="fas fa-paw text-success mr-2"></i>To verify accounts and maintain platform safety</li>
                            <li><i class="fas fa-paw text-success mr-2"></i>To process adoption applications</li>
                            <li><i class="fas fa-paw text-success mr-2"></i>To allow communication between owners and adopters</li>
                            <li><i class="fas fa-paw text-success mr-2"></i>To operate community forums</li>
                            <li><i class="fas fa-paw text-success mr-2"></i>To respond to user inquiries</li>
                            <li><i class="fas fa-paw text-success mr-2"></i>To prevent fraud, spam, and misuse of the platform</li>
                        </ul>
                        <p class="text-muted small mb-0">
                            We do not sell, rent, or trade user information, including pet information, under any circumstances.
                        </p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-share-square text-primary mr-2"></i>4. When Information May Be Shared</h3>
                        <p>Information is only shared when necessary to operate the service:</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-check-circle text-success mr-2"></i>Pet owners see adopter application details</li>
                            <li><i class="fas fa-check-circle text-success mr-2"></i>Adopters see pet listing details (not owner's full profile)</li>
                            <li><i class="fas fa-check-circle text-success mr-2"></i>Admins can view and moderate all data for safety</li>
                            <li><i class="fas fa-check-circle text-success mr-2"></i>Law enforcement—only when legally required</li>
                        </ul>
                        <p class="text-muted small mb-0">We do not share data with advertisers, data brokers, or external marketing systems.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-lock text-primary mr-2"></i>5. Data Storage and Security</h3>
                        <p>We take reasonable technical, administrative, and physical measures to protect personal information:</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-shield-alt text-success mr-2"></i>Passwords hashed with bcrypt</li>
                            <li><i class="fas fa-shield-alt text-success mr-2"></i>Prepared statements to prevent SQL injection</li>
                            <li><i class="fas fa-shield-alt text-success mr-2"></i>CSRF protection on all forms</li>
                            <li><i class="fas fa-shield-alt text-success mr-2"></i>Session security and secure cookies</li>
                            <li><i class="fas fa-shield-alt text-success mr-2"></i>File upload validation and size limits</li>
                        </ul>
                        <p class="mb-0">Data is stored on secure servers located in Canada or the United States (depending on hosting selection).</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-clock text-primary mr-2"></i>6. Data Retention</h3>
                        <p>We retain information only as long as necessary for its intended purpose:</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-check text-success mr-2"></i>User accounts: retained until user requests deletion</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Pet listings: retained for audit and safety purposes</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Adoption applications: stored for safety and accountability</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Forum posts: retained unless removed by user or moderator</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Contact form messages: 12–24 months</li>
                        </ul>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-user-check text-primary mr-2"></i>7. User Rights Under PIPA</h3>
                        <p>You have the right to:</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-check text-success mr-2"></i>Request access to your personal information</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Request corrections</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Request deletion of your account</li>
                            <li><i class="fas fa-check text-success mr-2"></i>Withdraw consent (may affect account use)</li>
                        </ul>
                        <p class="mb-0">To submit a request, contact our Privacy Officer at  
                            <strong><a href="mailto:support@pawsitiveplacements.ca" class="text-primary">support@pawsitiveplacements.ca</a></strong>.
                        </p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-children text-primary mr-2"></i>8. Protection of Minors</h3>
                        <p class="mb-0">
                            We do not knowingly allow users under the age of 16 to create accounts or participate on the platform. 
                            Parents or guardians may request removal of a minor's personal information at any time.
                        </p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-robot text-primary mr-2"></i>9. Use of Automated Tools</h3>
                        <p class="mb-0">
                            We may use automated tools (e.g., spam detection systems) to protect user safety.  
                            We do <strong>not</strong> use AI to make decisions affecting a user's rights, adoption eligibility, or account status.
                        </p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-exclamation-triangle text-primary mr-2"></i>10. Limitation of Liability</h3>
                        <p>
                            While we take reasonable security measures, no system is completely secure.  
                            Pawsitive Placements is not liable for:
                        </p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fas fa-times text-danger mr-2"></i>Actions of pet owners or adopters</li>
                            <li><i class="fas fa-times text-danger mr-2"></i>Accuracy of pet information provided by users</li>
                            <li><i class="fas fa-times text-danger mr-2"></i>Third-party breaches beyond our control</li>
                        </ul>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-edit text-primary mr-2"></i>11. Changes to This Policy</h3>
                        <p class="mb-0">
                            We may update this Privacy Policy periodically.  
                            The "Last Updated" date reflects the most recent revision.
                        </p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-envelope text-primary mr-2"></i>12. Contact Information</h3>
                        <p class="mb-0">
                            For questions, privacy requests, or concerns, contact our Privacy Officer at:  
                            <strong><a href="mailto:support@pawsitiveplacements.ca" class="text-primary">support@pawsitiveplacements.ca</a></strong>
                        </p>
                    </div>

                    <div class="alert alert-info mt-4 mb-0">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>By using our website, you agree to this Privacy Policy.</strong>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <p class="mb-1"><strong>Effective Date:</strong> August 1, 2024</p>
                        <p class="mb-0"><strong>Last Updated:</strong> <?php echo date("F j, Y"); ?></p>
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

