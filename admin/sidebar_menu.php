<?php
$menu_items = [
    'dashboard' => ['text' => 'Dashboard', 'icon' => 'fa-solid fa-chart-simple'],
    'pengajuan' => ['text' => 'Pengajuan', 'icon' => 'fa-regular fa-file-lines'],
    'terverifikasi' => ['text' => 'Terverifikasi', 'icon' => 'fa-solid fa-check-circle'],
    'chat' => ['text' => 'Chat', 'icon' => 'fa-solid fa-comment'],
    'profil' => ['text' => 'Profil', 'icon' => 'fa-solid fa-user'],
    'tentang' => ['text' => 'Tentang Aplikasi', 'icon' => 'fa-solid fa-info'],
    'logout' => ['text' => 'Logout', 'icon' => 'fa-solid fa-sign-out-alt', 'url' => '../logout.php']
];

foreach ($menu_items as $module => $item) {
    $active = (isset($_GET['module']) && $_GET['module'] == $module) ? 'active' : '';
    $url = isset($item['url']) ? $item['url'] : "?module=$module";
    
    echo "<li class='nav-item'>";
    if ($module == 'logout') {
        echo "<form action='{$item['url']}' method='post'>";
        echo "<button type='submit' class='btn nav-link $active'>";
        echo "<i class='{$item['icon']}'></i> {$item['text']}";
        echo "</button>";
        echo "</form>";
    } else {
        echo "<a class='nav-link $active' href='$url'>";
        echo "<i class='{$item['icon']}'></i> {$item['text']}";
        echo "</a>";
    }
    echo "</li>";
}
?>
