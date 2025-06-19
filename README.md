# 🤖 Job-Finding Chatbot

A lightweight PHP and HTML-based chatbot system designed to help users find job opportunities. Includes features such as user registration, job upload, password reset, and a chatbot interface for querying jobs.

## 🌟 Features

- 🔐 User Registration & Login
- 🤖 Chatbot interface to find relevant jobs
- 📝 Upload job listings
- 🔁 Password reset with email
- 📁 Data stored in `.txt` files for simplicity
- 🚀 Laravel workflow CI (`laravel.yml`)

## 🗂️ File Structure

| File/Folder              | Description |
|--------------------------|-------------|
| `.github/workflows/laravel.yml` | GitHub Actions CI for Laravel (placeholder) |
| `index.html`             | Main landing page |
| `chatbot.html`           | Frontend chatbot interface |
| `chatbot.php`            | Backend chatbot logic |
| `bot.html`               | Alternative or embedded bot interface |
| `register.php`           | Handles user registration |
| `sign_in.php`            | Handles user login |
| `forgot_password.php`    | Handles "forgot password" requests |
| `reset_password.html`    | Reset form page |
| `reset_password.php`     | Backend for password reset |
| `get_user_email.php`     | Retrieves user's email for password reset |
| `upload_job.html`        | Form to upload new jobs |
| `upload_job.php`         | Backend logic for job upload |
| `get_jobs.php`           | Retrieves job listings |
| `jobs.txt`               | Stores uploaded job listings |
| `users.txt`              | Stores user credentials (plaintext for demo) |
| `reset_tokens.txt`       | Stores password reset tokens |
| `composer.json`, `composer.lock` | PHP dependency config (Laravel placeholder) |

## 🧑‍💼 How It Works

1. **Users register or sign in.**
2. **They can upload job listings or use the chatbot to find jobs.**
3. **Chatbot queries are handled via `chatbot.php` by reading from `jobs.txt`.**
4. **Users can reset forgotten passwords using secure token-based reset flow.**

## 🛠️ Setup Instructions

### Requirements

- PHP 7.x or later
- Web server (Apache, Nginx, or PHP built-in)
- Composer (optional if using Laravel setup later)

### Installation

```bash
git clone https://github.com/fayaf2/job-finding-chatbot.git
cd job-finding-chatbot
