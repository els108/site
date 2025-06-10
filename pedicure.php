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
        .card-img-top {
            object-fit: cover;
            height: 250px;
        }
    </style>
</head>
<body>

<!-- Основной контент страницы -->
<div class="container mt-5">
    <h2 class="text-center">Разновидности педикюра и цены</h2>
    <div class="row mb-5">
        <!-- Класс col-md-6 для двух карточек в строке -->
        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/педикюр без покрытия.png" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Педикюр полный (без покрытия)</h5>
                    <p class="card-text">Любимая, твои ножки заслуживают лучшего ухода. Полный педикюр с препаратами Clearance — это быстро, безопасно и эффективно. Обработка стоп и ногтей подарит твоим ножкам комфорт и красоту. Цена: 7 500 руб.</p>
                    <p class="card-price"><strong>Цена: 7 500 руб.</strong></p>
                    <a href="zapis.php" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/педикюр с покрытием.png" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Педикюр полный (с покрытием)</h5>
                    <p class="card-text">Полный педикюр с обработкой и покрытием гель-лаком — это максимум комфорта и красоты для твоих ножек. Минимальное воздействие на ногтевую пластину, чтобы они оставались здоровыми.  Цена: 15 000 руб.</p>
                    <p class="card-price"><strong>Цена: 15 000 руб.</strong></p>
                    <a href="zapis.php" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/мужской педикюр.png" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Мужской педикюр полный (без покрытия)</h5>
                    <p class="card-text">Эй, крепыш, твои ноги тоже заслуживают внимания. Полный мужской педикюр с препаратами Clearance приведет твои стопы и ногти в идеальное состояние. Быстро, безопасно, эффективно — как и должно быть для настоящего мужика.</p>
                    <p class="card-price"><strong>Цена: 20 000 руб.</strong></p>
                    <a href="zapis.php" class="btn btn-primary">Записаться</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <img src="foto/пятка.png" height="275" width="628"/>
                <div class="card-body">
                    <h5 class="card-title">Обработка стоп</h5>
                    <p class="card-text">Дорогая, забота о стопах с препаратами Clearance — это экономия времени и комфорт для твоих ножек. Быстро и эффективно, чтобы ты всегда была на высоте.</p>
                    <p class="card-price"><strong>Цена: 5 000 руб.</strong></p>
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
