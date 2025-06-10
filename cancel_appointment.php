<?php
require_once 'config/database.php';
session_start();

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}

// Проверка наличия ID записи
if (!isset($_POST['appointment_id'])) {
    header('Location: my_appointments.php');
    exit;
}

$db = getDBConnection();

try {
    // Проверяем, принадлежит ли запись текущему пользователю
    $checkQuery = "SELECT id FROM appointments WHERE id = ? AND user_id = ? AND status = 'pending'";
    $stmt = $db->prepare($checkQuery);
    $stmt->execute([$_POST['appointment_id'], $_SESSION['user_id']]);
    
    if ($stmt->rowCount() === 0) {
        throw new Exception('Запись не найдена или не может быть отменена');
    }

    // Отменяем запись
    $updateQuery = "UPDATE appointments SET status = 'cancelled' WHERE id = ?";
    $stmt = $db->prepare($updateQuery);
    $stmt->execute([$_POST['appointment_id']]);

    header('Location: my_appointments.php?success=1');
} catch (Exception $e) {
    header('Location: my_appointments.php?error=' . urlencode($e->getMessage()));
}
exit; 