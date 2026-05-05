<?php
/**
 * MYCITADEL: DATABASE CONNECTIVITY (PDO)
 * Configuration for local and production nodes.
 */

// Database Configuration
$db_host = 'localhost';
$db_name = 'DB_NAME_HERE';
$db_user = 'USER_HERE'; 
$db_pass = 'PWD_HERE'; // Update for your local MariaDB environment

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false, // Critical for security
    ];

    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    $db = $pdo;

} catch (\PDOException $e) {
    // Cyber-Viking Error Reporting
    error_log($e->getMessage());
    die("<div style='background:#05070a; color:#ff6600; padding:40px; font-family:monospace; border:4px solid #8a0303; text-align:center;'>
            <h1>[!] DATABASE CONNECTION SEVERED [!]</h1>
            <p>The Citadel's connection to the storage node has been lost.</p>
            <p style='color:#666;'>REASON: NODE_UNREACHABLE</p>
         </div>");
}