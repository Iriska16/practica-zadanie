<?php 
require_once 'db.php';
checkAuth();
include 'header.php'; 
?>
<h1>Личный кабинет</h1>
<p><strong>Ваш логин:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
<p><strong>Ваш ID:</strong> <?php echo $_SESSION['user_id']; ?></p>
<p>Добро пожаловать в систему! Используйте меню сверху для навигации.</p>
<?php include 'footer.php'; ?>