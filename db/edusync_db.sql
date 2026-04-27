-- إنشاء قاعدة البيانات يلا ماكانتش
CREATE DATABASE IF NOT EXISTS edu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE edu;

-- ==========================================
-- 1. جدول الأقسام (Classes)
-- ==========================================
CREATE TABLE IF NOT EXISTS classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    salle VARCHAR(50) NOT NULL
);

-- ==========================================
-- 2. جدول المستخدمين (Users)
-- ==========================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'teacher', 'student') DEFAULT 'student',
    classe_id INT NULL,
    FOREIGN KEY (classe_id) REFERENCES classes(id) ON DELETE SET NULL
);

-- ==========================================
-- 3. جدول المواد/الدروس (Courses)
-- ==========================================
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    volume_horaire INT NOT NULL,
    professeur_id INT NOT NULL,
    FOREIGN KEY (professeur_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ==========================================
-- 4. جدول التسجيلات (Enrollments)
-- ==========================================
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    cours_id INT NOT NULL,
    status ENUM('Actif', 'Termine') DEFAULT 'Actif',
    FOREIGN KEY (etudiant_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (cours_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE(etudiant_id, cours_id) -- باش التلميذ مايتسجلش فنفس المادة جوج مرات
);

-- ==========================================
-- إدخال البيانات التجريبية (Dummy Data)
-- ==========================================

-- إدخال 3 أقسام
INSERT INTO classes (nom, salle) VALUES 
('Développement Web 101', 'Salle A1'),
('Réseaux et Sécurité', 'Salle B2'),
('Design Graphique', 'Salle C3');

-- إدخال المستخدمين
-- ملاحظة: كاع هاد الحسابات المودباس ديالهم هو: password
-- الهاش المستعمل هو التشفير ديال كلمة password بـ Bcrypt

-- 1. الأدمين
INSERT INTO users (nom, email, password, role, classe_id) VALUES 
('Directeur Admin', 'admin@edusync.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL);

-- 2. الأساتذة
INSERT INTO users (nom, email, password, role, classe_id) VALUES 
('Prof. Youssef', 'youssef.prof@edusync.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', NULL),
('Prof. Ahmed', 'ahmed.prof@edusync.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'teacher', NULL);

-- 3. التلاميذ
INSERT INTO users (nom, email, password, role, classe_id) VALUES 
('Etudiant Hassan', 'hassan@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 1),
('Etudiante Fatima', 'fatima@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 1),
('Etudiant Karim', 'karim@student.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 2);

-- إدخال المواد وربطها بالأساتذة
INSERT INTO courses (nom, description, volume_horaire, professeur_id) VALUES 
('PHP Avancé et PDO', 'Apprendre à connecter une BDD avec PDO en PHP 8.', 40, 2), -- يدرسها Prof Youssef
('Sécurité Web', 'Les failles XSS, SQL Injection et comment les contrer.', 30, 2), -- يدرسها Prof Youssef
('Réseaux Cisco', 'Configuration des routeurs et switchs.', 50, 3); -- يدرسها Prof Ahmed

-- تسجيل التلاميذ في المواد
INSERT INTO enrollments (etudiant_id, cours_id, status) VALUES 
(4, 1, 'Actif'),    -- حسن كيقرى PHP
(4, 2, 'Actif'),    -- حسن كيقرى Sécurité Web
(5, 1, 'Actif'),    -- فاطمة كتقرى PHP
(6, 3, 'Termine');  -- كريم قرى Réseaux وسالى