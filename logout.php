<?php
// Начинаем сессию
session_start();

// Очищаем все данные сессии
$_SESSION = array();

// Уничтожаем сессию
session_destroy();

// Очищаем куки сессии
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Перенаправляем на главную страницу
header("Location: index.php");
exit(); 