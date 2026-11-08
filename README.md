# 🎉 Mini Event Management System

A web-based Event Management System built using **Laravel 12, PHP, MySQL, Bootstrap, AJAX, and Vue.js**.

This project allows administrators to manage events, categories, tickets, users, and registrations. Users can explore upcoming events and register for their preferred events.

---

## 📌 Project Overview

The Mini Event Management System is designed to simplify event management through a user-friendly web application.

It provides separate functionalities for Admin and Users with role-based access control.

## ✨ Features

### 👨‍💼 Admin Features
- Admin Login and Authentication
- Admin Dashboard
- Create, View, Update and Delete Events
- Manage Event Categories
- Manage Event Tickets
- View All Event Registrations
- Manage Users
- Update User Roles
- Delete Users
- Search and Pagination

### 👤 User Features
- User Registration and Login
- View Upcoming Events
- View Event Details
- Search Events using AJAX
- Register for Events
- View My Registrations
- Cancel Event Registration

### ⚙️ Additional Features
- Role-Based Access Control
- Form Validation
- Middleware Protection
- AJAX Search and Delete Interactions
- Vue.js Ticket List with Search
- Database Relationships
- Pagination
- CSRF Protection
- Responsive UI

---

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| PHP 8.2 | Backend Programming |
| Laravel 12 | PHP Framework |
| MySQL | Database |
| HTML5 | Page Structure |
| CSS3 | Styling |
| Bootstrap | Responsive UI |
| JavaScript | Client-Side Functionality |
| AJAX | Asynchronous Requests |
| Vue.js | Interactive Ticket List |
| Git & GitHub | Version Control |

---

## 🏗️ Project Architecture

This project follows the **MVC (Model-View-Controller)** architecture.

- **Model:** Handles database operations.
- **View:** Displays the user interface using Blade templates.
- **Controller:** Handles requests and application logic.

### Application Flow

Browser → Route → Controller → Model → Database → View → Browser

---

## 📂 Main Project Structure

```text
event_management/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
│
├── database/
│   └── migrations/
│
├── resources/
│   ├── views/
│   ├── js/
│   └── css/
│
├── routes/
│   └── web.php
│
├── public/
├── tests/
├── package.json
├── composer.json
└── README.md
```

---

## 🗄️ Database

The application uses MySQL.

Main database tables include:

- users
- events
- categories
- tickets
- registrations
- roles

The application uses Laravel Eloquent ORM to interact with the database.

---

## 🚀 Installation & Setup

Follow these steps to run the project locally.

### 1. Clone the Repository

```bash
git clone https://github.com/skhan233229-oss/event_management.git
```

### 2. Open Project Folder

```bash
cd event_management
```

### 3. Install PHP Dependencies

```bash
composer install
```

### 4. Create Environment File

```bash
copy .env.example .env
```

Configure your MySQL database credentials inside `.env`.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Install Frontend Dependencies

```bash
npm install
```

### 8. Build Frontend Assets

```bash
npm run build
```

### 9. Start Laravel Server

```bash
php artisan serve
```

Open in your browser:

```text
http://127.0.0.1:8000
```

---

## 🔐 Security

- Authentication and authorization
- Admin middleware protection
- CSRF protection
- Form validation
- Protected environment configuration

**Note:** Never upload your `.env` file or database credentials to GitHub.

---

## 🎯 Learning Outcomes

Through this project, I practiced:

- Laravel MVC Architecture
- PHP and MySQL Integration
- CRUD Operations
- Authentication and Authorization
- Middleware
- Eloquent ORM and Relationships
- AJAX Requests
- Vue.js Integration
- Form Validation
- Git and GitHub

---

## 👨‍💻 Developer

**Afzal Ali Khan**

MCA Student | Aspiring PHP & Laravel Developer

GitHub: https://github.com/skhan233229-oss

---

⭐ If you find this project useful, feel free to explore the repository!