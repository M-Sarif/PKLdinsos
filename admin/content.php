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
//menampilkan data pada pencaharian
elseif ($_GET['module'] == 'tampil_data') {
    // panggil file tampil data pengajuan
    include "modules/pengajuan/tampil_data.php";
}
// jika module yang dipilih "form_entri_siswa"
elseif ($_GET['module'] == 'form_entri_pengajuan') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/form_entri.php";
}
elseif ($_GET['module'] == 'terverifikasi') {
    // panggil file form entri pengajuan
    include "modules/laporan/form_filter.php";
}
elseif ($_GET['module'] == 'cetak') {
    // panggil file form entri pengajuan
    include "modules/laporan/cetak.php";
}
elseif ($_GET['module'] == 'dataverifikasi') {
    // panggil file form entri pengajuan
    include "modules/laporan/anggota_verifikasi.php";
}


elseif($_GET['module'] == 'chat'){
    include "modules/chat/admin_chat.php";
}
elseif($_GET['module'] == 'chatlist'){
    include "modules/chat/get_chat_list.php";
}
elseif($_GET['module'] == 'chatget'){
    include "modules/chat/get_messages.php";
}
elseif($_GET['module'] == 'chatsend'){
    include "modules/chat/send_message.php";
}
elseif($_GET['module'] == 'chatmark'){
    include "modules/chat/mark_as_read.php";
}


elseif ($_GET['module'] == 'biodata_anggota') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/anggota/detail_anggota.php";
}




elseif ($_GET['module'] == 'form_entri_detailpengajuan') {
    // panggil file form entri pengajuan
    include "modules/pengajuan/anggota/form_entri.php";
}
// jika module yang dipilih "form_ubah_siswa"
elseif ($_GET['module'] == 'form_ubah_pengajuan') {
    // panggil file form ubah pengajuan
    include "modules/pengajuan/form_ubah.php";
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
elseif ($_GET['module'] == 'tampil_pencarian') {
    // panggil file tampil pencarian pengajuan
    include "modules/pengajuan/tampil_pencarian.php";
}

// jika module yang dipilih "tampil_pencarian_kelas"
elseif ($_GET['module'] == 'tampil_pencarian_kelas') {
    // panggil file tampil pencarian kelas
    include "modules/kelas/tampil_pencarian.php";
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
