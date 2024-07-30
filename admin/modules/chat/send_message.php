<?php
session_start();
include '../../config/koneksi.php'; 

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    exit('Unauthorized');
}

$id_admin = $_SESSION['id_user'];
$id_pemohon = isset($_POST['id_pemohon']) ? (int)$_POST['id_pemohon'] : 0;
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validasi input
if ($id_pemohon <= 0 || empty($message)) {
    exit('Invalid input');
}

$query = "INSERT INTO chat (id_admin, id_user, chat) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("iis", $id_admin, $id_pemohon, $message);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Message sent']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error sending message']);
}

$stmt->close();
$mysqli->close();
?>
