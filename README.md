# Finance Familly

**Finance Familly** is a web application built with **Laravel** and **Filament** for managing family finances, cash flows, and currency exchanges. It helps track transfers, exchanges, and movements between cash accounts, providing a clear overview of financial operations in a family or small group setting.

---

## 🛠 Features

- **Cash Management**
  - Create and manage multiple cash accounts (`caisses`)
  - Track movements automatically on exchanges or transfers

- **Exchanges & Transfers**
  - Record currency exchanges with automatic calculation
  - Debit and credit cash accounts automatically
  - Support for multiple currencies (DZD, EUR)

- **Finance Tracking**
  - Display total amounts per operation
  - Track source and destination cash accounts
  - Calculate totals in source and destination currencies

- **Filament Admin Panel**
  - Modern, responsive UI
  - Forms with auto-calculation placeholders
  - Filters by type, currency, and cash accounts
  - Summarized totals in tables

- **Automations**
  - Automatic creation of cash movements on operations
  - Observer pattern ensures data consistency
  - Rollback-safe transactions

---

## 📦 Technologies

- **Backend:** Laravel 10
- **Frontend/Admin Panel:** Filament
- **Database:** MySQL
- **Languages:** PHP 8+, HTML, Tailwind CSS

---

## ⚙️ Installation

1. Clone the repository:

```bash
git clone https://github.com/<username>/finance-familly.git
cd finance-familly
