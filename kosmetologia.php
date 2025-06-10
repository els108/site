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
  <h2 class="text-center">Косметологические процедуры и цены</h2>
  <div class="mb-3">
    <label for="sortSelect" class="form-label">Выберите вид услуги:</label>
    <select id="sortSelect" class="form-select">
      <option value="all">Все услуги</option>
      <option value="peeling">Пилинг</option>
      <option value="injection">Инъекционная косметология</option>
      <option value="cleaning">Чистки лица</option>
    </select>
  </div>
  <div class="row mb-5" id="serviceCards">
    <!-- Класс col-md-6 для двух карточек в строке -->
    <div class="col-md-6">
      <div class="card mb-4" data-category="consultation">
        <img src="foto/Косметология/косультация косметолога.png" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Консультация косметолога</h5>
          <p class="card-text">На консультации, которая займет всего 30 минут, мой косметолог с любовью оценит тип и состояние твоей кожи, подберет процедуры, идеально подходящие для твоих нужд, и поможет выбрать средства для домашнего ухода.</p>
          <p class="card-price"><strong>Цена: 5 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="peeling">
        <img src="foto/Косметология/пилинг лица поверхностный.jpeg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Пилинг поверхностный</h5>
          <p class="card-text">Лёгкое обновление для твоей кожи. Этот пилинг мягко удаляет ороговевшие клетки, очищает поры и улучшает текстуру, делая её гладкой и сияющей.</p>
          <p class="card-price"><strong>Цена: 5 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="peeling">
        <img src="foto/Косметология/Пилинг ДНК (DNA Recovery peel Mediderma).webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Пилинг ДНК (DNA Recovery peel Mediderma)</h5>
          <p class="card-text">Уникальная формула пилинг ДНК (DNA Recovery peel Mediderma) поможет нам достичь волшебных результатов</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="peeling">
        <img src="foto/Косметология/Пилинг миндальный.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Пилинг миндальный</h5>
          <p class="card-text">Нежный и деликатный уход, созданный для самой чувствительной кожи. Он мягко обновляет, выравнивает тон и уменьшает воспаления, возвращая коже сияние.</p>
          <p class="card-price"><strong>Цена: 5 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="peeling">
        <img src="foto/Косметология/Пилинг ретиноловый желтый.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Пилинг ретиноловый "желтый"</h5>
          <p class="card-text">Попробуйте Ретиноевый желтый пилинг VISELLE Retinol Detox Peel 5% и насладитесь красотой и здоровьем вашей кожи уже сегодня.</p>
          <p class="card-price"><strong>Цена: 10 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="injection">
        <img src="foto/Косметология/Мезотерапия для волос.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Мезотерапия для волос</h5>
          <p class="card-text">Мезотерапия кожи головы способствует улучшению кровообращения и снабжения луковиц волос питательными веществами.</p>
          <p class="card-price"><strong>Цена: 12 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="injection">
        <img src="foto/Косметология/Плазмолифтинг лица.jpeg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Плазмолифтинг лица</h5>
          <p class="card-text">Эффект от плазмолифтинга лица, который направлен на избавление от акне, заключается не только в удалении самих угрей, но и последствий от них.</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="injection">
        <img src="foto/Косметология/Увеличение губ.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Увеличение губ</h5>
          <p class="card-text">Процедура увеличения губ (контурная пластика) основана на инъекционном введении филлеров с гиалуроновой кислотой. Они корректируют форму, создают желаемый объём, ликвидируют возрастные или природные деформации.</p>
          <p class="card-price"><strong>Цена: 15 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="injection">
        <img src="foto/Косметология/Коррекция морщин лба.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Коррекция морщин лба</h5>
          <p class="card-text">Коррекция морщин лба — это современная процедура, направленная на разглаживание глубоких и мелких складок кожи, возвращающая лицу молодость и свежесть. С помощью инъекций ботокса или других препаратов мы поможем вам добиться естественного и ухоженного внешнего вида, подчеркнув вашу индивидуальность</p>
          <p class="card-price"><strong>Цена: 9 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="injection">
        <img src="foto/Косметология/Контурная коррекция шеи.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Контурная коррекция шеи и подбородка</h5>
          <p class="card-text">Контурная пластика шеи и подбородка — прекрасная процедура, которая позволит увлажнить и подтянуть кожу на шее, вернув ей молодой вид и синее.</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="cleaning">
        <img src="foto/Косметология/Механическая чистка лица.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Механическая чистка лица</h5>
          <p class="card-text">Удаление комедонов и угрей вручную или с помощью медицинских инструментов. Подходит для проблемной кожи.</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="cleaning">
        <img src="foto/Косметология/Ультразвуковая чистка лица.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Аппаратная чистка лица</h5>
          <p class="card-text">Специалист очищает кожу при помощи специальных устройств.</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="cleaning">
        <img src="foto/Косметология/Аппаратная чистка лица.webp" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Ультразвуковая чистка лица</h5>
          <p class="card-text">Ультразвук, действуя через гель или другую контактную среду, разрывает связи между ороговевшими чешуйками и ускоряет их отшелушивание.</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4" data-category="cleaning">
        <img src="foto/Косметология/Комбинированная чистка лица.jpg" height="275" width="628"/>
        <div class="card-body">
          <h5 class="card-title">Комбинированная чистка лица</h5>
          <p class="card-text">Комбинированная чистка лица — это косметологическая методика, которая сочетает в себе ультразвуковое и механическое воздействие на кожу.</p>
          <p class="card-price"><strong>Цена: 7 000 руб.</strong></p>
          <a href="zapis.html" class="btn btn-primary">Записаться</a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Подключение Bootstrap JS и Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('sortSelect').addEventListener('change', function() {
    const selectedCategory = this.value;
    const cards = document.querySelectorAll('#serviceCards .card');

    cards.forEach(card => {
      if (selectedCategory === 'all') {
        card.parentElement.style.display = 'block';
      } else {
        card.parentElement.style.display = card.getAttribute('data-category') === selectedCategory ? 'block' : 'none';
      }
    });
  });
</script>
</body>
</html>
