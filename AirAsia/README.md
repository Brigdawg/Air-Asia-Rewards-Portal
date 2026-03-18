# AirAsia Rewards — Gift Card Redemption Portal

A full-stack web application that simulates a loyalty rewards redemption platform, inspired by AirAsia's BIG Points program. Users can browse, redeem, add, update, and remove gift cards from a catalog of 20+ partner brands — all backed by a relational MySQL database.

---

## The Problem I Was Solving

Airline loyalty programs often have clunky redemption interfaces that make it hard for customers to discover or manage available rewards. This project explores what a cleaner, more manageable admin-side experience could look like — giving operators full CRUD control over the gift card catalog.

---

## Features

- **Browse the catalog** — responsive card grid showing all available gift cards with icons, values, and points required
- **View card details** — full detail page per card with redemption info
- **Add new cards** — form with dropdown categorization and server-side validation
- **Edit existing cards** — pre-populated update form that validates all inputs before saving
- **Delete cards** — confirmation-guarded deletion via POST (prevents accidental or crawler-triggered deletes)
- **Relational data model** — `USER`, `ACCOUNT`, `GIFTCARD`, and `REDEMPTION` tables with foreign key constraints

---

## Tech Stack

| Layer | Technology |
|---|---|
| Frontend | HTML5, CSS3 (responsive grid layout) |
| Backend | PHP 8.x |
| Database | MySQL 8.x |
| Local Dev | MAMP (Apache + MySQL) |
| DB Admin | phpMyAdmin |

---

## Database Schema

```
USER ──< ACCOUNT ──< REDEMPTION >── GIFTCARD
```

- **USER** — customer accounts with roles (customer / admin)
- **ACCOUNT** — loyalty tier (Bronze / Silver / Gold / Platinum) and point balance
- **GIFTCARD** — redeemable gift cards with dollar value and points cost
- **REDEMPTION** — transaction log linking accounts to redeemed cards

The seed data includes 5 sample user accounts and 21 gift cards across 11 categories (Food & Beverage, Shopping, Entertainment, Travel, etc.).

---

## Application Flow

```
index.html (Welcome)
    └── card-list.php        ← Browse all gift cards
            ├── card-details.php   ← View one card
            │       ├── card-update.php  ← Edit card
            │       └── card-delete.php  ← Delete card (POST only)
            └── card-add.php       ← Add new card
```

---

## Running Locally

**Prerequisites:** [MAMP](https://www.mamp.info/) (or any Apache + MySQL stack)

1. **Clone the repo** and move the folder to your MAMP `htdocs` directory:
   ```
   /Applications/MAMP/htdocs/AirAsia-Submission/
   ```

2. **Import the database** via phpMyAdmin (`http://localhost:8888/phpMyAdmin`):
   - Create a database named `rewards`
   - Import `rewards.sql`

3. **Configure the connection** in `db-connect.php` if your MAMP uses a non-standard port:
   ```php
   $hn = 'localhost:3306'; // try 8889 if 3306 doesn't connect
   ```

4. **Open the app** at `http://localhost:8888/AirAsia-Submission/`

---

## What I Learned / PM Takeaways

- Designing a data model that reflects real-world loyalty program relationships (users → accounts → redemptions → rewards)
- Thinking through edge cases: what happens when a card is deleted that may have existing redemptions? (Foreign key constraints enforce integrity at the DB level)
- Validating inputs at both the client (HTML5 `required`, `type="number"`) and server (PHP whitelist validation) levels
- The UX importance of confirmation dialogs before destructive actions

---

## Possible Extensions

- User login and session management so customers see only their own account and point balance
- A "Redeem" flow that deducts points from an account and logs to the `REDEMPTION` table
- Search and filter on the card list by category or points range
- Admin vs. customer role separation (read-only view for customers, full CRUD for admins)
