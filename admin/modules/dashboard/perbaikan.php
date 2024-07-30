

    <!-- menampilkan informasi jumlah siswa pelajar -->
    <div class="col-lg-6 col-xl-4">
        <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
            <div class="d-flex align-items-center justify-content-start">
                <div class="me-4">
                    <i class="fa-solid fa-laptop-code icon-widget"></i>
                </div>
                <div>
                    <p class="text-muted mb-1"><small>Terverifikasi</small></p>
                    <?php
                    // sql statement untuk menampilkan jumlah data pada tabel "tbl_siswa" berdasarkan "kelas"
                    $query = mysqli_query($mysqli, "SELECT COUNT(a.id_siswa) as jumlah FROM tbl_siswa as a INNER JOIN tbl_kelas as b ON a.kelas=b.id_kelas 
                                                    WHERE b.nama_kelas='Web Development'")
                                                    or die('Ada kesalahan pada query jumlah data siswa gratis : ' . mysqli_error($mysqli));
                    // ambil data hasil query
                    $data = mysqli_fetch_assoc($query);
                    // buat variabel untuk menampilkan data
                    $jumlah_siswa = $data['jumlah'];
                    ?>
                    <!-- tampilkan data -->
                    <h5 class="fw-bold mb-0"><?php echo number_format($jumlah_siswa, 0, '', '.'); ?></h5>
                </div>
            </div>
        </div>
    </div>
    <!-- menampilkan informasi jumlah siswa personal -->
    <div class="col-lg-6 col-xl-4">
        <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
            <div class="d-flex align-items-center justify-content-start">
                <div class="text-muted me-4">
                    <i class="fa-solid fa-mobile-screen icon-widget"></i>
                </div>
                <div>
                    <p class="mb-1"><small>Ditolak</small></p>
                    <?php
                    // sql statement untuk menampilkan jumlah data pada tabel "tbl_siswa" berdasarkan "kelas"
                    $query = mysqli_query($mysqli, "SELECT COUNT(a.id_siswa) as jumlah FROM tbl_siswa as a INNER JOIN tbl_kelas as b ON a.kelas=b.id_kelas 
                                                    WHERE b.nama_kelas='Mobile Development'")
                                                    or die('Ada kesalahan pada query jumlah data siswa gratis : ' . mysqli_error($mysqli));
                    // ambil data hasil query
                    $data = mysqli_fetch_assoc($query);
                    // buat variabel untuk menampilkan data
                    $jumlah_siswa = $data['jumlah'];
                    ?>
                    <!-- tampilkan data -->
                    <h5 class="fw-bold mb-0"><?php echo number_format($jumlah_siswa, 0, '', '.'); ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>