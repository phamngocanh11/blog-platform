# 📝 .Blog Platform

> Nền tảng blog hiện đại, đầy đủ tính năng được xây dựng với Laravel 11 và Tailwind CSS

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

---

## 📑 Mục lục

- [Tính năng](#-tính-năng)
- [Cài đặt](#-cài-đặt)
- [Cấu trúc dự án](#-cấu-trúc-dự-án)
- [Công nghệ sử dụng](#️-công-nghệ-sử-dụng)
- [Lộ trình phát triển](#-lộ-trình-phát-triển)
- [Đóng góp](#-đóng-góp)
- [Bảo mật](#-bảo-mật)
- [Giấy phép](#-giấy-phép)

---

## ✨ Tính năng

### 👤 Tính năng người dùng
- 🔐 **Xác thực** - Đăng ký, Đăng nhập, Xác thực Email, Đặt lại mật khẩu
- 📝 **Quản lý bài viết** - Tạo, Sửa, Xóa bài viết với trình soạn thảo Quill WYSIWYG
- 🖼️ **Tải lên media** - Tải ảnh thumbnail và ảnh inline với storage link
- 🏷️ **Tags & Categories** - Tổ chức bài viết với tags và categories
- 📚 **Series** - Nhóm các bài viết liên quan thành series
- ❤️ **Tương tác xã hội** - Like (10/phút), Comment (5/phút), Bookmark bài viết
- 💬 **Comment lồng nhau** - Trả lời comment (tối đa 2 cấp)
- 🔍 **Tìm kiếm nâng cao** - Tìm theo tiêu đề, nội dung, tác giả với nhiều bộ lọc
- 👤 **Hồ sơ người dùng** - Tùy chỉnh profile với avatar upload
- 📊 **Thống kê đọc** - Đếm lượt xem tự động, ước tính thời gian đọc

### 👨‍💼 Tính năng Admin
- 📊 **Dashboard** - Phân tích toàn diện với biểu đồ tương tác
  - Thống kê tăng trưởng người dùng
  - Theo dõi lượt xem
  - Top người dùng theo bài viết và lượt thích
  - Top bài viết theo mức độ tương tác
  - Bài viết xu hướng theo tháng
- 👥 **Quản lý người dùng** - Đầy đủ các thao tác CRUD cho người dùng
- 📝 **Quản lý bài viết** - Quản lý tất cả bài viết, ghim/bỏ ghim bài viết nổi bật
- 🏷️ **Quản lý Category & Series** - Tổ chức cấu trúc nội dung
- 📈 **Phân tích thời gian thực** - Thống kê và số liệu trực tiếp

### 🔧 Tính năng kỹ thuật
- ⚡ **Tối ưu hiệu suất**
  - Đánh index database trên các cột thường xuyên truy vấn
  - Eager loading để ngăn N+1 queries
  - Tối ưu hóa query
- 🛡️ **Bảo mật**
  - Rate limiting (10 likes/phút, 5 comments/phút)
  - CSRF protection
  - XSS prevention
  - SQL injection prevention
  - Input validation
  - Giới hạn độ sâu comment lồng nhau
- 📱 **Responsive Design** - Thiết kế mobile-first với Tailwind CSS
- 🎨 **UI hiện đại** - Giao diện sạch sẽ và trực quan
- 🔄 **Sẵn sàng cho Real-time** - Cấu trúc chuẩn bị cho tích hợp WebSocket

---

## 🌿 Branches

This repository uses a structured branching strategy for organized development:

### Main Branches

| Branch | Description | Status |
|--------|-------------|--------|
| `main` | Production-ready code | 🟢 Stable |
| `develop` | Development branch | 🟡 Active |

### Feature Branches

| Branch | Feature | Status | Priority |
|--------|---------|--------|----------|
| `feature/dark-mode` | Dark mode implementation | 📋 Planned | ⭐⭐⭐ |
| `feature/follow-system` | Follow/Unfollow users | 📋 Planned | ⭐⭐⭐ |
| `feature/notifications` | Real-time notifications | 📋 Planned | ⭐⭐⭐ |
| `feature/bookmarks-ui` | Bookmarks page UI | 📋 Planned | ⭐⭐⭐ |
| `feature/reading-progress` | Reading progress bar | 📋 Planned | ⭐⭐ |
| `feature/highlight-share` | Highlight & share quotes | 📋 Planned | ⭐⭐ |
| `feature/toc` | Table of contents | 📋 Planned | ⭐⭐ |
| `feature/code-highlight` | Code syntax highlighting | 📋 Planned | ⭐⭐ |
| `feature/auto-save` | Auto-save draft | 📋 Planned | ⭐⭐ |
| `feature/seo` | SEO optimization | 📋 Planned | ⭐⭐ |
| `feature/full-text-search` | Scout + Meilisearch | 📋 Planned | ⭐ |
| `feature/redis-cache` | Redis caching | 📋 Planned | ⭐ |
| `feature/rest-api` | REST API layer | 📋 Planned | ⭐ |
| `feature/ai-summary` | AI content summarization | 📋 Planned | ⭐ |
| `feature/newsletter` | Email newsletter | 📋 Planned | ⭐ |

### How to Use Branches

```bash
# Clone repository
git clone https://github.com/YOUR_USERNAME/blog-platform.git

# Switch to develop branch
git checkout develop

# Create new feature branch
git checkout -b feature/your-feature-name

# After completing feature
git add .
git commit -m "feat: Add your feature description"
git push origin feature/your-feature-name

# Create Pull Request to develop branch
```

---

## 🚀 Cài đặt

### Yêu cầu hệ thống
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0 (hoặc MariaDB)
- Git

### Hướng dẫn cài đặt

1. **Clone repository**
```bash
git clone https://github.com/phamngocanh11/blog-platform.git
cd blog-platform
```

2. **Cài đặt PHP dependencies**
```bash
composer install
```

3. **Cài đặt JavaScript dependencies**
```bash
npm install
```

4. **Thiết lập môi trường**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Cấu hình database**

Chỉnh sửa file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

6. **Tạo database**
```bash
# MySQL
mysql -u root -p
CREATE DATABASE blog_db;
exit;
```

7. **Chạy migrations**
```bash
php artisan migrate
```

8. **Seed database (tùy chọn)**
```bash
php artisan db:seed
```

9. **Tạo storage link**
```bash
php artisan storage:link
```

10. **Build assets**
```bash
npm run build
```

11. **Chạy ứng dụng**

**Cách 1: Hai terminal riêng biệt**

Terminal 1 - Laravel:
```bash
php artisan serve
```

Terminal 2 - Vite (cho development):
```bash
npm run dev
```

**Cách 2: Production**
```bash
php artisan serve
# Assets đã được build với npm run build
```

12. **Truy cập ứng dụng**
- 🌐 Frontend: http://localhost:8000
- 👨‍💼 Admin: http://localhost:8000/admin/dashboard

### Tài khoản mặc định

Sau khi seed, đăng nhập với:
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

### � Planned (v1.2)
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

If you discover a security vulnerability, please email: your.email@example.com

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

**Your Name**
- GitHub: [@YOUR_USERNAME](https://github.com/YOUR_USERNAME)
- Email: your.email@example.com
- LinkedIn: [Your LinkedIn](https://linkedin.com/in/yourprofile)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Quill.js](https://quilljs.com) - Rich Text Editor
- [ApexCharts](https://apexcharts.com) - Modern Charts
- [Font Awesome](https://fontawesome.com) - Icons

---

## 📊 Stats

![GitHub repo size](https://img.shields.io/github/repo-size/YOUR_USERNAME/blog-platform)
![GitHub contributors](https://img.shields.io/github/contributors/YOUR_USERNAME/blog-platform)
![GitHub last commit](https://img.shields.io/github/last-commit/YOUR_USERNAME/blog-platform)
![GitHub issues](https://img.shields.io/github/issues/YOUR_USERNAME/blog-platform)
![GitHub pull requests](https://img.shields.io/github/issues-pr/YOUR_USERNAME/blog-platform)

---

<div align="center">

### ⭐ If you like this project, please give it a star on GitHub! ⭐

Made with ❤️ by [Your Name](https://github.com/YOUR_USERNAME)

</div>

## ✨ Features

### 👤 User Features
- 🔐 **Authentication** - Register, Login, Email Verification, Password Reset
- 📝 **Post Management** - Create, Edit, Delete posts with Quill editor
- 🖼️ **Media Upload** - Thumbnail and inline image upload
- 🏷️ **Tags & Categories** - Organize posts with tags and categories
- 📚 **Series** - Group related posts into series
- ❤️ **Social Interactions** - Like, Comment (nested), Bookmark posts
- 🔍 **Advanced Search** - Search by title, content, author with filters
- 👤 **User Profile** - Customizable profile with avatar
- 📊 **Reading Stats** - View count, reading time estimation

### 👨‍💼 Admin Features
- 📊 **Dashboard** - Comprehensive analytics with charts
- 👥 **User Management** - CRUD operations for users
- 📝 **Post Management** - Manage all posts, pin/unpin
- 🏷️ **Category & Series Management**
- 📌 **Pin Posts** - Feature important posts
- 📈 **Analytics** - User growth, views, top posts statistics

### 🔧 Technical Features
- ⚡ **Performance** - Database indexing, eager loading
- 🛡️ **Security** - Rate limiting, CSRF protection, input validation
- 📱 **Responsive Design** - Mobile-friendly interface
- 🎨 **Modern UI** - Tailwind CSS with custom components
- 🔄 **Real-time** - Live view counter (ready for WebSocket)

## 🚀 Installation

### Requirements
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0

### Setup

1. **Clone the repository**
```bash
git clone https://github.com/YOUR_USERNAME/blog-platform.git
cd blog-platform
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
```

6. **Seed database (optional)**
```bash
php artisan db:seed
```

7. **Create storage link**
```bash
php artisan storage:link
```

8. **Run the application**

Terminal 1:
```bash
php artisan serve
```

Terminal 2:
```bash
npm run dev
```

9. **Access the application**
- Frontend: http://localhost:8000
- Admin: http://localhost:8000/admin/dashboard

### Default Admin Account
After seeding, you can login with:
- Email: admin@example.com
- Password: password

## 📸 Screenshots

### Homepage
![Homepage](screenshots/homepage.png)

### Post Detail
![Post Detail](screenshots/post-detail.png)

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)

## 🛠️ Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Editor:** Quill.js
- **Charts:** ApexCharts, Chart.js
- **Icons:** Font Awesome
- **Build Tool:** Vite

## 📦 Project Structure

```
blog-platform/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   └── User/
│   │   └── Middleware/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── user/
│   │   └── layouts/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   └── auth.php
└── public/
```

## 🔐 Security

- ✅ CSRF Protection
- ✅ XSS Prevention
- ✅ SQL Injection Prevention
- ✅ Rate Limiting (10 likes/min, 5 comments/min)
- ✅ Password Hashing (Bcrypt)
- ✅ Email Verification
- ✅ Input Validation

## 🎯 Roadmap

### Phase 1: Core Features ✅
- [x] User authentication
- [x] Post CRUD
- [x] Comments system
- [x] Like/Bookmark
- [x] Admin dashboard

### Phase 2: Enhancements 🚧
- [ ] Follow/Unfollow users
- [ ] Real-time notifications
- [ ] Dark mode
- [ ] Bookmarks UI
- [ ] Reading progress bar

### Phase 3: Advanced Features 📋
- [ ] Full-text search (Scout + Meilisearch)
- [ ] Redis caching
- [ ] REST API
- [ ] AI content summarization
- [ ] Newsletter system

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 👨‍💻 Author

**Your Name**
- GitHub: [@YOUR_USERNAME](https://github.com/YOUR_USERNAME)
- Email: your.email@example.com

## 🙏 Acknowledgments

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Quill.js](https://quilljs.com)
- [ApexCharts](https://apexcharts.com)

---


