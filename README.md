# Laravel Vector-Based Category Search

This Laravel application imports category names from an Excel file and performs AI-powered vector similarity search. Users can enter natural language search queries and get relevant categories based on semantic similarity.

---

## 🚀 Features

- Excel import of categories via Artisan command
- Category name to embedding conversion using free Hugging Face API
- Cosine similarity search on vector embeddings
- Blade form to perform and display search results
- Stores category embeddings in a separate table
- Laravel 11, Laravel Excel, Guzzle

---

## 🔧 Requirements

- PHP >= 8.2
- Composer
- Laravel >= 11
- SQLite / MySQL
- Excel file of categories
- Free Hugging Face API Token (optional for faster embedding)

---

## 📁 Setup Instructions

**Clone the Repository**

```bash
git clone https://github.com/UKFlash/BlueHoleAssessment.git
cd BlueHoleAssessment

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