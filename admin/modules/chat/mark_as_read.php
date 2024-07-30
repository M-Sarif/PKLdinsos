<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    exit('Unauthorized');
}

$id_admin = $_SESSION['id_user'];
$id_user = isset($_POST['id_user']) ? (int)$_POST['id_user'] : 0;

if ($id_user <= 0) {
    exit('Invalid input');
}

$query = "UPDATE chat SET is_read = 1 WHERE id_user = ? AND (id_admin IS NULL OR id_admin != ?) AND is_read = 0";
$stmt = $mysqli->prepare($query);
if (!$stmt) {
    exit('Error in preparing statement: ' . $mysqli->error);
}

$stmt->bind_param("ii", $id_user, $id_admin);
if (!$stmt->execute()) {
    exit('Error executing statement: ' . $stmt->error);
}

$affected_rows = $stmt->affected_rows;

$stmt->close();
$mysqli->close();

echo json_encode(['success' => true, 'affected_rows' => $affected_rows]);
?>