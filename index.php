<?php include 'header.php'; ?>

<?php
session_start();
require_once 'config/database.php';
$db = getDBConnection();

// Получаем последние 3 отзыва
$reviewsQuery = "SELECT r.*, u.name as user_name, s.name as service_name 
                FROM reviews r 
                LEFT JOIN users u ON r.user_id = u.id 
                LEFT JOIN services s ON r.service_id = s.id 
                ORDER BY r.created_at DESC LIMIT 3";
$reviews = $db->query($reviewsQuery)->fetchAll(PDO::FETCH_ASSOC);

// Получаем активные акции
$promotionsQuery = "SELECT p.*, s.name as service_name 
                   FROM promotions p 
                   LEFT JOIN services s ON p.service_id = s.id 
                   WHERE p.is_active = 1 
                   AND p.start_date <= CURRENT_DATE() 
                   AND p.end_date >= CURRENT_DATE()
                   ORDER BY p.end_date ASC";
$promotions = $db->query($promotionsQuery)->fetchAll(PDO::FETCH_ASSOC);

// Debug information for promotions
error_log("Number of active promotions: " . count($promotions));
foreach ($promotions as $promo) {
    error_log("Promotion: " . $promo['name'] . " - Active: " . $promo['is_active'] . 
              " - Start: " . $promo['start_date'] . " - End: " . $promo['end_date']);
}

// Обработка отправки отзыва
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $serviceId = !empty($_POST['service_id']) ? $_POST['service_id'] : null;
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        
        try {
            $db->beginTransaction();
            
            // Добавляем отзыв
            $stmt = $db->prepare("INSERT INTO reviews (user_id, service_id, rating, comment) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, $serviceId, $rating, $comment]);
            
            // Обновляем бонусы в программе лояльности
            $stmt = $db->prepare("UPDATE loyalty_program SET points = points + 50 WHERE user_id = ?");
            $stmt->execute([$userId]);
            
            $db->commit();
            
            // Перенаправляем на страницу с отзывами
            header('Location: index.php#reviews');
            exit;
        } catch (Exception $e) {
            $db->rollBack();
            $error = "Произошла ошибка при сохранении отзыва: " . $e->getMessage();
        }
    } else {
        $error = "Для оставления отзыва необходимо авторизоваться";
    }
}

// Получаем список услуг для формы отзыва
$servicesQuery = "SELECT id, name FROM services ORDER BY category, name";
$services = $db->query($servicesQuery)->fetchAll(PDO::FETCH_ASSOC);

// Debug information
if (isset($_POST['submit_review'])) {
    error_log("Review submission attempt:");
    error_log("User ID: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'not set'));
    error_log("Service ID: " . $_POST['service_id']);
    error_log("Rating: " . $_POST['rating']);
    error_log("Comment: " . $_POST['comment']);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Салон красоты "Тигрица"</title>

    <!-- Подключение CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ваши стили -->
    <link rel="stylesheet" href="salonKrasotushka.css">
    <style>
        .carousel-item img {
            height: 500px; /* Одинаковый размер для всех изображений */
            object-fit: cover; /* Сохранение пропорций */
        }
        #map {
            border: 5px solid #f8b4d9; /* Бледно-розовая рамка вокруг карты */
            margin-top: 20px;
        }
        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            cursor: pointer;
            font-size: 1.5em;
            color: #ddd;
            padding: 0 0.1em;
        }

        .rating-input input:checked ~ label,
        .rating-input label:hover,
        .rating-input label:hover ~ label {
            color: #ffd700;
        }
    </style>
</head>
<body>

<!-- Основной контент страницы -->
<div class="container mt-5">
    <h2 class="text-center">Добро пожаловать в салон красоты Тигрица</h2>
    <h2 class="text-center">Тигрица снаружи - тигрица внутри</h2>
    <h5 class="text-center">Салон премиум класса для настоящих тигриц!!!</h5>

    <!-- Слайдер с фотографиями салона -->
    <div id="salonCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="foto/scale_1200.jpeg" class="d-block w-100" alt="Фото салона 1">
            </div>
            <div class="carousel-item">
                <img src="foto/салон красоты внутри 1.jpg" class="d-block w-100" alt="Фото салона 2">
            </div>
            <div class="carousel-item">
                <img src="foto/салон красоты внутри 2.jpg" class="d-block w-100" alt="Фото салона 3">
            </div>
            <div class="carousel-item">
                <img src="foto/салон красоты внутри 3.jpg" class="d-block w-100" alt="Фото салона 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#salonCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#salonCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Блок с акциями -->
    <section class="promotions py-5">
        <div class="container">
            <h2 class="text-center mb-4">Акции и специальные предложения</h2>
            <div class="row">
                <?php if (empty($promotions)): ?>
                    <div class="col-12 text-center">
                        <p>В данный момент нет активных акций</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($promotions as $promo): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($promo['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($promo['description']); ?></p>
                                <?php if ($promo['service_name']): ?>
                                    <p class="card-text"><small class="text-muted">Действует на услугу: <?php echo htmlspecialchars($promo['service_name']); ?></small></p>
                                <?php endif; ?>
                                <p class="card-text"><strong>Скидка: <?php echo $promo['discount_percent']; ?>%</strong></p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Действует: <?php echo date('d.m.Y', strtotime($promo['start_date'])); ?> - 
                                        <?php echo date('d.m.Y', strtotime($promo['end_date'])); ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Блок с отзывами -->
    <section id="reviews" class="reviews py-5">
        <div class="container">
            <h2 class="text-center mb-4">Отзывы наших клиентов</h2>
            <div class="row">
                <?php foreach ($reviews as $review): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($review['user_name']); ?></h5>
                            <?php if ($review['service_name']): ?>
                                <p class="card-text"><small class="text-muted">Услуга: <?php echo htmlspecialchars($review['service_name']); ?></small></p>
                            <?php endif; ?>
                            <div class="rating mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span style="color: <?php echo $i <= $review['rating'] ? '#ffd700' : '#ddd'; ?>">★</span>
                                <?php endfor; ?>
                                <span class="ms-2">(<?php echo $review['rating']; ?>/5)</span>
                            </div>
                            <p class="card-text"><?php echo htmlspecialchars($review['comment']); ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo date('d.m.Y', strtotime($review['created_at'])); ?></small></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Форма для оставления отзыва -->
            <div class="row mt-5">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4">Оставить отзыв</h3>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#reviews">
                                    <div class="form-group mb-3">
                                        <label for="service">Выберите услугу (необязательно)</label>
                                        <select class="form-control" id="service" name="service_id">
                                            <option value="">Не выбрано</option>
                                            <?php foreach ($services as $service): ?>
                                                <option value="<?php echo $service['id']; ?>"><?php echo htmlspecialchars($service['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Оценка</label>
                                        <div class="rating-input">
                                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                                <input type="radio" name="rating" value="<?php echo $i; ?>" id="star<?php echo $i; ?>" required>
                                                <label for="star<?php echo $i; ?>">★</label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="comment">Ваш отзыв</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" name="submit_review" class="btn btn-primary">Отправить отзыв</button>
                                </form>
                            <?php else: ?>
                                <div class="text-center">
                                    <p>Для оставления отзыва необходимо <a href="auth.php">авторизоваться</a></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Контакты -->
<div class="container mt-5">
    <h2>Контакты</h2>
    <p>Адрес: ул. Примерная, д. 10</p>
    <p>Телефон: +7 123 456 78 90</p>
    <div id="map" style="height: 400px;"></div>
</div>

<!-- Подключение карты Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Инициализация карты
    var map = L.map('map').setView([55.7558, 37.6173], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
</script>

<!-- Подключение Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
