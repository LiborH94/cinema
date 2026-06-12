# Cinema Reservation System

A modern web application for cinema management and administration of halls, movies, and plays. Built with a focus on clean architecture, security, and robust testing.

## 📸 Screenshots


### 🏠 Home Page & Cinema Program
<img src="https://github.com/user-attachments/assets/9063d901-308c-484d-8221-d0e4ebead2e4" alt="Home Page" width="700" />

### 🛠️ Admin Dashboard: Hall & Seat Management
<img src="https://github.com/user-attachments/assets/8997a652-d517-4c98-9695-d989596cb9ba" alt="Admin Dashboard 1" width="700" />
<br />
<img src="https://github.com/user-attachments/assets/ecd2d807-28fe-4e5c-a715-a3992e4bf5ec" alt="Admin Dashboard 2" width="700" />

### 🎟️ Ticket Delivery & PDF Generation (with QR Code)
<br />
<img src="https://github.com/user-attachments/assets/ce440cbb-09b5-4ef2-9ea1-8bb57caf0b10" alt="Ticket PDF 2" width="700" />

---

## 🚀 Tech Stack

- **Backend:** Laravel 13 (PHP 8.3) & `barryvdh/laravel-dompdf` for ticket generation
- **Frontend:** Blade templates, Tailwind CSS & Alpine.js
- **Local Development:** Laravel Herd
- **Testing Suite:** Pest Framework

---

## ✨ Key Features

- **Complete Admin CRUD:** Seamless management of cinema halls, movies, plays and tickets.
- **Advanced Security & Middleware:** Custom `CheckProfileAccess` middleware protecting user data against unauthorized access, alongside strict Admin/User role separation.
- **Automated Ticket QR code Generation:** Every ticket features a unique QR code generated from its secure UUID, ready for electronic scanning at the cinema entrance.
- **UUID & ID Enumeration Protection:** The system uses secure UUIDs instead of auto-incrementing IDs, and returns a `404 Not Found` instead of a `403 Forbidden` for unauthorized requests. This completely prevents attackers from testing and trying to find out which IDs exist in the database and which do not.
- **Robust Testing:** High test coverage of critical paths using Feature tests, DB seeders, and factories for realistic data generation.

---

## 🔮 Future Plans

- **Seat Reservation:** Complete the interactive seat selection feature powered by Alpine.js and connect it to a payment gateway simulation.
- **Mobile-First Web App:** Fully redesign the user interface using a strict mobile-first approach, optimizing the seat-selection grid for smaller touch screens.
- **Frontend Refactoring (React):** Move away from Blade views and migrate the frontend to React (using Laravel Inertia.js) for a fully decoupled, single-page application experience.
