# Gaply - Smart Career Guidance and Gap Analysis Platform 🚀

**Gaply** is a comprehensive professional platform built using the **Laravel** framework and AI technologies. The platform aims to help graduates and job seekers analyze the professional gap between their current skills and the actual requirements of the job market for their target roles. It then provides a personalized and intensive weekly career roadmap, complete with smart technical interview questions to prepare them for the job market.

---

## 🌟 Key Features

1. **Dashboard & Readiness Score:**
   An interactive chart that visualizes the user's readiness level for their target job by comparing their skills with current market requirements.

2. **Skills Inventory:**
   Complete management of user skills, categorized by level (Beginner, Intermediate, Expert).

3. **AI Bio Optimizer:**
   A smart tool that rephrases simple work experiences into a strong, professional bio tailored for recruiters and employers with a single click.

4. **AI Career Roadmap (Weekly):**
   A personalized, weekly development plan containing suggested resources (books, courses) and practical projects to bridge skill gaps.

5. **AI Interview Coach:**
   Automated generation of expected technical interview questions and model answers based on the user's missing skills and target job.

6. **Smart API V1 (Sanctum Auth):**
   Fully protected endpoints enabling external or mobile applications to consume the platform's features.

---

## 🛠️ Tech Stack & Architecture

* **Framework:** Laravel 13 (PHP 8.4)
* **Database:** SQLite
* **Artificial Intelligence:** Laravel AI SDK (`laravel/ai`) to manage AI clients and generate structured outputs.
* **Authentication & API Protection:** Laravel Fortify and Laravel Sanctum.
* **Queue Management:** Laravel Jobs & Queues to handle heavy AI operations in the background, keeping the user interface fast and responsive.
* **Design Patterns & Architecture:**
  * **Service Layer:** Decoupled business logic from Controllers.
  * **Database Transactions:** Ensures data integrity during sequential saves.
  * **Eloquent Observers:** Automated model lifecycle management (e.g., deleting old plans when a new plan is activated).
  * **Query Scopes & Custom Enums:** For clean, readable code and efficient database filtering.

---

## 🚀 Installation & Local Setup

### Prerequisites
* PHP >= 8.4
* Composer
* Node.js & NPM

### Setup Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/a7med-radwan/Gaply.git
   cd Gaply
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment file:**
   Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
   *Make sure to configure your Gemini API key (or other supported AI providers) in the `.env` file.*

4. **Generate application key and run migrations:**
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

5. **Build frontend assets:**
   ```bash
   npm run build
   # Or for development:
   npm run dev
   ```

6. **Start local servers:**
   In two separate terminal windows, run:
   * Web Server:
     ```bash
     php artisan serve
     ```
   * Queue Worker:
     ```bash
     php artisan queue:work
     ```

---

## 🧪 Testing

The platform features automated unit and feature tests to ensure stability and prevent regressions:

* **Unit Tests:** Verify the models and logic for [CareerPlan](file:///e:/UCAS/Code/Gaply/app/Models/CareerPlan.php) and [CareerPlanObserver](file:///e:/UCAS/Code/Gaply/app/Observers/CareerPlanObserver.php).
* **Feature Tests:** Check endpoint access and authorization for protected API routes.

To run tests:
```bash
# Run all tests
php artisan test

# Run Unit tests only
php artisan test --filter=CareerPlanTest

# Run API Feature tests only
php artisan test --filter=CareerPlanApiTest
```

---

## 📑 API Documentation (V1)

Endpoints are protected by **Laravel Sanctum**. You must pass the token in the request header as `Authorization: Bearer <token>`.

### 1. Generate a Test Token (via Tinker):
```bash
php artisan tinker --execute "App\Models\User::first()->createToken('token')->plainTextToken;"
```

### 2. Endpoints:

* **Generate a New Career Roadmap:**
  * **Endpoint:** `POST /api/v1/career-plans/generate`
  * **Response:** `202 Accepted`
  * **Response Example:**
    ```json
    {
        "message": "Career gap analysis started in the background.",
        "career_plan": {
            "id": 1,
            "target_job": "Software Engineer",
            "status": "pending"
        }
    }
    ```

* **Get Current Active Roadmap:**
  * **Endpoint:** `GET /api/v1/career-plans/active`
  * **Response:** `200 OK` (or `404 Not Found` if processing is not yet complete).
