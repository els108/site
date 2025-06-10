<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Салон красоты "Тигрица"</title>

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
        .btn-appointment {
            background-color: #8bddc6; /* Мятный */
            color: #495057; /* Темно-серый */
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 20px;
        }
        .btn-appointment:hover {
            background-color: #f8b4d9; /* Бледно-розовый */
        }
    </style>
</head>
<body>


<!-- Основной контент страницы -->
<div class="container mt-5">
    <h2 class="text-center">Личный кабинет</h2>
    <h3 class="text-center" id="userName">Добро пожаловать, [Имя пользователя]!</h3>

    <!-- История процедур -->
    <div class="mt-5">
        <h3>История процедур</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Процедура</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>2023-10-01</td>
                <td>Пилинг поверхностный</td>
                <td>5 000 руб.</td>
            </tr>
            <tr>
                <td>2023-09-15</td>
                <td>Мезотерапия для волос</td>
                <td>12 000 руб.</td>
            </tr>
            <tr>
                <td>2023-08-20</td>
                <td>Плазмолифтинг лица</td>
                <td>7 000 руб.</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Бонусные баллы -->
    <div class="mt-5">
        <h3>Бонусные баллы</h3>
        <p>Ваш текущий баланс бонусных баллов: <strong>150 баллов</strong></p>
        <p>Бонусные баллы можно использовать для получения скидок на услуги салона.</p>
    </div>
</div>

<!-- Подключение Bootstrap JS и Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Ваши скрипты -->
<script>
    // Симуляция получения данных пользователя
    const userData = {
        name: "Иван Иванов" // Пример имени пользователя
    };

    // Отображение имени пользователя
    document.getElementById('userName').innerText = `Добро пожаловать, ${userData.name}!`;
</script>
</body>
</html>
