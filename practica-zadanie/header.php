<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студенческий Мессенджер</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <h2>Мессенджер</h2>
        <?php if (isset($_SESSION['user_id'])): ?>
            <nav>
                <a href="profile.php">Личный кабинет</a>
                <a href="messages.php">Сообщения</a>
                <a href="stats.php">Статистика</a>
                <a href="logout.php" class="logout-link">Выход (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
            </nav>
        <?php else: ?>
            <nav>
                <a href="login.php">Вход</a>
                <a href="register.php">Регистрация</a>
            </nav>
        <?php endif; ?>
    </header>
    <main class="container">