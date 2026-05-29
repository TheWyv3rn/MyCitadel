<?php
/**
 * PROJECT: MY CITADEL
 * COMPONENT: TELEMETRY & BEACON RECEIVER
 * DESCRIPTION: Handles anonymous session tracking, partial IP logging, 
 * and receives batched telemetry data from the client-side JS.
 */

// Define the absolute path for logs (Stored outside web root if possible)
define('TELEMETRY_DIR', __DIR__ . '/../logs/telemetry/');
if (!is_dir(TELEMETRY_DIR)) {
    mkdir(TELEMETRY_DIR, 0755, true);
}

// ------------------------------------------------------------------
// 1. AJAX ENDPOINT ROUTE (Handles incoming JS Beacon Data)
// ------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_CITADEL_BEACON'])) {
    
    // Read the raw JSON payload from the JS fetch() request
    $rawData = file_get_contents('php://input');
    $events = json_decode($rawData, true);
    
    if (is_array($events) && !empty($events)) {
        // We use the week number and year for the log file (e.g., telemetry_2026_W22.log)
        $weekLogFile = TELEMETRY_DIR . 'telemetry_' . date('Y_W') . '.ndjson';
        
        // Open file for APPEND ONLY. This prevents concurrency corruption.
        $fileHandle = fopen($weekLogFile, 'a');
        if ($fileHandle) {
            // Lock file momentarily to prevent race conditions during write
            if (flock($fileHandle, LOCK_EX)) {
                foreach ($events as $event) {
                    // Append Server-side timestamps to the client data
                    $event['server_time'] = date('Y-m-d H:i:s');
                    // Write single line JSON (NDJSON format)
                    fwrite($fileHandle, json_encode($event) . PHP_EOL);
                }
                flock($fileHandle, LOCK_UN); // Release lock
            }
            fclose($fileHandle);
        }
    }
    // Return a 204 No Content to keep the network payload light
    http_response_code(204);
    exit;
}

// ------------------------------------------------------------------
// 2. SESSION INITIALIZER (Runs when included in header.php)
// ------------------------------------------------------------------

// Start standard session if not already running
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Generates or retrieves the current tracking ID.
 * Handles the transformation from visitor -> logged in user.
 */
function getCitadelTrackerId() {
    // If the user logs in, we assume $_SESSION['user_id'] is set elsewhere in your auth code
    if (isset($_SESSION['user_id'])) {
        $trackerId = 'phpSID_' . hash('crc32b', $_SESSION['user_id'] . 'SECRET_SALT'); 
    } else {
        // Generate a random visitor ID if one doesn't exist
        if (!isset($_COOKIE['citadel_visitor'])) {
            // Generates visitor_0045A9 etc.
            $trackerId = 'visitor_' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
            // Set for 30 days
            setcookie('citadel_visitor', $trackerId, time() + (86400 * 30), "/");
            $_COOKIE['citadel_visitor'] = $trackerId; // Populate immediately
        } else {
            $trackerId = $_COOKIE['citadel_visitor'];
        }
    }
    return $trackerId;
}

/**
 * Masks the IP address for privacy compliance (e.g., 192.168.1.100 -> 192.168.XX.XX)
 */
function getPartialIp() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $parts = explode('.', $ip);
        return $parts[0] . '.' . $parts[1] . '.XX.XX';
    }
    // Basic IPv6 masking
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $parts = explode(':', $ip);
        return $parts[0] . ':' . $parts[1] . ':XXXX:XXXX:XXXX:XXXX';
    }
    return 'UNKNOWN';
}

/**
 * Simplified Browser Parser
 */
function getBrowserType() {
    $agent = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';
    if (stripos($agent, 'Firefox') !== false) return 'Firefox';
    if (stripos($agent, 'Chrome') !== false) return 'Chrome';
    if (stripos($agent, 'Safari') !== false) return 'Safari';
    return 'Other';
}

// Global JS configuration variables to pass into the frontend telemetry
$citadelTelemetryConfig = [
    'tracker_id' => getCitadelTrackerId(),
    'partial_ip' => getPartialIp(),
    'browser'    => getBrowserType(),
    'endpoint'   => '/includes/cookies.php' // Points back to this file
];
?>

<script>
    /**
     * MY CITADEL - CLIENT TELEMETRY MODULE
     * Batches events locally and sends them to the server quietly.
     */
    const CitadelTelemetry = (function() {
        const config = <?php echo json_encode($citadelTelemetryConfig); ?>;
        let eventQueue = [];
        let lastScrollY = window.scrollY;
        
        // Helper to push events to the queue
        function logEvent(action, details = '') {
            eventQueue.push({
                tracker_id: config.tracker_id,
                ip: config.partial_ip,
                browser: config.browser,
                url: window.location.href,
                referrer: document.referrer,
                action: action,
                details: details,
                timestamp: Date.now()
            });
            
            // Flush queue if it gets too large to prevent memory leaks
            if (eventQueue.length >= 20) flush();
        }

        // 1. Initial Page Load
        logEvent('page_view', `Loaded ${document.title}`);

        // 2. Click Tracking
        document.addEventListener('click', (e) => {
            let targetName = e.target.tagName;
            if (e.target.id) targetName += `#${e.target.id}`;
            if (e.target.innerText) targetName += ` (${e.target.innerText.substring(0, 15)})`;
            logEvent('left_click', targetName);
        });

        // 3. Right Click Tracking
        document.addEventListener('contextmenu', (e) => {
            let targetName = e.target.tagName;
            logEvent('right_click', targetName);
        });

        // 4. Typing (Not Harvesting)
        let isTyping = false;
        let typeTimer;
        document.addEventListener('keydown', (e) => {
            // Ignore system keys, only track actual typing actions
            if (e.key.length === 1 && !isTyping) {
                isTyping = true;
                logEvent('typing_started', e.target.tagName);
            }
            clearTimeout(typeTimer);
            typeTimer = setTimeout(() => { isTyping = false; }, 2000);
        });

        // 5. Scroll Tracking (Throttled for performance)
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            if (scrollTimeout) return;
            scrollTimeout = setTimeout(() => {
                let currentScroll = window.scrollY;
                let direction = currentScroll > lastScrollY ? 'down' : 'up';
                logEvent('scroll', direction);
                lastScrollY = currentScroll;
                scrollTimeout = null;
            }, 1000); // Only log a scroll once per second max
        });

        // 6. Beacon Dispatcher (Sends data silently on page exit or queue limit)
        function flush() {
            if (eventQueue.length === 0) return;
            
            let data = JSON.stringify(eventQueue);
            
            // Try navigator.sendBeacon (ideal for unloading pages), fallback to fetch
            if (navigator.sendBeacon) {
                // sendBeacon requires Blob for custom headers
                const blob = new Blob([data], { type: 'application/json' });
                navigator.sendBeacon(config.endpoint, blob);
            } else {
                fetch(config.endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Citadel-Beacon': 'true' // Trigger for the PHP script
                    },
                    body: data,
                    keepalive: true
                });
            }
            eventQueue = []; // Clear queue
        }

        // Send data when user leaves the page or closes the tab
        window.addEventListener('beforeunload', flush);
        window.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden') flush();
        });

        // Heartbeat - send data every 30 seconds if they are just staring at the screen
        setInterval(flush, 30000);

    })();
</script>