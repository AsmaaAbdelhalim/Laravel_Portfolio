# Laravel Portfolio

A feature-rich portfolio and admin dashboard built with Laravel. This project allows users to showcase their work, manage content, and handle contact messages, with a secure admin panel for CRUD operations and user management.

## Features

### Current Features
- **User Authentication**: Register, login, password reset, and email verification.
- **Admin Dashboard**: Secure admin area for managing all content.
- **CRUD Operations**:
  - About section
  - Categories
  - Projects
  - Portfolios (supports multiple portfolios)
  - Qualifications
  - Services
  - Skills & Languages
  - Users (with roles)
- **Contact Form with Gmail Integration**: Users can send messages via a contact form. Messages are stored and sent to your Gmail using SMTP. See setup below.
- **Profile Management**: Admins can update their profile and change passwords.
- **File/Image Uploads**: Upload and manage images for projects and portfolios.
- **Responsive Design**: Works well on desktop and mobile.
- **AJAX Pagination in Portfolio**: Projects in each portfolio are paginated and update dynamically via AJAX, providing a smooth user experience without full page reloads.
- **Partials for AJAX Updates**: The project uses Blade partials for rendering project lists, making AJAX updates efficient and modular.
- **Project Details Modal (Public Side)**: On the user-facing site, clicking a project opens a modal window displaying detailed information, images, and links for that project. This allows visitors to explore project details without leaving the main portfolio page, enhancing the browsing experience.

### Planned Features
- **Notifications**:
  - Admins receive notifications when a new contact message is received.
  - Admins are notified when another admin performs CRUD actions on projects.
- **Project View Counter**:
  - Each project tracks the number of views by guests (not logged-in users).

## Installation & Setup

### Requirements
- PHP >= 8.0
- Composer
- Node.js & npm
- MySQL or compatible database

### Steps
1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd Laravel_Portfolio
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install Node dependencies:**
   ```bash
   npm install
   # or
   yarn install
   ```
4. **Copy and configure environment:**
   ```bash
   cp .env.example .env
   # Edit .env with your database and mail settings
   ```
5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
6. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```
7. **Build frontend assets:**
   ```bash
   npm run dev
   # or
   yarn dev
   ```
8. **Start the development server:**
   ```bash
   php artisan serve
   ```

### Gmail SMTP Setup for Contact Form
To send contact form messages via Gmail, add these to your `.env`:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_gmail@gmail.com
MAIL_FROM_NAME="Your Name"
```
- Use an App Password if you have 2FA enabled on your Gmail account.

## Usage

- **Admin Panel:**
  - Visit `/admin` after logging in as an admin to manage all content.
- **Contact Form:**
  - Available on the public site for visitors to send messages. Messages are sent to your Gmail and stored in the database.
- **Portfolio & Projects:**
  - Add, edit, and showcase your work via the admin panel.
  - Multiple portfolios are supported, each with its own projects and categories.
  - AJAX pagination allows users to browse projects smoothly.
  - On the public site, visitors can click on a project to view its details and images in a modal window, without leaving the main page.

## Planned Feature Details

- **Notifications:**
  - Real-time or dashboard notifications for admins about new contact messages and CRUD actions by other admins.
- **Project View Counter:**
  - Each project will display a view count, incremented for each guest (not logged-in user) visit.

## Contribution

Contributions are welcome! Please fork the repository and submit a pull request. For major changes, open an issue first to discuss what you would like to change.

## License

This project is open-source and available under the [MIT License](LICENSE).