<?php
// Подключение к БД
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "itsmyproject");

// Получаем все сообщения из таблицы
$query = "SELECT * FROM messege ORDER BY id DESC";
$result = mysqli_query($link, $query);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обратная связь</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="background-image2"></div>
<header class="header">
    <h1>О витаминах</h1>
</header>

<nav class="navbar">
    <ul>
        <li><a href="index.html">Главная</a></li>
        <li><a href="vitamins.html">Про витамины</a></li>
        <li><a href="feedback.php">Обратная связь</a></li>
        <li><a href="contacts.html">Контакты</a></li>
    </ul>
</nav>

<main class="content">
    <h2>Обратная связь</h2>

    <!-- Форма -->
    <form action="send_feedback.php" method="post">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Сообщение:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <button type="submit">Отправить</button>
    </form>

    <!-- Отображение сообщений -->
    <h3>Последние сообщения:</h3>
    <?php if(mysqli_num_rows($result) > 0): ?>
        <ul class="feedback-list">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <li class="feedback-item">
                    <strong><?= htmlspecialchars($row['name']) ?></strong> (<?= htmlspecialchars($row['email']) ?>)<br>
                    <em><?= nl2br(htmlspecialchars($row['message1'])) ?></em>
                    <hr>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Пока нет сообщений.</p>
    <?php endif; ?>
</main>

<footer class="footer">
    <p>&copy; 2025 О витаминах</p>
</footer>
</body>
</html>