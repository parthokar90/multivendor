# Multivendor E-commerce System (Laravel)

A powerful **Multivendor E-commerce Platform** built with **Laravel**, where multiple vendors can register, manage their own shops, products, and orders, while the admin controls the entire system.

This system is suitable for building marketplaces like **Daraz, Amazon, or Etsy (small to mid-scale)**.

---

## 🚀 Core Features

### 👑 Admin Panel

* Admin authentication
* Dashboard with analytics
* Vendor approval & management
* Category & brand management
* Commission setup (global / vendor-wise)
* Order & payment monitoring
* Withdraw request approval
* CMS (Pages, Banners, Sliders)
* Reports (Sales, Commission, Vendors)

---

### 🏪 Vendor Panel

* Vendor registration & verification
* Vendor dashboard
* Shop profile management
* Product management (CRUD)
* Inventory & stock control
* Order management
* Earnings & commission tracking
* Withdraw request system

---

### 🛍 Customer Panel

* Customer registration & login
* Product browsing & search
* Product reviews & ratings
* Cart & checkout
* Multiple payment methods
* Order tracking
* Wishlist

---

### 📦 Product Management

* Multi-category support
* Brand support
* Product variants (size, color, etc.)
* Product images gallery
* SKU & stock tracking

---

### 🧾 Order & Payment

* Multi-vendor order splitting
* Order status tracking
* Invoice generation
* Payment gateways integration (Stripe / SSLCommerz / PayPal)
* Cash on Delivery (optional)

---

### 💰 Commission & Payout

* Admin commission system
* Vendor earnings calculation
* Withdraw request & history
* Payout management

---

### 📊 Reports & Analytics

* Total sales report
* Vendor-wise sales report
* Commission report
* Product performance report
* Customer order report

---

## 🛠 Tech Stack

* **Backend:** Laravel
* **Frontend:** Blade / Bootstrap / Tailwind
* **Database:** MySQL
* **Authentication:** Laravel Breeze / Fortify
* **Payment:** Stripe / SSLCommerz / PayPal

---

## 📂 Project Structure

```
multivendor-ecommerce/
├── app/
│   ├── Models/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   ├── Vendor/
│   │   └── Customer/
│   ├── Services/
│   └── Policies/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── vendor/
│   │   └── frontend/
├── routes/
│   ├── admin.php
│   ├── vendor.php
│   └── web.php
└── README.md
```

---

## ⚙️ Installation Guide

### 1️⃣ Clone Repository

```bash
git clone https://github.com/your-username/multivendor-ecommerce.git
cd multivendor-ecommerce
```

### 2️⃣ Install Dependencies

```bash
composer install
npm install && npm run dev
```

### 3️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update database credentials in `.env`

```env
DB_DATABASE=multivendor
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Migrate & Seed

```bash
php artisan migrate --seed
```

### 5️⃣ Storage Link

```bash
php artisan storage:link
```

### 6️⃣ Run Application

```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`

---

## 🔐 Roles & Permissions

* Admin
* Vendor
* Customer

---

## 📌 Future Enhancements

* Multi-language support
* Multi-currency support
* Mobile App API
* Vendor subscription plans
* Advanced recommendation system

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Submit a pull request

---

## 📄 License

Licensed under the **MIT License**.

---

## 👨‍💻 Author

**Partho**
Senior Software Developer
Laravel | PHP | MySQL | SaaS

---

⭐ If you find this project useful, give it a star!
