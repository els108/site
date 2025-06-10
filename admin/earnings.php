<?php
session_start();
require_once '../config/database.php';

// Проверка авторизации администратора
if (!isset($_SESSION['user_id']) || $_SESSION['email'] !== 'admin@gmail.com') {
    header('Location: ../login.php');
    exit();
}

$db = getDBConnection();

// Получаем все записи с информацией об услугах
$query = "SELECT a.*, s.name as service_name, s.price, s.duration 
          FROM appointments a 
          JOIN services s ON a.service_id = s.id 
          WHERE a.status = 'completed' 
          ORDER BY a.appointment_date DESC";
$appointments = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

// Рассчитываем заработок
$totalEarnings = 0;
$totalTax = 0;
$totalNetEarnings = 0;

foreach ($appointments as $appointment) {
    $totalEarnings += $appointment['price'];
}

$totalTax = $totalEarnings * 0.20; // 20% НДФЛ
$totalNetEarnings = $totalEarnings - $totalTax;
?>

<?php include '../header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Панель администратора - Заработок</h1>
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Общий заработок</h5>
                    <h3 class="card-text"><?php echo number_format($totalEarnings, 2); ?> ₽</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">НДФЛ (20%)</h5>
                    <h3 class="card-text"><?php echo number_format($totalTax, 2); ?> ₽</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Чистый заработок</h5>
                    <h3 class="card-text"><?php echo number_format($totalNetEarnings, 2); ?> ₽</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>История записей</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Услуга</th>
                            <th>Клиент</th>
                            <th>Сумма</th>
                            <th>НДФЛ</th>
                            <th>Чистая прибыль</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                            <?php 
                            $tax = $appointment['price'] * 0.20;
                            $netEarnings = $appointment['price'] - $tax;
                            ?>
                            <tr>
                                <td><?php echo date('d.m.Y H:i', strtotime($appointment['appointment_date'])); ?></td>
                                <td><?php echo htmlspecialchars($appointment['service_name']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['client_name']); ?></td>
                                <td><?php echo number_format($appointment['price'], 2); ?> ₽</td>
                                <td><?php echo number_format($tax, 2); ?> ₽</td>
                                <td><?php echo number_format($netEarnings, 2); ?> ₽</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.card-body h3 {
    margin: 0;
    font-size: 24px;
}
.table th {
    background-color: #f8f9fa;
}
</style>

<?php include '../footer.php'; ?> 