# ⚔️ MYCITADEL ⚔️  
  
**A Privacy-First, Near Zero-Knowledge Communication Fortress**
  
## 🛡️ A. What is MyCitadel?  
  
**MyCitadel** is a secure haven for communication, engineered from the ground up to be entirely free from surveillance and unauthorized data mining.  
  
Built on a highly optimized, lean **PHP 8+** and **MariaDB** framework, it operates on a strict **Near Zero-Knowledge** (***NZK***) architecture. This means your sensitive information, messages, and interactions are encrypted client-side before they ever touch our servers. We cannot read your data, which means we cannot sell it, leak it, or surrender it.  
  
## 🚫 B. Zero Ads. Zero Tracking.  
  
> "We reject the surveillance capitalism model entirely."
  
**MyCitadel Guarantees:**  
  
* **⛔ Zero Advertisements**  
* **⛔ Zero Marketing Trackers** (_No Google Analytics, Meta Pixels, etc._)  
* **⛔ Zero Third-Party Data Sharing**  
* **⚠️ The Security Exception**: _The only tracking implemented on this platform is strict, security-focused session monitoring. We monitor the `sid` (**Session ID**) across page operations, clicks, and API requests exclusively to detect anomalous behavior. This ensures we can identify potential hackers, stop unauthorized account access, and mitigate automated DDoS attacks in real-time. **We track the threat, not the user**_. 
  
## 🤝 C. Who is Welcomed?
  
Citizens of the Citadel come from all walks of life. This platform is forged specifically for:  
  
* **🔐 Privacy Advocates & Cypherpunks** _who demand mathematical cryptographic guarantees over hollow corporate privacy policies_.  
* **💻 Infosec Professionals** _looking for a secure, isolated space to collaborate_.  
* **📰 Journalists & Activists** _who require uncompromising operational security to protect their sources_.  
* **👤 The Sovereign Citizen** _who is simply exhausted by being treated as a data-farmed product by Big Tech_.  
***As long as you respect the platform and your fellow Citizens, the gates are open***.  
  
## 🎖️ D. The Ecosystem: Status & Hierarchy  
  
**MyCitadel** isn't just about communication; it is about building a trusted, verifiable community. Citizens are ranked against each other based on positive contributions using two core metrics:  
* **Reputational Points (Badges)**: Earned through concrete actions. Did you submit a valid security bug? Did you contribute to the open-source codebase? Did you help a new user understand ZK encryption? These earn you permanent, visible badges that signify your technical and ethical standing in the Citadel.  
  
* **Influential Points (Interactions)**: A fluid metric based on community consensus. High-quality posts, verified information, and positive engagement raise your influence, naturally filtering out bots, trolls, and low-effort noise.  
  
## 🖥️ E. Tech Stack & Infrastructure Roadmap
  
Building a near zero-knowledge architecture requires absolute control over the metal it runs on.
  
### ⚙️ The Cryptographic Stack
* **Key Derivation**: Argon2id + Unique Salts  
* **Symmetric Encryption**: XChaCha20  
* **Message Authentication**: Poly1305 MAC  
  
### 🗺️ Deployment Roadmap  
> **Phase 1:** Staging & Alpha Testing (Current) > **Host**: Namecheap Shared Infrastructure  
* **Specs**: _LiteSpeed Webserver, High-performance SSDs, Unmetered Bandwidth_.  
* **Purpose**: _Temporary staging environment for CI/CD pipeline testing, database migrations, and UI/UX validation_.  
> **Phase 2:** The Fortress (Fundraising / Target) > To fully realize our ZK operations and run heavy cryptographic background jobs, we are migrating to a dedicated, sovereign bare-metal server.  
* **Location**: _Phoenix, Arizona, USA_  
* **Hardware**: _Intel Xeon E-2136 (6 Cores @ 3.3 GHz) | 32 GB DDR4 RAM | 2x 480 GB SSD (RAID 1)_  
* **Network**: _1000 Mbps public network (100 TB/mo bandwidth)_  
  
## 🛠️ F. How to Use & Deploy (Local Setup)  

To run a local node of MyCitadel for development or verification, you need a standard LAMP stack (Linux, Apache, MariaDB, PHP).

### Clone the Repository:
```
git clone git@github.com:TheWyv3rn/MyCitadel.git
cd MyCitadel
```
  
### Setup the Database:
Import the `database/schema.sql` (coming soon) into your local MariaDB instance.  
  
### Configure Environment:  
Rename `includes/db.sample.php` to `includes/db.php` and input your local database credentials.  
  
### Boot the Node:  
Serve the directory via Apache (`/var/www/html/mycitadel`) or run the PHP dev server:
```
php -S localhost:8000
```
  
# ⚔️ G. How to Contribute  

Securing the Citadel requires the brightest minds. We actively welcome contributions, but strict protocols must be followed.

## 🐛 For Hackers (Vulnerability Disclosure Program)

We actively welcome ethical hackers and security researchers to break our defenses. MyCitadel will soon be officially listed on **HackerOne**, **Bugcrowd**, **Intigriti**, and **YesWeHack**.
  
**Rules of Engagement:**  
Currently, we operate a strict VDP with NO financial rewards. Researchers who submit valid, in-scope vulnerabilities are rewarded with:
  
* An eternal spot in the Citadel Hall of Fame.  
* Exclusive Ecosystem Badges permanently attached to your profile.  
* The immense respect of securing a platform built to protect human privacy.  
  
### ⚠️ DO NOT OPEN PUBLIC GITHUB ISSUES FOR SECURITY BUGS. 
_See our official vdp.php page or email security@mycitadel.lol to report vulnerabilities privately_.  

## 💻 For Coders (Pull Requests)
  
Fork the repository and create a feature branch (`git checkout -b feature/ZeroKnowledgeUpgrade`).
  
ALL COMMITS MUST BE GPG SIGNED. Unsigned code will be automatically rejected.  
  
Submit a Pull Request detailing the exact architectural changes.  
  
**WELCOME TO THE CITADEL!!!!**  
 Please enjoy your stay. Send us a message on our GitHub Community board, reach out via email, and enjoy your secure communication at The Citadel!

📧 General Inquiries: info@mycitadel.lol

💻 Lead Developer: wyv3rn@mycitadel.lol