<?php
// session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    echo "Anda tidak memiliki akses ke halaman ini.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .chat-container {
            height: 600px;
            display: flex;
        }
        .chat-list {
            width: 30%;
            overflow-y: auto;
            border-right: 1px solid #ccc;
        }
        .chat-messages {
            width: 70%;
            display: flex;
            flex-direction: column;
        }
        .messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
        }
        .message-input {
            padding: 10px;
            border-top: 1px solid #ccc;
        }
        .chat-item {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .chat-item:hover {
            background-color: #f8f9fa;
        }
        .message {
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .user-message {
            background-color: #B4E380;
            align-self: flex-start;
            width: 70%;
        }
        .admin-message {
            background-color: #FFC96F;
            margin-left: 30%;
            width: 70%;
        }
        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
        }
        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Admin Chat</h2>
    <div class="chat-container">
        <div class="chat-list" id="chatList">
            <!-- Daftar chat akan dimuat di sini -->
        </div>
        <div class="chat-messages">
            <div class="messages" id="messages">
                <!-- Pesan-pesan akan dimuat di sini -->
            </div>
            <div class="message-input">
                <input type="text" id="messageInput" class="form-control" placeholder="Ketik pesan...">
                <button onclick="sendMessage()" class="btn btn-primary mt-2">Kirim</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
let currentUserId = null;

function updateUnreadBadge(userId, count) {
    const chatItem = $(`.chat-item[data-user-id="${userId}"]`);
    const badgeContainer = chatItem.find('.unread-badge');
    if (count > 0) {
        badgeContainer.html(`<span class='badge badge-danger'>${count}</span>`);
    } else {
        badgeContainer.empty();
    }
}

function loadMessages(userId) {
    currentUserId = userId;
    $.get('modules/chat/get_messages.php', { id_pemohon: userId }, function(response) {
        const data = JSON.parse(response);
        if (data.success) {
            const messages = data.messages.map(msg => {
                const messageClass = msg.id_admin ? 'admin-message' : 'user-message';
                return `<div class="message ${messageClass}">
                            <p>${msg.chat}</p>
                            <small>${msg.created_at}</small>
                        </div>`;
            }).join('');
            $('#messages').html(messages);
            $('#messages').scrollTop($('#messages')[0].scrollHeight);
            
            // Menandai pesan sebagai telah dibaca
            $.post('modules/chat/mark_as_read.php', { id_user: userId }, function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    updateUnreadBadge(userId, 0);
                }
            });
            
        } else {
            alert(data.error);
        }
    });
}

function loadChatList() {
    $.get('modules/chat/get_chat_list.php', function(data) {
        $('#chatList').html(data);
    });
}

// Interval untuk memperbarui daftar chat dan badge
setInterval(function() {
    loadChatList();
    if (currentUserId) {
        $.get('modules/chat/get_unread_count.php', { id_user: currentUserId }, function(response) {
            const result = JSON.parse(response);
            updateUnreadBadge(currentUserId, result.unread_count);
        });
    }
}, 2000);

function sendMessage() {
    if (!currentUserId) {
        alert("Pilih pengguna terlebih dahulu!");
        return;
    }
    
    let message = $('#messageInput').val();
    if (message.trim() === '') {
        return;
    }
    
    $.post('modules/chat/send_message.php', {
        id_pemohon: currentUserId,
        message: message
    }, function(response) {
        $('#messageInput').val('');
        loadMessages(currentUserId);
    });
}

$(document).ready(function() {
    loadChatList();
    
    $('#messageInput').keypress(function(e) {
        if(e.which == 13) {
            sendMessage();
        }
    });
});
</script>
</body>
</html>