# 🚀 Hướng dẫn đẩy dự án lên GitHub

## ✅ Đã hoàn thành

1. ✅ Khởi tạo Git repository
2. ✅ Tạo commit đầu tiên trên nhánh `master`
3. ✅ Tạo nhánh `develop`
4. ✅ File `.env` đã được ẩn trong `.gitignore`
5. ✅ File `.env.example` đã được làm sạch (không có thông tin nhạy cảm)
6. ✅ README.md đã được cập nhật

## 📋 Các bước tiếp theo

### Bước 1: Tạo repository trên GitHub

1. Truy cập: https://github.com/new
2. Điền thông tin:
   - **Repository name:** `blog-platform`
   - **Description:** Nền tảng blog hiện đại với Laravel 11 và Tailwind CSS
   - **Visibility:** Public hoặc Private (tùy chọn)
   - **KHÔNG** chọn "Initialize this repository with a README"
3. Click **Create repository**

### Bước 2: Kết nối với GitHub repository

```bash
# Thêm remote repository
git remote add origin https://github.com/phamngocanh11/blog-platform.git

# Kiểm tra remote
git remote -v
```

### Bước 3: Đẩy code lên GitHub

```bash
# Đẩy nhánh master (main branch)
git push -u origin master

# Đẩy nhánh develop
git push -u origin develop
```

### Bước 4: Thiết lập nhánh mặc định (tùy chọn)

Nếu muốn `develop` là nhánh mặc định:

1. Truy cập: https://github.com/phamngocanh11/blog-platform/settings
2. Chọn **Branches** ở sidebar
3. Trong phần **Default branch**, click nút chuyển đổi
4. Chọn `develop` và xác nhận

## 🌿 Cấu trúc nhánh

```
master (production)
  └── develop (development)
       └── feature/* (các tính năng mới)
```

### Quy trình làm việc với nhánh

#### Tạo nhánh tính năng mới

```bash
# Chuyển về nhánh develop
git checkout develop

# Tạo nhánh tính năng mới
git checkout -b feature/ten-tinh-nang

# Ví dụ:
git checkout -b feature/dark-mode
git checkout -b feature/follow-system
git checkout -b feature/notifications
```

#### Làm việc trên nhánh tính năng

```bash
# Thêm thay đổi
git add .

# Commit với message rõ ràng
git commit -m "feat: Thêm chức năng dark mode"

# Đẩy lên GitHub
git push -u origin feature/dark-mode
```

#### Merge nhánh tính năng vào develop

```bash
# Chuyển về develop
git checkout develop

# Merge nhánh tính năng
git merge feature/dark-mode

# Đẩy develop lên GitHub
git push origin develop

# Xóa nhánh tính năng (tùy chọn)
git branch -d feature/dark-mode
git push origin --delete feature/dark-mode
```

#### Merge develop vào master (khi release)

```bash
# Chuyển về master
git checkout master

# Merge develop
git merge develop

# Tạo tag version
git tag -a v1.0.0 -m "Release version 1.0.0"

# Đẩy lên GitHub
git push origin master
git push origin v1.0.0
```

## 📝 Quy ước Commit Message

Sử dụng [Conventional Commits](https://www.conventionalcommits.org/):

```bash
# Tính năng mới
git commit -m "feat: Thêm chức năng dark mode"
git commit -m "feat(auth): Thêm đăng nhập bằng Google"

# Sửa lỗi
git commit -m "fix: Sửa lỗi hiển thị avatar"
git commit -m "fix(post): Sửa lỗi không lưu được bài viết"

# Cập nhật tài liệu
git commit -m "docs: Cập nhật hướng dẫn cài đặt"

# Refactor code
git commit -m "refactor: Tối ưu query database"

# Style/Format
git commit -m "style: Format code theo PSR-12"

# Test
git commit -m "test: Thêm test cho PostController"

# Chore (maintenance)
git commit -m "chore: Cập nhật dependencies"
```

## 🔒 Bảo mật

### Files đã được ẩn trong `.gitignore`:

- ✅ `.env` - File cấu hình môi trường
- ✅ `.env.backup` - Backup của file .env
- ✅ `.env.production` - File cấu hình production
- ✅ `/vendor` - PHP dependencies
- ✅ `/node_modules` - JavaScript dependencies
- ✅ `auth.json` - Composer authentication
- ✅ `/storage/*.key` - Encryption keys

### Kiểm tra trước khi push:

```bash
# Xem các file sẽ được commit
git status

# Xem nội dung thay đổi
git diff

# Kiểm tra file .env KHÔNG nằm trong danh sách
git ls-files | grep .env
# Kết quả chỉ nên hiển thị: .env.example
```

## 🎯 Các nhánh tính năng đề xuất

Bạn có thể tạo các nhánh sau để phát triển:

### Priority ⭐⭐⭐ (Cao)
```bash
git checkout -b feature/dark-mode
git checkout -b feature/follow-system
git checkout -b feature/notifications
git checkout -b feature/bookmarks-ui
```

### Priority ⭐⭐ (Trung bình)
```bash
git checkout -b feature/reading-progress
git checkout -b feature/highlight-share
git checkout -b feature/toc
git checkout -b feature/code-highlight
git checkout -b feature/auto-save
git checkout -b feature/seo
```

### Priority ⭐ (Thấp)
```bash
git checkout -b feature/full-text-search
git checkout -b feature/redis-cache
git checkout -b feature/rest-api
git checkout -b feature/ai-summary
git checkout -b feature/newsletter
```

## 🔄 Cập nhật README.md

Sau khi đẩy lên GitHub, cập nhật các link trong README.md:

1. Thay `YOUR_USERNAME` bằng `phamngocanh11`
2. Thay `your.email@example.com` bằng email thật của bạn
3. Cập nhật thông tin tác giả

```bash
# Mở README.md và tìm kiếm
YOUR_USERNAME -> phamngocanh11
your.email@example.com -> email_cua_ban@gmail.com
Your Name -> Tên của bạn
```

## 📸 Thêm Screenshots (tùy chọn)

1. Tạo thư mục `screenshots/`:
```bash
mkdir screenshots
```

2. Chụp màn hình và lưu vào thư mục:
   - `screenshots/homepage.png`
   - `screenshots/post-detail.png`
   - `screenshots/admin-dashboard.png`

3. Commit và push:
```bash
git add screenshots/
git commit -m "docs: Thêm screenshots cho README"
git push
```

## 🎉 Hoàn thành!

Sau khi hoàn thành các bước trên, repository của bạn sẽ có:

- ✅ Nhánh `master` (production-ready)
- ✅ Nhánh `develop` (development)
- ✅ README.md đầy đủ và chuyên nghiệp
- ✅ File `.env` được bảo vệ
- ✅ Cấu trúc dự án rõ ràng
- ✅ Sẵn sàng cho cộng tác viên đóng góp

## 🆘 Xử lý sự cố

### Lỗi: remote origin already exists
```bash
git remote remove origin
git remote add origin https://github.com/phamngocanh11/blog-platform.git
```

### Lỗi: failed to push some refs
```bash
# Pull trước khi push
git pull origin master --allow-unrelated-histories
git push -u origin master
```

### Lỗi: Authentication failed
```bash
# Sử dụng Personal Access Token thay vì password
# Tạo token tại: https://github.com/settings/tokens
# Hoặc sử dụng SSH key
```

### Kiểm tra file .env có bị push nhầm không
```bash
# Nếu .env đã bị push nhầm, xóa khỏi Git history
git rm --cached .env
git commit -m "chore: Remove .env from repository"
git push
```

## 📚 Tài liệu tham khảo

- [Git Documentation](https://git-scm.com/doc)
- [GitHub Guides](https://guides.github.com/)
- [Conventional Commits](https://www.conventionalcommits.org/)
- [Git Flow](https://nvie.com/posts/a-successful-git-branching-model/)

---

**Chúc bạn thành công! 🚀**
