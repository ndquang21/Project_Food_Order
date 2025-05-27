## Ứng dụng Web Đặt Đồ Ăn: Foodi
Một hệ thống đặt đồ ăn đơn giản được xây dựng bằng PHP, HTML, CSS và MySQL. Ứng dụng cho phép người dùng duyệt món ăn và đặt hàng trực tuyến, đồng thời cung cấp giao diện quản trị để quản lý nhân viên, thực đơn và xem thống kê đơn hàng.

## 1. Tính Năng
- Giao diện thân thiện, dễ dàng duyệt và tìm kiếm món ăn.
- Đặt món và xác nhận đơn hàng trực tuyến.
- Trang quản trị dành cho admin để quản lý món ăn, danh mục, nhân viên và đơn hàng.
- Thiết kế responsive phù hợp với cả điện thoại và máy tính.

## 2. Công Nghệ Sử Dụng
- Frontend: HTML, CSS
- Backend: PHP
- Cơ sở dữ liệu: MySQL
- Web Server: Apache (qua XAMPP hoặc tương tự)

## 3. Cấu Trúc Thư Mục:
```
Project_Food_Order/
│
├── admin/                # Giao diện và chức năng quản trị
├── config/
│   └── constant.php      # Cấu hình kết nối CSDL và hằng số toàn cục
│
├── css/
│   ├── admin.css         # Giao diện quản trị
│   └── style.css         # Giao diện người dùng
│
├── db_mysql/
│   └── food_order.sql    # File SQL tạo cơ sở dữ liệu
│
├── images/               # Thư mục chứa ảnh được upload
├── partials-front/       # Header/Footer/Menu phía frontend
├── Video/                # Thư mục chứa video nền
│
├── categories.php        # Duyệt món ăn theo danh mục
├── category-foods.php    # Liệt kê món trong một danh mục
├── food-search.php       # Tìm kiếm món ăn
├── foods.php             # Duyệt tất cả món ăn
├── index.php             # Trang chủ
├── order.php             # Đặt hàng
└── README.md             # Tài liệu hướng dẫn
```

## 4. Hướng Dẫn Cài Đặt
4.1. Clone dự án về máy:
git clone https://github.com/ndquang21/Project_Food_Order.git

4.2. Nhập cơ sở dữ liệu:
- Mở phpMyAdmin hoặc công cụ MySQL bạn dùng.
- Tạo database mới, ví dụ: food_order.
- Import file food_order.sql trong thư mục db_mysql/.

4.3. Cấu hình kết nối cơ sở dữ liệu:
- Mở file config/constant.php.
- Cập nhật thông tin như sau:

```
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food_order');
```

4.4. Chạy ứng dụng trên localhost:
- Dùng XAMPP hoặc phần mềm tương tự.
- Copy toàn bộ folder dự án vào thư mục htdocs.
- Khởi động Apache và MySQL.
- Truy cập: http://localhost/Project_Food_Order/


5. Tài Khoản Demo
Tài khoản Admin:
```
Username: quangn30
Password: 12345
```

## Tác Giả

Nguyễn Đức Quang (https://github.com/ndquang21)

## Giấy Phép
Dự án này được phát triển nhằm mục đích học tập và nghiên cứu cá nhân.
