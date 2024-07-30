<?php
session_start();
require_once 'config/koneksi.php';

// Check if user is logged in as a regular user
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'pemohon') {
    header("Location: index.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Process message sending
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesan'])) {
    $pesan = trim($_POST['pesan']);
    
    if (!empty($pesan)) {
        $query = "INSERT INTO chat (id_user, chat, id_admin, created_at) VALUES (?, ?, NULL, NOW())";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("is", $id_user, $pesan);
        
        if (!$stmt->execute()) {
            die("Error: " . $stmt->error);
        }
        
        // Redirect to prevent form resubmission
        header("Location: ?module=chatpengguna");
        exit();
    }
}

// Fetch chat messages
$query_chat = "SELECT * FROM chat WHERE id_user = ? ORDER BY created_at ASC";
$stmt_chat = $mysqli->prepare($query_chat);
$stmt_chat->bind_param("i", $id_user);
$stmt_chat->execute();
$result_chat = $stmt_chat->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            align-self: flex-start;
        }
        .user-message {
            margin-left: auto;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 10px;
            align-self: flex-end;
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
            resize: vertical;
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
        .message-time {
            font-size: 0.8em;
            color: #888;
            margin-top: 5px;
        }
        .message-sender {
            font-weight: bold;
            margin-bottom: 5px;
        }
        #backButton {
            background: none;
            border: none;
            color: white;
            font-size: 1.2em;
            cursor: pointer;
        }
    </style>
</head>
<body >
<div class="chat-window">
        <div class="chat-header">
            Chat dengan Admin
        </div>
        <div class="chat-body" id="chat-body">
            <?php while ($chat = $result_chat->fetch_assoc()) : ?>
                <div class="message <?php echo $chat['id_admin'] ? 'admin-message' : 'user-message'; ?>">
                    <?php echo htmlspecialchars($chat['chat']); ?>
                      </div>
            <?php endwhile; ?>
        </div>
        <div class="chat-footer">
            <form method="POST" id="chat-form">
                <textarea name="pesan" class="chat-input" required placeholder="Ketik pesan Anda..."></textarea>
                <button type="submit" class="chat-send">Kirim</button>
            </form>
        </div>
    </div>

    <script>
        // Scroll to bottom of chat
        function scrollToBottom() {
            var chatBody = document.getElementById('chat-body');
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        // Call scrollToBottom on page load
        window.onload = scrollToBottom;

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
   
    </script>
</body>
</html>