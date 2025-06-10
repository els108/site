-- Добавляем тестовые услуги, если их еще нет
INSERT INTO services (name, price, duration, description) 
VALUES 
('Стрижка', 2000, 60, 'Классическая стрижка'),
('Окрашивание', 5000, 120, 'Окрашивание волос'),
('Укладка', 3000, 90, 'Вечерняя укладка')
ON DUPLICATE KEY UPDATE id=id;

-- Добавляем тестовые записи
INSERT INTO appointments (service_id, client_name, appointment_date, status, price)
VALUES 
(1, 'Иван Петров', DATE_SUB(NOW(), INTERVAL 2 DAY), 'completed', 2000),
(2, 'Мария Иванова', DATE_SUB(NOW(), INTERVAL 1 DAY), 'completed', 5000),
(3, 'Алексей Сидоров', NOW(), 'completed', 3000); 