<?php
/**
 * CITADEL GHOST-COOKIE ENGINE v3.5 // STABILIZED
 */

// Use the INC_PATH constant from your config if possible, 
// otherwise absolute paths are fine for emergency stabilization.
require_once '/home/valhhfkf/private/citadel_config.php';
require_once '/home/valhhfkf/private/CitadelCrypto.php';

class CitadelCookie {
    public static function set($name, $value, $expiry = 0) {
        // We let CitadelCrypto handle the heavy lifting and key derivation
        $enc = CitadelCrypto::encrypt($value); 
        
        setcookie($name, $enc, [
            'expires' => $expiry > 0 ? time() + $expiry : 0,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    public static function get($name) {
        if (!isset($_COOKIE[$name])) return null;
        
        // Decrypt using the internal Master Key in CitadelCrypto
        $decrypted = CitadelCrypto::decrypt($_COOKIE[$name]);
        return ($decrypted === false) ? null : $decrypted;
    }
}

// 2. FORCE SESSION START
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