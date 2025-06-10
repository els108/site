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
  <h2 class="text-center">Разновидности макияжа и цены</h2>
  <div class="row mb-5">
    <!-- Класс col-md-6 для двух карточек в строке -->
    <div class="col-md-6">
      <div class="card mb-4">
        <img src="foto/классичесий 1макияж.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Классический макияж</h5>
          <p class="card-text">Моя красавица, ты достойна быть в центре внимания. Доверься нашим профессионалам, и они создадут для тебя макияж, который подчеркнет твою неповторимость. руб.</p>
          <p class="card-price"><strong>Цена: 8 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-price="15000"> <!-- Добавилен атрибут data-price -->
        <img src="foto/вечерний макияж.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Вечерний макияж</h5>
          <p class="card-text">Создайте эффектный образ для вечернего мероприятия с нашим вечерним макияжем. Мы подчеркнем ваши лучшие черты, чтобы вы чувствовали себя уверенно и привлекательно</p>
          <p class="card-price"><strong>Цена: 12 500 руб.</strong></p> <!-- Отдельное поле с ценой -->
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>


    <div class="col-md-6">
      <div class="card mb-4">
        <img src="foto/эффектный макияж.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Эффектный макияж</h5>
          <p class="card-text">Сияйте ярче всех с нашим эффектным макияжем, который выделит вашу индивидуальность. Идеально подходит для фотосессий и особых событий!</p>
          <p class="card-price"><strong>Цена: 13 500 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4">
        <img src="foto/свадебный макияж.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Свадебный макияж</h5>
          <p class="card-text">В самый важный день доверяйте нашим профессионалам для создания уникального свадебного макияжа. Мы обеспечим стойкость и безупречный вид на протяжении всего дня!</p>
          <p class="card-price"><strong>Цена: 15 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Подключение Bootstrap JS и Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
