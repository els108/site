-- Create database
CREATE DATABASE IF NOT EXISTS salon_tigritsa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE salon_tigritsa;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Services table
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    duration INT, -- Duration in minutes
    image_url VARCHAR(255), -- URL изображения услуги
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Specialists table
CREATE TABLE IF NOT EXISTS specialists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    description TEXT,
    photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Appointments table
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    specialist_id INT NOT NULL,
    appointment_date DATETIME NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (specialist_id) REFERENCES specialists(id)
);

-- Reviews table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT,
    specialist_id INT,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (service_id) REFERENCES services(id),
    FOREIGN KEY (specialist_id) REFERENCES specialists(id)
);

-- Promotions table
CREATE TABLE IF NOT EXISTS promotions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    discount_percent INT NOT NULL CHECK (discount_percent >= 0 AND discount_percent <= 100),
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    service_id INT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id)
);

-- Working hours table
CREATE TABLE IF NOT EXISTS working_hours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    specialist_id INT NOT NULL,
    day_of_week TINYINT NOT NULL CHECK (day_of_week >= 1 AND day_of_week <= 7),
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (specialist_id) REFERENCES specialists(id)
);

-- Loyalty program table
CREATE TABLE IF NOT EXISTS loyalty_program (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    points INT NOT NULL DEFAULT 0,
    level ENUM('bronze', 'silver', 'gold', 'platinum') DEFAULT 'bronze',
    total_spent DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    last_visit_date DATE,
    birthday_bonus_used BOOLEAN DEFAULT FALSE,
    referral_code VARCHAR(20) UNIQUE,
    referred_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (referred_by) REFERENCES users(id)
);

-- Insert sample users first
INSERT INTO users (email, password, name, phone) VALUES
('anna@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Анна Иванова', '+7 (999) 123-45-67'),
('maria@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Мария Петрова', '+7 (999) 234-56-78'),
('elena@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Елена Сидорова', '+7 (999) 345-67-89');

-- Insert some sample services
INSERT INTO services (name, description, price, category, duration, image_url) VALUES
('Классический маникюр', 'Просто, но со вкусом!', 7500.00, 'manicure', 60, 'foto/nogtinogti.webp'),
('Премиум маникюр', 'Долговечный и красивый, весь маникюр проводится на примиальный материалах.', 25000.00, 'manicure', 90, 'foto/nogti.jpg'),
('Наращивание', 'Любые виды наращивания!', 20000.00, 'manicure', 120, 'foto/manicure/narachev_nogti.jpg'),
('Гелевый маникюр', 'Лучшие материалы и уникальный уход.', 15000.00, 'manicure', 90, 'foto/manicure/gel.jpg'),
('Педикюр полный (без покрытия)', 'Полный педикюр с препаратами Clearance', 7500.00, 'pedicure', 60, 'foto/pedikurbezpokr.png'),
('Педикюр полный (с покрытием)', 'Полный педикюр с обработкой и покрытием гель-лаком', 15000.00, 'pedicure', 90, 'foto/pedikutpokr.png'),
('Мужской педикюр', 'Полный мужской педикюр с препаратами Clearance', 20000.00, 'pedicure', 60, 'foto/mpedikur.png'),
('Обработка стоп', 'Забота о стопах с препаратами Clearance', 5000.00, 'pedicure', 30, 'foto/stop.png'),
('Лечебный массаж', 'Устраните напряжение и боль с помощью этого восстановительного массажа', 5000.00, 'massage', 60, 'foto/lech_mas.webp'),
('Общий массаж тела', 'Откройте для себя гармонию и расслабление!', 2500.00, 'massage', 60, 'foto/obch_mas.webp'),
('Спортивный массаж', 'Поддержите свои спортивные достижения', 3500.00, 'massage', 60, 'foto/sport_mas.webp'),
('Возрастной массаж', 'Специальный массаж для людей старше 60 лет', 700.00, 'massage', 45, 'foto/vzros_mas.webp');

-- Insert some sample specialists
INSERT INTO specialists (name, position, description) VALUES
('Анна', 'Мастер маникюра', 'Опытный мастер с 5-летним стажем'),
('Мария', 'Мастер педикюра', 'Специалист по аппаратному педикюру'),
('Елена', 'Массажист', 'Сертифицированный специалист по лечебному массажу'),
('Ольга', 'Мастер маникюра', 'Эксперт по наращиванию ногтей');

-- Now insert promotions (after services are created)
INSERT INTO promotions (name, description, discount_percent, start_date, end_date, service_id, is_active) VALUES
('Летняя скидка на маникюр', 'Скидка 20% на все виды маникюра', 20, '2024-03-01', '2024-08-31', 1, 1),
('Приведи друга', 'Скидка 15% при записи с другом', 15, '2024-03-01', '2024-12-31', NULL, 1),
('День рождения', 'Скидка 25% в день рождения', 25, '2024-03-01', '2024-12-31', NULL, 1),
('Скидка на педикюр', 'Скидка 10% на все виды педикюра', 10, '2024-03-01', '2024-04-30', 5, 1),
('Скидка на массаж', 'Скидка 15% на все виды массажа', 15, '2024-03-01', '2024-05-31', 9, 1);

-- Insert sample working hours (after specialists are created)
INSERT INTO working_hours (specialist_id, day_of_week, start_time, end_time) VALUES
(1, 1, '09:00:00', '18:00:00'),
(1, 2, '09:00:00', '18:00:00'),
(1, 3, '09:00:00', '18:00:00'),
(1, 4, '09:00:00', '18:00:00'),
(1, 5, '09:00:00', '18:00:00'),
(2, 1, '10:00:00', '19:00:00'),
(2, 2, '10:00:00', '19:00:00'),
(2, 3, '10:00:00', '19:00:00'),
(2, 4, '10:00:00', '19:00:00'),
(2, 5, '10:00:00', '19:00:00');

-- Insert sample loyalty program data (after users are created)
INSERT INTO loyalty_program (user_id, points, level, total_spent, last_visit_date, referral_code) VALUES
(1, 1500, 'gold', 75000.00, '2024-03-15', 'REF001'),
(2, 500, 'silver', 25000.00, '2024-03-10', 'REF002'),
(3, 100, 'bronze', 5000.00, '2024-03-01', 'REF003');

-- Insert sample reviews
INSERT INTO reviews (user_id, service_id, rating, comment) VALUES
(1, 1, 5, 'Отличный маникюр! Очень довольна результатом.'),
(2, 5, 4, 'Хороший педикюр, но немного долго ждала.'),
(3, 9, 5, 'Прекрасный массаж, очень расслабился.'); 