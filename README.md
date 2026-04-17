# 📦 Italo Components

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Amazon API](https://img.shields.io/badge/Amazon_API-FF9900?style=for-the-badge&logo=amazon&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

**Italo Components** is a complete, custom-built Inventory and Sales Management System specifically designed for premium software components, digital assets, or hardware parts. Built with Vanilla PHP, MySQL, and Tailwind CSS, this project provides an intuitive and modern dashboard to track sales, manage low-stock alerts, print detailed invoices, and monitor business growth.

---

## 🎨 User Experience (UX) & Design

This project is built with a **UX-first mindset**, focusing on a premium, clean, and professional interface:
- **Zero-Click Awareness:** All critical business metrics are presented on a single screen to save time.
- **Micro-interactions:** Hover effects and transitions designed to provide immediate visual feedback.
- **Clean Aesthetic:** Using white space, high-quality typography (Serif for titles), and a soft palette to reduce user fatigue.

## 🛒 Data Integration (Amazon API)

To provide accurate and rich catalog data, the system integrates with the **Amazon Product Advertising API**:
- **Automatic Metadata:** Fetching high-resolution images and precise product names directly from Amazon's database.
- **Catalog Enrichment:** Synchronizing categories and prices to maintain a realistic and updated inventory system.

---

## ✨ Key Features

- 🎨 **Premium UX/UI Design:** Meticulously crafted with a "Glassmorphism" touch, featuring smooth transitions, hover effects, and a clean, high-end professional aesthetic.
- 🚨 **Dynamic Low-Stock Dropdown:** An intuitive user interface element that allows instant stock monitoring without leaving the main dashboard.
- 🛒 **Amazon API Integration:** Real-time product synchronization and catalog management powered by the Amazon Product Advertising API.
- 🧾 **Pro Invoice System:** Clear, detailed document generation with automated tax (IGV) and discount calculation.
- 📊 **Smart Data Analytics:** Advanced SQL ranking of "Top Sales" to help businesses identify their best-performing products instantly.

---

## ✨ Dasboard View
<img width="746" height="360" alt="Screencast from 2026-04-16 21-24-57" src="https://github.com/user-attachments/assets/50a18c3c-b156-474e-bff5-c48507db6b01" />

## ✨ Inventory View
<img width="746" height="360" alt="Screencast from 2026-04-16 21-02-28" src="https://github.com/user-attachments/assets/4e9d3dba-7107-4aa2-bf92-f1e85a6dfae9" />

## ✨ Sales manager View
<img width="746" height="360" alt="Screencast from 2026-04-16 21-13-10" src="https://github.com/user-attachments/assets/401a0b53-99d8-4980-b8af-28bc2003fcdd" />

## ✨ Invoice View
<img width="746" height="360" alt="Screencast from 2026-04-16 21-16-40" src="https://github.com/user-attachments/assets/8a9446f9-f6e4-48c0-bd20-95d8012e7ddc" />






## 🛠️ Technology Stack

- **Backend:** PHP 8+ (Vanilla, Object-Oriented Controllers)
- **Database:** MySQL / MariaDB (managed via PDO for security)
- **Frontend & Styling:** HTML5, Vanilla JavaScript (DOM manipulation), and Tailwind CSS (via CDN).
- **Alerts:** SweetAlert2 integration for beautiful, responsive popups.

---

## 📂 Project Structure

This project follows an MVC-inspired architecture for easy maintenance and scalability:

```text
/
├── connection/         # Database connection logic (bd.php) and SQL setup (bd.sql)
├── controllers/        # Business logic for Sales, Inventory, Invoices, and Dashboard stats
├── view/               # Frontend pages (index.php, sales.php, inventory.php, invoice.php)
│   └── components/     # Reusable UI parts (e.g., sidebar.php, imports.php)
├── index.php           # Entry point (auto-redirects users directly to the views)
└── README.md           # Project documentation
```

---

## 🚀 Getting Started

Follow these steps to run the project locally on your machine.

### Prerequisites
- Install a local server environment like **XAMPP, MAMP, or LAMP**.
- PHP 8.0 or higher.
- MySQL Database.

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/italo-components.git
   cd italo-components
   ```

2. **Set up the Database:**
   - Open phpMyAdmin (or your preferred MySQL client).
   - Create a new database (e.g., `italo_components`).
   - Import the provided SQL structure located at: `connection/bd.sql`.

3. **Configure the Connection:**
   - Open `connection/bd.php`.
   - Update the database credentials (`$host`, `$dbname`, `$username`, `$password`) to match your local setup.

4. **Run the Project:**
   - If using XAMPP/MAMP, place the project folder inside your `htdocs` or `www` directory and visit:
     ```text
     http://localhost/italo-components/
     ```
   - Alternatively, you can use the built-in PHP server from the project's root directory:
     ```bash
     php -S localhost:8000
     ```
     Then, open your browser and navigate to `http://localhost:8000/`. The root `index.php` file will automatically load the main dashboard view.

---



## 👨‍💻 Author

**[Dylan Florez / zairex-code]**
- Portfolio: [https://www.zairex-code.tech/](#)
- GitHub: [@your-username](https://github.com/zairex-code)
- LinkedIn: [https://www.linkedin.com/in/dylan-florez/](#)

Feel free to reach out if you have any questions or suggestions!

---
*If you liked this project and it helped you, please consider giving it a ⭐ on GitHub!*
