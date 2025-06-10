<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Педикюр - Салон красоты "Тигрица"</title>

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
            transition: transform 0.2s;
            height: 100%;
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
        .card-img-top {
            object-fit: cover;
            height: 250px;
        }
    </style>
</head>
<body>


<!-- Основной контент страницы -->
<div class="container mt-5">
    <h2 class="text-center">Наращивание ресниц прайс-лист</h2>
    <div class="row mb-5">
        <!-- Класс col-md-6 для двух карточек в строке -->
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/наращивание ресниц/1д.jpg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">1D наращивание</h5>
                    <p class="card-text">Естественный эффект!</p>
                    <p class="card-price"><strong>Цена: 3 000руб.</strong></p>
                    <a href="zapis.html" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/наращивание ресниц/2D наращивание.jpg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">2D наращивание</h5>
                    <p class="card-text">Эффектный огненный взгляд обеспечен!</p>
                    <p class="card-price"><strong>Цена: 5 000руб </strong></p>
                    <a href="zapis.html" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/наращивание ресниц/3D наращивание.jpg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">3D наращивание</h5>
                    <p class="card-text">Не хватает денег на самолет? Улетите в теплые страны на своих роскошных ресницах!</p>
                    <p class="card-price"><strong>Цена: 8 000руб.</strong></p>
                    <a href="zapis.html" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/наращивание ресниц/ламинирование ресниц.jpg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Ламинирование ресниц</h5>
                    <p class="card-text">Прекрасные, натуральные и подкрученные ресницы всегда при вас!</p>
                    <p class="card-price"><strong>Цена: 2 000руб. </strong></p>
                    <a href="zapis.html" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/наращивание ресниц/цветные ресницы наращивание.jpeg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Цветные ресницы</h5>
                    <p class="card-text">Будь те яркой личностью! </p>
                    <p class="card-price"><strong>Цена: + 2 000руб. к выбранному объему. </strong></p>
                    <a href="zapis.html" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>

        <!-- Подключение Bootstrap JS и Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>