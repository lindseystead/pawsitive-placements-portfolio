<?php
/**
 * Pawsitive Placements
 * 
 * @file       sitemap.php
 * @author     Lindsey D. Stead
 * @date       November 2025
 * @description Dynamic XML sitemap generator for SEO. Includes all public pages,
 *              pet listings, and forum posts. Updates automatically as content changes.
 */

header('Content-Type: application/xml; charset=utf-8');

require_once('util/session.php');
require_once('model/database.php');
require_once('model/pet_db.php');
require_once('model/forum_db.php');

$site_url = get_site_url();

// Get current date for lastmod
$lastmod = date('Y-m-d');

// Get all approved pets
$pets = get_pets(); // Gets approved pets only

// Get all active forum posts
$forum_posts = [];
try {
    require_once('model/forum_db.php');
    $forum_posts = get_forum_posts(['status' => 'active'], 1000); // Get up to 1000 posts
} catch (Exception $e) {
    // If forum functions don't exist, continue without forum posts
    error_log("Error fetching forum posts for sitemap: " . $e->getMessage());
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

// Homepage
echo '  <url>' . "\n";
echo '    <loc>' . htmlspecialchars($site_url . '/index.php') . '</loc>' . "\n";
echo '    <lastmod>' . $lastmod . '</lastmod>' . "\n";
echo '    <changefreq>daily</changefreq>' . "\n";
echo '    <priority>1.0</priority>' . "\n";
echo '  </url>' . "\n";

// Static Pages
$static_pages = [
    ['url' => '/home.php', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['url' => '/about/about.php', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['url' => '/pets/index.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['url' => '/pet-rehome/index.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['url' => '/forum/index.php', 'priority' => '0.8', 'changefreq' => 'daily'],
    ['url' => '/contact/index.php', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['url' => '/user/create_account.php', 'priority' => '0.6', 'changefreq' => 'monthly'],
    ['url' => '/view/terms-of-use.php', 'priority' => '0.5', 'changefreq' => 'yearly'],
    ['url' => '/view/privacy-policy.php', 'priority' => '0.5', 'changefreq' => 'yearly']
];

foreach ($static_pages as $page) {
    echo '  <url>' . "\n";
    echo '    <loc>' . htmlspecialchars($site_url . $page['url']) . '</loc>' . "\n";
    echo '    <lastmod>' . $lastmod . '</lastmod>' . "\n";
    echo '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
    echo '    <priority>' . $page['priority'] . '</priority>' . "\n";
    echo '  </url>' . "\n";
}

// Pet Detail Pages
foreach ($pets as $pet) {
    $pet_url = $site_url . '/pets/index.php?action=pet_detail&pet_id=' . $pet['pet_id'];
    $image_url = $site_url . '/' . ($pet['image_path'] ?? 'images/default_image.png');
    
    echo '  <url>' . "\n";
    echo '    <loc>' . htmlspecialchars($pet_url) . '</loc>' . "\n";
    echo '    <lastmod>' . ($pet['updated_at'] ?? $lastmod) . '</lastmod>' . "\n";
    echo '    <changefreq>weekly</changefreq>' . "\n";
    echo '    <priority>0.8</priority>' . "\n";
    if (!empty($pet['image_path'])) {
        echo '    <image:image>' . "\n";
        echo '      <image:loc>' . htmlspecialchars($image_url) . '</image:loc>' . "\n";
        echo '      <image:title>' . htmlspecialchars($pet['pet_name'] . ' - ' . $pet['pet_type']) . '</image:title>' . "\n";
        echo '      <image:caption>' . htmlspecialchars(substr($pet['description'] ?? '', 0, 200)) . '</image:caption>' . "\n";
        echo '    </image:image>' . "\n";
    }
    echo '  </url>' . "\n";
}

// Forum Posts
foreach ($forum_posts as $post) {
    $post_url = $site_url . '/forum/index.php?action=view_post&post_id=' . $post['id'];
    
    echo '  <url>' . "\n";
    echo '    <loc>' . htmlspecialchars($post_url) . '</loc>' . "\n";
    echo '    <lastmod>' . ($post['updated_at'] ?? $post['created_at'] ?? $lastmod) . '</lastmod>' . "\n";
    echo '    <changefreq>monthly</changefreq>' . "\n";
    echo '    <priority>0.6</priority>' . "\n";
    echo '  </url>' . "\n";
}

echo '</urlset>';

/**
 * Gets the site URL (handles both local and production)
 */
function get_site_url(): string {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script_name = dirname($_SERVER['SCRIPT_NAME']);
    
    if ($script_name === '/') {
        $script_name = '';
    }
    
    return $protocol . $host . $script_name;
}

