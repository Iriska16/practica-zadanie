<?php 
require_once 'db.php';
checkAuth();
$user_id = (int)$_SESSION['user_id'];

$sent_res = $mysqli->query("SELECT COUNT(*) as total FROM messages WHERE sender_id = $user_id");
$sent_count = $sent_res->fetch_assoc()['total'];

$recv_res = $mysqli->query("SELECT COUNT(*) as total FROM messages WHERE receiver_id = $user_id");
$recv_count = $recv_res->fetch_assoc()['total'];

include 'header.php'; 
?>

<h1>Статистика</h1>
<div class="stats-block">
    <p>Всего отправлено сообщений: <strong><?php echo $sent_count; ?></strong></p>
    <p>Всего получено сообщений: <strong><?php echo $recv_count; ?></strong></p>
</div>

<?php include 'footer.php'; ?>