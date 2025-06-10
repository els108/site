<?php
session_start();
require_once 'config/database.php';

// Проверяем, есть ли товары в корзине
if (!isset($_SESSION['cart_id'])) {
    header('Location: cart.php');
    exit();
}

$db = getDBConnection();

// Получаем содержимое корзины
$cartQuery = "SELECT ci.*, s.name, s.price, s.duration 
             FROM cart_items ci 
             JOIN services s ON ci.service_id = s.id 
             WHERE ci.session_id = ?";
$stmt = $db->prepare($cartQuery);
$stmt->execute([$_SESSION['cart_id']]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Если корзина пуста, перенаправляем на страницу корзины
if (empty($cartItems)) {
    header('Location: cart.php');
    exit();
}

// Подсчет общей суммы
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Обработка оформления заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db->beginTransaction();

        // Создаем запись о заказе
        $orderQuery = "INSERT INTO appointments (client_name, phone, email, total_amount, status, created_at) 
                      VALUES (?, ?, ?, ?, 'pending', NOW())";
        $stmt = $db->prepare($orderQuery);
        $stmt->execute([
            $_POST['name'],
            $_POST['phone'],
            $_POST['email'],
            $total
        ]);
        
        $orderId = $db->lastInsertId();

        // Добавляем услуги из корзины в заказ
        foreach ($cartItems as $item) {
            $orderItemQuery = "INSERT INTO appointment_services (appointment_id, service_id, quantity, price) 
                             VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($orderItemQuery);
            $stmt->execute([
                $orderId,
                $item['service_id'],
                $item['quantity'],
                $item['price']
            ]);
        }

        // Очищаем корзину
        $clearCartQuery = "DELETE FROM cart_items WHERE session_id = ?";
        $stmt = $db->prepare($clearCartQuery);
        $stmt->execute([$_SESSION['cart_id']]);
        
        unset($_SESSION['cart_id']);

        $db->commit();
        
        // Перенаправляем на страницу успешного оформления
        header('Location: order_success.php?order_id=' . $orderId);
        exit();
    } catch (Exception $e) {
        $db->rollBack();
        $error = "Произошла ошибка при оформлении заказа. Пожалуйста, попробуйте позже.";
    }
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Оформление заказа</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Данные для связи</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Комментарий к заказу</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Подтвердить заказ</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Ваш заказ</h4>
                </div>
                <div class="card-body">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['quantity']; ?></span>
                            <span><?php echo number_format($item['price'] * $item['quantity'], 2); ?> ₽</span>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Итого:</strong>
                        <strong><?php echo number_format($total, 2); ?> ₽</strong>
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