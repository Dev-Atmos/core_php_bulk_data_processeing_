# Core PHP Bulk Data Processing

A robust Core PHP application to upload, validate, process, and import large Excel/CSV datasets (1+ lakh rows) into a MySQL database using generators, batch processing, and a modular MVC-like architecture.

---

## 📦 Features

- ✅ Secure user login & registration system
- ✅ Modular Core PHP MVC structure
- ✅ CSV upload with validation & sanitization
- ✅ Memory-efficient CSV parsing using `Generator`
- ✅ Batch database insert to prevent memory exhaustion
- ✅ CLI importer for cron or command-line processing
- ✅ Logging system with timestamped log files
- ✅ Base URL + path constants for clean routing
- ✅ Apache virtual host support (no `/public/` in URLs)

---

## 🏗️ Project Structure

```
core_php_bulk_data_processeing_/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Helpers/
├── config/
│   └── db.php
├── public/
│   ├── index.php
│   └── assets/
├── views/
│   ├── auth/
│   ├── layout/
│   └── dashboard.php
├── uploads/
├── logs/
├── bootstrap.php
├── composer.json
```

---

## 🚀 Getting Started

### 📋 Requirements

- PHP 8.x
- MySQL 5.7+
- Composer
- Apache (WAMP/XAMPP or custom)

### 📥 Installation

```bash
git clone https://github.com/Dev-Atmos/core_php_bulk_data_processeing_.git
cd core_php_bulk_data_processeing_
composer install
```

### ⚙️ Configuration

1. Set up your database and update `config/db.php`:

```php
$pdo = new PDO("mysql:host=localhost;dbname=your_db", "username", "password");
```

2. Configure your virtual host to point to the `public/` folder.

3. Make sure folders are writable:

```bash
chmod -R 775 uploads logs
```

---

## 📤 CSV Import Guide

### Web-Based Import

- Login and go to the `/import` page.
- Upload your `.csv` file (1 lakh+ records supported).
- File is processed in chunks with memory-safe streaming.

### CLI Import (Optional)

```bash
php cli/import.php /absolute/path/to/yourfile.csv
```

---

## 🧾 Logging

Logs are stored in the `logs/` folder.

- `app.log` → General info logs
- `error.log` → Errors and exceptions
- `import.log` → Import-related logs (batch progress, skips)

---

## 📌 TODO

- [ ] Field-level validation & feedback
- [ ] Import history viewer
- [ ] Normalize staging → relational tables
- [ ] Admin panel for log viewer & stats

---

## 👨‍💻 Author

- **Dev Atmos** — [@Dev-Atmos](https://github.com/Dev-Atmos)

---

## 📄 License

MIT License
