<div class="d-flex flex-column flex-lg-row mb-4">
    <!-- judul halaman -->
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Siswa</h3>
    </div>
    <!-- breadcrumbs -->
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="https://pustakakoding.com/" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?module=siswa" class="text-dark text-decoration-none">Siswa</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Entri</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <!-- judul form -->
    <div class="alert alert-secondary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-pen-to-square me-2"></i> Entri Data Siswa
    </div>
    <!-- form entri data -->
    <form action="modules/pengajuan/input.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-xl-6">
            <div class="row g-0">
                <div class="mb-3 col-xl-6 pe-xl-3">
                    <div>
                        <label class="form-label">Nomor KK <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_kk" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">RT <span class="text-danger">*</span></label>
                        <input type="text" name="rt" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">RW <span class="text-danger">*</span></label>
                        <input type="text" name="rw" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Desa <span class="text-danger">*</span></label>
                        <input type="text" name="desa" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <input type="text" name="kecamatan" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">SKTM <span class="text-danger">*</span></label>
                        <input type="file" name="sktm" class="form-control" accept=".pdf, .jpg, .png" required>
                    </div>
                    <div>
                        <label class="form-label">DTKS <span class="text-danger">*</span></label>
                        <input type="file" name="dtks" class="form-control" accept=".pdf, .jpg, .png" required>
                    </div>
                    <div>
                        <label class="form-label">Kartu Keluarga <span class="text-danger">*</span></label>
                        <input type="file" name="kartu_keluarga" class="form-control" accept=".pdf, .jpg, .png" required>
                    </div>
                    <div>
                        <label class="form-label">KTP <span class="text-danger">*</span></label>
                        <input type="file" name="ktp" class="form-control" accept=".pdf, .jpg, .png" required>
                    </div>
                    <div class="mb-3 ps-xl-3">
                        <div class="form-text fs-7 mt-3">
                            Keterangan : <br>
                            - Tipe file yang bisa diunggah adalah *.jpg, *.png, atau *.pdf. <br>
                            - Ukuran file yang bisa diunggah maksimal 1 Mb.
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-outline-brand px-4">
                    <a href="?module=pengajuan" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<script>
    function validasi_foto() {
        var inputFile = document.getElementById('foto');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
        if (!ekstensiOk.exec(pathFile)) {
            alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png/.pdf.');
            inputFile.value = '';
            return false;
        } else {
            // Check file size
            if (inputFile.files[0].size > 1048576) { // 1MB in bytes
                alert('Ukuran file maksimal yang diizinkan adalah 1MB.');
                inputFile.value = '';
                return false;
            }
        }
    }
</script>
