<?php
require_once 'config/database.php';
$db = getDBConnection();

// Получаем все услуги
$servicesQuery = "SELECT * FROM services ORDER BY category, name";
$services = $db->query($servicesQuery)->fetchAll(PDO::FETCH_ASSOC);

// Получаем активные акции
$promotionsQuery = "SELECT p.*, s.name as service_name 
                   FROM promotions p 
                   LEFT JOIN services s ON p.service_id = s.id 
                   WHERE p.is_active = 1 AND p.start_date <= CURDATE() AND p.end_date >= CURDATE()";
$promotions = $db->query($promotionsQuery)->fetchAll(PDO::FETCH_ASSOC);

// Создаем массив акций для быстрого поиска
$servicePromotions = [];
foreach ($promotions as $promo) {
    if ($promo['service_id']) {
        $servicePromotions[$promo['service_id']] = $promo;
    }
}

// Получаем информацию о программе лояльности для авторизованного пользователя
$loyaltyInfo = null;
if (isset($_SESSION['user_id'])) {
    $loyaltyQuery = "SELECT * FROM loyalty_program WHERE user_id = ?";
    $stmt = $db->prepare($loyaltyQuery);
    $stmt->execute([$_SESSION['user_id']]);
    $loyaltyInfo = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Наши услуги</h1>

    <?php if ($loyaltyInfo): ?>
    <div class="alert alert-info mb-4">
        <h4>Ваша программа лояльности</h4>
        <p>Уровень: <?php echo ucfirst($loyaltyInfo['level']); ?></p>
        <p>Бонусные баллы: <?php echo $loyaltyInfo['points']; ?></p>
        <?php if ($loyaltyInfo['level'] === 'gold'): ?>
            <p class="text-success">У вас есть скидка 10% на все услуги!</p>
        <?php elseif ($loyaltyInfo['level'] === 'silver'): ?>
            <p class="text-success">У вас есть скидка 5% на все услуги!</p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($services as $service): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if ($service['image_url']): ?>
                <img src="<?php echo htmlspecialchars($service['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($service['name']); ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($service['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($service['description']); ?></p>
                    <p class="card-text">
                        <strong>Цена: </strong>
                        <?php
                        $price = $service['price'];
                        // Применяем скидку по программе лояльности
                        if ($loyaltyInfo) {
                            if ($loyaltyInfo['level'] === 'gold') {
                                $price = $price * 0.9;
                            } elseif ($loyaltyInfo['level'] === 'silver') {
                                $price = $price * 0.95;
                            }
                        }
                        // Применяем скидку по акции
                        if (isset($servicePromotions[$service['id']])) {
                            $promo = $servicePromotions[$service['id']];
                            $price = $price * (1 - $promo['discount_percent'] / 100);
                            echo '<span class="text-danger"><del>' . number_format($service['price'], 2) . ' ₽</del></span> ';
                            echo '<span class="badge bg-danger">-'.$promo['discount_percent'].'%</span> ';
                        }
                        echo number_format($price, 2) . ' ₽';
                        ?>
                    </p>
                    <p class="card-text"><small class="text-muted">Длительность: <?php echo $service['duration']; ?> мин.</small></p>
                    <a href="zapis.php?service=<?php echo $service['id']; ?>" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>

<?php include 'footer.php'; ?>
