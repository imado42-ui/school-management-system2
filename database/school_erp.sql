CREATE DATABASE IF NOT EXISTS school_erp
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE school_erp;

-- ==========================
-- جدول المستخدمين
-- ==========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    role ENUM('admin','teacher') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- جدول الأقسام
-- ==========================
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    level VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- جدول التلاميذ
-- ==========================
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    gender ENUM('ذكر','أنثى'),
    birthdate DATE,
    class_id INT NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_student_class
    FOREIGN KEY (class_id)
    REFERENCES classes(id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);

-- ==========================
-- جدول الأساتذة
-- ==========================
CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    specialty VARCHAR(150) NOT NULL,
    phone VARCHAR(30),
    email VARCHAR(150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- جدول المواد
-- ==========================
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(150) NOT NULL,
    coefficient INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- جدول العلامات
-- ==========================
CREATE TABLE marks (
    id INT AUTO_INCREMENT PRIMARY KEY,

    student_id INT NOT NULL,
    subject_id INT NOT NULL,

    semester ENUM('الفصل الأول','الفصل الثاني','الفصل الثالث') NOT NULL,

    mark DECIMAL(4,2) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_mark_student
        FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_mark_subject
        FOREIGN KEY (subject_id)
        REFERENCES subjects(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- ==========================
-- جدول الحضور
-- ==========================
CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,

    student_id INT NOT NULL,

    attendance_date DATE NOT NULL,

    status ENUM('حاضر','غائب','متأخر') NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_attendance_student
        FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- ==========================
-- حساب المدير الافتراضي
-- اسم المستخدم: admin
-- كلمة المرور: admin123
-- ==========================
INSERT INTO users (username,password,fullname,role)
VALUES (
'admin',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'Administrator',
'admin'
);