# 📝 .Blog Platform

> A modern, feature-rich blog platform built with Laravel 11 and Tailwind CSS

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

---

## 📑 Table of Contents

- [Features](#-features)
- [Installation](#-installation)
- [Screenshots](#-screenshots)
- [Tech Stack](#️-tech-stack)
- [Project Structure](#-project-structure)
- [Roadmap](#-roadmap)
- [Security](#-security)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 👤 User Features
- 🔐 **Authentication** - Register, Login, Email Verification, Password Reset
- 📝 **Post Management** - Create, Edit, Delete posts with Quill WYSIWYG editor
- 🖼️ **Media Upload** - Thumbnail and inline image upload with storage link
- 🏷️ **Tags & Categories** - Organize posts with tags and categories
- 📚 **Series** - Group related posts into series
- ❤️ **Social Interactions** - Like (10/min), Comment (5/min), Bookmark posts
- 💬 **Nested Comments** - Reply to comments (max 2 levels)
- 🔍 **Advanced Search** - Search by title, content, author with multiple filters
- 👤 **User Profile** - Customizable profile with avatar upload
- 📊 **Reading Stats** - Auto view counter, reading time estimation

### 👨‍💼 Admin Features
- 📊 **Dashboard** - Comprehensive analytics with interactive charts
  - User growth statistics
  - Views tracking
  - Top users by posts and likes
  - Top posts by engagement
  - Monthly trending posts
- 👥 **User Management** - Full CRUD operations for users
- 📝 **Post Management** - Manage all posts, pin/unpin featured posts
- 🏷️ **Category & Series Management** - Organize content structure
- 📈 **Real-time Analytics** - Live statistics and metrics

### 🔧 Technical Features
- ⚡ **Performance Optimized**
  - Database indexing on frequently queried columns
  - Eager loading to prevent N+1 queries
  - Query optimization
- 🛡️ **Security**
  - Rate limiting (10 likes/min, 5 comments/min)
  - CSRF protection
  - XSS prevention
  - SQL injection prevention
  - Input validation
  - Nested comment depth limiting
- 📱 **Responsive Design** - Mobile-first approach with Tailwind CSS
- 🎨 **Modern UI** - Clean and intuitive interface
- 🔄 **Ready for Real-time** - Structure prepared for WebSocket integration

---

## 🚀 Installation

### Requirements
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0 (or MariaDB)
- Git

### Quick Start

1. **Clone the repository**
```bash
git clone https://github.com/phamngocanh11/blog-platform.git
cd blog-platform
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install JavaScript dependencies**
```bash
npm install
```

4. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**

Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

6. **Create database**
```bash
# MySQL
mysql -u root -p
CREATE DATABASE blog_db;
exit;
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Seed database (optional)**
```bash
php artisan db:seed
```

9. **Create storage link**
```bash
php artisan storage:link
```

10. **Build assets**
```bash
npm run build
```

11. **Run the application**

**Option 1: Separate terminals**

Terminal 1 - Laravel:
```bash
php artisan serve
```

Terminal 2 - Vite (for development):
```bash
npm run dev
```

**Option 2: Production**
```bash
php artisan serve
# Assets already built with npm run build
```

12. **Access the application**
- 🌐 Frontend: http://localhost:8000
- 👨‍💼 Admin: http://localhost:8000/admin/dashboard

### Default Credentials

After seeding, login with:
- **Email:** admin@example.com
- **Password:** password

---

## 📸 Screenshots

### Homepage
![Homepage](screenshots/homepage.png)
*Clean and modern homepage with featured posts*

### Post Detail
![Post Detail](screenshots/post-detail.png)
*Rich text editor with image support*

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)
*Comprehensive analytics and statistics*

> **Note:** Screenshots will be added soon. To add your own:
> 1. Create `screenshots/` folder
> 2. Add images: `homepage.png`, `post-detail.png`, `admin-dashboard.png`
> 3. Commit and push

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 11
- **Language:** PHP 8.2
- **Database:** MySQL 8.0
- **Authentication:** Laravel Breeze
- **ORM:** Eloquent

### Frontend
- **CSS Framework:** Tailwind CSS 3
- **JavaScript:** Alpine.js, Axios
- **Editor:** Quill.js
- **Charts:** ApexCharts, Chart.js
- **Icons:** Font Awesome 6
- **Build Tool:** Vite 5

### Development Tools
- **Package Manager:** Composer, NPM
- **Version Control:** Git
- **Code Style:** Laravel Pint

---

## 📦 Project Structure

```
blog-platform/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminDashboardController.php
│   │   │   ├── PostController.php
│   │   │   ├── CommentController.php
│   │   │   ├── LikeController.php
│   │   │   └── User/
│   │   │       ├── BlogController.php
│   │   │       ├── UserPostController.php
│   │   │       └── SearchController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Post.php
│       ├── Comment.php
│       ├── Like.php
│       ├── Bookmark.php
│       ├── Category.php
│       └── Series.php
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_posts_table.php
│   │   ├── create_comments_table.php
│   │   ├── create_likes_table.php
│   │   ├── create_bookmarks_table.php
│   │   └── add_indexes_to_posts_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── posts/
│   │   │   ├── users/
│   │   │   └── categories/
│   │   ├── user/
│   │   │   ├── blog/
│   │   │   ├── post/
│   │   │   └── profile/
│   │   └── layouts/
│   │       ├── app.blade.php
│   │       ├── user.blade.php
│   │       └── navigation.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php
│   └── auth.php
├── public/
│   ├── images/
│   └── storage/ (symlink)
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── README.md
```

---

## 🎯 Roadmap

### ✅ Completed (v1.0)
- [x] User authentication system
- [x] Post CRUD with rich text editor
- [x] Comments system with nested replies
- [x] Like/Bookmark functionality
- [x] Admin dashboard with analytics
- [x] Search and filter system
- [x] Rate limiting
- [x] Database optimization
- [x] Responsive design

### 🚧 In Progress (v1.1)
- [ ] Dark mode
- [ ] Follow/Unfollow users
- [ ] Real-time notifications
- [ ] Bookmarks UI page

### 📋 Planned (v1.2)
- [ ] Reading progress bar
- [ ] Highlight & share quotes
- [ ] Table of contents
- [ ] Code syntax highlighting
- [ ] Auto-save draft
- [ ] SEO optimization

### 🔮 Future (v2.0)
- [ ] Full-text search (Scout + Meilisearch)
- [ ] Redis caching
- [ ] REST API
- [ ] WebSocket real-time features
- [ ] AI content summarization
- [ ] Newsletter system
- [ ] Mobile app

---

## 🔐 Security

This project implements multiple security measures:

- ✅ **CSRF Protection** - Laravel's built-in CSRF tokens
- ✅ **XSS Prevention** - Input sanitization and output escaping
- ✅ **SQL Injection Prevention** - Eloquent ORM with prepared statements
- ✅ **Rate Limiting** - 10 likes/min, 5 comments/min
- ✅ **Password Hashing** - Bcrypt algorithm
- ✅ **Email Verification** - Required for new accounts
- ✅ **Input Validation** - Server-side validation for all forms
- ✅ **Nested Comment Limiting** - Max 2 levels to prevent spam
- ✅ **File Upload Validation** - Type and size restrictions

### Reporting Security Issues

If you discover a security vulnerability, please email: security@example.com

---

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

### How to Contribute

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/AmazingFeature
   ```
3. **Make your changes**
4. **Commit your changes**
   ```bash
   git commit -m 'feat: Add some AmazingFeature'
   ```
5. **Push to the branch**
   ```bash
   git push origin feature/AmazingFeature
   ```
6. **Open a Pull Request**

### Commit Convention

We follow [Conventional Commits](https://www.conventionalcommits.org/):

- `feat:` - New feature
- `fix:` - Bug fix
- `docs:` - Documentation changes
- `style:` - Code style changes (formatting)
- `refactor:` - Code refactoring
- `test:` - Adding tests
- `chore:` - Maintenance tasks

### Code Style

- Follow PSR-12 coding standards
- Use Laravel Pint for code formatting
- Write meaningful commit messages
- Add comments for complex logic

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 👨‍💻 Author

**Pham Ngoc Anh**
- GitHub: [@phamngocanh11](https://github.com/phamngocanh11)
- Email: your.email@example.com

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Quill.js](https://quilljs.com) - Rich Text Editor
- [ApexCharts](https://apexcharts.com) - Modern Charts
- [Font Awesome](https://fontawesome.com) - Icons

---

## 📊 Stats

![GitHub repo size](https://img.shields.io/github/repo-size/phamngocanh11/blog-platform)
![GitHub contributors](https://img.shields.io/github/contributors/phamngocanh11/blog-platform)
![GitHub last commit](https://img.shields.io/github/last-commit/phamngocanh11/blog-platform)
![GitHub issues](https://img.shields.io/github/issues/phamngocanh11/blog-platform)
![GitHub pull requests](https://img.shields.io/github/issues-pr/phamngocanh11/blog-platform)

---

<div align="center">

### ⭐ If you like this project, please give it a star on GitHub! ⭐

Made with ❤️ by [Pham Ngoc Anh](https://github.com/phamngocanh11)

</div>
