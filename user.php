<?php
include 'koneksi.php'; // Menyambungkan ke database Anda
$id_user = isset($_GET['user_id']) ? $_GET['user_id'] : 1; // Mengambil user_id secara dinamis
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Tokoku - Belanja Online Modern</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f7fb; color: #2a3547; width: 100%; overflow-x: hidden; }
        :root {
            --primary: #5D87FF; --primary-dark: #3c5bdc; --secondary: #49BEFF;
            --success: #13DEB9; --warning: #FFAE1F; --danger: #FA896B; --dark: #1e2a3a;
            --border-light: #eef2f6; --text-muted: #5a6a85;
        }
        .navbar { background-color: var(--dark); box-shadow: 0 2px 10px rgba(0,0,0,0.08); position: sticky; top: 0; z-index: 100; padding: 12px 0; width: 100%; }
        .container { width: 100%; padding: 0 40px; }
        .nav-wrapper { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
        .logo-area { display: flex; align-items: center; gap: 8px; }
        .logo-icon { font-size: 28px; color: var(--primary); }
        .logo-text { font-weight: 700; font-size: 24px; color: white; letter-spacing: -0.3px; }
        .search-bar { flex: 1; max-width: 500px; display: flex; background: white; border-radius: 40px; padding: 4px 16px; align-items: center; border: 1px solid rgba(255,255,255,0.2); transition: all 0.2s; }
        .search-bar:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(93,135,255,0.2); }
        .search-bar i { color: #94a3b8; font-size: 18px; }
        .search-bar input { background: transparent; border: none; padding: 12px 8px; font-size: 14px; width: 100%; outline: none; }
        
        .nav-icons { display: flex; gap: 24px; align-items: center; }
        .nav-icons a { text-decoration: none; position: relative; display: inline-block; }
        .nav-icons i { font-size: 22px; color: #e2e8f0; cursor: pointer; transition: color 0.2s; }
        .nav-icons i:hover { color: var(--primary); }
        .cart-badge { position: absolute; top: -8px; right: -10px; background-color: var(--danger); color: white; font-size: 11px; font-weight: 700; border-radius: 50%; padding: 2px 6px; min-width: 18px; text-align: center; display: none; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        
        .hero { background: linear-gradient(105deg, #eef2ff 0%, #ffffff 100%); margin: 28px 0 32px 0; border-radius: 24px; padding: 40px 32px; display: flex; justify-content: space-between; align-items: center; border: 1px solid var(--border-light); width: 100%; }
        .hero-text h1 { font-size: 2rem; font-weight: 700; color: var(--dark); }
        .hero-text p { color: var(--text-muted); margin-top: 6px; font-size: 16px; }
        .section-title { font-size: 1.8rem; font-weight: 700; margin: 40px 0 24px 0; color: var(--dark); }
        
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 32px; margin-bottom: 60px; width: 100%; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03); transition: all 0.25s ease; border: 1px solid var(--border-light); display: flex; flex-direction: column; cursor: pointer; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 20px 28px -12px rgba(0,0,0,0.12); border-color: var(--primary); }
        .card-img { background: #f8fafc; height: 240px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .card-img img { width: 100%; height: 100%; object-fit: cover; }
        .card-info { padding: 20px 18px; display: flex; flex-direction: column; flex-grow: 1; }
        .product-name { font-weight: 600; font-size: 1.05rem; line-height: 1.4; margin-bottom: 8px; color: var(--dark); min-height: 44px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .stok-info { font-size: 13px; color: var(--text-muted); margin-bottom: 12px; }
        .stok-count { font-weight: bold; color: var(--dark); }
        .current-price { font-weight: 700; font-size: 1.35rem; color: var(--primary); margin-bottom: 16px; }
        
        .action-buttons { display: flex; flex-direction: column; gap: 10px; margin-top: auto; }
        .btn-cart { width: 100%; background: #ecf2ff; border: 1px solid rgba(93,135,255,0.2); padding: 12px 0; border-radius: 40px; font-weight: 600; font-size: 0.9rem; color: var(--primary); display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: all 0.2s; }
        .btn-cart:hover { background: var(--primary); color: white; }
        .btn-buy-now { width: 100%; background: var(--primary); border: none; padding: 13px 0; border-radius: 40px; font-weight: 600; font-size: 0.9rem; color: white; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: all 0.2s; text-align: center; text-decoration: none; }
        .btn-buy-now:hover { background: var(--primary-dark); }
        
        .footer { border-top: 1px solid var(--border-light); margin-top: 60px; padding: 40px 0; text-align: center; color: var(--text-muted); font-size: 14px; background: white; width: 100%; }

        /* NOTIFIKASI GREEN BANNER */
        .custom-alert {
            position: fixed; top: -100px; left: 50%; transform: translateX(-50%);
            width: calc(100% - 80px); max-width: 1200px; background-color: #e8f5e9;
            color: #2e7d32; padding: 16px 24px; border-radius: 12px; font-size: 15px;
            font-weight: 500; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #c8e6c9;
            z-index: 9999; transition: top 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex; align-items: center; gap: 12px;
        }
        @media (max-width: 768px) { .container { padding: 0 16px; } .products-grid { grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 16px; } .card-img { height: 170px; } }
    </style>
</head>
<body>

<div id="customAlert" class="custom-alert">
    <i class="fas fa-check-circle"></i>
    <span id="alertMessage">A simple success alert—check it out!</span>
</div>

<div class="navbar">
    <div class="container">
        <div class="nav-wrapper">
            <div class="logo-area">
                <i class="fas fa-store logo-icon"></i>
                <span class="logo-text">Tokoku</span>
            </div>
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari produk..." id="searchInput">
            </div>
            <div class="nav-icons">
                <a href="pesanan_saya.php?user_id=<?php echo $id_user; ?>" title="Keranjang Belanja">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge">0</span>
                </a>
                
                <a href="tracking.php?id_user=<?php echo $id_user; ?>" title="Lacak Pesanan Saya">
                    <i class="fas fa-truck"></i>
                </a>

                <a href="login.php"><i class="far fa-user-circle" style="font-size: 26px;"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="hero">
        <div class="hero-text">
            <h1>Belanja Hemat & Terpercaya</h1>
            <p>Sistem Toko Online Praktis, Aman, dan Cepat</p>
        </div>
    </div>
    <div class="section-title">✨ Rekomendasi Produk Pilihan</div>
    <div class="products-grid" id="productsGrid"></div>
</div>

<div class="footer"><p>© 2026 Tokoku — Marketplace modern.</p></div>

<script>
    const produkList = [
        { id: 1, nama: "Kaos Polos Pria Cotton Combed 30s", harga: 79000, stok: 45 },
        { id: 2, nama: "Sepatu Sneakers Casual Original", harga: 350000, stok: 12 },
        { id: 3, nama: "Headphone Bluetooth Wireless Stereo Bass", harga: 249000, stok: 30 },
        { id: 4, nama: "Tas Ransel BackPack Anti Air Premium", harga: 180000, stok: 8 },
        { id: 5, nama: "Jam Tangan Digital Sporty Waterproof", harga: 150000, stok: 20 },
        { id: 6, nama: "Smartphone 5G RAM 8GB ROM 256GB", harga: 2499000, stok: 5 },
        { id: 7, nama: "Laptop Gaming Ryzen 16GB SSD 512GB", harga: 8499000, stok: 3 },
        { id: 8, nama: "Kamera Mirrorless Video 4K Lensa Kit", harga: 5699000, stok: 2 },
        { id: 9, nama: "Jaket Hoodie Fleece Premium Unisex", harga: 185000, stok: 15 },
        { id: 10, nama: "Power Bank 20000mAh Fast Charging", harga: 125000, stok: 40 }
    ];

    const currentUserId = "<?php echo $id_user; ?>";
    function formatRupiah(amount) { return 'Rp' + amount.toLocaleString('id-ID'); }

    function tampilkanNotifikasi(pesan) {
        const alertBox = document.getElementById('customAlert');
        const alertMsg = document.getElementById('alertMessage');
        if(!alertBox || !alertMsg) return;
        alertMsg.innerText = pesan;
        alertBox.style.top = '24px';
        setTimeout(() => { alertBox.style.top = '-100px'; }, 3000);
    }

    function updateCartBadge() {
        let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
        let totalQty = cart.reduce((total, item) => total + item.qty, 0);
        const badge = document.getElementById('cartBadge');
        if(badge) {
            badge.innerText = totalQty;
            badge.style.display = totalQty > 0 ? 'block' : 'none';
        }
    }

    function tambahKeCartStorage(produk) {
        let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
        let existingItem = cart.find(item => item.id === produk.id);
        if(existingItem) {
            if(existingItem.qty + 1 <= produk.stok) { existingItem.qty += 1; } 
            else { tampilkanNotifikasi(`⚠️ Stok tidak mencukupi!`); return false; }
        } else {
            cart.push({ id: produk.id, nama: produk.nama, harga: produk.harga, stok: produk.stok, qty: 1 });
        }
        localStorage.setItem('cart_items', JSON.stringify(cart));
        updateCartBadge();
        return true;
    }

    function renderProducts(productArray) {
        const grid = document.getElementById('productsGrid');
        if(!grid) return; grid.innerHTML = '';
        productArray.forEach(prod => {
            const imgUrl = `https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80&sig=${prod.id}`;
            const card = document.createElement('div');
            card.className = 'product-card';
            card.innerHTML = `
                <div class="card-img"><img src="${imgUrl}" alt="${prod.nama}"></div>
                <div class="card-info">
                    <div class="product-name">${prod.nama}</div>
                    <div class="stok-info">Stok: <span class="stok-count">${prod.stok} pcs</span></div>
                    <div class="current-price">${formatRupiah(prod.harga)}</div>
                    <div class="action-buttons">
                        <button class="btn-cart"><i class="fas fa-cart-plus"></i> Tambahkan Keranjang</button>
                    </div>
                </div>
            `;
            card.addEventListener('click', (e) => {
                if(e.target.closest('.btn-cart')) {
                    e.stopPropagation();
                    if(tambahKeCartStorage(prod)) tampilkanNotifikasi(`🛒 ${prod.nama} dimasukkan ke keranjang!`);
                    return;
                }
                if(e.target.closest('.btn-buy-now')) {
                    e.stopPropagation();
                    tambahKeCartStorage(prod);
                    window.location.href = `pesanan_saya.php?user_id=${currentUserId}`;
                    return;
                }
                window.location.href = `detail_produk.php?id=${prod.id}&user_id=${currentUserId}`;
            });
            grid.appendChild(card);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderProducts(produkList);
        updateCartBadge();
        document.getElementById('searchInput').addEventListener('input', (e) => {
            renderProducts(produkList.filter(p => p.nama.toLowerCase().includes(e.target.value.toLowerCase())));
        });
    });
</script>
</body>
</html>