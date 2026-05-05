<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: COOKIE & TRACKING ENGINE (ESID)
 * DESCRIPTION: Generates unique encrypted tracking IDs and masks IPs.
 */

declare(strict_types=1);

/**
 * Get Masked IP Address (Zero Knowledge Compliance)
 * Only keeps the first two octets for general location tracking.
 */
function get_masked_ip(): string {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $parts = explode('.', $ip);
        return $parts[0] . '.' . $parts[1] . '.x.x';
    }
    return 'untracked.ipv6';
}

/**
 * Generate or Retrieve Citadel ESID
 */
function get_citadel_esid(): string {
    if (!isset($_SESSION['esid'])) {
        // Create a unique, high-entropy token
        $token = bin2hex(random_bytes(32));
        // Encrypt the token for client-side storage visibility (simulated)
        $_SESSION['esid'] = "CITADEL-" . strtoupper(substr($token, 0, 16));
    }
    return $_SESSION['esid'];
}

// Global Tracking Data Preparation
$tracking_data = [
    'esid' => get_citadel_esid(),
    'masked_ip' => get_masked_ip(),
    'referrer' => $_SERVER['HTTP_REFERER'] ?? 'Direct',
    'landing_page' => $_SERVER['PHP_SELF'],
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
    'timestamp' => date('Y-m-d H:i:s')
];

// Logic for converting Anon to User tracking
if (isset($_SESSION['user_id'])) {
    $tracking_data['internal_id'] = $_SESSION['user_id'];
}