
# 🛡️ ChronoSoft Internal Upload Portal (CTF Lab)

**Môi trường thực hành khai thác lỗ hổng File Upload và Command Injection cho mục đích đào tạo an toàn thông tin.**  
Dự án được xây dựng bởi bộ phận bảo mật giả lập của công ty tưởng tượng **ChronoSoft Ltd.**

---

## 🎯 Mục tiêu học tập

Thông qua phòng lab này, học viên sẽ được học và thực hành:

- Phân tích và khai thác **lỗ hổng tải tệp tin** (File Upload Vulnerability)
- Thực hiện **RCE (Remote Code Execution)** thông qua việc upload backdoor hoặc shell script
- Hiểu và thực hành khai thác **Command Injection** trong môi trường web PHP
- Kỹ thuật tìm và truy cập file bị ẩn (hidden paths hoặc obfuscated filenames)
- Tìm và chiếm được **flag** được cất giấu trong hệ thống nội bộ

---

## 🧪 Kiến thức trọng tâm

### 1. File Upload Vulnerabilities

- Cơ chế xử lý file sai cách (không kiểm tra MIME, không lọc phần mở rộng)
- Bỏ qua các biện pháp lọc như: `.php.jpg`, null byte (`.php%00.jpg`), case bypass (`.PhP`)
- Sử dụng PHP Shell phổ biến như `b374k`, `pentestmonkey reverse shell`, v.v.

### 2. Command Injection

- Sử dụng input của người dùng trong hàm hệ thống như `system()`, `exec()`, `shell_exec()` mà không lọc
- Payload mẫu: `; ls -la`, `&& cat /etc/passwd`, `| whoami`
- Kỹ thuật Blind Command Injection (xài delay hoặc DNS exfiltration)

### 3. Hành vi và kỹ thuật tìm file ẩn

- Truy cập trực tiếp theo phỏng đoán đường dẫn: `/uploads/shell.php`
- Brute-force tên file với wordlist: `gobuster`, `ffuf`
- Quan sát response code và thời gian phản hồi để đoán đường dẫn

---

## 🚀 Hướng dẫn triển khai với Docker

### Yêu cầu:

- Cài đặt [Docker](https://www.docker.com/) và [Docker Compose](https://docs.docker.com/compose/)

### Cách chạy:

```bash
docker-compose up --build
```

Ứng dụng sẽ chạy tại địa chỉ:

🔗 http://localhost:8080

---

## 🕵️‍♀️ Các thử thách trong hệ thống

| STT | Mô tả | Gợi ý |
|-----|------|-------|
| 1 | Upload file thực thi (Web Shell) | Thử các cách đặt tên để bypass lọc |
| 2 | Truy cập file đã upload | Dò path hoặc dùng tool tìm |
| 3 | Tìm nơi chứa FLAG | Có thể liên quan đến RCE |
| 4 | Khai thác command injection | Input user đi vào hàm `system()`? |
| 5 | Đọc nội dung nhạy cảm | `/etc/passwd`, hoặc file chứa flag |

---

## 🧰 Gợi ý công cụ hỗ trợ

- 🧪 **Burp Suite**: kiểm tra và gửi request tùy chỉnh
- 📁 **Gobuster / FFUF**: tìm file và folder ẩn
- 🐚 **Curl / Wget / Netcat**: gửi request, thiết lập reverse shell
- 🐍 **Python**: để viết reverse shell hoặc xử lý payload encode

---

## 📬 Liên hệ (giả lập)

Nếu bạn là thành viên của đội bảo mật nội bộ, hãy gửi báo cáo về lỗ hổng qua email:

📧 `security@chronosoft.io`

---

## 🔐 Ghi chú dành cho giảng viên

- Mã nguồn không nên được cung cấp trực tiếp cho học viên
- Khuyến khích học viên tự khai thác thay vì xem code
- Có thể cài thêm plugin monitor container để kiểm tra hoạt động của học viên

---

## 🏁 FLAG

> 🔍 Flag được ẩn kỹ trong hệ thống. Nó sẽ không dễ dàng hiển thị khi bạn chỉ upload file đơn thuần.  
> Bạn cần khai thác đúng lỗ hổng **Command Injection** để đọc được file flag này.

---

## 📌 Các kỹ thuật bypass upload phổ biến

- Đổi phần mở rộng `.php.png`, `.php5`, `.phtml`
- Dùng Content-Type giả mạo (`image/jpeg`)
- Double extension: `shell.php.jpg`
- Null byte injection: `shell.php%00.jpg` (chỉ hoạt động ở phiên bản PHP < 5.3)
- RCE sau khi upload thành công: `http://host/uploads/shell.php?cmd=id`

---

## 📚 Tài liệu tham khảo

- [OWASP File Upload Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/File_Upload_Cheat_Sheet.html)
- [PayloadAllTheThings - Command Injection](https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/Command%20Injection)
- [PHP Web Shell Collection](https://github.com/tennc/webshell)

---

> 🧑‍💻 **Lưu ý quan trọng:** Môi trường này chỉ được dùng cho mục đích giáo dục và kiểm thử hợp pháp. Không được sử dụng cho các hoạt động khai thác thực tế hoặc trái phép.

