# Report a System Anomaly / Security Defect

Thank you for contributing to the integrity of the Citadel. We require a standardized, forensic-level breakdown of any anomalies to ensure rapid triage and remediation.

## Mandatory Anomaly Submission Guidelines

Please copy the template below and complete all fields. Reports missing these data points will be flagged for insufficient data and may be closed.

---

### [BUG] Anomaly Title
*Brief, descriptive title for the bug.*

### 1. Environment & Node ID
* **Browser/Container:** (e.g., Chrome 125, Firefox 127)
* **Node ID/Session Hash:** (If applicable)
* **Encryption Sandbox Version:** (e.g., XChaCha20 V1)
* **PHP Engine Version:** 

### 2. Threat Vector Description
*Clearly describe the behavior observed.*
- **Expected Outcome:** What should have happened under the Default-Deny protocol?
- **Actual Outcome:** What occurred that violated the Near Zero-Knowledge (N-NZK) framework?

### 3. Steps to Reproduce
1. Initialize the client-side container...
2. Inject the following payload: `[Insert Payload here]`
3. Trigger the following cryptographic operation...
4. Observed anomaly: 

### 4. Forensic Evidence
*Attach any logs or console outputs below. Ensure you redact your actual credentials or private keys before submission.*
```
[Insert Console Logs / Network Trace Here]
```
### 5. Architectural Impact
*How does this affect the Citadel?*
- [ ] Compromises Client-Side Sovereignty
- [ ] Threatens Blinded Transit
- [ ] Exposes Web Root Data
- [ ] Other: __________

---

## Submission Protocol
- **Public Reports:** Use this form for functional bugs that do *not* involve a security vulnerability.
- **Security Vulnerabilities:** If this report involves a compromise of the cryptographic chain or an bypass of the N-NZK framework, **STOP**. Do not submit this here. Follow the guidelines in our `SECURITY.md` for private, responsible disclosure.

*Built by a father, secured by a battle-tested specialist, and hardened to protect the people who matter most.*

**PROJECT CODE PRIVACY MANIFEST // V2.0**