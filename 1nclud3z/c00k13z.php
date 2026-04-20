<?php
/**
 * CITADEL GHOST-COOKIE ENGINE v3.4 // EMERGENCY_STABILIZATION
 */

// 1. HARD-LOAD THE KERNEL IMMEDIATELY
require_once '/home/valhhfkf/private/citadel_config.php';
require_once '/home/valhhfkf/private/CitadelCrypto.php';

class CitadelCookie {
    public static function set($name, $value, $expiry = 0) {
        $key = hash_hmac('sha256', 'CITADEL_COOKIE_KEY', MASTER_PEPPER, true);
        $enc = CitadelCrypto::encrypt($value, $key);
        setcookie($name, $enc, [
            'expires' => $expiry,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    public static function get($name) {
        if (!isset($_COOKIE[$name])) return null;
        $key = hash_hmac('sha256', 'CITADEL_COOKIE_KEY', MASTER_PEPPER, true);
        try {
            return CitadelCrypto::decrypt($_COOKIE[$name], $key);
        } catch (Exception $e) {
            return null;
        }
    }
}

// 2. FORCE SESSION START WITH ROOT PATH
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 28800,
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    session_start();
}

