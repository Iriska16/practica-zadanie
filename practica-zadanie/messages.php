<?php 
require_once 'db.php';
checkAuth();
$user_id = (int)$_SESSION['user_id'];
$msg_status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_msg'])) {
    $receiver_id = (int)$_POST['receiver_id'];
    $text = trim($_POST['message_text']);
    
    if ($receiver_id > 0 && !empty($text) && $receiver_id != $user_id) {
        $stmt = $mysqli->prepare("INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $receiver_id, $text);
        if ($stmt->execute()) {
            $msg_status = "<p class='success'>Сообщение отправлено!</p>";
        }
    } else {
        $msg_status = "<p class='error'>Выберите получателя и введите текст!</p>";
    }
}

$users_list = $mysqli->query("SELECT id, username FROM users WHERE id != $user_id");

$received_msgs = $mysqli->query("
    SELECT u.username, m.message_text, m.created_at 
    FROM messages m 
    JOIN users u ON m.sender_id = u.id 
    WHERE m.receiver_id = $user_id 
    ORDER BY m.created_at DESC
");

include 'header.php'; 
?>

<h1>Сообщения</h1>
<?php echo $msg_status; ?>

<h3>Отправить сообщение</h3>
<form method="POST">
    <label>Кому:</label>
    <select name="receiver_id" required>
        <option value="">-- Выберите пользователя --</option>
        <?php while($u = $users_list->fetch_assoc()): ?>
            <option value="<?php echo $u['id']; ?>"><?php echo htmlspecialchars($u['username']); ?></option>
        <?php endwhile; ?>
    </select>
    
    <label>Текст сообщения:</label>
    <textarea name="message_text" rows="4" required></textarea>
    <button type="submit" name="send_msg">Отправить</button>
</form>

<hr style="margin: 30px 0;">

<h3>Входящие сообщения</h3>
<?php if ($received_msgs->num_rows > 0): ?>
    <?php while($m = $received_msgs->fetch_assoc()): ?>
        <div class="message-box">
            <span class="date"><?php echo $m['created_at']; ?></span>
            <span class="sender">От: <?php echo htmlspecialchars($m['username']); ?></span>
            <p><?php echo nl2br(htmlspecialchars($m['message_text'])); ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>Входящих сообщений пока нет.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>