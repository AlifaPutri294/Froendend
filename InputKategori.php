<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokoku - Admin Input Kategori</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabler-icons@1.119.0/iconfont/tabler-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding: 40px 24px;
        }

        /* Container form */
        .form-container {
            max-width: 680px;
            margin: 0 auto;
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        /* Header */
        .form-header {
            background: linear-gradient(105deg, #0f2b3d 0%, #1a4a6f 100%);
            padding: 28px 32px;
            position: relative;
        }

        .form-header h2 {
            color: white;
            font-weight: 700;
            font-size: 28px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-header h2 i {
            font-size: 32px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .form-header p {
            color: rgba(255,255,255,0.8);
            margin-top: 8px;
            font-size: 14px;
            font-weight: 400;
        }

        /* body form */
        .form-body {
            padding: 32px 32px 40px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #1e2a3a;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: #2c6e9e;
            font-size: 16px;
            width: 20px;
        }

        .required-star {
            color: #e53e3e;
            font-size: 14px;
            margin-left: 4px;
        }

        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.2s ease;
            background-color: #fff;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2c6e9e;
            box-shadow: 0 0 0 4px rgba(44, 110, 158, 0.15);
            outline: none;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        /* preview gambar */
        .image-preview-area {
            background: #f8fafc;
            border-radius: 20px;
            padding: 16px;
            margin-top: 12px;
            border: 1px dashed #cbd5e1;
            transition: all 0.2s;
            text-align: center;
        }

        .image-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 12px;
        }

        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 20px;
            background: white;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border: 2px solid white;
        }

        .preview-placeholder {
            width: 100px;
            height: 100px;
            background: #eef2ff;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2c6e9e;
            font-size: 36px;
        }

        .btn-preview-reset {
            background: none;
            border: none;
            color: #e53e3e;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 8px;
        }

        /* tombol aksi */
        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            justify-content: flex-end;
        }

        .btn-cancel {
            background: white;
            border: 1.5px solid #cbd5e1;
            border-radius: 40px;
            padding: 12px 28px;
            font-weight: 600;
            color: #475569;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }

        .btn-submit {
            background: linear-gradient(95deg, #1f5e8c, #2c6e9e);
            border: none;
            border-radius: 40px;
            padding: 12px 32px;
            font-weight: 600;
            color: white;
            box-shadow: 0 4px 12px rgba(44,110,158,0.3);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-submit:hover {
            background: linear-gradient(95deg, #164e74, #1f5e8c);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(44,110,158,0.4);
        }

        /* floating sukses alert */
        .toast-notif {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #1f5e8c;
            color: white;
            padding: 14px 24px;
            border-radius: 60px;
            font-weight: 500;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1050;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            font-size: 14px;
        }

        .toast-notif.show {
            transform: translateX(0);
        }

        hr {
            margin: 24px 0 16px;
            opacity: 0.5;
        }

        /* responsif */
        @media (max-width: 560px) {
            body {
                padding: 20px 16px;
            }
            .form-body {
                padding: 24px 20px;
            }
            .form-actions {
                flex-direction: column;
            }
            .btn-cancel, .btn-submit {
                justify-content: center;
            }
        }

        /* icon kecil */
        .input-group-icon {
            position: relative;
        }
    </style>
</head>
<body>

<div class="form-container">
    <!-- Header -->
    <div class="form-header">
        <h2>
            <i class="ti ti-package"></i> 
            Tambah Data Kategori
        </h2>
    </div>

    <!-- Form Body -->
    <div class="form-body">
        <form id="formProduk" action="#" method="post">
            <!-- Nama Produk -->
            <div class="mb-4">
                <label class="form-label">
                    <i class="ti ti-tag"></i> Id
                    <span class="required-star">*</span>
                </label>
                <input type="text" class="form-control" id="namaProduk" placeholder="Contoh: Kemeja Flanel Premium" required>
            </div>
            <div class="mb-4">
                <label class="form-label">
                    <i class="ti ti-tag"></i> kategori
                    <span class="required-star">*</span>
                </label>
                <input type="text" class="form-control" id="namaProduk" placeholder="Contoh: Kemeja Flanel Premium" required>
            </div>
            <hr>

            <!-- Tombol Aksi -->
            <div class="form-actions">
                <button type="button" class="btn-cancel" id="btnBatal">
                    <i class="ti ti-x"></i> Batal
                </button>
                <button type="submit" class="btn-submit" id="btnSimpan">
                    <i class="ti ti-device-floppy"></i> Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Toast notifikasi -->
<div id="toastMsg" class="toast-notif">
    <i class="ti ti-check-circle" style="font-size: 20px;"></i>
    <span id="toastText">Produk berhasil disimpan!</span>
</div>

<script>
    // Format Rupiah
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, '');
        if (value === '') {
            input.value = 'Rp ';
            return;
        }
        let number = parseInt(value, 10);
        if (!isNaN(number)) {
            let formatted = number.toLocaleString('id-ID');
            input.value = 'Rp ' + formatted;
        } else {
            if (input.value.startsWith('Rp')) {
                let raw = input.value.replace('Rp ', '').replace(/\./g, '');
                let num = parseInt(raw, 10);
                if (!isNaN(num)) {
                    input.value = 'Rp ' + num.toLocaleString('id-ID');
                }
            }
        }
    }

    // Preview gambar dari URL
    const urlInput = document.getElementById('gambarUrl');
    const previewImg = document.getElementById('previewImg');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const previewTextSpan = document.getElementById('previewText');
    const resetBtn = document.getElementById('resetImageBtn');

    function updateImagePreview() {
        let url = urlInput.value.trim();
        if (url === "") {
            previewImg.style.display = "none";
            previewPlaceholder.style.display = "flex";
            previewTextSpan.innerText = "Belum ada gambar, masukkan URL untuk pratinjau";
            resetBtn.style.display = "none";
            return;
        }
        // Coba load gambar
        const tempImg = new Image();
        tempImg.onload = function() {
            previewImg.src = url;
            previewImg.style.display = "block";
            previewPlaceholder.style.display = "none";
            previewTextSpan.innerText = "Pratinjau gambar produk";
            resetBtn.style.display = "inline-block";
        };
        tempImg.onerror = function() {
            previewImg.style.display = "none";
            previewPlaceholder.style.display = "flex";
            previewTextSpan.innerText = "URL tidak valid atau gambar gagal dimuat";
            resetBtn.style.display = "none";
        };
        tempImg.src = url;
    }

    urlInput.addEventListener('input', updateImagePreview);
    resetBtn.addEventListener('click', function() {
        urlInput.value = '';
        updateImagePreview();
    });

    // showToast
    function showToast(message, isError = false) {
        const toast = document.getElementById('toastMsg');
        const toastText = document.getElementById('toastText');
        const iconSpan = toast.querySelector('i');
        if (isError) {
            iconSpan.className = "ti ti-alert-circle";
            toast.style.background = "#b91c1c";
            toastText.innerText = message;
        } else {
            iconSpan.className = "ti ti-check-circle";
            toast.style.background = "#1f5e8c";
            toastText.innerText = message;
        }
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }

    // handle submit form
    const form = document.getElementById('formProduk');
    const kategoriSelect = document.getElementById('kategori');
    const namaInput = document.getElementById('namaProduk');
    const hargaInput = document.getElementById('harga');
    const stokInput = document.getElementById('stok');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // validasi sederhana
        let isValid = true;
        if (!kategoriSelect.value) {
            kategoriSelect.classList.add('is-invalid');
            isValid = false;
        } else {
            kategoriSelect.classList.remove('is-invalid');
        }

        if (!namaInput.value.trim()) {
            namaInput.classList.add('is-invalid');
            isValid = false;
        } else {
            namaInput.classList.remove('is-invalid');
        }

        let hargaRaw = hargaInput.value.replace('Rp ', '').replace(/\./g, '');
        if (!hargaRaw || isNaN(parseInt(hargaRaw)) || parseInt(hargaRaw) <= 0) {
            hargaInput.classList.add('is-invalid');
            isValid = false;
        } else {
            hargaInput.classList.remove('is-invalid');
        }

        if (!stokInput.value || parseInt(stokInput.value) < 0) {
            stokInput.classList.add('is-invalid');
            isValid = false;
        } else {
            stokInput.classList.remove('is-invalid');
        }

        if (!isValid) {
            showToast('Lengkapi data yang wajib diisi (*)', true);
            return;
        }

        // kumpulkan data produk
        const kategori = kategoriSelect.value;
        const namaProduk = namaInput.value.trim();
        const hargaFormatted = hargaInput.value; // sudah Rp xxx
        const detailProduk = document.getElementById('detail').value.trim() || "-";
        const stokVal = stokInput.value;
        const gambarUrlVal = urlInput.value.trim() || "";

        // Buat objek data
        const produkBaru = {
            kategori: kategori,
            nama: namaProduk,
            harga: hargaFormatted,
            detail: detailProduk,
            stok: stokVal,
            gambar: gambarUrlVal || "https://placehold.co/400x400?text=No+Image"
        };

        // Simpan ke localStorage agar bisa diakses di halaman lain (jika diperlukan)
        let daftarProduk = JSON.parse(localStorage.getItem('daftarProdukFlexy') || '[]');
        daftarProduk.push(produkBaru);
        localStorage.setItem('daftarProdukFlexy', JSON.stringify(daftarProduk));

        // Tampilkan notifikasi sukses
        showToast(`Produk "${namaProduk}" berhasil ditambahkan!`, false);

        // Reset form (opsional)
        form.reset();
        // reset manual kategori dan beberapa field
        kategoriSelect.value = "";
        namaInput.value = "";
        hargaInput.value = "Rp ";
        document.getElementById('detail').value = "";
        stokInput.value = "0";
        urlInput.value = "";
        updateImagePreview();
        // hapus class is-invalid jika ada
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        // setelah sukses, bisa redirect ke halaman produk? opsional: delay 1.5s lalu ke produk.html
        // tapi biarkan tetap di form, user bisa tambah lagi.
        // Tapi kita beri opsi: tombol untuk lihat daftar? tambahkan link
        // menampilkan informasi
        const extraInfo = document.createElement('div');
        // cegah duplikasi notifikasi besar
        let existingAlert = document.querySelector('.success-redirect-info');
        if (existingAlert) existingAlert.remove();
        const successNote = document.createElement('div');
        successNote.className = 'alert alert-success mt-4 d-flex align-items-center gap-2 success-redirect-info';
        successNote.style.borderRadius = "20px";
        successNote.style.fontSize = "13px";
        successNote.innerHTML = `<i class="ti ti-database-export"></i> <span>Data tersimpan di LocalStorage. <a href="produk.html" style="font-weight:600;">Lihat daftar produk →</a> (jika halaman produk sudah mendukung)</span>`;
        document.querySelector('.form-body').appendChild(successNote);
        setTimeout(() => {
            if(successNote) successNote.remove();
        }, 4000);
    });

    // batal / reset form
    document.getElementById('btnBatal').addEventListener('click', function() {
        if (confirm('Batalkan input? Semua data yang belum disimpan akan hilang.')) {
            form.reset();
            kategoriSelect.value = "";
            hargaInput.value = "Rp ";
            stokInput.value = "0";
            urlInput.value = "";
            updateImagePreview();
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            let existingAlert = document.querySelector('.success-redirect-info');
            if(existingAlert) existingAlert.remove();
            showToast('Form dibersihkan', false);
        }
    });

    // inisialisasi placeholder gambar
    updateImagePreview();
    // styling validasi manual
    const inputsReq = [namaInput, hargaInput, stokInput, kategoriSelect];
    inputsReq.forEach(inp => {
        inp.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                if (this.value && this.value !== 'Rp ') {
                    this.classList.remove('is-invalid');
                } else if (this === kategoriSelect && this.value) {
                    this.classList.remove('is-invalid');
                } else if (this === stokInput && parseInt(this.value) >= 0) {
                    this.classList.remove('is-invalid');
                }
            }
        });
    });
    kategoriSelect.addEventListener('change', function() {
        if(this.value) this.classList.remove('is-invalid');
    });
</script>

<!-- Bootstrap JS (untuk interaksi jika dibutuhkan, tapi tidak wajib untuk form ini) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional: tambahan smooth -->
</body>
</html>