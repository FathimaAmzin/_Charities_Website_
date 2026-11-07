# 🌐 Social Development Council (SDC) — International Charity & Community Support System

<p align="center">
  <img src="sdc-main/public/images/logo-sdc.jpg" alt="SDC Logo" width="120" style="border-radius: 50%; box-shadow: 0 4px 12px rgba(0,0,0,0.15);" onerror="this.src='https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg'; this.width=250;">
</p>

<p align="center">
  <strong>A modern, full-stack, enterprise-grade humanitarian NGO platform designed for community empowerment, donor transparency, welfare aid delivery, and volunteer mobilization.</strong>
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12"></a>
  <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+"></a>
  <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"></a>
  <a href="https://getbootstrap.com"><img src="https://img.shields.io/badge/Bootstrap-5.3.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5.3"></a>
  <a href="https://vitejs.dev"><img src="https://img.shields.io/badge/Vite-7.0-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 7"></a>
  <a href="https://www.mysql.com/"><img src="https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License MIT"></a>
</p>

---

## 📑 Table of Contents

- [About The Project](#-about-the-project)
  - [Background & Legacy](#background--legacy)
  - [Core Mission & Vision](#core-mission--vision)
- [Key Features](#-key-features)
  - [1. Public Humanitarian Portal](#1-public-humanitarian-portal)
  - [2. User & Member Portal](#2-user--member-portal)
  - [3. Comprehensive Admin Control Center](#3-comprehensive-admin-control-center)
- [Humanitarian Services & Courses](#-humanitarian-services--courses)
- [System Architecture & Tech Stack](#-system-architecture--tech-stack)
- [Database Schema & Core Entities](#-database-schema--core-entities)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation (Step-by-Step)](#installation-step-by-step)
  - [Database Setup & Seeding](#database-setup--seeding)
  - [Running the Application](#running-the-application)
- [Default Credentials](#-default-credentials)
- [Project Directory Structure](#-project-directory-structure)
- [Testing & Quality Assurance](#-testing--quality-assurance)
- [Production Deployment](#-production-deployment)
- [Security & Data Protection](#-security--data-protection)
- [Contributing](#-contributing)
- [License & Acknowledgements](#-license--acknowledgements)

---

## 🌍 About The Project

The **Social Development Council (SDC)** web platform is a comprehensive digital ecosystem crafted to streamline and elevate the humanitarian operations of non-governmental organizations (NGOs) and community welfare bodies. Rooted in two decades of direct grassroots service in Sri Lanka's Eastern Province, SDC bridges the gap between generous global donors, dedicated volunteers, and marginalized families in dire need of social assistance.

### Background & Legacy
Originating in Maligaikadu, Sri Lanka, SDC was created in response to urgent humanitarian imperatives—assisting communities recovering from natural disasters, seasonal cyclones, and entrenched socioeconomic hardship. Today, SDC spearheads multi-sectoral relief and development initiatives, maintaining strict accountability and 100% voluntary dedication.

### Core Mission & Vision
- **Dignity & Welfare:** Restore sustainable living standards through shelter construction, clean water access, household electrification, and basic sanitation.
- **Self-Reliance:** Provide free vocational education and certification to equip youth and heads of families with income-generating skills.
- **Radical Transparency:** Ensure every donation, aid allocation, and project milestone is systematically tracked, audited, and verifiable.

---

## 🚀 Key Features

### 1. Public Humanitarian Portal
- **Modern Responsive Design:** Crafted with Bootstrap 5.3, Tailwind CSS v4, and Plus Jakarta Sans typography.
- **Theme Switcher (Dark & Light Mode):** Instant theme persistence via `localStorage` with zero Flash of Unstyled Content (FOUC).
- **8 Core Humanitarian Domains:** Dedicated showcase pages detailing infrastructure, water, shelter, electricity, livelihood, widows' aid, disability care, and student empowerment.
- **Vocational Training Directory:** Detailed curriculum listings for vocational courses (IT, Tailoring, Culinary, English) and community seminars.
- **Online Service & Course Request Submission:** Interactive multi-step application forms allowing individuals to request aid or apply for free vocational programs.
- **Fundraising Campaigns & Progress Trackers:** Real-time funding progress bars, target amounts, days remaining, and direct donation buttons.
- **Transparent Donation System:** Support for online and manual banking donations, instant generation of unique receipt reference codes, and dedicated confirmation vouchers.
- **Volunteer & Membership Enrollment:** Dedicated registration portals with skill selection, background history, identity documents, and profile image uploads.
- **Press, News & Events:** Slug-optimized articles, press releases, community event listings, and event registration.
- **Interactive Media Gallery:** Visual showcases categorized by relief drives, projects, and ceremonies.
- **Contact & Inquiry System:** Direct inquiry messaging with database archiving and admin alerting.

### 2. User & Member Portal
- **Role-Based Authentication:** Clean sign-up, sign-in, session management, and password reset flows with email verification tokens.
- **Personal Dashboard (`/user/dashboard`):** Centralized hub displaying user-specific activities, application history, and personal records.
- **Application Tracking:** Monitor real-time status updates (Pending, Under Review, Approved, Rejected) for submitted course and aid requests.
- **Donation History:** View all past contributions, payment methods, transaction timestamps, and downloadable receipt codes.
- **Profile Management:** Update personal contact information, country, address, bio, and profile photo.

### 3. Comprehensive Admin Control Center (`/admin`)
Protected by role-based `AdminMiddleware` for authorized staff:
- **Executive Analytics Dashboard:** High-level metrics tracking total funds raised, active campaigns, ongoing projects, volunteer count, pending course requests, and recent activity logs.
- **Applications & Service Requests Triage:** Complete workflow management for incoming course requests and welfare aid applications, featuring one-click quick approvals/rejections and automated email decision notices (`RequestDecisionMail`).
- **Services & Courses CRUD:** Complete control to create, edit, customize highlight badges, service cards, and photo galleries for all services and vocational courses.
- **Fundraising & Projects Management:** Oversee active projects, set targets, record funds raised, configure featured items, and manage photo assets.
- **Donation & Donor Ledger:** Full registry of donors, donation verification interface for bank transfers, receipt lookup, and CSV export.
- **Volunteer & Member Roster:** Review applicant dossiers, qualification details, contact credentials, and update approval statuses.
- **Beneficiaries Registry:** Track vulnerable families and individuals receiving monthly support, welfare packages, or medical aid.
- **News, Events & Gallery Manager:** Full editorial suite for publishing articles, creating community events, and uploading high-resolution gallery images.
- **Reporting & Business Intelligence:** Generate and download comprehensive financial and operational data in CSV format.
- **User & Role Administration:** Manage registered users, toggle active/inactive status, and assign administrator privileges.
- **System Settings:** Centralized management of organizational contact information, notification preferences, and branding details.

---

## 🛠 Humanitarian Services & Courses

The platform natively supports and seeds **8 Core Humanitarian Domains** and **5 Vocational Disciplines**:

| Service Domain | Focus & Impact Scope |
| :--- | :--- |
| ⚡ **Electricity & Power** | Grid hookup aid, household wiring safety, solar kits for off-grid families. |
| 🎓 **Education & Students** | Scholarships, school kits, student mentorship, and academic seminars. |
| 🏠 **Shelter & Housing** | Safe brick-and-mortar homes, roofing repairs, and cyclone-resilient structures. |
| 💧 **Clean Water & Tube Wells** | Deep tube-well drilling, water filtration units, and community taps. |
| 🚿 **Basic Facilities & Sanitation** | Hygienic toilet units, drainage infrastructure, and clean health packs. |
| 🌾 **Livelihood Support** | Micro-grants, livestock distribution, sewing machines, and small trade tools. |
| 🤝 **Widows & Head of Families** | Monthly sustenance allowances, nutritional hampers, and emergency family aid. |
| ♿ **Disability Assistance** | Wheelchairs, mobility gear, specialized therapy access, and home modifications. |

### Free Vocational Courses
- **Professional Sewing & Tailoring** (Vocational certification for women empowerment)
- **IT Certificate Course** (Foundations of computing, office productivity, and digital literacy)
- **IT Diploma Course** (Advanced software, web fundamentals, and technical maintenance)
- **Culinary Arts & Cooking** (Commercial food prep, bakery, and hospitality skills)
- **English Diploma Course** (Spoken fluency, professional writing, and career communication)
- **Free Youth & Student Seminars** (Leadership, career counseling, and exam guidance)

---

## 💻 System Architecture & Tech Stack

```
+----------------------------------------------------------------------------+
|                             CLIENT / BROWSER                               |
|        Bootstrap 5.3  *  Tailwind CSS v4  *  FontAwesome 6  *  Vite 7      |
+----------------------------------------------------------------------------+
                                      |
                                  HTTP / HTTPS
                                      |
+----------------------------------------------------------------------------+
|                          LARAVEL 12 APPLICATION ENGINE                     |
|                                                                            |
|  [ Routing & Middleware ]                                                  |
|     * web.php (Public, Member, Admin groups)                               |
|     * AdminMiddleware / AuthMiddleware                                     |
|                                                                            |
|  [ Controllers & Business Logic ]                                          |
|     * HomeController, ServiceController, DonationController                |
|     * CourseRequestController, VolunteerController, MemberController        |
|     * Admin Namespace (Dashboard, Projects, Requests, Donations, Reports)  |
|                                                                            |
|  [ Presentation Layer ]                                                    |
|     * Blade Engine + Partials (Header, Footer, Modals)                     |
|     * Dark / Light Theme Engine                                            |
|                                                                            |
|  [ Mail & Notifications ]                                                  |
|     * RequestDecisionMail, PasswordResetMail                               |
+----------------------------------------------------------------------------+
                                      |
                            Eloquent ORM / PDO
                                      |
+----------------------------------------------------------------------------+
|                              DATA STORAGE                                  |
|         MySQL Database (charities)  *  Local Storage / Public Disk         |
+----------------------------------------------------------------------------+
```

- **Backend Framework:** [Laravel 12.x](https://laravel.com) (PHP 8.2+)
- **Frontend Frameworks:** [Bootstrap 5.3.3](https://getbootstrap.com) & [Tailwind CSS v4.0](https://tailwindcss.com)
- **Build Tool:** [Vite 7](https://vitejs.dev) via `laravel-vite-plugin` and `@tailwindcss/vite`
- **Database Engine:** [MySQL 8.0+](https://www.mysql.com) / MariaDB 10.4+
- **Icons & Typography:** FontAwesome 6.5.1, Plus Jakarta Sans
- **Mail Engine:** SMTP / Log Mailer with customizable HTML Blade mail templates

---

## 🗄 Database Schema & Core Entities

The application utilizes an optimized relational schema:

```
[ users ] 1 ---------< [ donations ]
    |
    +---------------< [ course_requests ]
    |
    +---------------< [ volunteer_applications ]
    |
    +---------------< [ member_applications ]

[ services ] --------< [ course_requests ]
[ categories ] ------< [ projects ]
[ categories ] ------< [ campaigns ]
```

- **`users`** — Identity, credentials, role flags (`admin`, `user`), profile attributes, and status flags.
- **`services`** — Service/course metadata, slug, categories, highlight lists, custom card attributes, and photo galleries.
- **`course_requests`** — Applications for welfare aid or vocational course enrollments with applicant background and decision statuses (`pending`, `under_review`, `approved`, `rejected`).
- **`donations`** — Financial contributions, transaction reference numbers, receipt codes, donor association, payment channels, and verification state.
- **`projects` & `campaigns`** — Target funding goals, collected totals, timeline dates, and progress markers.
- **`volunteer_applications` & `member_applications`** — Profiles, skillsets, availability, photos, and review outcomes.
- **`beneficiaries`** — Directory of recipients supported by SDC welfare packages.
- **`team_members`** — Board of Directors and Executive Staff portfolios.
- **`news` & `events`** — Articles, press statements, and scheduled community gatherings.
- **`gallery_images`** — Categorized photographic repository of field interventions.
- **`contact_messages`** — Inbound public inquiries and communication history.
- **`admin_notifications`** — Real-time event notifications for administrative review.

---

## 🏁 Getting Started

Follow these step-by-step instructions to get a local development environment up and running.

### Prerequisites

Ensure you have the following installed on your machine:
- **PHP** `>= 8.2` (with extensions: `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`)
- **Composer** `2.x` ([Get Composer](https://getcomposer.org/))
- **Node.js** `>= 18.x` & **npm** ([Get Node.js](https://nodejs.org/))
- **MySQL** `>= 8.0` or **MariaDB** (Available via [XAMPP](https://www.apachefriends.org/), Laragon, or standalone service)
- **Git** ([Get Git](https://git-scm.com/))

---

### Installation (Step-by-Step)

#### 1. Clone the Repository
```bash
git clone https://github.com/FathimaAmzin/_Charities_Website_.git
cd _Charities_Website_
```
*(If you cloned into an existing web root such as `c:/xampp/htdocs/sdc-main`, navigate into that project directory).*

#### 2. Install PHP Dependencies
```bash
composer install
```

#### 3. Install Node.js Dependencies
```bash
npm install
```

#### 4. Configure Environment Variables
Create a local `.env` file by copying the example:
```bash
cp .env.example .env
```
Open `.env` and configure your database settings:
```ini
APP_NAME="SDC International Charity"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=charities
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Generate Application Key
```bash
php artisan key:generate
```

#### 6. Create Storage Symlink
Link the `storage/app/public` directory to `public/storage` for uploads:
```bash
php artisan storage:link
```

---

### Database Setup & Seeding

You can configure the database using either of the two methods below:

#### Option A: Fresh Migrations & Seeders (Recommended for Clean Dev)
1. Ensure your MySQL server is running (e.g., via XAMPP Control Panel).
2. Create an empty database named `charities`:
   ```sql
   CREATE DATABASE charities CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Run the migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
4. Seed the services and leadership team data:
   ```bash
   php artisan db:seed --class=ServiceSeeder
   php artisan db:seed --class=TeamMemberSeeder
   ```

#### Option B: Import Pre-Configured Database Dump (`charities.sql`)
A complete database dump is included in the project root (`charities.sql`):
```bash
# Using MySQL CLI:
mysql -u root -p charities < charities.sql

# Or import `charities.sql` directly using phpMyAdmin / MySQL Workbench
```
Run any subsequent incremental migrations:
```bash
php artisan migrate
```

---

### Running the Application

#### Option 1: Run with Composer Concurrent Dev Script
The project includes a unified development command that launches the PHP server, queue listener, log tailing, and Vite simultaneously:
```bash
composer dev
```

#### Option 2: Run in Separate Terminals
**Terminal 1 (Backend Server):**
```bash
php artisan serve
```
*Application runs at: `http://127.0.0.1:8000`*

**Terminal 2 (Vite Asset Bundling):**
```bash
npm run dev
```

For production builds:
```bash
npm run build
```

---

## 🔑 Default Credentials

The database seeder provisions default accounts for development and testing:

### 🛡️ Administrator Account
- **Portal URL:** `http://127.0.0.1:8000/login`
- **Email:** `adminsdc@gmail.com`
- **Password:** `admin123`
- **Privileges:** Full access to `/admin` management modules, request decisions, financial ledger, and system settings.

### 👤 Test User / Member Account
- **Email:** `test@example.com`
- **Password:** `password`
- **Privileges:** Personal member dashboard, application tracking, donation history.

> ⚠️ **Security Notice:** Always update default administrative passwords before deploying to a production or publicly accessible server!

---

## 📂 Project Directory Structure

```plaintext
sdc-main/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                  # Admin CRUD controllers (Dashboard, Requests, Donations, etc.)
│   │   │   ├── User/                   # Member portal controllers (Dashboard, Profile)
│   │   │   ├── AuthController.php      # Custom authentication logic
│   │   │   ├── CourseRequestController.php
│   │   │   ├── DonationController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ServiceController.php
│   │   │   └── VolunteerController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php     # Admin role authorization gate
│   ├── Mail/                           # Mailable classes (RequestDecisionMail, PasswordResetMail)
│   └── Models/                         # Eloquent Models (User, Service, CourseRequest, Donation, etc.)
├── bootstrap/                          # Framework bootstrap and app providers
├── config/                             # Application configurations
├── database/
│   ├── factories/                      # Model testing factories
│   ├── migrations/                     # Database migration definitions
│   └── seeders/                        # Seeders (DatabaseSeeder, ServiceSeeder, TeamMemberSeeder)
├── public/                             # Public web root (index.php, compiled assets, images)
│   ├── css/                            # Custom styling (style.css, darkmode.css)
│   └── images/                         # Logos, service headers, team portraits
├── resources/
│   ├── css/                            # Tailwind source styles
│   ├── js/                             # JavaScript entrypoints
│   └── views/                          # Blade templates
│       ├── Admin/                      # Back-office administration views
│       ├── auth/                       # Login, Register, Forgot Password
│       ├── campaigns/                  # Campaign catalogs and details
│       ├── courses/                    # Course application interface
│       ├── donate/                     # Donation pages & confirmation vouchers
│       ├── emails/                     # Markdown email layouts
│       ├── layouts/                    # Master templates (app.blade.php)
│       ├── partials/                   # Reusable components (header, footer)
│       ├── services/                   # Service detail & request pages
│       └── user/                       # User/Member personal dashboard
├── routes/
│   ├── console.php                     # Artisan console commands
│   └── web.php                         # Application route mappings
├── storage/                            # Uploads, cache, logs, and compiled views
├── tests/
│   ├── Feature/                        # Feature integration tests (e.g. AdminRoutesTest.php)
│   └── Unit/                           # Unit tests
├── charities.sql                       # Complete MySQL database export
├── composer.json                       # PHP package dependencies and automated scripts
├── package.json                        # Node dependencies and Vite config
├── vite.config.js                      # Vite asset bundler configuration
└── README.md                           # Documentation guide
```

---

## 🧪 Testing & Quality Assurance

The project comes with test suites verifying route integrity and access restrictions:

```bash
# Run all automated PHPUnit tests
php artisan test

# Or run tests using Composer
composer test

# Run code style formatting via Laravel Pint
vendor/bin/pint
```

---

## 🚀 Production Deployment

When deploying to a production server (Ubuntu/Debian Nginx/Apache, cPanel, or VPS):

1. **Optimize Configuration & Routes:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
2. **Build Production Assets:**
   ```bash
   npm run build
   ```
3. **Set Web Server Document Root:**
   Ensure your web server (Apache/Nginx) directs traffic directly to the `public/` directory (not the project root) to protect sensitive environment files and source code.
4. **Queue Worker Configuration:**
   For asynchronous email dispatching:
   ```bash
   php artisan queue:work --tries=3
   ```
5. **SSL Certificate:**
   Install an SSL certificate (e.g., via Let's Encrypt / Certbot) and enforce HTTPS in `AppServiceProvider`.

---

## 🔒 Security & Data Protection

- **CSRF Defense:** All state-changing POST/PUT/DELETE forms are safeguarded with `@csrf` tokens.
- **SQL Injection Prevention:** 100% Eloquent ORM parameterized queries across all controllers.
- **Role Isolation:** Strict separation between regular users and administrative staff enforced through route middleware.
- **Credential Safety:** High-cost Bcrypt password hashing (`BCRYPT_ROUNDS=12`) with hidden attribute serialization.
- **Input Sanitization:** Rigorous form request validation on all public and authenticated submission endpoints.

---

## 🤝 Contributing

Contributions make the open-source community a tremendous environment to learn, inspire, and create:

1. **Fork the Project**
2. **Create your Feature Branch** (`git checkout -b feature/NewFeature`)
3. **Commit your Changes** (`git commit -m 'feat: Add NewFeature'`)
4. **Push to the Branch** (`git push origin feature/NewFeature`)
5. **Open a Pull Request**

---

## 📜 License & Acknowledgements

- **License:** Distributed under the **MIT License**. See `LICENSE` for more information.
- **Community:** Developed with honor and dedication for the **Social Development Council (SDC)** and all humanitarian volunteers serving communities in need worldwide.
- **Framework:** Powered by [Laravel](https://laravel.com), [Tailwind CSS](https://tailwindcss.com), [Bootstrap](https://getbootstrap.com), and the global open-source community.

<p align="center">
  <sub>Built with ❤️ for community empowerment and humanitarian service.</sub>
</p>
