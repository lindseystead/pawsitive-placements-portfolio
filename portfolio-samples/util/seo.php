<?php
/**
 * Pawsitive Placements
 * 
 * @file       util/seo.php
 * @author     Lindsey D. Stead
 * @date       November 2025
 * @description Comprehensive SEO utility functions for meta tags, structured data,
 *              and social sharing. Implements enterprise-level SEO strategy.
 */

/**
 * Generates comprehensive SEO meta tags for any page
 * 
 * @param string $title Page title (will be appended to site name)
 * @param string $description Meta description
 * @param string $keywords Comma-separated keywords
 * @param string $image_url Full URL to page image (for social sharing)
 * @param string $url Canonical URL for the page
 * @param string $type Open Graph type (website, article, product, etc.)
 * @param array $additional Additional meta tags as key-value pairs
 * @return string HTML meta tags
 */
function generate_seo_meta_tags(
    string $title,
    string $description,
    string $keywords = '',
    string $image_url = '',
    string $url = '',
    string $type = 'website',
    array $additional = []
): string {
    $site_name = 'Pawsitive Placements';
    $site_url = get_site_url();
    $full_title = $title . ' | ' . $site_name;
    
    // Default image if none provided
    if (empty($image_url)) {
        $image_url = $site_url . '/images/pawsitive_placements.png';
    }
    
    // Default URL if none provided
    if (empty($url)) {
        $url = $site_url . $_SERVER['REQUEST_URI'];
    }
    
    // Default keywords if none provided
    if (empty($keywords)) {
        $keywords = 'pet adoption, pet rehoming, adopt a pet, find a pet, pet adoption BC, British Columbia pet adoption, ethical pet adoption, rescue pets, adopt dogs, adopt cats, pet adoption platform';
    }
    
    $meta = '';
    
    // Basic Meta Tags
    $meta .= '<meta name="description" content="' . htmlspecialchars($description, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta name="keywords" content="' . htmlspecialchars($keywords, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta name="author" content="Lindsey D. Stead">' . "\n";
    $meta .= '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    $meta .= '<meta name="googlebot" content="index, follow">' . "\n";
    $meta .= '<meta name="language" content="English">' . "\n";
    $meta .= '<meta name="geo.region" content="CA-BC">' . "\n";
    $meta .= '<meta name="geo.placename" content="British Columbia, Canada">' . "\n";
    
    // Canonical URL
    $meta .= '<link rel="canonical" href="' . htmlspecialchars($url, ENT_QUOTES) . '">' . "\n";
    
    // Open Graph Tags (Facebook, LinkedIn, etc.)
    $meta .= '<meta property="og:type" content="' . htmlspecialchars($type, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta property="og:title" content="' . htmlspecialchars($full_title, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta property="og:description" content="' . htmlspecialchars($description, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta property="og:image" content="' . htmlspecialchars($image_url, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta property="og:url" content="' . htmlspecialchars($url, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta property="og:site_name" content="' . htmlspecialchars($site_name, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta property="og:locale" content="en_CA">' . "\n";
    
    // Twitter Card Tags
    $meta .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
    $meta .= '<meta name="twitter:title" content="' . htmlspecialchars($full_title, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta name="twitter:description" content="' . htmlspecialchars($description, ENT_QUOTES) . '">' . "\n";
    $meta .= '<meta name="twitter:image" content="' . htmlspecialchars($image_url, ENT_QUOTES) . '">' . "\n";
    
    // Additional meta tags
    foreach ($additional as $key => $value) {
        $meta .= '<meta name="' . htmlspecialchars($key, ENT_QUOTES) . '" content="' . htmlspecialchars($value, ENT_QUOTES) . '">' . "\n";
    }
    
    return $meta;
}

/**
 * Generates JSON-LD structured data for Organization
 * 
 * @return string JSON-LD script tag
 */
function generate_organization_schema(): string {
    $site_url = get_site_url();
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Pawsitive Placements',
        'url' => $site_url,
        'logo' => $site_url . '/images/logo.png',
        'description' => 'Ethical pet adoption and rehoming platform connecting pets with loving families across British Columbia, Canada.',
        'address' => [
            '@type' => 'PostalAddress',
            'addressRegion' => 'BC',
            'addressCountry' => 'CA'
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'email' => 'support@pawsitiveplacements.ca',
            'contactType' => 'Customer Service',
            'areaServed' => 'CA',
            'availableLanguage' => 'English'
        ],
        'sameAs' => [
            // Add social media URLs when available
            // 'https://www.facebook.com/pawsitiveplacements',
            // 'https://www.instagram.com/pawsitiveplacements',
            // 'https://twitter.com/pawsitiveplace'
        ]
    ];
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Generates JSON-LD structured data for a Pet
 * 
 * @param array $pet Pet data array
 * @return string JSON-LD script tag
 */
function generate_pet_schema(array $pet): string {
    $site_url = get_site_url();
    $pet_url = $site_url . '/pets/index.php?action=pet_detail&pet_id=' . $pet['pet_id'];
    $image_url = $site_url . '/' . ($pet['image_path'] ?? 'images/default_image.png');
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $pet['pet_name'] . ' - ' . $pet['pet_type'] . ' for Adoption',
        'description' => strip_tags($pet['description'] ?? ''),
        'image' => $image_url,
        'url' => $pet_url,
        'offers' => [
            '@type' => 'Offer',
            'price' => $pet['fee'] ?? '0',
            'priceCurrency' => 'CAD',
            'availability' => 'https://schema.org/InStock',
            'itemCondition' => 'https://schema.org/UsedCondition'
        ],
        'brand' => [
            '@type' => 'Brand',
            'name' => 'Pawsitive Placements'
        ],
        'category' => 'Pet Adoption',
        'additionalProperty' => [
            [
                '@type' => 'PropertyValue',
                'name' => 'Breed',
                'value' => $pet['breed'] ?? 'Mixed'
            ],
            [
                '@type' => 'PropertyValue',
                'name' => 'Age',
                'value' => ($pet['age'] ?? 'Unknown') . ' years'
            ],
            [
                '@type' => 'PropertyValue',
                'name' => 'Gender',
                'value' => $pet['gender'] ?? 'Unknown'
            ],
            [
                '@type' => 'PropertyValue',
                'name' => 'Location',
                'value' => $pet['city'] ?? 'British Columbia'
            ]
        ]
    ];
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Generates JSON-LD structured data for a WebSite with SearchAction
 * 
 * @return string JSON-LD script tag
 */
function generate_website_schema(): string {
    $site_url = get_site_url();
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Pawsitive Placements',
        'url' => $site_url,
        'description' => 'Ethical pet adoption and rehoming platform in British Columbia, Canada. Find your perfect pet companion or rehome your pet responsibly.',
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => $site_url . '/pets/index.php?action=list_pets&search={search_term_string}',
            'query-input' => 'required name=search_term_string'
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Pawsitive Placements',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $site_url . '/images/logo.png'
            ]
        ]
    ];
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Generates JSON-LD structured data for BreadcrumbList
 * 
 * @param array $breadcrumbs Array of ['name' => '...', 'url' => '...']
 * @return string JSON-LD script tag
 */
function generate_breadcrumb_schema(array $breadcrumbs): string {
    $site_url = get_site_url();
    
    $items = [];
    $position = 1;
    foreach ($breadcrumbs as $crumb) {
        $items[] = [
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => $crumb['name'],
            'item' => $site_url . $crumb['url']
        ];
    }
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items
    ];
    
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Gets the site URL (handles both local and production)
 * 
 * @return string Full site URL
 */
function get_site_url(): string {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script_name = dirname($_SERVER['SCRIPT_NAME']);
    
    // Remove trailing slash
    if ($script_name === '/') {
        $script_name = '';
    }
    
    return $protocol . $host . $script_name;
}

/**
 * Generates social sharing buttons HTML
 * 
 * @param string $url URL to share
 * @param string $title Title to share
 * @param string $description Description to share
 * @param string $image_url Image URL to share
 * @return string HTML for sharing buttons
 */
function generate_social_sharing_buttons(string $url, string $title, string $description = '', string $image_url = ''): string {
    $encoded_url = urlencode($url);
    $encoded_title = urlencode($title);
    $encoded_description = urlencode($description);
    $encoded_image = urlencode($image_url);
    
    $html = '<div class="social-sharing-buttons d-flex flex-wrap gap-2 mt-3">' . "\n";
    $html .= '<span class="mr-2 align-self-center"><strong>Share:</strong></span>' . "\n";
    
    // Facebook
    $html .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $encoded_url . '" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary social-share-btn" aria-label="Share on Facebook" title="Share on Facebook">' . "\n";
    $html .= '<i class="fab fa-facebook-f mr-1"></i> Facebook' . "\n";
    $html .= '</a>' . "\n";
    
    // Twitter
    $html .= '<a href="https://twitter.com/intent/tweet?url=' . $encoded_url . '&text=' . $encoded_title . '" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-info social-share-btn" aria-label="Share on Twitter" title="Share on Twitter">' . "\n";
    $html .= '<i class="fab fa-twitter mr-1"></i> Twitter' . "\n";
    $html .= '</a>' . "\n";
    
    // LinkedIn
    $html .= '<a href="https://www.linkedin.com/sharing/share-offsite/?url=' . $encoded_url . '" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary social-share-btn" aria-label="Share on LinkedIn" title="Share on LinkedIn">' . "\n";
    $html .= '<i class="fab fa-linkedin-in mr-1"></i> LinkedIn' . "\n";
    $html .= '</a>' . "\n";
    
    // Email
    $html .= '<a href="mailto:?subject=' . $encoded_title . '&body=' . $encoded_description . '%20' . $encoded_url . '" class="btn btn-sm btn-outline-secondary social-share-btn" aria-label="Share via Email" title="Share via Email">' . "\n";
    $html .= '<i class="fas fa-envelope mr-1"></i> Email' . "\n";
    $html .= '</a>' . "\n";
    
    // Copy Link
    $html .= '<button type="button" class="btn btn-sm btn-outline-dark social-share-btn" onclick="copyToClipboard(\'' . htmlspecialchars($url, ENT_QUOTES) . '\')" aria-label="Copy Link" title="Copy Link">' . "\n";
    $html .= '<i class="fas fa-link mr-1"></i> Copy Link' . "\n";
    $html .= '</button>' . "\n";
    
    $html .= '</div>' . "\n";
    
    // Add JavaScript for copy functionality
    $html .= '<script>' . "\n";
    $html .= 'function copyToClipboard(text) {' . "\n";
    $html .= '    navigator.clipboard.writeText(text).then(function() {' . "\n";
    $html .= '        alert("Link copied to clipboard!");' . "\n";
    $html .= '    }, function(err) {' . "\n";
    $html .= '        console.error("Could not copy text: ", err);' . "\n";
    $html .= '    });' . "\n";
    $html .= '}' . "\n";
    $html .= '</script>' . "\n";
    
    return $html;
}

/**
 * Generates internal linking suggestions for SEO
 * 
 * @param string $current_page Current page identifier
 * @return array Array of related internal links
 */
function get_internal_links(string $current_page): array {
    $links = [
        'home' => [
            ['url' => '/about/about.php', 'text' => 'Learn About Our Mission', 'anchor' => 'about'],
            ['url' => '/pets/index.php', 'text' => 'Browse Available Pets', 'anchor' => 'pets'],
            ['url' => '/forum/index.php', 'text' => 'Join Our Community', 'anchor' => 'forum']
        ],
        'pets' => [
            ['url' => '/pet-rehome/index.php', 'text' => 'Rehome Your Pet', 'anchor' => 'rehome'],
            ['url' => '/about/about.php', 'text' => 'About Pet Adoption', 'anchor' => 'about'],
            ['url' => '/forum/index.php?category=adoption_tips', 'text' => 'Adoption Tips', 'anchor' => 'tips']
        ],
        'pet_detail' => [
            ['url' => '/pets/index.php', 'text' => 'View More Pets', 'anchor' => 'more-pets'],
            ['url' => '/application/form.php', 'text' => 'Apply to Adopt', 'anchor' => 'apply'],
            ['url' => '/forum/index.php?category=pet_care', 'text' => 'Pet Care Resources', 'anchor' => 'care']
        ],
        'forum' => [
            ['url' => '/pets/index.php', 'text' => 'Find a Pet', 'anchor' => 'pets'],
            ['url' => '/about/about.php', 'text' => 'About Us', 'anchor' => 'about'],
            ['url' => '/contact/index.php', 'text' => 'Contact Support', 'anchor' => 'contact']
        ]
    ];
    
    return $links[$current_page] ?? [];
}

