<?php
require_once 'database.php';

// User operations
function createUser($email, $password, $name, $phone) {
    $db = getDBConnection();
    global $error; // Глобальная переменная для передачи ошибок в интерфейс

    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password, name, phone) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$email, $hashedPassword, $name, $phone]);
    } catch (PDOException $e) {
        // Ловим ошибку от SQL-триггера //на регистрацию триггер
        $error = $e->getMessage();
        return false;
    }
}


function getUserByEmail($email) {
    $db = getDBConnection();
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Service operations
function getAllServices() {
    $db = getDBConnection();
    $sql = "SELECT * FROM services ORDER BY category, name";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getServicesByCategory($category) {
    $db = getDBConnection();
    $sql = "SELECT * FROM services WHERE category = ? ORDER BY name";
    $stmt = $db->prepare($sql);
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Specialist operations
function getAllSpecialists() {
    $db = getDBConnection();
    $sql = "SELECT * FROM specialists ORDER BY position, name";
    $stmt = $db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpecialistsByPosition($position) {
    $db = getDBConnection();
    $sql = "SELECT * FROM specialists WHERE position = ? ORDER BY name";
    $stmt = $db->prepare($sql);
    $stmt->execute([$position]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//Функция которая вызывает тригер на запись на прием
function createAppointment($userId, $serviceId, $specialistId, $appointmentDate, $notes = '') {
    $db = getDBConnection();

    try {
        $sql = "INSERT INTO appointments (user_id, service_id, specialist_id, appointment_date, notes)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$userId, $serviceId, $specialistId, $appointmentDate, $notes]);
        return true;

    } catch (PDOException $e) {
        $msg = $e->getMessage();

        if (str_contains($msg, 'ERROR_NO_SERVICE')) {
            echo "<script>alert('Ошибка: услуга не выбрана');</script>";
        } elseif (str_contains($msg, 'ERROR_NO_SPECIALIST')) {
            echo "<script>alert('Ошибка: мастер не выбран');</script>";
        } elseif (str_contains($msg, 'ERROR_NO_DATE')) {
            echo "<script>alert('Ошибка: дата не указана');</script>";
        } else {
            echo "<script>alert('Неизвестная ошибка: " . htmlspecialchars($msg) . "');</script>";
        }

        return false;
    }
}




function getUserAppointments($userId) {
    $db = getDBConnection();
    $sql = "SELECT a.*, s.name as service_name, sp.name as specialist_name 
            FROM appointments a 
            JOIN services s ON a.service_id = s.id 
            JOIN specialists sp ON a.specialist_id = sp.id 
            WHERE a.user_id = ? 
            ORDER BY a.appointment_date DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Review operations
function createReview($userId, $rating, $comment, $serviceId = null, $specialistId = null) {
    $db = getDBConnection();
    $sql = "INSERT INTO reviews (user_id, service_id, specialist_id, rating, comment) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$userId, $serviceId, $specialistId, $rating, $comment]);
}

function getServiceReviews($serviceId) {
    $db = getDBConnection();
    $sql = "SELECT r.*, u.name as user_name 
            FROM reviews r 
            JOIN users u ON r.user_id = u.id 
            WHERE r.service_id = ? 
            ORDER BY r.created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$serviceId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpecialistReviews($specialistId) {
    $db = getDBConnection();
    $sql = "SELECT r.*, u.name as user_name 
            FROM reviews r 
            JOIN users u ON r.user_id = u.id 
            WHERE r.specialist_id = ? 
            ORDER BY r.created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$specialistId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 