<?php
session_start();
require_once '../../config/database.php';

// Проверка авторизации администратора
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit();
}

$db = getDBConnection();

$services = [];
$totalAmount = 0;
$vatAmount = 0;
$vatPercentage = 20; // Фиксированное значение НДС
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $startDate = $_POST["start_date"] ?? null;
    $endDate = $_POST["end_date"] ?? null;

    if ($startDate && $endDate && $startDate <= $endDate) {
        try {
            // Получаем услуги за выбранный период
            $stmt = $db->prepare("SELECT * FROM services WHERE DATE(created_at) BETWEEN :start AND :end ORDER BY created_at ASC");
            $stmt->execute([
                ':start' => $startDate,
                ':end' => $endDate
            ]);
            $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Считаем сумму
            foreach ($services as $service) {
                $totalAmount += $service['price'];
            }

            // Используем функцию calculate_vat из базы данных
            if ($totalAmount > 0) {
                // Получаем сумму НДС из функции calculate_vat
                $vatStmt = $db->prepare("SELECT calculate_vat(:total) AS vat");
                $vatStmt->execute([':total' => $totalAmount]);
                $vatAmount = $vatStmt->fetchColumn();
            }
        } catch (Exception $e) {
            $error = "Ошибка: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора - Прибыль</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #f8b4d9; }
        .card { border: 1px solid #f8b4d9; }
        .card-header { background-color: #f8b4d9; }
        .table th { background-color: #f8b4d9; }
        .calculation-result {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
            margin-top: 20px;
        }
        .calculation-result h5 {
            margin-bottom: 10px;
            color: #495057;
        }
        .calculation-result strong {
            color: #212529;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">Тигрица</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="profit.php">Прибыль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointments.php">Записи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">Выйти</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Доходы по дате</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-5">
                <label for="start_date" class="form-label">С даты</label>
                <input type="date" class="form-control" name="start_date" required value="<?= htmlspecialchars($_POST['start_date'] ?? '') ?>">
            </div>
            <div class="col-md-5">
                <label for="end_date" class="form-label">По дату</label>
                <input type="date" class="form-control" name="end_date" required value="<?= htmlspecialchars($_POST['end_date'] ?? '') ?>">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Показать</button>
            </div>
        </form>

        <?php if (!empty($services)): ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Детальная статистика услуг</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Категория</th>
                                    <th>Дата</th>
                                    <th>Цена</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?= htmlspecialchars($service['id']) ?></td>
                                    <td><?= htmlspecialchars($service['name']) ?></td>
                                    <td><?= htmlspecialchars($service['category']) ?></td>
                                    <td><?= date('d.m.Y H:i', strtotime($service['created_at'])) ?></td>
                                    <td><?= number_format($service['price'], 2, ',', ' ') ?> ₽</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="calculation-result">
                        <h5>Результат расчета:</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Общая сумма:</h5>
                                <p class="h4"><?= number_format($totalAmount, 2, ',', ' ') ?> ₽</p>
                            </div>
                            <div class="col-md-4">
                                <h5>НДС (<?= $vatPercentage ?>%):</h5>
                                <p class="h4"><?= number_format($vatAmount, 2, ',', ' ') ?> ₽</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Доход без НДС:</h5>
                                <p class="h4"><?= number_format($totalAmount - $vatAmount, 2, ',', ' ') ?> ₽</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <div class="alert alert-warning mt-4">Нет данных за указанный период.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

