# Budget Tracker

## Project Overview

Budget Tracker is a web-based financial management system developed using PHP, MySQL, HTML, CSS, and JavaScript. The system helps users manage their personal finances by tracking income, expenses, categories, transactions, and financial reports.

The application provides an easy-to-use dashboard that allows users to monitor their financial activities and make better budgeting decisions.

---

## Features

### User Features

* User Registration and Login
* Secure Authentication System
* User Dashboard
* Profile Management
* Add Income
* Add Expenses
* View Transactions
* Category Management
* Financial Reports
* Budget Tracking
* CSV Report Export
* PDF Report Download

### Admin Features

* Admin Dashboard
* View All Users
* Manage User Accounts
* Block/Activate Users
* Dashboard Statistics
* System Monitoring

---

## Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript

### Backend

* PHP 8+

### Database

* MySQL

### Testing

* PHPUnit

### Version Control

* Git
* GitHub

---

## Project Structure

```text
Budget_Tracker/
│
├── admin_dashboard.php
├── dashboard.php
├── config.php
├── database/
├── login/
├── register/
├── profile/
├── category_management/
├── expense_module/
├── transaction_module/
├── report/
├── tests/
├── vendor/
└── README.md
```

---

## Installation

### Step 1: Clone Repository

```bash
git clone https://github.com/Mohankewat108/Budget_Tracker.git
```

### Step 2: Move Project

Copy the project folder into:

```text
xampp/htdocs/
```

### Step 3: Start XAMPP

Start:

* Apache
* MySQL

### Step 4: Create Database

Create a database named:

```sql
budget_tracker
```

Import the provided SQL file into MySQL.

### Step 5: Configure Database

Update database settings in:

```php
config.php
```

```php
$host = "localhost";
$db   = "budget_tracker";
$user = "root";
$pass = "";
```

### Step 6: Run Application

Open:

```text
http://localhost/budget_tracker
```

---

## Testing

This project uses PHPUnit for unit testing.

### Run Admin Dashboard Tests

```bash
vendor\bin\phpunit tests\AdminDashboardTest.php
```

### Run User Dashboard Tests

```bash
vendor\bin\phpunit tests\UserDashboardTest.php
```

### Run Report Tests

```bash
vendor\bin\phpunit tests\ReportTest.php
```

### Generate TestDox Report

```bash
vendor\bin\phpunit --testdox
```

---

## Test Coverage

The project includes tests for:

### User Dashboard

* Income Calculation
* Expense Calculation
* Balance Calculation
* Greeting Messages
* Search Functionality
* HTML Escaping

### Admin Dashboard

* User Statistics
* Admin Statistics
* Database Validation
* Security Validation

### Reports

* Income Summary
* Expense Summary
* Balance Calculation
* Date Filtering
* Category Reports
* Budget Analysis

---

## Security Features

* Session Authentication
* SQL Injection Protection using PDO Prepared Statements
* XSS Protection using htmlspecialchars()
* Access Control
* Secure User Sessions

---

## Author

**Mohan Kewat**

BSc Computer Science

Niels Brock Copenhagen Business College

---

## GitHub Repository

https://github.com/Mohankewat108/Budget_Tracker

---

## License

This project was developed for educational purposes as part of university coursework.
