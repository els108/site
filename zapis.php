<?php
require_once 'config/db_helper.php';
session_start();
$db = getDBConnection();
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}

$error = '';
$success = '';

// Get service and specialist if provided
$service = null;
$specialist = null;
if (isset($_GET['service_id'])) {
    $service = getServicesByCategory($_GET['service_id'])[0] ?? null;
}
if (isset($_GET['specialist_id'])) {
    $specialist = getSpecialistsByPosition($_GET['specialist_id'])[0] ?? null;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = $_POST['service_id'] ?? null;
    $specialistId = $_POST['specialist_id'] ?? null;
    $appointmentDate = $_POST['appointment_date'] ?? '';
    $notes = $_POST['notes'] ?? '';

    try {
      $stmt = $db->prepare("INSERT INTO appointments (user_id, service_id, specialist_id, appointment_date, notes)
                            VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([
          1, // Временно user_id = 1
          $serviceId,
          $specialistId,
          $appointmentDate,
          $notes
      ]);
      $success = "Запись успешно создана!";
  } catch (PDOException $e) {
      // Получаем текст ошибки из триггера
      $msg = $e->getMessage();

  if (str_contains($msg, 'service_id')) {
      $error = 'Ошибка: Услуга не выбрана.';
  } elseif (str_contains($msg, 'specialist_id')) {
      $error = 'Ошибка: Мастер не выбран.';
  } elseif (str_contains($msg, 'appointment_date')) {
      $error = 'Ошибка: Не указана дата и время записи.';
  } elseif (str_contains($msg, 'Incorrect datetime value')) {
      $error = 'Ошибка: Неверный формат даты.';
  } else {
      $error = 'Ошибка при записи: ' . $msg;
  }

  }
}

// Get all services and specialists for the form
$services = getAllServices();
$specialists = getAllSpecialists();

include 'header.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Запись на услугу - Салон красоты "Тигрица"</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="salonKrasotushka.css">
  <style>
    body { background-color: #f8f9fa; color: #495057; }
    .navbar { background-color: #f8b4d9; }
    .navbar a { color: #495057; }
    .navbar a:hover { color: #8bddc6; }
    .container { background-color: #ffffff; border-radius: 8px; padding: 20px; margin-top: 20px; }
    input, textarea { background-color: #ffffff; color: #495057; border: 1px solid #f8b4d9; border-radius: 4px; padding: 10px; width: 100%; }
    input[type="submit"] { background-color: #8bddc6; color: #495057; border: none; }
    input[type="submit"]:hover { background-color: #f8b4d9; }
    a { color: #f8b4d9; text-decoration: none; }
    a:hover { color: #8bddc6; }
    p { color: #495057; line-height: 1.5; }
    h1, h2, h3, h4 { color: #8bddc6; }
    .btn-primary { background-color: #f8b4d9; border: none; }
    .btn-primary:hover { background-color: #8bddc6; }
  </style>
</head>
<body>

<div class="container mt-5">
  <h1 class="text-center mb-5">Запись на услугу</h1>

  <?php if ($error): ?>
    <script>alert('<?php echo addslashes($error); ?>');</script>
  <?php endif; ?>
  <?php if ($success): ?>
    <script>alert('<?php echo addslashes($success); ?>');</script>
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <form method="POST" action="">
            <div class="mb-3">
              <label for="service" class="form-label">Услуга</label>
              <select class="form-select" id="service" name="service_id">
                <option value="">Выберите услугу</option>
                <?php foreach ($services as $s): ?>
                  <option value="<?php echo $s['id']; ?>" <?php echo ($service && $service['id'] === $s['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($s['name']); ?> - <?php echo number_format($s['price'], 0, ',', ' '); ?> ₽
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="specialist" class="form-label">Мастер</label>
              <select class="form-select" id="specialist" name="specialist_id">
                <option value="">Выберите мастера</option>
                <?php foreach ($specialists as $s): ?>
                  <option value="<?php echo $s['id']; ?>" <?php echo ($specialist && $specialist['id'] === $s['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($s['name']); ?> - <?php echo htmlspecialchars($s['position']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="appointment_date" class="form-label">Дата и время</label>
              <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date">
            </div>

            <div class="mb-3">
              <label for="notes" class="form-label">Дополнительная информация</label>
              <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Записаться</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
