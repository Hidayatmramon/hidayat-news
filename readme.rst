# Hidayat News CMS

A news publishing CMS built as a take-home coding assessment for a PHP developer role. Beyond basic CRUD, it includes login analytics with geo/ISP lookup and proxy/VPN detection on every login attempt.

## Built with

- CodeIgniter 3 (PHP)
- Bootstrap

## Roles

- **Admin**: full access to users, posts, and login logs
- **Editor**: content management access

## Core Features

### Authentication
- Login via username or email
- Google reCAPTCHA on login
- Role-based access control (Admin & Editor)

### Content Management
- Full CRUD for posts, with draft/published status and cover image
- Full CRUD for users

### Public Frontend
- News list and detail pages, responsive with Bootstrap

### Login Security & Analytics
- Every login attempt is logged with:
  - ASN, ISP, and geolocation (via ip-api)
  - User-agent details
  - Proxy/VPN detection (via ProxyRadar)

## Setup

### Requirements

- PHP 7.x
- MySQL
- A web server (Apache/XAMPP) with `mod_rewrite` enabled

### Installation

Clone the repository:

```bash
git clone https://github.com/hidayatmramon/hidayat-news.git
```

Create a MySQL database and import the schema, then update `application/config/database.php` with your database credentials.

Set your own API keys before running the project:

```
application/config/config.php     -> recaptcha_secret_key
application/config/proxy.php      -> proxyradar_api_key
```

> This project uses third-party APIs (Google reCAPTCHA, ProxyRadar). You'll need your own keys from each provider, since keys are not committed to this repository.

Run the app via your local server, then create an admin/editor account directly in the `users` table to log in for the first time.