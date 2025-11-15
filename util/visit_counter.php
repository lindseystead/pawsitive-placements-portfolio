<?php
/**
 * Pawsitive Placements
 * 
 * @file       util/visit_counter.php
 * @author     Lindsey D. Stead
 * @date       November 2025
 * @description Visit counter utility. Tracks and displays total site visits.
 *              Uses session to prevent duplicate counting on page refreshes.
 */

require_once(__DIR__ . '/database.php');

/**
 * Increments and returns the total visit count
 * Uses session to prevent counting the same visitor multiple times per session
 * 
 * @return int Total visit count
 */
function increment_visit_count(): int {
    global $db;
    
    // Check if we've already counted this visit in this session
    if (!isset($_SESSION['visit_counted'])) {
        try {
            // Increment the visit count
            $stmt = $db->prepare("UPDATE site_visits SET visit_count = visit_count + 1 WHERE id = 1");
            $stmt->execute();
            $stmt->closeCursor();
            
            // Mark this session as counted
            $_SESSION['visit_counted'] = true;
        } catch (PDOException $e) {
            error_log("Error incrementing visit count: " . $e->getMessage());
        }
    }
    
    return get_visit_count();
}

/**
 * Gets the current total visit count
 * 
 * @return int Total visit count
 */
function get_visit_count(): int {
    global $db;
    
    try {
        $stmt = $db->prepare("SELECT visit_count FROM site_visits WHERE id = 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return (int)($result['visit_count'] ?? 0);
    } catch (PDOException $e) {
        error_log("Error getting visit count: " . $e->getMessage());
        return 0;
    }
}

/**
 * Formats the visit count with commas for readability
 * 
 * @param int $count Visit count
 * @return string Formatted count with commas
 */
function format_visit_count(int $count): string {
    return number_format($count);
}

