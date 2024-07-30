<?php
session_start();

if (isset($_GET['index']) && isset($_SESSION['anggota_temp'][$_GET['index']])) {
    unset($_SESSION['anggota_temp'][$_GET['index']]);
    $_SESSION['anggota_temp'] = array_values($_SESSION['anggota_temp']); // Re-index array
}

header("Location: ?module=entri_detailpengajuan");
exit();
?>