/**
 * PROJECT: MY CITADEL
 * MODULE: SENTRY BEHAVIORAL TRACKER
 * DESCRIPTION: Detects tampering, F12, Right-clicks, and UI interactions.
 */

const CitadelSentry = {
    init() {
        this.trackRightClick();
        this.trackDevTools();
        this.trackInteraction();
        console.log("%c CITADEL SENTRY ACTIVE ", "background: #00f2ff; color: #000; font-weight: bold;");
    },

    // Detect Right Click
    trackRightClick() {
        document.addEventListener('contextmenu', (e) => {
            // Log this behavior to the server later
            console.warn("Security Alert: Context menu suppressed.");
            // e.preventDefault(); // Uncomment to disable right-click entirely
        });
    },

    // Detect F12 / DevTools
    trackDevTools() {
        let threshold = 160;
        setInterval(() => {
            if (window.outerWidth - window.innerWidth > threshold || 
                window.outerHeight - window.innerHeight > threshold) {
                // Potential tampering detected
                document.body.classList.add('tamper-detected');
            }
        }, 1000);

        document.addEventListener('keydown', (e) => {
            if (e.keyCode == 123) { // F12
                this.logEvent('f12_pressed');
            }
        });
    },

    // Track interactions for session profiling
    trackInteraction() {
        let lastActivity = Date.now();

        document.addEventListener('scroll', () => {
            lastActivity = Date.now();
        });

        document.addEventListener('keypress', (e) => {
            this.logEvent('input_activity', { target: e.target.name });
        });
    },

    logEvent(type, data = {}) {
        // Here we would use fetch() to send data to a log_action.php
        console.log(`[CITADEL LOG]: ${type}`, data);
    }
};

CitadelSentry.init();