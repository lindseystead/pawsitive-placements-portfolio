<?php
/**
 * Pawsitive Placements
 * 
 * @file       view/terms-of-use.php
 * @author     Lindsey D. Stead
 * @date       November 7, 2025
 * @description Terms and Conditions page. Displays the terms of use for the platform.
 */

require_once('../util/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - Pawsitive Placements</title>
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
                <h1 class="section-title"><i class="fas fa-file-contract text-primary mr-2"></i>Terms and Conditions</h1>
                <p class="section-subtitle">Welcome to Pawsitive Placements! Together, let's pave the way to a loving home for your future furry friend.</p>
            </section>

            <section class="about-section-modern mt-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="about-image-wrapper">
                            <img src="../images/cat.png" alt="Terms and Conditions" class="img-fluid rounded shadow-lg">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-content">
                            <div class="feature-item mb-4">
                                <h3 class="h5 mb-3"><i class="fas fa-info-circle text-primary mr-2"></i>1. Introduction</h3>
                                <p class="mb-0">Pawsitive Placements is a platform that allows pet owners to list their pets for adoption and potential adopters to browse and apply to adopt pets. Our website is designed to facilitate the adoption process, but we are not responsible for the actual adoption process or any agreements made between pet owners and adopters.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="about-section-modern mt-4 mb-4">
                <div class="about-content">
                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-building text-primary mr-2"></i>2. Not a Shelter or Rescue Organization</h3>
                        <p class="mb-0">Pawsitive Placements is a technology platform only. We are not an animal shelter, rescue organization, veterinarian, or enforcement agency. We do not take custody of animals, evaluate pets, verify health or behaviour, or oversee any adoption or rehoming process.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-laptop text-primary mr-2"></i>3. Use of the Website</h3>
                        <p class="mb-3">You must be at least 18 years old to use our website. By using our website, you agree to:</p>
                        <ul class="list-unstyled ml-3 mb-0">
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Provide accurate and truthful information about yourself and your pet(s).</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Not use our website for any unlawful or unauthorized purpose.</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Not post any content that is defamatory, obscene, or harassing.</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Not use our website to solicit or promote any business or organization.</li>
                            <li class="mb-0"><i class="fas fa-check-circle text-success mr-2"></i>Not attempt to hack or disrupt the operation of our website.</li>
                        </ul>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-paw text-primary mr-2"></i>4. Listing and Adoption Process</h3>
                        <p class="font-weight-bold mb-2">Pet owners who list their pets on our website are responsible for:</p>
                        <ul class="list-unstyled ml-3 mb-3">
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Providing accurate and truthful information about their pet(s).</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Ensuring that their pet(s) are healthy and well-cared for.</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Responding to inquiries from potential adopters in a timely and professional manner.</li>
                        </ul>
                        <p class="font-weight-bold mb-2">Potential adopters who apply to adopt pets on our website are responsible for:</p>
                        <ul class="list-unstyled ml-3 mb-3">
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Providing accurate and truthful information about themselves.</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Ensuring that they are prepared to provide a suitable home for the pet.</li>
                            <li class="mb-0"><i class="fas fa-check-circle text-success mr-2"></i>Responding to communications from pet owners in a timely and professional manner.</li>
                        </ul>
                        <p class="mb-0 mt-3"><strong>Animal Behaviour and Health Risk:</strong> Pawsitive Placements does not screen pets for health, temperament, or behaviour. Interacting with animals carries inherent risks. You agree that Pawsitive Placements is not responsible for injuries, damages, illnesses, or losses related to any pet listed on the platform.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-handshake text-primary mr-2"></i>5. Adoption Agreements and User-to-User Responsibility</h3>
                        <p class="mb-3">Any adoption agreements made between pet owners and adopters are between the parties involved and do not involve Pawsitive Placements. We are not responsible for enforcing any adoption agreements or resolving any disputes that may arise.</p>
                        <p class="mb-0"><strong>User-to-User Responsibility:</strong> Any communication, meeting, exchange, adoption, or agreement between users happens entirely at their own risk. Pawsitive Placements does not perform background checks or identity verification on users.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-dollar-sign text-primary mr-2"></i>6. Payment and Fees</h3>
                        <p class="mb-0">Pawsitive Placements does not charge any fees for listing pets or applying to adopt pets. However, we may charge fees for certain services, such as premium listings or advertising. Any fees will be clearly disclosed on our website.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-copyright text-primary mr-2"></i>7. Intellectual Property</h3>
                        <p class="mb-3">All content on our website, including text, images, and logos, is the property of Pawsitive Placements or our licensors. You may not reproduce, distribute, or display any content from our website without our prior written permission.</p>
                        <p class="mb-0"><strong>User Content License:</strong> By uploading photos or content, you confirm you own the rights and grant Pawsitive Placements a non-exclusive, royalty-free license to use that content for operating the platform.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-shield-alt text-primary mr-2"></i>8. Disclaimer of Warranties</h3>
                        <p class="mb-0">Our website is provided "as is" and "as available" without any warranties of any kind, express or implied. We do not warrant that our website will be error-free or uninterrupted, or that any defects will be corrected.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-exclamation-triangle text-primary mr-2"></i>9. Limitation of Liability</h3>
                        <p class="mb-0">In no event will Pawsitive Placements be liable for any damages, including but not limited to incidental, consequential, or punitive damages, arising out of the use of our website or any information or services provided on our website.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-gavel text-primary mr-2"></i>10. Governing Law</h3>
                        <p class="mb-0">These Terms and Conditions will be governed by and construed in accordance with the laws of British Columbia, Canada. Any disputes will be resolved by binding arbitration in British Columbia pursuant to the Arbitration Act (BC).</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-edit text-primary mr-2"></i>11. Changes to Terms and Conditions</h3>
                        <p class="mb-0">We reserve the right to modify these Terms and Conditions at any time without notice. Your continued use of our website after any changes to these Terms and Conditions will constitute your acceptance of the revised Terms and Conditions.</p>
                    </div>

                    <div class="feature-item mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-envelope text-primary mr-2"></i>12. Contact Us</h3>
                        <p class="mb-0">If you have any questions or concerns about these Terms and Conditions, please contact us at <a href="mailto:support@pawsitiveplacements.ca" class="text-primary font-weight-bold">support@pawsitiveplacements.ca</a>.</p>
                    </div>

                    <div class="alert alert-info mt-4 mb-0" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>By using our website, you acknowledge that you have read, understand, and agree to be bound by these Terms and Conditions.</strong>
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
