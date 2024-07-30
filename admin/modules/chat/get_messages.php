<?php
session_start();
include '../../config/koneksi.php';

// Periksa apakah pengguna adalah admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    exit(json_encode(['error' => 'Unauthorized']));
}

$id_admin = $_SESSION['id_user'];
$id_pemohon = isset($_GET['id_pemohon']) ? (int)$_GET['id_pemohon'] : 0;

// Validasi input
if ($id_pemohon <= 0) {
    exit(json_encode(['error' => 'Invalid input']));
}

// Query untuk mengambil pesan dari tabel chat
$query = "SELECT c.id_chat, c.id_admin, c.id_user, c.chat, c.created_at
          FROM chat c
          WHERE (c.id_admin = ? OR c.id_admin IS NULL) AND c.id_user = ?
          ORDER BY c.created_at ASC";

$stmt = $mysqli->prepare($query);
if (!$stmt) {
    exit(json_encode(['error' => 'Error in preparing statement: ' . $mysqli->error]));
}

$stmt->bind_param("ii", $id_admin, $id_pemohon);
if (!$stmt->execute()) {
    exit(json_encode(['error' => 'Error executing statement: ' . $stmt->error]));
}

$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'id_chat' => $row['id_chat'],
        'id_admin' => $row['id_admin'],
        'id_user' => $row['id_user'],
        'chat' => $row['chat'],
        'created_at' => $row['created_at']
    ];
}

$stmt->close();
$mysqli->close();

// Mengembalikan hasil dalam format JSON
echo json_encode(['success' => true, 'messages' => $messages]);
?>
