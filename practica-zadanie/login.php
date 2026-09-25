<?php require_once 'db.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: profile.php");
            exit;
        } else {
            $msg = "<p class='error'>Неверный пароль.</p>";
        }
    } else {
        $msg = "<p class='error'>Пользователь не найден.</p>";
    }
}
include 'header.php';
?>
<h1>Вход</h1>
<?php echo $msg; ?>
<form method="POST">
    <label>Логин:</label>
    <input type="text" name="username" required>
    <label>Пароль:</label>
    <input type="password" name="password" required>
    <button type="submit">Войти</button>
</form>
<?php include 'footer.php'; ?>