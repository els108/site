<?php
require_once 'config/database.php';
session_start();

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}

$db = getDBConnection();

// Получаем все записи клиента
$query = "SELECT a.*, s.name as service_name, s.price as service_price, 
          sp.name as specialist_name, sp.position as specialist_position
          FROM appointments a
          LEFT JOIN services s ON a.service_id = s.id
          LEFT JOIN specialists sp ON a.specialist_id = sp.id
          WHERE a.user_id = ?
          ORDER BY a.appointment_date DESC";

$stmt = $db->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'header.php';
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Мои записи</h1>

    <?php if (empty($appointments)): ?>
        <div class="alert alert-info">
            У вас пока нет записей. <a href="services.php" class="alert-link">Записаться на услугу</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($appointments as $appointment): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($appointment['service_name']); ?></h5>
                            <div class="card-text">
                                <p><strong>Дата и время:</strong> <?php echo date('d.m.Y H:i', strtotime($appointment['appointment_date'])); ?></p>
                                <p><strong>Мастер:</strong> <?php echo htmlspecialchars($appointment['specialist_name']); ?> 
                                   (<?php echo htmlspecialchars($appointment['specialist_position']); ?>)</p>
                                <p><strong>Стоимость:</strong> <?php echo number_format($appointment['service_price'], 0, ',', ' '); ?> ₽</p>
                                <?php if ($appointment['notes']): ?>
                                    <p><strong>Дополнительная информация:</strong><br>
                                    <?php echo nl2br(htmlspecialchars($appointment['notes'])); ?></p>
                                <?php endif; ?>
                                <p>
                                    <strong>Статус:</strong>
                                    <?php
                                    $statusClass = '';
                                    $statusText = '';
                                    switch ($appointment['status']) {
                                        case 'pending':
                                            $statusClass = 'warning';
                                            $statusText = 'Ожидает подтверждения';
                                            break;
                                        case 'confirmed':
                                            $statusClass = 'success';
                                            $statusText = 'Подтверждено';
                                            break;
                                        case 'completed':
                                            $statusClass = 'info';
                                            $statusText = 'Завершено';
                                            break;
                                        case 'cancelled':
                                            $statusClass = 'danger';
                                            $statusText = 'Отменено';
                                            break;
                                    }
                                    ?>
                                    <span class="badge bg-<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                </p>
                            </div>
                            <?php if ($appointment['status'] === 'pending'): ?>
                                <form method="POST" action="cancel_appointment.php" class="mt-3">
                                    <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите отменить запись?')">
                                        Отменить запись
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.card {
    border: 1px solid #f8b4d9;
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(248, 180, 217, 0.2);
}
.badge {
    font-size: 0.9em;
    padding: 8px 12px;
}
</style>

<?php include 'footer.php'; ?> 