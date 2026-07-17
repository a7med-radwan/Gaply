<div align="center">

# Gaply · منصة تحليل الفجوة المهنية بالذكاء الاصطناعي

**An AI-powered career-gap analysis platform that guides graduates toward their target job with a personalised weekly development roadmap.**

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://php.net)
[![AI SDK](https://img.shields.io/badge/laravel%2Fai-SDK-0ea5e9)](https://github.com/laravel/ai)

</div>

---

## 📋 Table of Contents · فهرس المحتوى

- [About · عن المشروع](#about)
- [Features · الميزات](#features)
- [Tech Stack · التقنيات](#tech-stack)
- [Architecture · الهيكلة](#architecture)
- [Presentation · العرض التقديمي](#presentation)
- [Getting Started · التشغيل](#getting-started)
- [Project Structure · هيكل الملفات](#project-structure)
- [Author · المطوّر](#author)

---

## About

**Gaply** is a smart career-development web application built for recent graduates and job-seekers. It bridges the gap between a user's current skill set and the actual requirements of their target job using AI-driven analysis, then delivers a week-by-week action plan to close that gap.

**Gaply** منصة ويب ذكية للتطوير المهني، تُحلّل الفجوة بين مهارات المستخدم ومتطلبات وظيفته المستهدفة باستخدام الذكاء الاصطناعي، وتُصدر خطة تطوير أسبوعية مخصصة لسدّ تلك الفجوة.

---

## Features

| Feature | Description |
|---|---|
| 📊 **Career Readiness Dashboard** | Visual readiness gauge + smart status cards (skills, gaps, target job) |
| 🗂️ **Skills Inventory** | Add, edit, and rate personal skills (Beginner / Intermediate / Expert) |
| 🤖 **Bio Optimizer** | One-click AI rewrite of experience summaries using strong action verbs |
| 🗓️ **AI Career Plan** | Asynchronous weekly roadmap: courses, books, and hands-on projects per gap skill |
| 🎯 **Interview Coach** | Auto-generated technical Q&A (Easy / Medium / Hard) tailored to missing skills |
| 🔒 **Secure Auth** | Full authentication (register, login, password-reset) via Laravel Fortify |
| ⚡ **Background Jobs** | Heavy AI operations run via Laravel Queues, keeping the UI responsive |
| 💾 **Smart Caching** | Interview answers cached per skill to minimise redundant AI API calls |
| 🧹 **DB Observers** | Auto-clean outdated plans the moment a user updates their profile |

---

## Tech Stack

### Backend
| Technology | Purpose |
|---|---|
| **Laravel 11** | Core PHP framework |
| **laravel/ai SDK** | AI Agents, structured output schema, model orchestration |
| **Laravel Fortify** | Authentication scaffolding |
| **Laravel Queues & Jobs** | Async background processing |
| **Laravel Caching** | Redis/database cache layer for AI responses |
| **Eloquent Observers** | Reactive DB side-effects on model events |
| **Eloquent Scopes / Mutators / Enums** | Data integrity and clean model access |
| **RESTful Resource Controllers** | Standard CRUD routes for skills & plans |
| **Blade Layout Components** | Shared master layout to eliminate template duplication |

### Frontend
| Technology | Purpose |
|---|---|
| **Blade Templates** | Server-side rendering |
| **Vanilla CSS + Custom Properties** | Design system, dark/light theme |
| **Vanilla JS** | Interactive elements, no external dependencies |

---

## Architecture

```
┌─────────────────────────────────────────────────────────┐
│                        User Browser                     │
│          Blade Views  ←  Blade Components               │
└────────────────────────┬────────────────────────────────┘
                         │ HTTP (RESTful)
┌────────────────────────▼────────────────────────────────┐
│                   Resource Controllers                   │
│          (Skills, CareerPlan, Bio, Interview)            │
└──────┬─────────────────┬──────────────────┬─────────────┘
       │                 │                  │
  ┌────▼────┐    ┌───────▼──────┐   ┌──────▼──────┐
  │Eloquent │    │ Service Layer│   │ Queue / Jobs│
  │ Models  │    │CareerPlanSvc │   │ (Async AI)  │
  │Observer │    │BioOptimizerSvc│  └──────┬──────┘
  │Scopes   │    └───────┬──────┘          │
  └────┬────┘            │         ┌───────▼───────┐
       │          ┌──────▼──────┐  │  laravel/ai   │
  ┌────▼────┐     │    Cache    │  │    SDK / LLM  │
  │Database │     │ (Redis/DB)  │  └───────────────┘
  └─────────┘     └─────────────┘
```

### Key Design Decisions

- **Service Layer** — All complex business logic and AI calls live inside dedicated service classes (e.g. `CareerPlanService`, `BioOptimizerService`). Controllers remain thin and focused on HTTP concerns.
- **Queued Jobs** — AI analysis is dispatched asynchronously so users see an interactive loading screen instead of a frozen browser tab.
- **Structured AI Output** — `laravel/ai` schema constraints ensure the LLM returns well-formed JSON (weekly plans, Q&A pairs) that can be directly persisted to the database.
- **Observers** — A `SkillObserver` and `TargetJobObserver` automatically invalidate and re-queue stale career plans when the user updates their data, keeping results fresh without manual triggers.

---

## Presentation

This repository also contains an **interactive HTML presentation** (`index.html`) showcasing the project features.

### Features of the presentation itself

- 🖥️ **7 animated slides** with cinematic entry transitions
- 🌙 / ☀️ **Dark / Light theme** toggle (persisted in localStorage)
- 📊 **Live progress bar** at the top of the screen
- ⌨️ **Keyboard navigation** (← / → arrow keys)
- 👆 **Touch swipe** support for mobile & tablet
- 🔢 **Slide counter** (Arabic numerals)
- 📱 **Fully responsive** — works on phones, tablets, and desktops
- 🖨️ **Print-ready** CSS for clean PDF export

### Running the presentation

No build step required — simply open `index.html` in any modern browser:

```bash
# Option A — double-click
start index.html

# Option B — VS Code Live Server
# Right-click index.html → Open with Live Server
```

---

## Getting Started

### Prerequisites

- PHP ≥ 8.3
- Composer 2.x
- Node.js ≥ 20 (for asset compilation)
- A database (MySQL / SQLite)
- An AI provider API key (OpenAI, Anthropic, etc.)

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/a7med-radwan/Gaply.git
cd Gaply

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Configure database and AI keys in .env
#    DB_DATABASE=gaply
#    AI_PROVIDER=openai
#    OPENAI_API_KEY=sk-...

# 6. Run migrations
php artisan migrate

# 7. Start the queue worker (for background AI jobs)
php artisan queue:work

# 8. Serve the application
php artisan serve
```

Then visit `http://localhost:8000`.

---

## Project Structure

```
Gaply/
├── app/
│   ├── Http/Controllers/        # Resource controllers (Skills, Bio, CareerPlan, Interview)
│   ├── Services/                # Business logic + AI integration
│   │   ├── CareerPlanService.php
│   │   ├── BioOptimizerService.php
│   │   └── InterviewCoachService.php
│   ├── Jobs/                    # Queued background jobs
│   ├── Models/                  # Eloquent models with Observers, Scopes, Enums
│   └── Observers/               # Auto-cleanup DB side effects
├── resources/
│   └── views/
│       ├── components/          # Blade layout components
│       ├── dashboard.blade.php
│       ├── skills/
│       ├── career-plan/
│       └── interview/
├── routes/web.php
├── database/migrations/
│
├── presentation/                # ← Interactive HTML presentation (this folder)
│   ├── index.html
│   ├── style.css
│   ├── script.js
│   └── image/Gaply/             # Screenshot assets
│
└── README.md
```

---

## Author

<div align="center">

**Ahmed Haitham Radwan**

*Presented at the UCAS Professional Innovation Incubator*
*eLancer Track — University College of Applied Sciences*

[![GitHub](https://img.shields.io/badge/GitHub-a7med--radwan-181717?logo=github)](https://github.com/a7med-radwan)

</div>

---

<div align="center">
<sub>Built with ❤️ using Laravel & AI · © 2026 Ahmed Haitham Radwan</sub>
</div>
