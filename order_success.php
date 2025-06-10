<?php
session_start();
require_once 'config/database.php';

if (!isset($_GET['order_id'])) {
    header('Location: services.php');
    exit();
}

$db = getDBConnection();
$orderId = (int)$_GET['order_id'];

// Получаем информацию о заказе
$orderQuery = "SELECT * FROM appointments WHERE id = ?";
$stmt = $db->prepare($orderQuery);
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    header('Location: services.php');
    exit();
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>
                    <h2 class="mt-3">Заказ успешно оформлен!</h2>
                    <p class="lead">Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время.</p>
                    
                    <div class="alert alert-info mt-4">
                        <h4>Детали заказа</h4>
                        <p><strong>Номер заказа:</strong> #<?php echo $order['id']; ?></p>
                        <p><strong>Сумма заказа:</strong> <?php echo number_format($order['total_amount'], 2); ?> ₽</p>
                        <p><strong>Статус:</strong> <?php echo $order['status']; ?></p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="services.php" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Вернуться к услугам
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>

<?php include 'footer.php'; ?> 