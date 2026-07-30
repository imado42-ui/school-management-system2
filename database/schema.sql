CREATE DATABASE IF NOT EXISTS school_management
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE school_management;

-- جدول المستخدمين
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','teacher','accountant') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول الأقسام
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    level VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول التلاميذ
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_number VARCHAR(30) UNIQUE,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    gender ENUM('ذكر','أنثى'),
    birth_date DATE,
    class_id INT,
    guardian_name VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (class_id) REFERENCES classes(id)
);

-- جدول الأساتذة
CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    specialty VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- جدول المواد
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL
);

-- جدول الغياب
CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    attendance_date DATE,
    status ENUM('حاضر','غائب','متأخر'),
    FOREIGN KEY(student_id) REFERENCES students(id)
);

-- جدول الامتحانات
CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_name VARCHAR(100),
    exam_date DATE
);

-- جدول النقاط
CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_id INT,
    exam_id INT,
    grade DECIMAL(5,2),
    FOREIGN KEY(student_id) REFERENCES students(id),
    FOREIGN KEY(subject_id) REFERENCES subjects(id),
    FOREIGN KEY(exam_id) REFERENCES exams(id)
);

-- جدول الرسوم الدراسية
CREATE TABLE fees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    amount DECIMAL(10,2),
    payment_date DATE,
    status ENUM('مدفوع','غير مدفوع'),
    FOREIGN KEY(student_id) REFERENCES students(id)
);