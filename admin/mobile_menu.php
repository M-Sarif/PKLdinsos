<?php
// pengecekan menu aktif
// jika menu dashboard dipilih, menu dashboard aktif
if ($_GET['module'] == 'dashboard') { ?>
    <div class="col-2 item-menu active text-center">
        <a href="?module=dashboard">
            <i class="fa-solid fa-chart-simple"></i>
        </a>
    </div>
<?php
}
// jika tidak dipilih, menu dashboard tidak aktif
else { ?>
    <div class="col-2 item-menu text-center">
        <a href="?module=dashboard">
            <i class="fa-solid fa-chart-simple"></i>
        </a>
    </div>
<?php
}

// jika menu pengajuan (tampil data / tampil detail / form entri / form ubah / tampil pencarian) dipilih, menu pengajuan aktif
if ($_GET['module'] == 'pengajuan' || $_GET['module'] == 'tampil_detail_siswa' || $_GET['module'] == 'form_entri_siswa' || $_GET['module'] == 'form_ubah_siswa' || $_GET['module'] == 'tampil_pencarian_siswa') { ?>
    <div class="col-2 item-menu active text-center">
        <a href="?module=pengajuan">
            <i class="fa-regular fa-file-lines"></i>
        </a>
    </div>
<?php
}
// jika tidak dipilih, menu pengajuan tidak aktif
else { ?>
    <div class="col-2 item-menu text-center">
        <a href="?module=pengajuan">
            <i class="fa-regular fa-file-lines"></i>
        </a>
    </div>
<?php
}



if ($_GET['module'] == 'chat') { ?>
    <div class="col-2 item-menu active text-center">
        <a href="?module=chat">
            <i class="fa-solid fa-user"></i>
        </a>
    </div>
<?php
}
// jika tidak dipilih, menu kelas tidak aktif
else { ?>
    <div class="col-2 item-menu text-center">
        <a href="?module=chat">
            <i class="fa-solid fa-user"></i>
        </a>
    </div>
<?php
}

// jika menu kelas (tampil data / tampil detail / form entri / form ubah / tampil pencarian) dipilih, menu kelas aktif
if ($_GET['module'] == 'profil') { ?>
    <div class="col-2 item-menu active text-center">
        <a href="?module=profil">
            <i class="fa-solid fa-user"></i>
        </a>
    </div>
<?php
}
// jika tidak dipilih, menu kelas tidak aktif
else { ?>
    <div class="col-2 item-menu text-center">
        <a href="?module=profil">
            <i class="fa-solid fa-user"></i>
        </a>
    </div>
<?php
}



// jika menu tentang aplikasi dipilih, menu tentang aplikasi aktif
if ($_GET['module'] == 'tentang') { ?>
    <div class="col-2 item-menu active text-center">
        <a href="?module=tentang">
            <i class="fa-solid fa-info"></i>
        </a>
    </div>
<?php
}
// jika tidak dipilih, menu tentang aplikasi tidak aktif
else { ?>
    <div class="col-2 item-menu text-center">
        <a href="?module=tentang">
            <i class="fa-solid fa-info"></i>
        </a>
    </div>
<?php
}
?>