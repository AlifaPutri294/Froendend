<?php
// Mengambil user_id secara dinamis dari URL, default ke 1 jika tidak ada
$id_user = isset($_GET['user_id']) ? $_GET['user_id'] : 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Transaksi - Checkout Toko Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .container {
                flex-direction: row;
                align-items: flex-start;
            }
        }

        header {
            width: 100%;
            margin-bottom: 10px;
        }

        header h1 {
            color: #2c3e50;
            font-size: 24px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .form-container {
            flex: 2;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .summary-container {
            flex: 1;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            position: sticky;
            top: 20px;
        }

        .section-title {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ecf0f1;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
            color: #555;
        }

        input[type="text"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #3498db;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        .radio-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 10px;
            margin-top: 5px;
        }

        .radio-box {
            border: 1px solid #ccc;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .radio-box input {
            display: none;
        }

        .radio-box:hover {
            border-color: #3498db;
            background-color: #f7f9fa;
        }

        .radio-box.selected {
            border-color: #3498db;
            background-color: #ebf5fb;
            color: #2980b9;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #666;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px dashed #ecf0f1;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .btn-checkout {
            width: 100%;
            padding: 12px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 15px;
        }

        .btn-checkout:hover {
            background-color: #27ae60;
        }

        /* STYLE GREEN BANNER NOTIFIKASI */
        .custom-alert {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 600px;
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 16px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 1px solid #c8e6c9;
            z-index: 9999;
            transition: top 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 12px;
        }
    </style>
</head>
<body>

<div id="customAlert" class="custom-alert">
    <i class="fas fa-check-circle" style="font-size: 20px;"></i>
    <span id="alertMessage">Pembayaran Berhasil! Pesanan Anda sedang diproses. Menuju halaman tracking...</span>
</div>

<header style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
        <a href="user.php" style="text-decoration: none; color: #2c3e50; font-size: 20px; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background-color: #fff; border-radius: 50%; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: all 0.2s;" onmouseover="this.style.backgroundColor='#ecf0f1'" onmouseout="this.style.backgroundColor='#fff'">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 style="border-bottom: none; padding-bottom: 0; margin-bottom: 0;">Proses Checkout Pembayaran</h1>
    </header>

<div class="container">
    <div class="form-container">
        <form id="checkoutForm">
            
            <div class="section-title">1. Alamat Pengiriman</div>
            <div class="form-group">
                <label for="nama_penerima">Nama Lengkap Penerima *</label>
                <input type="text" id="nama_penerima" name="nama_penerima" placeholder="Contoh: Budi Santoso" required>
            </div>
            
            <div class="form-group">
                <label for="no_telp">Nomor Telepon / HP (WhatsApp Aktif) *</label>
                <input type="tel" id="no_telp" name="no_telp" placeholder="Contoh: 081234567890" required>
            </div>

            <div class="form-group">
                <label for="alamat_lengkap">Alamat Lengkap *</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" placeholder="Nama Jalan, Nomor Rumah, RT/RW, Kelurahan, Kec, Patokan Rumah..." required></textarea>
            </div>

            <div class="section-title" style="margin-top: 25px;">2. Jasa Pengiriman</div>
            <div class="form-group">
                <label>Pilih Opsi Pengiriman *</label>
                <div class="radio-group" id="kurir-group">
                    <div class="radio-box" onclick="selectRadio('kurir', this)">
                        <input type="radio" name="kurir" value="jne_reg" required>
                        <span>JNE Reguler (Rp 12.000)</span>
                    </div>
                    <div class="radio-box" onclick="selectRadio('kurir', this)">
                        <input type="radio" name="kurir" value="jnt_ez">
                        <span>J&T Express (Rp 11.000)</span>
                    </div>
                    <div class="radio-box" onclick="selectRadio('kurir', this)">
                        <input type="radio" name="kurir" value="gosend_instant">
                        <span>GoSend Instan (Rp 25.000)</span>
                    </div>
                </div>
            </div>

            <div class="section-title" style="margin-top: 25px;">3. Metode Pembayaran</div>
            <div class="form-group">
                <label>Pilih Cara Pembayaran *</label>
                <div class="radio-group" id="payment-group">
                    <div class="radio-box" onclick="selectRadio('pembayaran', this)">
                        <input type="radio" name="pembayaran" value="va_bca" required>
                        <span>BCA Virtual Account</span>
                    </div>
                    <div class="radio-box" onclick="selectRadio('pembayaran', this)">
                        <input type="radio" name="pembayaran" value="gopay">
                        <span>GoPay / QRIS</span>
                    </div>
                    <div class="radio-box" onclick="selectRadio('pembayaran', this)">
                        <input type="radio" name="pembayaran" value="cod">
                        <span>COD (Bayar di Tempat)</span>
                    </div>
                </div>
            </div>

            <div class="section-title" style="margin-top: 25px;">4. Catatan & Opsi Tambahan</div>
            <div class="form-group">
                <label for="catatan_penjual">Catatan untuk Penjual (Opsional)</label>
                <textarea id="catatan_penjual" name="catatan_penjual" placeholder="Contoh: Warna biru ya gan, titip satpam kalau rumah kosong."></textarea>
            </div>

        </form>
    </div>

    <div class="summary-container">
        <div class="section-title">Ringkasan Belanja</div>
        
        <div class="summary-item">
            <span>Total Harga</span>
            <span id="summary-subtotal">Rp 0</span>
        </div>
        <div class="summary-item">
            <span>Total Ongkos Kirim</span>
            <span id="summary-ongkir">Rp 0</span>
        </div>
        <div class="summary-item">
            <span>Biaya Jasa Aplikasi</span>
            <span>Rp 1.000</span>
        </div>

        <div class="summary-total">
            <span>Total Tagihan</span>
            <span id="summary-total-harga">Rp 1.000</span>
        </div>

        <button type="submit" form="checkoutForm" class="btn-checkout">Bayar Sekarang</button>
    </div>
</div>

<script>
    const currentUserId = "<?php echo $id_user; ?>";
    let subtotal = 0;
    let ongkir = 0;
    let totalTagihan = 1000;

    function loadCheckoutItems() {
        const items = JSON.parse(localStorage.getItem('checkout_items')) || [];
        
        // Jika dari halaman keranjang kosong, kita set harga dummy default Rp 250.000 seperti template awal Anda
        if(items.length === 0) {
            subtotal = 250000;
        } else {
            subtotal = items.reduce((total, item) => total + (item.harga * item.qty), 0);
        }
        
        document.getElementById('summary-subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        updateTotalTagihan();
    }

    function updateTotalTagihan() {
        totalTagihan = subtotal + ongkir + 1000;
        document.getElementById('summary-total-harga').innerText = 'Rp ' + totalTagihan.toLocaleString('id-ID');
    }

    function selectRadio(name, element) {
        const group = element.parentElement;
        const boxes = group.getElementsByClassName('radio-box');
        for (let box of boxes) {
            box.classList.remove('selected');
        }
        
        const radio = element.querySelector('input[type="radio"]');
        radio.checked = true;
        element.classList.add('selected');

        if (name === 'kurir') {
            const ongkirSpan = document.getElementById('summary-ongkir');
            
            if (radio.value === 'jne_reg') {
                ongkir = 12000;
                ongkirSpan.innerText = 'Rp 12.000';
            } else if (radio.value === 'jnt_ez') {
                ongkir = 11000;
                ongkirSpan.innerText = 'Rp 11.000';
            } else if (radio.value === 'gosend_instant') {
                ongkir = 25000;
                ongkirSpan.innerText = 'Rp 25.000';
            }
            updateTotalTagihan();
        }
    }

    // INTERCEPT SUBMIT: Mengirim data ke Database pakai AJAX, baru tampilkan Pop Up & Redirect
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Menahan reload halaman bawaan HTML

        // Buat objek form data untuk dikirim ke backend PHP
        const formData = new FormData(this);
        formData.append('total_harga', totalTagihan); // Menambahkan nominal total tagihan

        // Kirim data secara background ke proses_transaksi.php
        fetch(`proses_transaksi.php?user_id=${currentUserId}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Jika database sukses menyimpan, Munculkan Banner Sukses Hijau
                const alertBox = document.getElementById('customAlert');
                alertBox.style.top = '24px';

                // Bersihkan keranjang lokal belanjaan
                localStorage.removeItem('checkout_items');

                // Alihkan ke tracking.php setelah 2.5 detik
                setTimeout(() => {
                    window.location.href = `tracking.php?id_user=${currentUserId}`;
                }, 2500);
            } else {
                alert('Gagal memproses pesanan ke database: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan saat memproses pesanan.');
        });
    });

    document.addEventListener('DOMContentLoaded', loadCheckoutItems);
</script>

</body>
</html>