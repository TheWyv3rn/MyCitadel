<div align="center">

<!-- LOGO / BANNER -->
<img src="https://mycitadel.lol/default_banner.jpg" alt="MyCitadel Banner" width="100%"/>

<br/>
<br/>

# ⬡ MyCitadel

### *Your Sovereign Digital Fortress*

**MyCitadel** is your sovereign digital fortress — a privacy-first social platform where *you* hold the keys. No ads. No tracking. No surveillance. Built on military-grade encryption, your identity, data, and connections stay yours alone. Connect, share, and thrive — fully shielded, completely free.

<br/>

<!-- BADGES ROW 1 — Status -->
![Status](https://img.shields.io/badge/Status-Live%20%26%20Active-00d4ff?style=for-the-badge&logo=statuspage&logoColor=white)
![Version](https://img.shields.io/badge/Version-1.0.0--alpha-7c3aed?style=for-the-badge&logo=git&logoColor=white)
![License](https://img.shields.io/badge/License-Proprietary-ff4757?style=for-the-badge&logo=opensourceinitiative&logoColor=white)
![PRs Welcome](https://img.shields.io/badge/PRs-Welcome-00b894?style=for-the-badge&logo=github&logoColor=white)

<br/>

<!-- BADGES ROW 2 — Tech Stack -->
![PHP](https://img.shields.io/badge/PHP-8.5-777bb4?style=for-the-badge&logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-11.4-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952b3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-2.4-d22128?style=for-the-badge&logo=apache&logoColor=white)

<br/>

<!-- BADGES ROW 3 — Security & Privacy -->
![Encryption](https://img.shields.io/badge/Encryption-Argon2id%20%2B%20XChaCha20-00d4ff?style=for-the-badge&logo=letsencrypt&logoColor=white)
![No Ads](https://img.shields.io/badge/Ads-Zero-ff4757?style=for-the-badge&logo=adblock&logoColor=white)
![No Tracking](https://img.shields.io/badge/Tracking-None-ff4757?style=for-the-badge&logo=privacybadger&logoColor=white)
![Zero Knowledge](https://img.shields.io/badge/Architecture-Zero%20Knowledge-00b894?style=for-the-badge&logo=keybase&logoColor=white)

<br/>

<!-- BADGES ROW 4 — Community & Support -->
![Platform](https://img.shields.io/badge/Platform-Web%20%7C%20Mobile%20Responsive-0984e3?style=for-the-badge&logo=googlechrome&logoColor=white)
![Accounts](https://img.shields.io/badge/Accounts-Free%20%26%20Premium-f39c12?style=for-the-badge&logo=stripe&logoColor=white)
![Made With](https://img.shields.io/badge/Made%20With-❤️%20%26%20Privacy-e84393?style=for-the-badge)

</div>

---

<br/>

## 📖 Table of Contents

- [What is MyCitadel?](#-what-is-mycitadel)
- [The Vision](#-the-vision)
- [Our Goals](#-our-goals)
- [How It Works](#-how-it-works)
- [Citadel Citizens — Meet the Users](#-citadel-citizens--meet-the-users)
- [Free vs Premium Tier Comparison](#-free-vs-premium-tier-comparison)
- [Why You Are Safe With Us](#-why-you-are-safe-with-us)
- [Security Architecture](#-security-architecture)
- [Technology Stack](#-technology-stack)
- [Roadmap](#-roadmap)
- [Contributing](#-contributing)
- [Legal & Privacy](#-legal--privacy)
- [Contact](#-contact)

---

<br/>

## 🏰 What is MyCitadel?

> *"In a world where your data is the product, MyCitadel makes you the owner."*

**MyCitadel** is a next-generation, privacy-first social media platform built for the people who are done being surveilled, monetized, and manipulated. We are a community — a **Citadel** — where every user is a sovereign citizen of their own digital identity.

Unlike every mainstream social platform in existence, MyCitadel was engineered from the ground up with a single, unbreakable promise:

**We will never sell you. We will never watch you. We will never betray you.**

MyCitadel operates on a **zero-knowledge architecture** — meaning the mathematical and cryptographic operations that protect your identity happen *on your device, in your browser*, before anything ever touches our servers. We are designed to be blind to your secrets by design, not just by policy.

This is not a social network. This is your **Citadel** — your fortress in the digital age.

---

<br/>

## 🌌 The Vision

The internet was supposed to set us free.

Instead, the world's largest social platforms built surveillance empires on the backs of their users — harvesting behavioral data, micro-targeting psychology, and commodifying human connection for profit.

**MyCitadel was built as the answer.**

We envision a world where:

- 🔐 **Privacy is the default** — not a premium feature or a buried settings toggle
- 🚫 **Attention is not for sale** — no advertiser will ever pay to reach you through us
- 🧠 **Your data is yours** — full stop, no asterisks, no fine print
- 🌐 **Connection is human** — not algorithmic, not optimized for engagement metrics
- ⚖️ **Power belongs to users** — not shareholders, not data brokers, not governments

MyCitadel is the Citadel that the internet always needed — and we are building it, brick by encrypted brick.

---

<br/>

## 🎯 Our Goals

| # | Goal | Description |
|---|------|-------------|
| `01` | **Zero-Knowledge by Architecture** | Cryptographic operations happen client-side. The server never sees plaintext credentials or private content. |
| `02` | **No Advertising. Ever.** | Our revenue comes from Premium subscriptions only. Your attention is not a product. |
| `03` | **No Third-Party Tracking** | All external libraries (Bootstrap, Chart.js, FontAwesome, Fonts) are self-hosted. Zero CDN leakage. |
| `04` | **Military-Grade Encryption** | Argon2id for password hashing. XChaCha20-Poly1305 for symmetric encryption. Industry-leading standards. |
| `05` | **Sustainable Growth** | Scale responsibly — from shared hosting today to dedicated infrastructure as our community grows. |
| `06` | **Radical Transparency** | We document what we collect, why, and for how long. No hidden pipelines. No shadow profiles. |
| `07` | **Inclusive Access** | The Free tier is fully functional — not a crippled demo. Premium enhances. It does not gatekeep. |
| `08` | **Community First** | Features are driven by Citadel Citizens, not investor roadmaps. |

---

<br/>

## ⚙️ How It Works

MyCitadel's architecture is fundamentally different from conventional social platforms. Here is the high-level flow:

### 🔑 Registration & Identity

```
Your Browser / Device
        │
        ▼
┌─────────────────────────────────┐
│  1. You enter credentials       │
│  2. Argon2id hashing runs HERE  │  ← Client-side, never sent raw
│  3. Unique UUID generated       │
│  4. Encrypted payload sent →    │
└─────────────────────────────────┘
        │
        ▼
  MyCitadel Server
  (Receives ONLY the hash — never your password)
        │
        ▼
┌─────────────────────────────────┐
│  MariaDB stores:                │
│  • UUID (your identity token)   │
│  • Argon2id hash only           │
│  • Encrypted profile data       │
│  • Zero plaintext secrets       │
└─────────────────────────────────┘
```

### 🔄 Session Flow

```
Login Attempt
    │
    ▼
Browser re-hashes credentials with Argon2id
    │
    ▼
Server compares hash-to-hash (never plaintext-to-hash)
    │
    ▼
Session token issued via XChaCha20-Poly1305 encrypted channel
    │
    ▼
You are inside your Citadel ✅
```

### 🛡️ Data Flow Philosophy

```
What WE store:          What we DON'T store:
─────────────────       ──────────────────────
✅ Password hashes      ❌ Plaintext passwords
✅ Encrypted content    ❌ Behavioral tracking data
✅ UUIDs                ❌ Device fingerprints
✅ Timestamps           ❌ IP logs beyond security
✅ Tier status          ❌ Ad profiles
                        ❌ Third-party analytics
                        ❌ Sold data. Ever.
```

---

<br/>

## 👥 Citadel Citizens — Meet the Users

Every person who joins MyCitadel is not a "user" — they are a **Citadel Citizen**. A sovereign member of a community built on trust, privacy, and human connection.

### 🏛️ What Every Citadel Citizen Can Do

Regardless of tier, every Citadel Citizen has access to the full platform experience:

#### 🧑💻 Identity & Profile
- [ ] Create and customize a fully encrypted profile
- [ ] Upload a profile photo and cover image
- [ ] Write a bio, set your pronouns, link your external portfolio
- [ ] Choose your display name and unique @handle
- [ ] Control who can see each part of your profile (public / friends / private)

#### 📡 Social Feed
- [ ] Post text updates, images, and links to your timeline
- [ ] React to posts with a range of custom Citadel reactions
- [ ] Comment and thread conversations on any post
- [ ] Share and re-post content from other Citizens
- [ ] Control audience for every post individually

#### 🤝 Connections
- [ ] Send and accept friend requests
- [ ] Follow Citizens without mutual connection
- [ ] Block and report Citizens who violate community standards
- [ ] Organize connections into custom groups/circles

#### 💬 Messaging
- [ ] End-to-end encrypted direct messages
- [ ] Create private group chats
- [ ] Share images and files in messages
- [ ] Message read receipts (togglable)

#### 🔔 Notifications
- [ ] Real-time notification center
- [ ] Fine-grained control over what triggers alerts
- [ ] Notification history with clear/dismiss controls

#### ⚙️ Account Management
- [ ] Full account settings dashboard
- [ ] Download your own data at any time
- [ ] Permanently delete your account and all associated data
- [ ] Two-factor authentication (2FA) for enhanced login security

---

<br/>

## 💎 Free vs Premium Tier Comparison

> **MyCitadel Free is not a demo.** It is a complete, fully-featured experience for every Citadel Citizen. Premium unlocks *more* — it does not take anything away from Free users.

<div align="center">

| Feature | 🆓 Free Citizen | 💎 Premium Citizen |
|---|:---:|:---:|
| **Full Platform Access** | ✅ | ✅ |
| **Encrypted Messaging** | ✅ | ✅ |
| **Profile Customization** | ✅ | ✅ |
| **Social Feed & Posts** | ✅ | ✅ |
| **Friend & Follow System** | ✅ | ✅ |
| **Two-Factor Authentication** | ✅ | ✅ |
| **Data Download & Export** | ✅ | ✅ |
| **No Ads (Ever)** | ✅ | ✅ |
| **Zero Tracking** | ✅ | ✅ |
| ── | ── | ── |
| **Profile Media Storage** | `500 MB` | `50 GB` |
| **Post Scheduling** | ❌ | ✅ |
| **Advanced Analytics Dashboard** | ❌ | ✅ |
| **Group Chats** | `INVITE ONLY` | `Up to 500 members` |
| **File Sharing in Messages** | `Up to 25 MB` | `Up to 2 GB` |
| **Post Visibility Boost** | ❌ | ✅ |
| **Priority Support** | Community | `Direct 24/7` |
| **Early Access to Features** | ❌ | ✅ |
| **Premium Citadel Badge** | ❌ | ✅ |

</div>

<br/>

> 💡 **Premium exists to sustain MyCitadel — not to exploit you.** Your subscription funds servers, development, and a team that works every day to protect your digital sovereignty. No investors. No advertisers. Just Citizens supporting their Citadel.

---

<br/>

## 🛡️ Why You Are Safe With Us

We know that trust is earned — not declared. Here is exactly why MyCitadel is different, and why we mean it:

### 1. 🔐 Client-Side Cryptography

The cryptographic operations that protect your credentials and private data happen **in your browser, on your device** — before anything is transmitted to our servers. We are mathematically incapable of reading your password. That is not a policy. That is math.

### 2. 🚫 Absolute Zero Advertising

We have no advertising infrastructure. No ad server. No ad network integrations. No pixel trackers. No sponsored content algorithms. It does not exist in our codebase because we never built it. Revenue comes exclusively from Premium subscriptions.

### 3. 📦 Self-Hosted Dependencies

Every external library — Bootstrap, Chart.js, FontAwesome, Google Fonts — is **downloaded and self-hosted on our servers**. We do not load anything from third-party CDNs. This means:
- No Google, Cloudflare, or jsDelivr tracking your visits
- No request logging by third parties
- Faster load times and zero external dependency risk

### 4. 🧬 Argon2id Password Hashing

We use **Argon2id** — the winner of the Password Hashing Competition and the current gold standard — to hash passwords. Even if our database were ever fully compromised, your password would be computationally infeasible to reverse.

### 5. 🔒 XChaCha20-Poly1305 Encryption

Sensitive data at rest and symmetric encryption operations use **XChaCha20-Poly1305** — a modern authenticated encryption cipher designed to be nonce-misuse resistant with a 192-bit nonce that eliminates nonce-reuse vulnerabilities.

### 6. 🆔 UUID-Based Identity

Your identity inside MyCitadel is anchored to a randomly generated **UUID** — not your email, not your phone number, not your real name. These are required for account recovery only and are stored encrypted.

### 7. 🛑 ImunifyAV + Apache Security

Our server runs **ImunifyAV** for malware detection and **Apache 2.4** with hardened configurations. All traffic is enforced over TLS. Security headers are implemented to prevent XSS, clickjacking, and MIME-type attacks.

### 8. 🗑️ Right to Erasure

You can permanently delete your MyCitadel account at any time. When you do, **all data is purged from our systems** — not archived, not anonymized-and-retained, not sold. Gone.

### 9. 📋 No Shadow Profiles

We do not build profiles of non-users. We do not import your contacts to map your social graph. We do not use behavioral inference to build profiles you cannot see. What you give us is all we have.

### 10. 🌐 Transparent Operations

We maintain a living **Transparency Report** documenting:
- What data we collect and why
- Retention periods for every data type
- Any legal requests received (and our response policy)
- Infrastructure and security changes

---

<br/>

## 🔬 Security Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                    MyCitadel Security Stack                      │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  CLIENT LAYER (Browser / Device)                                │
│  ┌────────────────────────────────────────────────────────┐    │
│  │  • Argon2id (PHP Sodium) — password hashing            │    │
│  │  • XChaCha20-Poly1305 — symmetric encryption           │    │
│  │  • UUID generation — identity tokens                   │    │
│  │  • TLS 1.3 enforced — all transport encrypted          │    │
│  └────────────────────────────────────────────────────────┘    │
│                          │                                       │
│                    (Encrypted Only)                              │
│                          │                                       │
│  SERVER LAYER (NameCheap / Apache 2.4 / PHP 8.5)               │
│  ┌────────────────────────────────────────────────────────┐    │
│  │  • ImunifyAV — malware detection                       │    │
│  │  • CSP / HSTS / X-Frame-Options headers                │    │
│  │  • Rate limiting on all auth endpoints                 │    │
│  │  • Input sanitization on all ingress points            │    │
│  │  • Prepared statements — zero SQL injection surface    │    │
│  └────────────────────────────────────────────────────────┘    │
│                          │                                       │
│  DATABASE LAYER (MariaDB 11.4)                                  │
│  ┌────────────────────────────────────────────────────────┐    │
│  │  • Encrypted storage for sensitive fields              │    │
│  │  • No plaintext credentials anywhere                   │    │
│  │  • Principle of least privilege — DB user permissions  │    │
│  │  • Audit logging for sensitive operations              │    │
│  └────────────────────────────────────────────────────────┘    │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

---

<br/>

## 🧰 Technology Stack

<div align="center">

| Layer | Technology | Purpose |
|---|---|---|
| **Language** | PHP 8.5 | Core backend & API |
| **Database** | MariaDB 11.4 | Primary data store |
| **Web Server** | Apache 2.4 | Request handling & routing |
| **Encryption** | PHP Sodium (libsodium) | Argon2id + XChaCha20 |
| **Caching** | APCu + Redis | Performance & session management |
| **Frontend** | Bootstrap 5 *(self-hosted)* | Responsive UI framework |
| **Charts** | Chart.js *(self-hosted)* | Analytics & data visualization |
| **Icons** | FontAwesome *(self-hosted)* | UI iconography |
| **Typography** | Google Fonts — Orbitron, Rajdhani *(self-hosted)* | Sci-fi aesthetic |
| **Security** | ImunifyAV + Apache Hardening | Server-side protection |
| **IDs** | UUID v4 | User & entity identification |
| **Sessions** | PHP Sessions + Redis | Secure session handling |
| **Uploads** | PHP GD / Vips | Image processing & optimization |

</div>

> **All frontend dependencies are downloaded and served locally.** No external CDN calls. No third-party request logging. Zero.

---

<br/>

## 🗺️ Roadmap

```
Phase 1 — Foundation          [🔄 In Progress]
─────────────────────────────────────────────
✅ Core authentication system (Argon2id)
✅ Encrypted session management
✅ User profiles & settings
🔄 Social feed & posting system
🔄 Encrypted direct messaging
🔄 Friend & follow system
🔄 Notification center

Phase 2 — Community           [📋 Planned]
─────────────────────────────────────────────
⬜ Group chats & communities
⬜ Post scheduling (Premium)
⬜ Analytics dashboard (Premium)
⬜ Custom themes (Premium)
⬜ Transparency Report v1.0
⬜ Premium subscription billing

Phase 3 — Growth              [🔭 Future]
─────────────────────────────────────────────
⬜ Mobile apps (iOS & Android)
⬜ Public API for Citizens (Premium)
⬜ Federated identity options
⬜ Dedicated server migration
⬜ Independent security audit
⬜ Open-source core components
```

---

<br/>

## 🤝 Contributing

MyCitadel is currently in active development. We welcome contributions from developers who share our values of privacy, security, and user sovereignty.

### Before You Contribute

Please read and agree to our contribution principles:

1. **Privacy is non-negotiable.** No feature may introduce tracking, logging of user behavior, or third-party data exposure.
2. **Security first.** All cryptographic decisions must use current best-practice algorithms. No MD5. No SHA1. No deprecated ciphers.
3. **User agency always.** Features should empower Citizens, not nudge, manipulate, or exploit.

### How to Contribute

```bash
# 1. Fork the repository
# 2. Create your feature branch
git checkout -b feature/your-feature-name

# 3. Commit your changes
git commit -m "feat: description of your feature"

# 4. Push to your branch
git push origin feature/your-feature-name

# 5. Open a Pull Request
```

### Contribution Guidelines

- Follow **PSR-12** coding standards for PHP
- All new auth/crypto code must include unit tests
- Document any new environment variables in `.env.example`
- Never commit secrets, API keys, or credentials
- PRs must pass all existing tests before review

---

<br/>

## ⚖️ Legal & Privacy

### License

MyCitadel is **proprietary software**. All rights reserved. Unauthorized copying, distribution, or modification of this software is strictly prohibited. See `LICENSE` for full terms.

### Privacy Policy

MyCitadel collects the minimum data necessary to operate the platform. We do not sell, rent, share, or broker any user data with any third party for any reason. A full Privacy Policy is available on the platform.

**Summary of what we collect:**

| Data Type | Why | Retention |
|---|---|---|
| Email address | Account recovery only (encrypted) | Until account deletion |
| Password hash (Argon2id) | Authentication | Until account deletion |
| UUID | Identity token | Until account deletion |
| Post content | To display your posts | Until you delete them |
| Session tokens | To keep you logged in | Until logout / expiry |
| Error logs | Server stability | 30 days, then purged |

**We do not collect:** IP address logs beyond security events, device fingerprints, behavioral tracking, ad profiles, or any data not listed above.

### Terms of Service

Use of MyCitadel is subject to our Terms of Service, available in-app and on our website. Key provisions:

- You own your content. We do not claim any license to your posts, images, or messages.
- You must be 13 or older to create an account.
- Harassment, hate speech, and illegal content are prohibited and will result in account termination.
- We reserve the right to terminate accounts that violate our Community Standards.

---

<br/>

## 📬 Contact

<div align="center">

| Channel | Link |
|---|---|
| 🌐 **Website** | `https://mycitadel.io` *(coming soon)* |
| 📧 **Security Reports** | `security@mycitadel.io` |
| 💬 **General Inquiries** | `hello@mycitadel.io` |
| 🐛 **Bug Reports** | [Open an Issue](../../issues) |
| 💡 **Feature Requests** | [Start a Discussion](../../discussions) |

> 🔐 **Security researchers:** We take all security disclosures seriously. Please report vulnerabilities responsibly via `security@mycitadel.io` before public disclosure. We commit to acknowledging all reports within 48 hours.

</div>

---

<br/>

<div align="center">

**Built with conviction. Engineered for sovereignty. Designed for you.**

<br/>

*"The Citadel does not watch you. The Citadel protects you."*

<br/>

![Made with PHP](https://img.shields.io/badge/Made%20with-PHP%208.5-777bb4?style=flat-square&logo=php&logoColor=white)
![Powered by MariaDB](https://img.shields.io/badge/Powered%20by-MariaDB-003545?style=flat-square&logo=mariadb&logoColor=white)
![Zero Tracking](https://img.shields.io/badge/Tracking-Absolutely%20Zero-00d4ff?style=flat-square)
![No Ads](https://img.shields.io/badge/Ads-None.%20Never.-ff4757?style=flat-square)

<br/>

© 2025 MyCitadel. All Rights Reserved.

</div>
