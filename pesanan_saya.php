<?php
include 'koneksi.php';
$id_user = isset($_GET['user_id']) ? $_GET['user_id'] : 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Tokoku</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f7fb; color: #2a3547; width: 100%; overflow-x: hidden; }
        :root {
            --primary: #5D87FF; --primary-dark: #3c5bdc; --danger: #FA896B;
            --dark: #1e2a3a; --border-light: #eef2f6; --text-muted: #5a6a85;
        }
        .navbar { background-color: var(--dark); padding: 12px 0; width: 100%; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .container { width: 100%; padding: 0 40px; }
        .nav-wrapper { display: flex; align-items: center; justify-content: space-between; }
        .logo-area { display: flex; align-items: center; gap: 8px; text-decoration: none; color: white; font-weight: 700; font-size: 24px; }
        .logo-icon { font-size: 28px; color: var(--primary); }
        
        .main-content { padding: 40px 0; }
        .page-title { font-size: 1.8rem; font-weight: 700; margin-bottom: 24px; color: var(--dark); display: flex; align-items: center; gap: 12px; }
        
        .cart-layout { display: flex; gap: 32px; align-items: flex-start; width: 100%; }
        .cart-items-panel { width: 70%; background: white; border-radius: 20px; padding: 24px; border: 1px solid var(--border-light); }
        .summary-panel { width: 30%; background: white; border-radius: 20px; padding: 24px; border: 1px solid var(--border-light); position: sticky; top: 100px; }
        
        /* FITUR CHECKBOX BARU */
        .select-all-box { display: flex; align-items: center; gap: 12px; padding-bottom: 16px; border-bottom: 1px solid var(--border-light); font-weight: 600; font-size: 15px; }
        .cart-item { display: flex; align-items: center; padding: 20px 0; border-bottom: 1px solid var(--border-light); gap: 20px; }
        .cart-item:last-child { border-bottom: none; }
        
        .item-checkbox { width: 20px; height: 20px; cursor: pointer; accent-color: var(--primary); }
        
        .item-img { width: 90px; height: 90px; background: #f8fafc; border-radius: 12px; overflow: hidden; }
        .item-img img { width: 100%; height: 100%; object-fit: cover; }
        .item-details { flex-grow: 1; }
        .item-name { font-weight: 600; font-size: 1.05rem; color: var(--dark); margin-bottom: 4px; }
        .item-price { font-weight: 700; color: var(--primary); font-size: 1.1rem; }
        
        .qty-controls { display: flex; align-items: center; border: 1px solid #cbd5e1; border-radius: 30px; overflow: hidden; background: white; }
        .qty-btn { background: none; border: none; width: 32px; height: 32px; font-size: 16px; cursor: pointer; font-weight: bold; }
        .qty-btn:hover { background: #f1f5f9; }
        .qty-text { width: 40px; text-align: center; font-weight: 600; font-size: 14px; border: none; outline: none; }
        
        .btn-delete { background: none; border: none; color: var(--danger); font-size: 18px; cursor: pointer; }
        .btn-delete:hover { transform: scale(1.1); }
        
        .summary-title { font-weight: 700; font-size: 1.2rem; margin-bottom: 16px; border-bottom: 2px solid var(--border-light); padding-bottom: 10px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 15px; }
        .total-row { display: flex; justify-content: space-between; margin-top: 20px; padding-top: 16px; border-top: 2px dashed var(--border-light); font-weight: 700; font-size: 1.25rem; color: var(--dark); }
        .btn-checkout { width: 100%; background: var(--primary); color: white; border: none; padding: 14px 0; border-radius: 40px; font-weight: 600; font-size: 1rem; margin-top: 24px; cursor: pointer; text-align: center; text-decoration: none; display: block; }
        .btn-checkout:hover { background: var(--primary-dark); }
        
        .empty-cart { text-align: center; padding: 60px 20px; background: white; border-radius: 20px; border: 1px solid var(--border-light); width: 100%; }
        .empty-cart i { font-size: 64px; color: #cbd5e1; margin-bottom: 16px; }
        .btn-shop { display: inline-block; background: var(--primary); color: white; text-decoration: none; padding: 12px 28px; border-radius: 40px; font-weight: 600; margin-top: 20px; }
    </style>
</head>
<body>

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

<div class="container main-content">
    <h1 class="page-title "><i class="fas fa-shopping-basket" style="color: var(--primary);"></i> Keranjang Belanja Anda</h1>
    
    <div class="cart-layout" id="cartLayout">
        <div class="cart-items-panel">
            <div class="select-all-box">
                <input type="checkbox" id="selectAll" class="item-checkbox" checked onchange="pilihSemuaBarang(this)">
                <label for="selectAll" style="cursor:pointer;">Pilih Semua Produk</label>
            </div>
            <div id="cartItems"></div>
        </div>
        
        <div class="summary-panel">
            <div class="summary-title">Ringkasan Belanja</div>
            <div class="summary-row">
                <span>Total Pilihan</span>
                <span id="sumQty">0 pcs</span>
            </div>
            <div class="total-row">
                <span>Total Harga</span>
                <span id="sumTotal">Rp0</span>
            </div>
            <button class="btn-checkout" onclick="lanjutKeTransaksi()">Mulai Pembayaran</button>
        </div>
    </div>
    <div class="container" style="margin-top: 20px;">
    <a href="user.php" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; color: #5a6a85; font-weight: 500; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#5D87FF'" onmouseout="this.style.color='#5a6a85'">
        <i class="fas fa-chevron-left"></i> Kembali Belanja
    </a>
</div>
</div>

<script>
    // Menyimpan indeks barang-barang yang diberi centang pilih oleh user
    let itemTerpilih = [];

    function formatRupiah(amount) { return 'Rp' + amount.toLocaleString('id-ID'); }

    function renderCart() {
        let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
        const itemsPanel = document.getElementById('cartItems');
        const layout = document.getElementById('cartLayout');
        
        if(cart.length === 0) {
            layout.innerHTML = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Keranjang belanjaanmu kosong</h3>
                    <p>Yuk, cari barang keren dan isi keranjangmu sekarang!</p>
                    <a href="user.php?user_id=<?php echo $id_user; ?>" class="btn-shop">Mulai Belanja</a>
                </div>
            `;
            return;
        }

        itemsPanel.innerHTML = '';
        
        cart.forEach((item, index) => {
            const imgUrl = `https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&q=80&sig=${item.id}`;
            
            // Atur status default tercentang jika rendering awal baru dimuat
            if (!itemTerpilih.hasOwnProperty(index)) {
                itemTerpilih[index] = true; 
            }
            const isChecked = itemTerpilih[index] ? 'checked' : '';

            const row = document.createElement('div');
            row.className = 'cart-item';
            row.innerHTML = `
                <input type="checkbox" class="item-checkbox sub-check" ${isChecked} onchange="aturPilihanBarang(${index}, this)">
                <div class="item-img"><img src="${imgUrl}" alt="${item.nama}"></div>
                <div class="item-details">
                    <div class="item-name">${item.nama}</div>
                    <div class="item-price">${formatRupiah(item.harga)}</div>
                </div>
                <div class="qty-controls">
                    <button class="qty-btn" onclick="ubahQty(${index}, -1)">−</button>
                    <input type="text" class="qty-text" value="${item.qty}" readonly>
                    <button class="qty-btn" onclick="ubahQty(${index}, 1)">+</button>
                </div>
                <button class="btn-delete" onclick="hapusItem(${index})"><i class="far fa-trash-alt"></i></button>
            `;
            itemsPanel.appendChild(row);
        });

        hitungUlangRingkasan();
    }

    // Fungsi menghitung total harga HANYA pada item yang dicentang
    function hitungUlangRingkasan() {
        let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
        let totalHargaAll = 0; let totalQtyAll = 0;

        cart.forEach((item, index) => {
            if (itemTerpilih[index]) {
                totalHargaAll += (item.harga * item.qty);
                totalQtyAll += item.qty;
            }
        });

        document.getElementById('sumQty').innerText = `${totalQtyAll} pcs`;
        document.getElementById('sumTotal').innerText = formatRupiah(totalHargaAll);
    }

    function aturPilihanBarang(index, checkbox) {
        itemTerpilih[index] = checkbox.checked;
        
        // Atur status tombol "Pilih Semua" jika ada salah satu sub-centang mati
        const allChecks = document.querySelectorAll('.sub-check');
        const checkedCount = Array.from(allChecks).filter(c => c.checked).length;
        document.getElementById('selectAll').checked = (checkedCount === allChecks.length);
        
        hitungUlangRingkasan();
    }

    function pilihSemuaBarang(masterCheckbox) {
        const checkboxes = document.querySelectorAll('.sub-check');
        checkboxes.forEach((cb, index) => {
            cb.checked = masterCheckbox.checked;
            itemTerpilih[index] = masterCheckbox.checked;
        });
        hitungUlangRingkasan();
    }

    function ubahQty(index, nilai) {
        let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
        let item = cart[index];
        let qtyBaru = item.qty + nilai;

        if(qtyBaru >= 1) {
            if(qtyBaru <= item.stok) {
                item.qty = qtyBaru;
                localStorage.setItem('cart_items', JSON.stringify(cart));
                renderCart();
            } else { alert(`Stok produk terbatas!`); }
        }
    }

    function hapusItem(index) {
        let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
        cart.splice(index, 1);
        itemTerpilih.splice(index, 1); // Buang tracker centang dari produk yang dihapus
        localStorage.setItem('cart_items', JSON.stringify(cart));
        renderCart();
    }

    // FUNGSI JALUR MENUJU HALAMAN TRANSAKSI BERDASARKAN PILIHAN
    function lanjutKeTransaksi() {
        let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
        
        // Filter hanya mengambil data barang yang dicentang user
        let barangDipilihKirim = cart.filter((item, index) => itemTerpilih[index]);

        if(barangDipilihKirim.length === 0) {
            alert("Silakan pilih minimal 1 produk untuk melanjutkan pembayaran!");
            return;
        }

        // Simpan daftar barang yang dicentang ke storage 'checkout_items'
        localStorage.setItem('checkout_items', JSON.stringify(barangDipilihKirim));
        
        window.location.href = `transaksi.php?user_id=<?php echo $id_user; ?>`;
    }

    document.addEventListener('DOMContentLoaded', renderCart);
</script>
</body>
</html>