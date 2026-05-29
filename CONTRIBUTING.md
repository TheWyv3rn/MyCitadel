# Contributing to MyCitadel

Welcome to the MyCitadel development ecosystem. We operate under a strict **Near Zero-Knowledge (N-NZK)** architectural mandate. All contributions must prioritize absolute user privacy, local data sovereignty, and robust threat mitigation.

## Architectural Mandates
Before submitting any pull requests, ensure your contributions adhere to our core operational principles:

1.  **Default-Deny:** Security is the baseline. No feature should allow data egress or unauthorized connection initiation.
2.  **Zero-Telemetry:** We do not harvest, track, or aggregate user data. If a feature requires telemetry, it must be anonymized, batched, and routed strictly through the internal Beacon Engine.
3.  **Client-Side Sovereignty:** Mathematical operations, encryption/decryption, and data processing must occur within the client-side container. The backend should only handle encrypted, opaque data shards.
4.  **Air-Gapped Privacy:** Do not introduce external dependencies (CDNs, external JS libraries, or tracking pixels) that compromise the air-gapped nature of the platform.

## Workflow & Submissions

### 1. Reporting Issues
* **Security Vulnerabilities:** If you identify a potential threat vector, **do not** open a public issue. Direct all security-sensitive findings to the project maintainer immediately via the established private communication channel.
* **Bug Reports:** Use the standard issue tracker for functional bugs. Include:
    * System Environment / Node ID.
    * Steps to reproduce the architectural failure.
    * Expected vs. Actual privacy outcome.

### 2. Pull Request Guidelines
* **Minimalist Scope:** Contributions must be granular and focused on a single architectural improvement.
* **Code Review:** All submissions will undergo strict vetting to ensure zero leakage of cryptographic keys or telemetry metadata.
* **Documentation:** Updates must be accompanied by corresponding modifications to the `System Manifest` if the operational pipeline is affected.

## Development Environment
To maintain consistency, all development should be performed in a containerized environment that mirrors our production hardening:
* **PHP Engine:** Ensure all concurrency uses `atomic flock` operations.
* **Assets:** All fonts and static dependencies must reside locally within the `/fonts` and `/vendor` directories. External resource calls are strictly forbidden.

## Cryptographic Standards
All new implementations involving data transit must utilize the `Libsodium XChaCha20` implementation. We do not support legacy hashing or weak encryption modules.

---

*Built by a father, secured by a battle-tested specialist, and hardened to protect the people who matter most.*

**PROJECT CODE PRIVACY MANIFEST // V2.0**