# Laravel Category Vector Search App

This application allows you to:
- Import categories from an Excel file
- Generate vector embeddings for AI-powered search
- Perform semantic category search using cosine similarity

---

## 🔧 Requirements

- PHP >= 8.1
- Laravel >= 10

- Composer
composer install

- MySQL
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass

Run Migration
php artisan migrate

Import Categories
php artisan import:categories storage/app/Lynx_Keyword_Enhanced_Services.xlsx

Store Embeddings
php artisan generate:embeddings

Url to run
e.g. [127.](http://127.0.0.1:8000/search)