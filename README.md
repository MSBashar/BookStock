# Assignment : 03

### Name : Shafiul Bashar
### Email: msbashar.info@gmail.com

---

# 📚 BookStock - Library Management System

## 🚀 Project Overview
BookStock is a Laravel-based web application designed to manage a library's book inventory. It supports user roles (Admin, Editor, Guest) and provides full CRUD functionality for books, categories, and authors.

## 🛠️ Technical Implementation
* **Framework:** Laravel 12.x
* **Database:** MySQL
* **Query Engine:** Laravel Query Builder (`DB` Facade) - *Eloquent ORM is intentionally not used as per project constraints.*
* **Frontend:** Laravel Blade with Tailwind CSS.
* **Storage:** Laravel File Storage with Symbolic Linking.

## 📋 Features
* **User Authentication:** Secure Login, Registration, and Profile Management.
* **Relational CRUD:** Manage books linked to specific authors and categories.
* **Advanced Indexing:** Multi-table joins to display human-readable category and author names.
* **Image Management:** Secure book cover uploads with validation and automated storage pathing.
* **Role-Based Access:** Managed via logic to distinguish between Admin, Editor, and Guest capabilities.

## ⚙️ Installation & Setup
1.  **Clone the repository** and run `composer install`.
2.  **Configure Environment:** Rename `.env.example` to `.env` and set your database credentials.
3.  **Run Migrations:** `php artisan migrate`.
4.  **Storage Link:** Run `php artisan storage:link` to enable cover image visibility.
5.  **Run Application:** `php artisan serve`.

## 🛡️ Security Measures
* **CSRF Protection:** All forms secured via Laravel's CSRF tokens.
* **Validation:** Strict server-side validation for ISBN uniqueness and image dimensions/types.
* **Prepared Statements:** Query Builder automatically uses PDO parameter binding to prevent SQL Injection.
