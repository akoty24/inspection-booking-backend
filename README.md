
# 🛠️ Multi-Tenant Inspection Booking System

A modular, multi-tenant SaaS inspection booking system built with **Laravel**. Tenants can manage teams, define weekly availability, and generate dynamic inspection time slots for booking.

---

## 📌 Features

- 🏢 **Multi-Tenancy** (tenant_id scoped)
- 👥 **Team Management**
- 🗓️ **Weekly Team Availability**
- ⏱️ **Dynamic Time Slot Generation**
- 📆 **Booking System with Conflict Prevention**
- 🔐 **API Authentication using Sanctum**
- 📁 **Modular HMVC Structure**

---

## 🧱 Technologies

- Laravel 10+
- Sanctum
- MySQL
- HMVC Structure via `/Modules`
- Laravel Eloquent
- Carbon & CarbonPeriod

---

## 🗂 Suggested Folder Structure

```
/Modules
├── Auth
├── Tenants
├── Teams
├── Availability
├── Bookings
├── Users
```

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/akoty24/inspection-booking-backend
cd inspection-booking-backend
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit your `.env` with database and app info:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inspection_db
DB_USERNAME=root
DB_PASSWORD=

APP_URL=http://127.0.0.1:8000
```

### 4. Run Migrations & Seeders

```bash
php artisan migrate --seed
```

### 5. Serve the Application

```bash
php artisan serve
```

---

## 🔑 Authentication (Sanctum)

All API endpoints require authentication.

- Register a user: `POST /api/v1/auth/register`
- Login: `POST /api/v1/auth/login`

Add `Authorization: Bearer {token}` in headers to access protected routes.

---

## 📬 API Endpoints

### 🔐 Auth

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/auth/register` | Register tenant + admin |
| POST | `/api/v1/auth/login` | Get token |

---

### 🏢 Tenants

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/tenant` | Get current tenant info |

---

### 👥 Teams

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/teams` | List teams |
| POST | `/api/v1/teams` | Create a team |
| POST | `/api/v1/teams/{id}/availability` | Set weekly availability |

---

### 🕒 Time Slots

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/teams/{id}/generate-slots?from=YYYY-MM-DD&to=YYYY-MM-DD` | Generate 1-hour slots dynamically |

> ⚠️ Time slots are **not stored** in the database. They're generated on-the-fly based on team availability and filtered to avoid booked slots.

---

### 📅 Bookings

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/bookings` | List current user's bookings |
| POST | `/api/v1/bookings` | Book a time slot |
| DELETE | `/api/v1/bookings/{id}` | Cancel a booking |

---



## 🌱 Dummy Data (Seeders)

Run seeders to populate:

- Tenants
- Users
- Teams
- Team Availability
- Sample Bookings

```bash
php artisan db:seed
```

---

## 📂 Postman Collection

You can import the Postman collection located at:

```
docs/InspectionBooking.postman_collection.json
```

It includes requests for:

- Auth
- Team creation
- Availability setup
- Slot generation
- Booking

---

## ✍️ Notes

- Multi-tenancy is implemented using **tenant_id** scoping.
- Each user belongs to a tenant.
- All queries are automatically scoped to the authenticated user’s tenant.
- Time slot generation uses `CarbonPeriod` to loop through date ranges and check availability.
- Conflict checking is done in real time by comparing generated slots with existing bookings.

---

## 🧑‍💻 Author

**Mohamed Saber**  

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).
