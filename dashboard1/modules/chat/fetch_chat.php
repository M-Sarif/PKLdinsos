<?php
session_start();
require_once 'config/koneksi.php';

$id_user = $_SESSION['id_user'];

$query_chat = "SELECT * FROM chat WHERE id_user = ? ORDER BY timestamp ASC";
$stmt_chat = $mysqli->prepare($query_chat);
$stmt_chat->bind_param("i", $id_user);
$stmt_chat->execute();
$result_chat = $stmt_chat->get_result();

while ($chat = $result_chat->fetch_assoc()) {
    echo '<div class="message ' . ($chat['id_admin'] ? 'admin-message' : 'user-message') . '">';
    echo htmlspecialchars($chat['chat']);
    echo '</div>';
}
?>
