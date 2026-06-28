<?php
include 'koneksi.php';
$id_user = isset($_GET['user_id']) ? $_GET['user_id'] : 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Tokoku</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f7fb; color: #2a3547; width: 100%; overflow-x: hidden; }
        :root {
            --primary: #5D87FF; --primary-dark: #3c5bdc; --dark: #1e2a3a;
            --border-light: #eef2f6; --text-muted: #5a6a85;
        }
        .navbar { background-color: var(--dark); padding: 12px 0; width: 100%; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .container { width: 100%; padding: 0 40px; }
        .nav-wrapper { display: flex; align-items: center; justify-content: space-between; }
        .logo-area { display: flex; align-items: center; gap: 8px; text-decoration: none; color: white; font-weight: 700; font-size: 24px; }
        .logo-icon { font-size: 28px; color: var(--primary); }
        
        .detail-layout { display: flex; gap: 40px; margin: 40px 0; background: white; border-radius: 24px; padding: 32px; border: 1px solid var(--border-light); width: 100%; }
        .detail-left { width: 45%; }
        .detail-right { width: 55%; display: flex; flex-direction: column; }
        .main-img-box { background: #f8fafc; border-radius: 16px; overflow: hidden; height: 450px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-light); }
        .main-img-box img { width: 100%; height: 100%; object-fit: cover; }
        
        .prod-title { font-size: 2rem; font-weight: 700; color: var(--dark); margin-bottom: 12px; line-height: 1.3; }
        .prod-price { font-size: 2.2rem; font-weight: 700; color: var(--primary); margin-bottom: 24px; }
        .info-row { display: flex; gap: 24px; padding: 16px 0; border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light); margin-bottom: 24px; font-size: 15px; }
        .info-label { color: var(--text-muted); }
        .info-value { font-weight: 600; color: var(--dark); }
        
        .desc-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 8px; color: var(--dark); }
        .desc-text { color: var(--text-muted); line-height: 1.6; font-size: 15px; margin-bottom: 32px; }
        
        .qty-area { display: flex; align-items: center; gap: 16px; margin-bottom: 32px; }
        .qty-selector { display: flex; align-items: center; border: 1px solid #cbd5e1; border-radius: 30px; background: white; overflow: hidden; }
        .qty-btn { background: none; border: none; width: 36px; height: 36px; font-size: 18px; cursor: pointer; font-weight: bold; }
        .qty-btn:hover { background: #f1f5f9; }
        .qty-input { width: 50px; text-align: center; font-weight: 600; font-size: 15px; border: none; outline: none; }
        
        .action-btns { display: flex; gap: 16px; margin-bottom: 16px; }
        .btn-add-cart { flex: 1; background: #ecf2ff; border: 1px solid rgba(93,135,255,0.2); color: var(--primary); padding: 16px 0; border-radius: 40px; font-weight: 600; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-add-cart:hover { background: var(--primary); color: white; }
        .btn-buy { flex: 1; background: var(--primary); border: none; color: white; padding: 16px 0; border-radius: 40px; font-weight: 600; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-buy:hover { background: var(--primary-dark); }
        
        /* TOMBOL KEMBALI BARU */
        .btn-back-home { width: 100%; background: #ffffff; border: 1px solid #cbd5e1; color: var(--text-muted); padding: 14px 0; border-radius: 40px; font-weight: 600; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; transition: all 0.2s; }
        .btn-back-home:hover { background: #f8fafc; color: var(--dark); border-color: #94a3b8; }

        .custom-alert {
            position: fixed; top: -100px; left: 50%; transform: translateX(-50%);
            width: calc(100% - 80px); max-width: 1200px; background-color: #e8f5e9;
            color: #2e7d32; padding: 16px 24px; border-radius: 12px; font-size: 15px;
            font-weight: 500; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #c8e6c9;
            z-index: 9999; transition: top 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex; align-items: center; gap: 12px;
        }
        @media (max-width: 768px) { .container { padding: 0 16px; } .detail-layout { flex-direction: column; padding: 16px; } .detail-left, .detail-right { width: 100%; } .main-img-box { height: 300px; } }
    </style>
</head>
<body>

<div id="customAlert" class="custom-alert">
    <i class="fas fa-check-circle"></i>
    <span id="alertMessage">Success Alert</span>
</div>

<div class="navbar">
    <div class="container">
        <div class="nav-wrapper">
            <a href="user.php?user_id=<?php echo $id_user; ?>" class="logo-area">
                <i class="fas fa-store logo-icon"></i>
                <span style="color: white;">Tokoku</span>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="detail-layout" id="detailLayout">
        </div>
</div>

<script>
    const produkList = [
        { id: 1, nama: "Kaos Polos Pria Cotton Combed 30s", harga: 79000, stok: 45, deskripsi: "Bahan 100% Cotton Combed 30s sangat halus, nyaman, adem di kulit, dan menyerap keringat dengan baik untuk harian." },
        { id: 2, nama: "Sepatu Sneakers Casual Original", harga: 350000, stok: 12, deskripsi: "Desain trendy nan kokoh, bantalan kaki sangat empuk, cocok untuk olahraga ringan atau hangout santai." },
        { id: 3, nama: "Headphone Bluetooth Wireless Stereo Bass", harga: 249000, stok: 30, deskripsi: "Koneksi wireless anti putus, bass super mantap menggelegar, daya tahan baterai hingga 15 jam pemakaian." },
        { id: 4, nama: "Tas Ransel BackPack Anti Air Premium", harga: 180000, stok: 8, deskripsi: "Dilengkapi pelindung air (waterproof), slot laptop khusus, jahitan kuat memuat beban berat harian." },
        { id: 5, nama: "Jam Tangan Digital Sporty Waterproof", harga: 150000, stok: 20, deskripsi: "Tahan air hingga kedalaman 30m, display digital terang benderang dengan fitur kalender otomatis aktif." },
        { id: 6, nama: "Smartphone 5G RAM 8GB ROM 256GB", harga: 2499000, stok: 5, deskripsi: "Layar refresh rate tinggi, prosesor ngebut bebas lag, abadikan momen indah lewat kamera ultra jernih." },
        { id: 7, nama: "Laptop Gaming Ryzen 16GB SSD 512GB", harga: 8499000, stok: 3, deskripsi: "Libas game berat dengan lancar, rendering video super instan, serta sistem cooling kipas ganda anti panas." },
        { id: 8, nama: "Kamera Mirrorless Video 4K Lensa Kit", harga: 5699000, stok: 2, deskripsi: "Hasil rekaman super cinematic beresolusi 4K tajam, auto-focus mendeteksi mata objek super akurat." },
        { id: 9, nama: "Jaket Hoodie Fleece Premium Unisex", harga: 185000, stok: 15, deskripsi: "Bahan kain tebal menghangatkan tubuh di cuaca dingin namun tetap adem tidak bikin gerah." },
        { id: 10, nama: "Power Bank 20000mAh Fast Charging", harga: 125000, stok: 40, deskripsi: "Kapasitas raksasa isi daya handphone berkali-kali lipat cepat berkat teknologi smart pengisian daya kilat." }
    ];

    const currentUserId = "<?php echo $id_user; ?>";
    const urlParams = new URLSearchParams(window.location.search);
    const prodId = parseInt(urlParams.get('id')) || 1;
    const prod = produkList.find(p => p.id === prodId) || produkList[0];

    function formatRupiah(amount) { return 'Rp' + amount.toLocaleString('id-ID'); }

    function tampilkanNotifikasi(pesan) {
        const alertBox = document.getElementById('customAlert');
        const alertMsg = document.getElementById('alertMessage');
        if(!alertBox || !alertMsg) return;
        alertMsg.innerText = pesan;
        alertBox.style.top = '24px';
        setTimeout(() => { alertBox.style.top = '-100px'; }, 3000);
    }

    function renderDetail() {
        const layout = document.getElementById('detailLayout');
        const imgUrl = `https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&q=80&sig=${prod.id}`;
        
        layout.innerHTML = `
            <div class="detail-left">
                <div class="main-img-box"><img src="${imgUrl}" alt="${prod.nama}"></div>
            </div>
            <div class="detail-right">
                <h1 class="prod-title">${prod.nama}</h1>
                <div class="prod-price">${formatRupiah(prod.harga)}</div>
                <div class="info-row">
                    <div><span class="info-label">Kondisi:</span> <span class="info-value">Baru</span></div>
                    <div><span class="info-label">Stok Tersedia:</span> <span class="info-value" id="stockValue">${prod.stok} pcs</span></div>
                </div>
                <div class="desc-title">Deskripsi Produk</div>
                <p class="desc-text">${prod.deskripsi}</p>
                
                <div class="qty-area">
                    <span style="font-weight:600;">Jumlah Belanja:</span>
                    <div class="qty-selector">
                        <button class="qty-btn" onclick="ubahQty(-1)">−</button>
                        <input type="text" class="qty-input" id="qtyInput" value="1" readonly>
                        <button class="qty-btn" onclick="ubahQty(1)">+</button>
                    </div>
                </div>
                
                <div class="action-btns">
                    <button class="btn-add-cart" onclick="prosesBeli(false)"><i class="fas fa-cart-plus"></i> Tambah Keranjang</button>
                    <button class="btn-buy" onclick="prosesBeli(true)"><i class="fas fa-shopping-bag"></i> Beli Sekarang</button>
                </div>

                <a href="user.php?user_id=${currentUserId}" class="btn-back-home">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        `;
    }

    function ubahQty(val) {
        const input = document.getElementById('qtyInput');
        let current = parseInt(input.value) + val;
        if(current >= 1 && current <= prod.stok) { input.value = current; }
    }

    function prosesBeli(langsungCheckout) {
        const qty = parseInt(document.getElementById('qtyInput').value);
        
        if (langsungCheckout) {
            const barangInstan = [{
                id: prod.id,
                nama: prod.nama,
                harga: prod.harga,
                stok: prod.stok,
                qty: qty
            }];
            
            localStorage.setItem('checkout_items', JSON.stringify(barangInstan));
            tampilkanNotifikasi(`⚡ Memproses pembelian ${qty} pcs ${prod.nama}...`);
            setTimeout(() => {
                window.location.href = `transaksi.php?user_id=${currentUserId}`;
            }, 1000);
            
        } else {
            let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
            let existingItem = cart.find(item => item.id === prod.id);

            if(existingItem) {
                if(existingItem.qty + qty <= prod.stok) { existingItem.qty += qty; } 
                else { tampilkanNotifikasi(`⚠️ Total barang di keranjang melebihi stok!`); return; }
            } else {
                cart.push({ id: prod.id, nama: prod.nama, harga: prod.harga, stok: prod.stok, qty: qty });
            }

            localStorage.setItem('cart_items', JSON.stringify(cart));
            tampilkanNotifikasi(`🛒 Berhasil memasukkan ${qty} pcs barang ke keranjang!`);
        }
    }

    document.addEventListener('DOMContentLoaded', renderDetail);
</script>
</body>
</html>