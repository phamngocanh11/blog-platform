# 🤝 Hướng dẫn đóng góp

Cảm ơn bạn đã quan tâm đến việc đóng góp cho dự án Blog Platform! Chúng tôi rất hoan nghênh mọi đóng góp từ cộng đồng.

## 📋 Mục lục

- [Code of Conduct](#code-of-conduct)
- [Bắt đầu](#bắt-đầu)
- [Quy trình đóng góp](#quy-trình-đóng-góp)
- [Quy tắc Commit](#quy-tắc-commit)
- [Coding Standards](#coding-standards)
- [Pull Request Process](#pull-request-process)
- [Báo cáo lỗi](#báo-cáo-lỗi)
- [Đề xuất tính năng](#đề-xuất-tính-năng)

## Code of Conduct

Dự án này tuân thủ [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/). Bằng cách tham gia, bạn đồng ý tuân theo các quy tắc này.

## Bắt đầu

### 1. Fork repository

Click nút "Fork" ở góc trên bên phải của trang repository.

### 2. Clone repository đã fork

```bash
git clone https://github.com/YOUR_USERNAME/blog-platform.git
cd blog-platform
```

### 3. Thêm upstream remote

```bash
git remote add upstream https://github.com/phamngocanh11/blog-platform.git
```

### 4. Cài đặt dependencies

```bash
# PHP dependencies
composer install

# JavaScript dependencies
npm install

# Thiết lập môi trường
cp .env.example .env
php artisan key:generate

# Cấu hình database và chạy migrations
php artisan migrate
php artisan db:seed
```

### 5. Tạo nhánh mới

```bash
git checkout develop
git checkout -b feature/your-feature-name
```

## Quy trình đóng góp

### 1. Đồng bộ với upstream

Trước khi bắt đầu làm việc, đảm bảo code của bạn được cập nhật:

```bash
git checkout develop
git fetch upstream
git merge upstream/develop
git push origin develop
```

### 2. Tạo nhánh tính năng

```bash
git checkout -b feature/your-feature-name
```

Quy tắc đặt tên nhánh:
- `feature/` - Tính năng mới (vd: `feature/dark-mode`)
- `fix/` - Sửa lỗi (vd: `fix/login-error`)
- `docs/` - Cập nhật tài liệu (vd: `docs/api-documentation`)
- `refactor/` - Refactor code (vd: `refactor/post-controller`)
- `test/` - Thêm tests (vd: `test/post-validation`)
- `chore/` - Maintenance (vd: `chore/update-dependencies`)

### 3. Thực hiện thay đổi

- Viết code rõ ràng và dễ hiểu
- Tuân thủ coding standards (xem bên dưới)
- Thêm comments cho logic phức tạp
- Cập nhật documentation nếu cần

### 4. Test thay đổi

```bash
# Chạy tests
php artisan test

# Chạy code style check
./vendor/bin/pint

# Kiểm tra lỗi
php artisan route:list
php artisan config:clear
```

### 5. Commit thay đổi

```bash
git add .
git commit -m "feat: Add dark mode toggle"
```

### 6. Push lên fork của bạn

```bash
git push origin feature/your-feature-name
```

### 7. Tạo Pull Request

1. Truy cập repository gốc trên GitHub
2. Click "New Pull Request"
3. Chọn nhánh của bạn
4. Điền thông tin chi tiết về thay đổi
5. Submit Pull Request

## Quy tắc Commit

Chúng tôi sử dụng [Conventional Commits](https://www.conventionalcommits.org/):

### Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

### Types

- `feat`: Tính năng mới
- `fix`: Sửa lỗi
- `docs`: Thay đổi documentation
- `style`: Thay đổi format code (không ảnh hưởng logic)
- `refactor`: Refactor code
- `test`: Thêm hoặc sửa tests
- `chore`: Maintenance tasks
- `perf`: Cải thiện performance

### Ví dụ

```bash
# Tính năng mới
git commit -m "feat: Add dark mode toggle button"
git commit -m "feat(auth): Add Google OAuth login"

# Sửa lỗi
git commit -m "fix: Resolve avatar upload issue"
git commit -m "fix(post): Fix post not saving properly"

# Documentation
git commit -m "docs: Update installation guide"

# Refactor
git commit -m "refactor: Optimize database queries"

# Style
git commit -m "style: Format code according to PSR-12"

# Test
git commit -m "test: Add tests for PostController"

# Chore
git commit -m "chore: Update Laravel to 11.x"
```

### Commit Message Guidelines

- Sử dụng present tense ("Add feature" không phải "Added feature")
- Sử dụng imperative mood ("Move cursor to..." không phải "Moves cursor to...")
- Giới hạn dòng đầu tiên ở 72 ký tự
- Tham chiếu issues và pull requests khi phù hợp

## Coding Standards

### PHP

Tuân thủ [PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/):

```bash
# Format code tự động
./vendor/bin/pint

# Hoặc check mà không sửa
./vendor/bin/pint --test
```

#### Quy tắc chung

- Sử dụng 4 spaces cho indentation
- Tên class sử dụng PascalCase
- Tên method sử dụng camelCase
- Tên constant sử dụng UPPER_CASE
- Luôn type hint parameters và return types
- Viết docblocks cho public methods

#### Ví dụ

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $posts = Post::with('user', 'category')
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::create($validated);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post created successfully!');
    }
}
```

### JavaScript

- Sử dụng ES6+ syntax
- Sử dụng 2 spaces cho indentation
- Sử dụng single quotes cho strings
- Thêm semicolons
- Sử dụng const/let thay vì var

```javascript
// Good
const fetchPosts = async () => {
  try {
    const response = await axios.get('/api/posts');
    return response.data;
  } catch (error) {
    console.error('Error fetching posts:', error);
    throw error;
  }
};

// Bad
var fetchPosts = function() {
  axios.get("/api/posts").then(function(response) {
    return response.data
  })
}
```

### Blade Templates

- Sử dụng 4 spaces cho indentation
- Sử dụng Blade directives thay vì PHP tags
- Tách logic phức tạp ra View Composers hoặc Components

```blade
{{-- Good --}}
@foreach ($posts as $post)
    <article class="post">
        <h2>{{ $post->title }}</h2>
        <p>{{ Str::limit($post->content, 150) }}</p>
        
        @if ($post->is_published)
            <span class="badge">Published</span>
        @endif
    </article>
@endforeach

{{-- Bad --}}
<?php foreach ($posts as $post): ?>
    <article>
        <h2><?php echo $post->title; ?></h2>
    </article>
<?php endforeach; ?>
```

### CSS/Tailwind

- Sử dụng Tailwind utility classes
- Tạo custom components cho patterns lặp lại
- Sắp xếp classes theo thứ tự: layout → spacing → sizing → colors → typography

```html
<!-- Good -->
<div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md">
    <h3 class="text-lg font-semibold text-gray-900">Title</h3>
    <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
        Action
    </button>
</div>
```

## Pull Request Process

### Checklist trước khi submit PR

- [ ] Code tuân thủ coding standards
- [ ] Đã chạy tests và tất cả pass
- [ ] Đã thêm tests cho code mới (nếu có)
- [ ] Đã cập nhật documentation (nếu cần)
- [ ] Commit messages tuân thủ quy tắc
- [ ] Đã rebase với develop branch mới nhất
- [ ] Không có conflicts

### Template Pull Request

```markdown
## Mô tả

Mô tả ngắn gọn về thay đổi của bạn.

## Loại thay đổi

- [ ] Bug fix (non-breaking change)
- [ ] New feature (non-breaking change)
- [ ] Breaking change
- [ ] Documentation update

## Thay đổi chi tiết

- Thêm chức năng X
- Sửa lỗi Y
- Cải thiện performance Z

## Testing

Mô tả cách bạn đã test thay đổi:

- [ ] Unit tests
- [ ] Integration tests
- [ ] Manual testing

## Screenshots (nếu có)

Thêm screenshots nếu thay đổi liên quan đến UI.

## Checklist

- [ ] Code tuân thủ style guide
- [ ] Tests pass
- [ ] Documentation updated
- [ ] No breaking changes

## Related Issues

Closes #123
Related to #456
```

### Review Process

1. Ít nhất 1 maintainer sẽ review PR của bạn
2. Có thể có yêu cầu thay đổi
3. Sau khi approve, PR sẽ được merge vào develop
4. Code sẽ được release trong version tiếp theo

## Báo cáo lỗi

### Trước khi báo cáo

- Kiểm tra [Issues](https://github.com/phamngocanh11/blog-platform/issues) xem lỗi đã được báo cáo chưa
- Đảm bảo bạn đang sử dụng version mới nhất
- Kiểm tra documentation

### Template báo cáo lỗi

```markdown
## Mô tả lỗi

Mô tả rõ ràng và ngắn gọn về lỗi.

## Các bước tái hiện

1. Truy cập '...'
2. Click vào '...'
3. Scroll xuống '...'
4. Thấy lỗi

## Kết quả mong đợi

Mô tả bạn mong đợi điều gì xảy ra.

## Kết quả thực tế

Mô tả điều gì đã xảy ra.

## Screenshots

Nếu có, thêm screenshots để giải thích vấn đề.

## Môi trường

- OS: [e.g. Windows 11, macOS 14]
- Browser: [e.g. Chrome 120, Firefox 121]
- PHP Version: [e.g. 8.2]
- Laravel Version: [e.g. 11.0]

## Thông tin bổ sung

Thêm bất kỳ thông tin nào khác về vấn đề.
```

## Đề xuất tính năng

### Template đề xuất tính năng

```markdown
## Tính năng đề xuất

Mô tả rõ ràng về tính năng bạn muốn thêm.

## Vấn đề hiện tại

Mô tả vấn đề mà tính năng này sẽ giải quyết.

## Giải pháp đề xuất

Mô tả cách bạn muốn tính năng hoạt động.

## Giải pháp thay thế

Mô tả các giải pháp thay thế bạn đã xem xét.

## Thông tin bổ sung

Thêm bất kỳ thông tin nào khác về đề xuất.
```

## Câu hỏi?

Nếu bạn có câu hỏi, bạn có thể:

- Mở một [Discussion](https://github.com/phamngocanh11/blog-platform/discussions)
- Gửi email đến: your.email@example.com
- Tham gia Discord server (nếu có)

## Giấy phép

Bằng cách đóng góp, bạn đồng ý rằng đóng góp của bạn sẽ được cấp phép theo [MIT License](LICENSE).

---

**Cảm ơn bạn đã đóng góp! 🎉**
