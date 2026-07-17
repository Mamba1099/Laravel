# Laravel Authentication System

A complete authentication system built with Laravel, featuring user registration, login, logout, and a protected dashboard.

## Features

- ✅ User Registration
- ✅ User Login
- ✅ User Logout
- ✅ Protected Dashboard
- ✅ Session Management
- ✅ Flash Messages
- ✅ Tailwind CSS Styling
- ✅ PostgreSQL Database Support

## Technologies Used

- **Laravel** - PHP Framework
- **PostgreSQL** - Database
- **Tailwind CSS** - Styling
- **Blade** - Templating Engine

## Requirements

- PHP >= 8.1
- Composer
- PostgreSQL >= 14
- Node.js & NPM

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/your-repo.git
cd your-repo
```
### 2. Install Dependencies
```bash
composer install
```
### 3. Environment Configuration
```bash
cp .env.example .env
```
Edit .env with your database credentials
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
### 4. Generate Application Key
```bash
php artisan key:generate
```
### 5. Run Migrations
```bash
php artisan migrate
```
### 6. Start Development Server
```bash
