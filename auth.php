<?php
require_once 'config/db_helper.php';
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'register') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';

            if (empty($email) || empty($password) || empty($name)) {
                $error = 'Пожалуйста, заполните все обязательные поля';
            } else {
                $existingUser = getUserByEmail($email);
                if ($existingUser) {
                    $error = 'Пользователь с таким email уже существует';
                } else {
                    if (createUser($email, $password, $name, $phone)) {
                        $success = 'Регистрация успешно завершена! Теперь вы можете войти.';
                    } else {
                        if (empty($error)) {
                            $error = 'Ошибка при регистрации. Пожалуйста, попробуйте позже.';
                        }
                    }
                }
            }
        } elseif ($_POST['action'] === 'login') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Пожалуйста, введите email и пароль';
            } else {
                $user = getUserByEmail($email);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    header('Location: index.php');
                    exit;
                } else {
                    $error = 'Неверный email или пароль';
                }
            }
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Вход и Регистрация - Салон красоты "Тигрица"</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="salonKrasotushka.css">
  <style>
    body { background-color: #f8f9fa; color: #495057; }
    .navbar { background-color: #f8b4d9; }
    .navbar a { color: #495057; }
    .navbar a:hover { color: #8bddc6; }
    .card { border: none; transition: transform 0.2s; }
    .card:hover { transform: scale(1.05); }
    .btn-primary { background-color: #f8b4d9; border: none; }
    .btn-primary:hover { background-color: #8bddc6; }
    input, textarea {
      background-color: #ffffff; color: #495057;
      border: 1px solid #f8b4d9; border-radius: 4px;
      padding: 10px; width: 100%;
    }
    input[type="submit"], button[type="submit"] {
      background-color: #8bddc6; color: #495057; border: none;
    }
    input[type="submit"]:hover, button[type="submit"]:hover {
      background-color: #f8b4d9;
    }
    h2, h3, h4, h1 { color: #8bddc6; }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-5">
  <h2 class="text-center">Вход и Регистрация</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">

      <!-- JS Alerts for feedback -->
      <?php if ($error): ?>
        <script>alert('<?php echo addslashes($error); ?>');</script>
      <?php endif; ?>
      <?php if ($success): ?>
        <script>alert('<?php echo addslashes($success); ?>');</script>
      <?php endif; ?>

      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="authTabs" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button">Вход</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button">Регистрация</button>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="authTabsContent">
            <!-- Вход -->
            <div class="tab-pane fade show active" id="login">
              <form method="POST" action="">
                <input type="hidden" name="action" value="login">
                <div class="mb-3">
                  <label for="loginEmail" class="form-label">Email</label>
                  <input type="text" class="form-control" id="loginEmail" name="email">
                </div>
                <div class="mb-3">
                  <label for="loginPassword" class="form-label">Пароль</label>
                  <input type="text" class="form-control" id="loginPassword" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
              </form>
            </div>

            <!-- Регистрация -->
            <div class="tab-pane fade" id="register">
              <form method="POST" action="">
                <input type="hidden" name="action" value="register">
                <div class="mb-3">
                  <label for="registerName" class="form-label">Имя</label>
                  <input type="text" class="form-control" id="registerName" name="name">
                </div>
                <div class="mb-3">
                  <label for="registerEmail" class="form-label">Email</label>
                  <input type="text" class="form-control" id="registerEmail" name="email">
                </div>
                <div class="mb-3">
                  <label for="registerPhone" class="form-label">Телефон</label>
                  <input type="text" class="form-control" id="registerPhone" name="phone">
                </div>
                <div class="mb-3">
                  <label for="registerPassword" class="form-label">Пароль</label>
                  <input type="text" class="form-control" id="registerPassword" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- УБРАНО: scripts.js -->
</body>
</html>
