<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    exit('Unauthorized');
}

$query = "SELECT c.id_user, p.nama,
          (SELECT chat FROM chat WHERE id_user = c.id_user ORDER BY created_at DESC LIMIT 1) as last_chat,
          (SELECT created_at FROM chat WHERE id_user = c.id_user ORDER BY created_at DESC LIMIT 1) as last_chat_time,
          (SELECT COUNT(*) FROM chat WHERE id_user = c.id_user) as total_messages,
          (SELECT COUNT(*) FROM chat WHERE id_user = c.id_user AND is_read = 0 AND (id_admin IS NULL OR id_admin != ?)) as unread_count
          FROM (SELECT DISTINCT id_user FROM chat) c 
          JOIN pemohon p ON c.id_user = p.id_user 
          ORDER BY last_chat_time DESC";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unreadBadge = $row['unread_count'] > 0 ? "<span class='badge badge-danger'>{$row['unread_count']}</span>" : "";
        echo "<div class='chat-item' data-user-id='{$row['id_user']}' onclick='loadMessages({$row['id_user']})'>";
        echo "<h5>" . htmlspecialchars($row['nama']) . " <span class='unread-badge'>{$unreadBadge}</span></h5>";
        echo "<p>" . htmlspecialchars(substr($row['last_chat'], 0, 30)) . "...</p>";
        echo "<small>" . $row['last_chat_time'] . "</small>";
        echo "</div>";
    }
} else {
    echo "<p>Tidak ada chat</p>";
}

$stmt->close();
$mysqli->close();
?>