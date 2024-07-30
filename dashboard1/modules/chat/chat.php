<?php
session_start();
include 'config/koneksi.php';

// Periksa apakah user sudah login sebagai pengguna
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'pemohon') {
    header("Location: index.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Proses pengiriman pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pesan'])) {
    $pesan = $_POST['pesan'];

    $query = "INSERT INTO chat (id_user, chat, id_admin) VALUES (?, ?, NULL)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "is", $id_user, $pesan);

    if (!mysqli_stmt_execute($stmt)) {
        die("Error: " . mysqli_stmt_error($stmt));
    }

    // Redirect untuk menghindari pengiriman ulang saat refresh
    header("Location:?module=chatpengguna");
    exit();
}

// Ambil pesan chat
$query_chat = "SELECT * FROM chat WHERE id_user = ? ORDER BY id_chat ASC";
$stmt_chat = mysqli_prepare($mysqli, $query_chat);
mysqli_stmt_bind_param($stmt_chat, "i", $id_user);
mysqli_stmt_execute($stmt_chat);
$result_chat = mysqli_stmt_get_result($stmt_chat);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .chat-window {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .chat-header {
            background-color: #ff8c00;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
        }
        .chat-body {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
        }
        .message {
            margin-bottom: 15px;
            max-width: 80%;
        }
        .admin-message {
            background-color: #e1ffc7;
            padding: 10px;
            border-radius: 10px;
        }
        .user-message {
            margin-left: auto;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 10px;
        }
        .chat-footer {
            padding: 20px;
            border-top: 1px solid #eee;
        }
        .chat-input {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .chat-send {
            width: 100%;
            padding: 10px;
            background-color: #ff8c00;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .chat-send:hover {
            background-color: #e67e00;
        }
    </style>
</head>
<body>
    <div class="chat-window">
        <div class="chat-header">
            Chat dengan Admin
        </div>
        <div class="chat-body">
            <?php while ($chat = mysqli_fetch_assoc($result_chat)) : ?>
                <div class="message <?php echo $chat['id_admin'] ? 'admin-message' : 'user-message'; ?>">
                    <?php echo htmlspecialchars($chat['chat']); ?>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="chat-footer">
            <form method="POST">
                <textarea name="pesan" class="chat-input" required placeholder="Ketik pesan Anda..."></textarea>
                <button type="submit" class="chat-send">Kirim</button>
            </form>
        </div>
    </div>
</body>
</html>