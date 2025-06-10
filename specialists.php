<?php
require_once 'config/db_helper.php';
include 'header.php';

$specialists = getAllSpecialists();
$positions = [
    'Мастер маникюра' => 'Мастера маникюра',
    'Мастер педикюра' => 'Мастера педикюра',
    'Массажист' => 'Массажисты'
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наши мастера - Салон красоты "Тигрица"</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="salonKrasotushka.css">
    <style>
        .specialist-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
            background-color: #ffffff;
        }
        .specialist-card:hover {
            transform: translateY(-5px);
        }
        .specialist-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin: 20px auto;
            border: 3px solid #f8b4d9;
        }
        .specialist-info {
            padding: 20px;
        }
        .specialist-name {
            color: #8bddc6;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .specialist-specialty {
            color: #f8b4d9;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .specialist-experience {
            color: #495057;
            margin-bottom: 15px;
        }
        .specialist-contact {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
        }
        .contact-item {
            margin-bottom: 10px;
            color: #495057;
        }
        .contact-item i {
            color: #f8b4d9;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <!-- Основной контент -->
    <div class="container mt-5">
        <h1 class="text-center mb-5">Наши мастера</h1>

        <?php foreach ($positions as $position => $positionTitle): ?>
            <h2 class="mb-4"><?php echo htmlspecialchars($positionTitle); ?></h2>
            <div class="row">
                <?php
                $positionSpecialists = array_filter($specialists, function($specialist) use ($position) {
                    return $specialist['position'] === $position;
                });
                foreach ($positionSpecialists as $specialist):
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if ($specialist['photo']): ?>
                                <img src="<?php echo htmlspecialchars($specialist['photo']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($specialist['name']); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($specialist['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($specialist['description']); ?></p>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <a href="zapis.php?specialist_id=<?php echo $specialist['id']; ?>" class="btn btn-primary">Записаться</a>
                                <?php else: ?>
                                    <a href="auth.php" class="btn btn-primary">Войдите для записи</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Подключение скриптов -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>
</html> 