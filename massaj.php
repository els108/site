<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Массаж - Салон красоты "Тигрица"</title>

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
  <h2 class="text-center">Разновидности массажа и цены</h2>
  <div class="mb-3">
    <label for="sortSelect" class="form-label">Сортировать по:</label>
    <select id="sortSelect" class="form-select">
      <option value="all">Все виды массажа</option>
      <option value="body">Массаж тела</option>
      <option value="face">Массаж лица</option>
      <option value="figure">Коррекция фигуры</option>
    </select>
  </div>
  <div class="row mb-5" id="massageCards">
    <!-- Класс col-md-6 для двух карточек в строке -->
    <div class="col-md-6">
      <div class="card mb-4" data-category="body">
        <img src="foto/массаж фото/массаж лечебный.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Лечебный массаж</h5>
          <p class="card-text">Устраните напряжение и боль с помощью этого восстановительного массажа. Идеален для людей с хроническими заболеваниями и после травм.</p>
          <p class="card-price"><strong>Цена: 5 000 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="body">
        <img src="foto/массаж фото/общий массаж.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Общий массаж тела</h5>
          <p class="card-text">Откройте для себя гармонию и расслабление! Этот массаж снимает стресс, улучшает кровообращение и придает бодрость.</p>
          <p class="card-price"><strong>Цена: 2 500 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="body">
        <img src="foto/массаж фото/спортивный массаж.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Спортивный массаж</h5>
          <p class="card-text">Поддержите свои спортивные достижения с помощью целенаправленного массажа. Он помогает подготовить мышцы к нагрузкам и ускоряет восстановление после тренировок.</p>
          <p class="card-price"><strong>Цена: 3 500 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="body">
        <img src="foto/массаж.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Возрастной массаж</h5>
          <p class="card-text">Акция! Для мужчин и женщин за 60 лет скидка 75% по пенсионному билету</p>
          <p class="card-price"><strong>Цена:700 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="face">
        <img src="foto/массаж фото/массаж лица.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Классический массаж лица</h5>
          <p class="card-text">Испытайте нежные ручные техники, которые освежают и омолаживают кожу. Этот массаж улучшает цвет лица и расслабляет мышцы.</p>
          <p class="card-price"><strong>Цена: 1 500 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="face">
        <img src="foto/массаж фото/Скульптурно-буккальный массаж лица.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Скульптурно-буккальный массаж лица </h5>
          <p class="card-text">Создайте идеальные линии вашего лица с помощью эффективной скульптурной техники. Убирает отечность и придает четкость контурам.</p>
          <p class="card-price"><strong>Цена: 2 000 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="face">
        <img src="foto/массаж фото/Лимфодренажный массаж лица.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Лимфодренажный массаж лица</h5>
          <p class="card-text"> Освободите кожу от отеков и токсинов с помощью этого деликатного массажа. Он улучшает цвет лица и возвращает ему свежесть.</p>
          <p class="card-price"><strong>Цена: 2 000 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="figure">
        <img src="foto/массаж фото/Ручное моделирование фигуры.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Ручное моделирование фигуры</h5>
          <p class="card-text">Корректируйте и улучшайте свою фигуру без усилий с помощью ручных техник. Этот массаж помогает уменьшить объемы и улучшить контуры тела.</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-4" data-category="figure">
        <img src="foto/массаж фото/антицелюлитный массаж.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Антицеллюлитный массаж</h5>
          <p class="card-text">Победите целлюлит с помощью интенсивного массажа, активизирующего обмен веществ. Делает кожу гладкой и упругой, подтягивая проблемные зоны.</p>
          <p class="card-price"><strong>Цена: 5 500 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-4" data-category="figure">
        <img src="foto/массаж фото/лимфодренажный массаж.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Лимфодренажный массаж</h5>
          <p class="card-text">Улучшите обмен веществ и выведите лишнюю жидкость с помощью этого эффективного массажа. Помогает бороться с отеками и улучшает общее самочувствие.</p>
          <p class="card-price"><strong>Цена: 4 000 руб.</strong></p>
          <a href="zapis.php" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Подключение Bootstrap JS и Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Функция для сортировки карточек
  document.getElementById('sortSelect').addEventListener('change', function() {
    const category = this.value;
    const cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
      if (category === 'all' || card.dataset.category === category) {
        card.closest('.col-md-6').style.display = 'block';
      } else {
        card.closest('.col-md-6').style.display = 'none';
      }
    });
  });
</script>
</body>
</html>
