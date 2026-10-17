# Keystone Real Estate Theme

A full-stack, hybrid WordPress theme designed for high-performance real estate directories. Inspired by Zillow's interface, this project demonstrates advanced WordPress architecture by bridging modern Full Site Editing (FSE) capabilities with the classic WordPress Template Hierarchy.

## 🚀 Project Overview

Keystone is built to handle complex relational data, dynamic map-based rendering, and comprehensive frontend user management. It prioritizes strict security standards, DRY architectural principles, and a seamless, app-like user experience entirely independent of the `wp-admin` dashboard.

### Core Features

- **Hybrid Theme Architecture:** Seamlessly integrates Gutenberg Custom Blocks (FSE) with classic PHP template hierarchy, utilizing the best of both modern block editors and robust backend PHP routing.
- **Dynamic Map & Real-Time Property Rendering:** Features a custom-built interactive map block. Property cards render, update, and remove in real-time natively based on the user's map viewport and search parameters.
- **Frontend CRUD System:** A complete frontend dashboard allowing authorized users to post, edit, and delete real estate listings without ever accessing the WordPress backend.
- **Custom Authentication & Role Management:** Fully custom registration, login, and password reset flows. Includes specialized onboarding for the custom `Agent` user role.
- **Advanced Agent Directory:** Custom `WP_Query` loops with custom pagination handling dynamic agent search filters and displaying Zillow-style split-column profile cards.

## 🧠 Architectural Highlights (For Developers)

- **DRY Component Reusability:** Custom blocks are designed for modularity. For example, the core Property Card UI is built once and dynamically injected into both standard archive loops and the complex Map Block using `get_template_part()`, ensuring a single source of truth for UI components.
- **Strict Security & Sanitization:** Built strictly to WordPress coding standards. All frontend data inputs (CRUD operations, profile updates, search queries) are meticulously sanitized, escaped, and protected via nonce validation to prevent XSS and CSRF attacks.
- **SCSS Preprocessing:** Modular, maintainable stylesheets compiled via SCSS, ensuring lightweight asset delivery and strict design consistency across both blocks and classic templates.

## 🛠️ Tech Stack & Infrastructure

- **Core:** PHP 8+, WordPress (Hybrid FSE), JavaScript (ES6+).
- **Styling:** SCSS / CSS3.
- **Database Management:** WP-CLI for database migrations, serialized data search-and-replace, and environment synchronization.
- **Deployment & DevOps:**
  - Hosted on a dedicated Linux VPS with root access.
  - Version control and continuous deployment pipeline managed via Git.
  - Hardened `wp-config.php` environment configurations for strict URL mapping and security.

## 📊 Performance Metrics

Out-of-the-box Lighthouse performance metrics yield **100/100 on Best Practices** and blazing fast First Contentful Paint (FCP) times (~0.5s desktop), validating the lean, bloat-free theme architecture.
