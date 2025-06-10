<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Маникюр - Салон красоты "Тигрица"</title>

    <!-- Подключение CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ваши стили -->
    <link rel="stylesheet" href="salonKrasotushka.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Разновидности маникюра и цены</h2>

    <div class="row mb-5">
        <!-- Класс col-md-6 для двух карточек в строке -->
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/classic-manicure.jpg" class="card-img-top" alt="" height=""><img
                    src="foto/pretty-manicured-han.jpg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Классический маникюр</h5>
                    <p class="card-text">Просто, но со вкусом! Цена: 7 500 руб.</p>
                    <a href="zapis.php" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/gel-manicure.jpg" class="card-img-top" alt="" height=""><img
                    src="foto/классический маникюр.jpg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Премиум маникюр</h5>
                    <p class="card-text">Долговечный и красивый, весь маникюр проводится на примиальный материалах. Цена: 25 000 руб.</p>
                    <a href="zapis.php" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/narashivanie.jpg" class="card-img-top" alt="" height=""><img
                    src="foto/narachev_nogti.jpg" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Наращивание</h5>
                    <p class="card-text">Любые виды наращивания! Цена: 20 000 руб.</p>
                    <a href="zapis.php" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/luxury-manicure.jpg" class="card-img-top" alt="" height=""><img
                    src="foto/ногти ногти ногти.webp" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Гелевый маникюр</h5>
                    <p class="card-text">Лучшие материалы и уникальный уход. Цена: 15 000 руб.</p>
                    <a href="zapis.php" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Подключение Bootstrap JS и Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
