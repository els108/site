<?php
session_start();
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
        body {
            background-color: #f8f9fa;
            color: #495057;
        }
        .navbar {
            background-color: #f8b4d9; /* Бледно-розовый */
        }
        .navbar a {
            color: #495057; /* Темно-серый */
        }
        .navbar a:hover {
            color: #8bddc6; /* Мятный */
        }
        .card {
            border: none;
            transition: transform 0.2s; /* Эффект при наведении */
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title {
            color: #495057; /* Темно-серый */
        }
        h2, h3 {
            color: #8bddc6; /* Мятный */
        }
        .btn-primary {
            background-color: #f8b4d9; /* Бледно-розовый */
            border: none;
        }
        .btn-primary:hover {
            background-color: #8bddc6; /* Мятный */
        }
        .carousel-item img {
            height: 500px; /* Одинаковый размер для всех изображений */
            object-fit: cover; /* Сохранение пропорций */
        }
        #map {
            border: 5px solid #f8b4d9; /* Бледно-розовая рамка вокруг карты */
            margin-top: 20px;
        }
        footer {
            background-color: #f8b4d9; /* Бледно-розовый */
            color: #495057; /* Темно-серый */
            padding: 15px;
            text-align: center;
        }
        .container {
            background-color: #ffffff; /* Белый фон для контейнера */
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        input, textarea {
            background-color: #ffffff; /* Белый фон для полей ввода */
            color: #495057; /* Темно-серый текст */
            border: 1px solid #f8b4d9; /* Бледно-розовая граница */
            border-radius: 4px;
            padding: 10px;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #8bddc6; /* Мятный */
            color: #495057; /* Темно-серый */
            border: none;
        }
        input[type="submit"]:hover {
            background-color: #f8b4d9; /* Бледно-розовый */
        }
        a {
            color: #f8b4d9; /* Бледно-розовые ссылки */
            text-decoration: none;
        }
        a:hover {
            color: #8bddc6; /* Мятные ссылки при наведении */
        }
        p {
            color: #495057; /* Темно-серый текст */
            line-height: 1.5;
        }
        h1, h2, h3, h4 {
            color: #8bddc6; /* Мятные заголовки */
        }
        .btn {
            background-color: #8bddc6 !important; /* Мятный */
            color: #495057 !important; /* Темно-серый */
            border: none !important;
            padding: 10px 20px !important;
            border-radius: 4px !important;
            margin-left: 20px !important;
        }
        .btn:hover {
            background-color: #f8b4d9 !important; /* Бледно-розовый */
        }
    </style>
</head>
<body>

<!-- Меню сайта -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">Тигрица</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Главная</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Услуги</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="specialists.php">Мастера</a></li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <span class="nav-link">Привет, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
                    <?php else: ?>
                        <a class="nav-link" href="auth.php">Вход и Регистрация</a>
                    <?php endif; ?>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="my_appointments.php">Мои записи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Выйти</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Кнопка "Записаться" -->
        <a href="zapis.php" class="btn btn-appointment">Записаться</a>
    </div>
</nav> 