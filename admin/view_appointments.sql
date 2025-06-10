-- Просмотр всех записей с детальной информацией
SELECT 
    a.id,
    a.appointment_date,
    a.status,
    a.notes,
    u.name as client_name,
    u.phone as client_phone,
    s.name as service_name,
    s.price as service_price,
    sp.name as specialist_name,
    sp.position as specialist_position
FROM appointments a
LEFT JOIN users u ON a.user_id = u.id
LEFT JOIN services s ON a.service_id = s.id
LEFT JOIN specialists sp ON a.specialist_id = sp.id
ORDER BY a.appointment_date DESC;

-- Просмотр записей конкретного клиента (замените USER_ID на ID клиента)
SELECT 
    a.id,
    a.appointment_date,
    a.status,
    a.notes,
    s.name as service_name,
    s.price as service_price,
    sp.name as specialist_name,
    sp.position as specialist_position
FROM appointments a
LEFT JOIN services s ON a.service_id = s.id
LEFT JOIN specialists sp ON a.specialist_id = sp.id
WHERE a.user_id = USER_ID
ORDER BY a.appointment_date DESC;

-- Статистика по статусам записей
SELECT 
    status,
    COUNT(*) as count
FROM appointments
GROUP BY status;

-- Записи на сегодня
SELECT 
    a.id,
    a.appointment_date,
    u.name as client_name,
    s.name as service_name,
    sp.name as specialist_name
FROM appointments a
LEFT JOIN users u ON a.user_id = u.id
LEFT JOIN services s ON a.service_id = s.id
LEFT JOIN specialists sp ON a.specialist_id = sp.id
WHERE DATE(a.appointment_date) = CURDATE()
ORDER BY a.appointment_date; 