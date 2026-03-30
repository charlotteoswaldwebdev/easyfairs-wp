# 🌐 Easyfairs WordPress Multisite

A local WordPress multisite built as a technical test for Easyfairs. The project demonstrates modern WordPress engineering practices: Bedrock-based Composer dependency management, Docker Compose for local infrastructure, Gutenberg Full Site Editing, and a controlled-yet-flexible editor experience across two distinctly branded event sites.

---

## 📋 Table of Contents

- [Project Structure](#project-structure)
- [Prerequisites](#prerequisites)
- [Setup Instructions](#setup-instructions)
- [Accessing the Sites](#accessing-the-sites)
- [Multisite Overview](#multisite-overview)
- [Theme Architecture](#theme-architecture)
- [Technical Decisions](#technical-decisions)
- [Assumptions](#assumptions)
- [What I Would Improve Next](#what-i-would-improve-next)

---

## 📁 Project Structure

```
.
├── config/                         # Bedrock environment-specific WP configs
│   ├── environments/
│   │   ├── development.php
│   │   └── staging.php
│   └── application.php             # Core WP application config
├── docker/
│   └── mysql-init/
│       └── create-test-db.sql      # Test database initialisation
├── tests/                          # PHPUnit / Pest test suite
│   ├── Feature/
│   │   ├── ContactFormTest.php
│   │   └── MultisiteTest.php
│   ├── unit/
│   ├── bootstrap.php
│   ├── Pest.php
│   ├── TestCase.php
│   └── wp-tests-config.php
├── web/
│   ├── app/
│   │   ├── mu-plugins/             # Must-use plugins
│   │   │   ├── bedrock-autoloader.php
│   │   │   ├── bedrock-disallow-indexing/
│   │   │   ├── contact-form/       # Custom contact form mu-plugin
│   │   │   └── multisite-url-fixer/
│   │   ├── plugins/                # Composer-managed plugins
│   │   ├── themes/
│   │   │   ├── charlottes-web/     # Custom FSE block theme
│   │   │   └── twentytwentyfive/
│   │   └── uploads/                # Excluded from Git
│   └── wp/                         # WordPress core (Composer-managed, excluded from Git)
├── composer.json
├── composer.lock
├── docker-compose.yml
├── Dockerfile
├── phpunit.xml.dist
├── pint.json
├── wp-cli.yml
├── .env.example                    # Environment variable template
└── README.md
```

---

## ✅ Prerequisites

Make sure you have the following installed on your machine before starting:

| Tool                                                              | Version    | Notes           |
| ----------------------------------------------------------------- | ---------- | --------------- |
| [Docker Desktop](https://www.docker.com/products/docker-desktop/) | Latest     | Must be running |
| [Git](https://git-scm.com/)                                       | Any recent | —               |
| [Composer](https://getcomposer.org/)                              | 2.x        | —               |

---

## 🤔 Assumptions

- The reviewer has Docker Desktop installed and running
- Subdomain-based multisite is acceptable (vs subdirectory)
- Demo content is intentionally minimal — enough to show the system, not to simulate a real event
- No SSL is needed for local review; plain HTTP is used
- The `uploads/` directory is excluded from Git; so no images loaded with build

---

## 🚀 Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/charlotteoswaldwebdev/easyfairs-wp.git
cd easyfairs-wp
```

### 2. Configure your environment

```bash
cp .env.example .env
```

Open `.env` and set your values. The defaults will work for local development without changes.

### 3. Add local hostnames

Add the following line to your `/etc/hosts` file:

**On macOS / Linux** — open with:

```bash
sudo nano /etc/hosts
```

**On Windows** — open `C:\Windows\System32\drivers\etc\hosts` as Administrator.

Add this line:

```
127.0.0.1   easyfairs.local techexpo.easyfairs.local foodsummit.easyfairs.local
```

### 4. Install PHP dependencies

```bash
composer install
```

### 5. Start the Docker environment

```bash
docker compose up -d
```

> This starts WordPress, MySQL, and phpMyAdmin. First run may take a minute while Docker pulls images.

## 🌍 Accessing the Sites

| URL                                          | Description                              |
| -------------------------------------------- | ---------------------------------------- |
| `http://localhost:8080/`                     | Network root / Site 1 (Tech Expo)        |
| `http://localhost:8080/tech-expo/`           | Site 1 — Tech Expo                       |
| `http://localhost:8080/food-summit/`         | Site 2 — Food Summit                     |
| `http://localhost:8080/wp/wp-admin/network/` | Network Super Admin                      |
| `http://localhost:8081/`                     | phpMyAdmin (optional, for DB inspection) |

## 🗂️ Multisite Overview

The network contains two sites, each representing a branded event platform:

**Site 1 — Tech Expo** (`http://localhost:8080/tech-expo/`)
A technology-focused event site. Dark, bold typography, blue accent palette.

**Site 2 — Food Summit** (`http://localhost:8080/food-summit/`)
A food and hospitality event site. Warm tones, approachable typography, earthy accent palette.

Both sites share the same `charlottes-web` block theme and the same editorial structure (templates, patterns, allowed blocks). Branding differences are applied through FSE **style variations** — one JSON file per site that overrides colours, typography, and spacing without changing any structural logic.

---

## 🎨 Theme Architecture

The custom theme lives at `web/app/themes/charlottes-web/` and is structured as follows:

```
charlottes-web/
├── parts/
│   ├── header.html
│   └── footer.html
├── patterns/
│   ├── hero.php
│   ├── features-grid.php
│   ├── cta.php
│   ├── contact-form.php
│   └── site-chooser.php
├── styles/
│   ├── tech-expo.json          # Style variation for Site 1
│   ├── food-summit.json        # Style variation for Site 2
│   └── main-site.json          # Style variation for the network root
├── templates/
│   ├── index.html
│   ├── front-page.html
│   └── page.html
├── functions.php
├── theme.json                  # Core design system + editor constraints
└── style.css
```

### How editorial control is enforced

`theme.json` defines the boundaries of what editors can do:

- **Colour palette** is locked to a curated set of brand-safe tokens; the full colour picker is disabled
- **Typography** is limited to the defined font scale; free-sizing is turned off
- **Spacing** uses a fixed scale (4px base) so layouts stay consistent
- **Allowed blocks** are filtered via a dedicated mu-plugin to remove blocks that have no use on event pages (e.g. audio, verse, table of contents)
- **Patterns** provide pre-built, structurally locked page sections that editors can insert but cannot break apart

### How branding flexibility works

Each site activates a **style variation** from the `/styles/` directory. A style variation is a single JSON file that inherits the full theme structure but overrides the colour palette, font family, and selected spacing values. This means:

- One theme codebase serves all sites
- Branding is changed in one place per site
- Adding a new branded site requires only a new JSON file — no theme duplication

---

## ⚙️ Technical Decisions

**Bedrock over plain WordPress**
Bedrock separates the application layer from WordPress core, keeps sensitive config in environment variables, and makes `composer.json` the single source of truth for all dependencies. This makes the project reproducible and avoids committing core files.

**Style variations over child themes**
Child themes would require duplicating all template and pattern files across every site. Style variations are pure JSON and version-controlled cleanly alongside the parent theme. The trade-off is that variations can only override what `theme.json` exposes — deep structural differences would need a different approach.

**mu-plugins for platform logic**
Platform-level concerns live in mu-plugins rather than the theme: `contact-form` registers the contact form shortcode and handles form submission, while `multisite-url-fixer` ensures URLs resolve correctly across the subdomain network. This separates platform concerns from visual concerns, meaning the theme could theoretically be swapped without losing this behaviour.

---

## Testing (PHPUnit)

To run a test, use `docker compose exec wordpress vendor/bin/pest`

_Framework: Pest running on top of PHPUnit_

**Test 1: ContactFormTest.php**
This tests the custom mu-plugin built for form submissions and handling
Broken down into 3 concerns:

- _Registration:_ Verifies the hooks exist (shortcode and admin_post). This test confirms WP wired everything up correctly on load.
- _HTML Output:_ Calls the shortcode and checks the rendered HTML contains the expected fields, posts to admin-post.php and that it includes a nonce field for Cross-Site Request Forgery (CSRF) protection.
- _State-based rendering:_ Simulates the form submission params to verify the form shows the right feedback messages. This catches bugs in the conditional display logic.

**Test 2: MultisiteTest.php**
Tests that the WP multisite network is correctly configured:

- Confirms is_multisite() returns true (checks the MULTISITE WP constant)
- Uses wpmu_create_blog() to create a second site programmatically and verifies get_sites() returns at least 2 – proving the multisite API works end to end against the test database.

This is more of a smoke test rather than feature testing. They confirm my setup is correctly configured to support WordPress Multisite, so that if I write any multisite-specific code, the test infrastructure is proven to support it.

**The Bootstrap - The Glue**
Points phpunit to my config file, loads my mu-plugin before WP boots so it is aware of the plugin’s existence and is able to test it properly.

---

## 🔭 What I Would Improve Next

Given more time, the following would be the priority next steps:

1. **Bootstrap the multisite** - write a setup script in scripts/setup.sh that bootstraps the multisite setup
2. **Include images in bootstrap** - due to time constraints and the lack of a setup script, the site is not fully 'copyable' for a new user.
3. **Expand test coverage** — Pest feature tests and a bootstrap are in place; next step is unit tests for the mu-plugin logic and broader integration coverage. I would strengthen the multisite feature testing, to do things like: check the contact form loads correctly across multiple sites, check the plugin is active across the network, check each site has its own isolated form submission, and check site specific email routing (test that the right emails are being used per site)
4. **GitHub Actions CI** — run more specific tests every push to keep the repo clean over time
5. **Nginx instead of the default Apache image** — better mirrors a typical production stack
6. **Store sensitive information in a txt file** - in docker-compose.yml I would move sensitive credentials into a txt file for more security.
7. **Redis Caching Service** — add a redis service to docker-compose.yml. I would use a plugin like W3 Total Cache or the bedrock compatible wp-redis.
8. **Styling and theme.json** - clean up unused or unreferenced code (used AI to generate standard template)
9. **Contact Form Plugin** - add a UI where users can set their own error or success messaging, customize colors, modify to and from emails etc. I would also install something like WP Mail SMTP to preview email contents and test email deliverability down the line.
10. **CPT mu-plugin** - create a tiny mu-plugin to create and register custom post types that connect events to their own subdomain site. This can then be used to write custom queries and use foreach loops to then create shortcodes or custom patterns to display these events.

---

## 🙏 Credits

Built on [Roots Bedrock](https://roots.io/bedrock/) — a modern WordPress stack maintained by the Roots team.
