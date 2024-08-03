<?php
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";
// panggil file "fungsi_tanggal_indo.php" untuk membuat format tanggal indonesia
require_once "helper/fungsi_tanggal_indo.php";

// pemanggilan file halaman konten sesuai "module" yang dipilih
// jika module yang dipilih "dashboard"
if ($_GET['module'] == 'dashboard') {
    // panggil file tampil data dashboard
    include "modules/dashboard/tampil_data.php";
}
// jika module yang dipilih "pengajuan"
elseif ($_GET['module'] == 'pengajuan') {
    // panggil file tampil data pengajuan
    include "modules/pengajuan/tampil_data.php";
}
// jika module yang dipilih "form_entri_siswa"
elseif ($_GET['module'] == 'form_entri_pengajuan') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/form_entri.php";
}

elseif ($_GET['module'] == 'biodata_anggota') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/anggota/detail_anggota.php";
}
elseif($_GET['module'] == 'chat'){
    include "modules/chat/chat.php";

}
elseif($_GET['module'] == 'chatpengguna'){
    include "modules/chat/chat_pengguna.php";

}
elseif($_GET['module'] == 'chatpengguna1'){
    include "chat_pengguna.php";

}

elseif ($_GET['module'] == 'entri_detailpengajuan') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/detail_page.php";
}

elseif ($_GET['module'] == 'hapus_anggota') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/hapus_anggota.php";
}

elseif ($_GET['module'] == 'tambah_anggota') {
   
    include "modules/pengajuan/anggota/tambah.php";
}

elseif ($_GET['module'] == 'form_entri_detailpengajuan') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/anggota/form_entri.php";
}

elseif ($_GET['module'] == 'form_ubah_pengajuan') {
    // panggil file form ubah pengajuan
    include "modules/pengajuan/form_ubah.php";
}

elseif ($_GET['module'] == 'form_ubah_anggota') {
    // panggil file form ubah pengajuan
    include "modules/pengajuan/anggota/form_ubah_anggota.php";
}
// jika module yang dipilih "tampil_detail_siswa"
elseif ($_GET['module'] == 'tampil_detail_pengajuan') {
    // panggil file tampil detail pengajuan
    include "modules/pengajuan/tampil_detail.php";
}
//panggil file detail pengajuan
elseif ($_GET['module'] == 'tampil_detail_anggota') {
    // panggil file tampil detail pengajuan
    include "modules/pengajuan/anggota/detail_anggota.php";
}
// jika module yang dipilih "tampil_pencarian_siswa"
elseif ($_GET['module'] == 'tampil_pencarian_siswa') {
    // panggil file tampil pencarian pengajuan
    include "modules/pengajuan/tampil_pencarian.php";
}

// jika module yang dipilih "tampil_pencarian_kelas"
elseif ($_GET['module'] == 'terverfikasi') {
    // panggil file tampil pencarian kelas
    include "modules/modules/laporan/form_filter.php";
}

elseif ($_GET['module'] == 'profil') {
    // panggil file tampil pencarian kelas
    include "modules/profil/tampil_detail.php";
}
// jika module yang dipilih "laporan"
elseif ($_GET['module'] == 'laporan') {
    // panggil file form filter laporan
    include "modules/laporan/form_filter.php";
}
// jika module yang dipilih "tentang"
elseif ($_GET['module'] == 'tentang') {
    // panggil file tampil data tentang
    include "modules/tentang/tampil_data.php";
}
