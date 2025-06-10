<?php
session_start();
require_once 'config/database.php';

// Инициализация сессии корзины, если её нет
if (!isset($_SESSION['cart_id'])) {
    $_SESSION['cart_id'] = uniqid();
}

$db = getDBConnection();

// Обработка добавления товара в корзину
if (isset($_POST['add_to_cart'])) {
    $service_id = (int)$_POST['service_id'];
    $quantity = (int)$_POST['quantity'];
    
    // Проверяем, есть ли уже такой товар в корзине
    $checkQuery = "SELECT id, quantity FROM cart_items 
                  WHERE session_id = ? AND service_id = ?";
    $stmt = $db->prepare($checkQuery);
    $stmt->execute([$_SESSION['cart_id'], $service_id]);
    $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existingItem) {
        // Обновляем количество
        $updateQuery = "UPDATE cart_items 
                       SET quantity = quantity + ? 
                       WHERE id = ?";
        $stmt = $db->prepare($updateQuery);
        $stmt->execute([$quantity, $existingItem['id']]);
    } else {
        // Добавляем новый товар
        $insertQuery = "INSERT INTO cart_items (session_id, service_id, quantity) 
                       VALUES (?, ?, ?)";
        $stmt = $db->prepare($insertQuery);
        $stmt->execute([$_SESSION['cart_id'], $service_id, $quantity]);
    }
    
    header('Location: cart.php');
    exit();
}

// Обработка удаления товара из корзины
if (isset($_GET['remove'])) {
    $item_id = (int)$_GET['remove'];
    $deleteQuery = "DELETE FROM cart_items 
                   WHERE id = ? AND session_id = ?";
    $stmt = $db->prepare($deleteQuery);
    $stmt->execute([$item_id, $_SESSION['cart_id']]);
    
    header('Location: cart.php');
    exit();
}

// Получаем содержимое корзины
$cartQuery = "SELECT ci.*, s.name, s.price, s.duration 
             FROM cart_items ci 
             JOIN services s ON ci.service_id = s.id 
             WHERE ci.session_id = ?";
$stmt = $db->prepare($cartQuery);
$stmt->execute([$_SESSION['cart_id']]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Подсчет общей суммы
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Корзина</h1>
    
    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">
            Ваша корзина пуста. <a href="services.php">Перейти к услугам</a>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Услуга</th>
                                <th>Длительность</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Сумма</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td><?php echo $item['duration']; ?> мин.</td>
                                    <td><?php echo number_format($item['price'], 2); ?> ₽</td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> ₽</td>
                                    <td>
                                        <a href="?remove=<?php echo $item['id']; ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Удалить услугу из корзины?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Итого:</strong></td>
                                <td><strong><?php echo number_format($total, 2); ?> ₽</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="services.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Продолжить выбор
                    </a>
                    <a href="checkout.php" class="btn btn-primary">
                        Оформить заказ <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.table th {
    background-color: #f8f9fa;
}
.btn-danger {
    padding: 0.25rem 0.5rem;
}
</style>

<?php include 'footer.php'; ?> 