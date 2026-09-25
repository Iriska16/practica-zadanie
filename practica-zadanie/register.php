<?php require_once 'db.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash);
        if ($stmt->execute()) {
            $msg = "<p class='success'>Регистрация успешна! <a href='login.php'>Войти</a></p>";
        } else {
            $msg = "<p class='error'>Ошибка: имя занято или данные некорректны.</p>";
        }
    } else {
        $msg = "<p class='error'>Заполните все поля!</p>";
    }
}
include 'header.php';
?>
<h1>Регистрация</h1>
<?php echo $msg; ?>
<form method="POST">
    <label>Логин:</label>
    <input type="text" name="username" required>
    <label>Пароль:</label>
    <input type="password" name="password" required>
    <button type="submit">Зарегистрироваться</button>
</form>
<?php include 'footer.php'; ?>