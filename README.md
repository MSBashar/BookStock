# Assignment : 03

### Name : Shafiul Bashar
### Email: msbashar.info@gmail.com

---

<img width="1366" height="942" alt="register" src="https://github.com/user-attachments/assets/6d9a3158-e352-44d8-a0c3-487499cb51a2" /><img width="1366" height="1389" alt="edit profile" src="https://github.com/user-attachments/assets/f62d55f8-eb73-4078-8c9d-c98ff0c5a44f" /><img width="1366" height="679" alt="categories" src="https://github.com/user-attachments/assets/a318c685-74f1-4982-aa93-e84ae3e1cfc5" /><img width="1366" height="679" alt="books" src="https://github.com/user-attachments/assets/44d4be3d-114c-4d29-be93-2cf4cabd081a" /><img width="1366" height="1160" alt="edit book" src="https://github.com/user-attachments/assets/1fb94093-2b80-43e2-a6f4-d7b3617497c2" /><img width="1366" height="679" alt="view book" src="https://github.com/user-attachments/assets/6ccd0eec-0c25-4af1-b0cb-e8aa04529325" /><img width="384" height="512" alt="books tablets" src="https://github.com/user-attachments/assets/f7899c7d-1e80-4233-b488-7999bccb50c8" /><img width="326" height="580" alt="books mobile" src="https://github.com/user-attachments/assets/1214f04f-3d3d-4872-864c-ff8fd2ab6d75" />

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
3.  **Run Migrations:** `php artisan migrate:fresh --seed --seeder=RolePermissionSeeder`  `php artisan db:seed --class=DatabaseSeeder`.
4.  **Storage Link:** Run `php artisan storage:link` to enable cover image visibility.
5.  **Run Application:** `php artisan serve`.

## 🛡️ Security Measures
* **CSRF Protection:** All forms secured via Laravel's CSRF tokens.
* **Validation:** Strict server-side validation for ISBN uniqueness and image dimensions/types.
* **Prepared Statements:** Query Builder automatically uses PDO parameter binding to prevent SQL Injection.
