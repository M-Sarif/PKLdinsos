<?php
$menu_items = [
    'dashboard' => ['text' => 'Dashboard'],
    'pengajuan' => ['text' => 'Pengajuan'],
    'chat' => ['text' => 'Chat'],
    'profil' => ['text' => 'Profil'],
    'tentang' => ['text' => 'Tentang Aplikasi'],
    'logout' => ['text' => 'Logout', 'url' => '../logout.php']
];

foreach ($menu_items as $module => $item) {
    $active = ($_GET['module'] == $module) ? 'active' : '';
    $url = isset($item['url']) ? $item['url'] : "?module=$module";
    echo "<li class='nav-item'>";
    echo "<a class='nav-link $active' href='$url'>";
    echo "{$item['text']}";
    echo "</a>";
    echo "</li>";
}
?>
