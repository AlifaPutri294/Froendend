<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tokoku - Dashboard Admin</title>
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <style>
    .stat-card { transition: transform 0.2s; cursor: pointer; }
    .stat-card:hover { transform: translateY(-3px); }
    .btn-add { border-radius: 40px; padding: 6px 16px; font-size: 13px; }
    .table-small td, .table-small th { padding: 10px 12px; font-size: 13px; vertical-align: middle; }
    .badge-stok { font-size: 11px; padding: 3px 8px; border-radius: 30px; }
    .card-title-custom { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; }
  </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- App Topstrip -->
    <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
        <a class="d-flex justify-content-center" href="#"><img src="assets/images/" alt="" width=""></a>
      </div>
      <div class="d-lg-flex align-items-center gap-2">
        <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">Toko Online</h3>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <div class="dropdown d-flex">
            <a class="btn btn-primary d-flex align-items-center gap-1" href="javascript:void(0)" id="drop4" data-bs-toggle="dropdown">
              <i class="ti ti-shopping-cart fs-5"></i> Login <i class="ti ti-chevron-down fs-5"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar (tetap) -->
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img d-flex align-items-center gap-2">
            <i class="fas fa-store" style="color: #5D87FF; font-size: 28px;"></i>
            <span style="font-weight: 700; font-size: 22px; color: #1e2a3a;">Tokoku</span>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap"><iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon><span class="hide-menu">Home</span></li>
            <li class="sidebar-item"><a class="sidebar-link" href="./index.php"><i class="fa-solid fa-chart-column"></i><span class="hide-menu">Dashboard</span></a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="produk.php"><div class="d-flex align-items-center gap-3"><span class="d-flex"><i class="ti ti-aperture"></i></span><span class="hide-menu">Produk</span></div></a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="kategori.php"><div class="d-flex align-items-center gap-3"><span class="d-flex"><i class="ti ti-shopping-cart"></i></span><span class="hide-menu">Kategori</span></div></a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="pesanan.php"><div class="d-flex align-items-center gap-3"><span class="d-flex"><i class="ti ti-shopping-cart"></i></span><span class="hide-menu">Pesanan</span></div></a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="invoice.php"><div class="d-flex align-items-center gap-3"><span class="d-flex"><i class="ti ti-shopping-cart"></i></span><span class="hide-menu">Invoice</span></div></a></li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main wrapper -->
    <div class="body-wrapper">
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none"><a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)"><i class="ti ti-menu-2"></i></a></li>
            <li class="nav-item dropdown"><a class="nav-link" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"><i class="ti ti-bell"></i><div class="notification bg-primary rounded-circle"></div></a>
              <div class="dropdown-menu dropdown-menu-animate-up"><div class="message-body"><a href="#" class="dropdown-item">Item 1</a><a href="#" class="dropdown-item">Item 2</a></div></div></li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown"><a class="nav-link" href="#" id="drop2" data-bs-toggle="dropdown"><img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle"></a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"><div class="message-body"><a href="#" class="d-flex align-items-center gap-2 dropdown-item"><i class="ti ti-user fs-6"></i><p class="mb-0 fs-3">My Profile</p></a><a href="#" class="d-flex align-items-center gap-2 dropdown-item"><i class="ti ti-mail fs-6"></i><p class="mb-0 fs-3">My Account</p></a><a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a></div></div></li>
            </ul>
          </div>
        </nav>
      </header>

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          
          <!-- ========== CARD STATISTIK ========== -->
          <div class="row mb-4">
            <div class="col-md-3">
              <div class="card stat-card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div><h6 class="text-muted mb-1">Total Produk</h6><h3 class="mb-0 fw-bold" id="totalProdukCount">0</h3></div>
                  <div class="bg-primary bg-opacity-10 p-3 rounded-circle"><i class="ti ti-package fs-4 text-primary"></i></div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card stat-card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div><h6 class="text-muted mb-1">Total Pesanan</h6><h3 class="mb-0 fw-bold" id="totalPesananCount">0</h3></div>
                  <div class="bg-success bg-opacity-10 p-3 rounded-circle"><i class="ti ti-shopping-cart fs-4 text-success"></i></div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card stat-card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div><h6 class="text-muted mb-1">Total Invoice</h6><h3 class="mb-0 fw-bold" id="totalInvoiceCount">0</h3></div>
                  <div class="bg-warning bg-opacity-10 p-3 rounded-circle"><i class="ti ti-file-text fs-4 text-warning"></i></div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card stat-card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div><h6 class="text-muted mb-1">Total Pendapatan</h6><h3 class="mb-0 fw-bold" id="totalPendapatan">Rp0</h3></div>
                  <div class="bg-danger bg-opacity-10 p-3 rounded-circle"><i class="ti ti-currency-dollar fs-4 text-danger"></i></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tombol aksi cepat -->
          <div class="d-flex gap-3 mb-4">
            <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#modalInputProduk"><i class="ti ti-plus me-1"></i> Input Produk Baru</button>
          </div>

          <!-- ========== FITUR DASHBOARD: PRODUK TERBARU & STOK MENIPIS ========== -->
          <div class="row mt-3">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title-custom mb-0">🆕 Produk Terbaru</h5>
                    <a href="produk.php" class="text-primary small">Lihat semua</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-sm table-borderless table-small">
                      <thead class="text-muted"><tr><th>Nama Produk</th><th>Harga</th><th>Stok</th></tr></thead>
                      <tbody id="daftarProdukTerbaru">
                        <tr><td colspan="3" class="text-center text-muted">Belum ada produk</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          <!-- ========== FITUR DASHBOARD: PESANAN TERBARU ========== -->
          <div class="row mt-3">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title-custom mb-0">📦 Pesanan Terbaru</h5>
                    <a href="pesanan.php" class="text-primary small">Lihat semua</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-sm table-borderless table-small">
                      <thead class="text-muted">
                        <tr><th>Pelanggan</th><th>Total</th><th>Status</th><th>Metode</th><th>Tanggal</th></tr>
                      </thead>
                      <tbody id="daftarPesananTerbaru">
                        <tr><td colspan="5" class="text-center text-muted">Belum ada pesanan</td></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="py-4 text-center"><p class="mb-0 fs-4">© 2025 Tokoku — Dashboard Penjualan Terintegrasi</p></div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL INPUT PRODUK -->
  <div class="modal fade" id="modalInputProduk" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Tambah Produk Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body"><div class="mb-3"><label class="form-label">Nama Produk</label><input type="text" id="produkNama" class="form-control"></div><div class="mb-3"><label class="form-label">Harga (Rp)</label><input type="number" id="produkHarga" class="form-control"></div><div class="mb-3"><label class="form-label">Stok</label><input type="number" id="produkStok" class="form-control"></div></div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-primary" id="simpanProdukBtn">Simpan Produk</button></div></div></div>
  </div>

  <!-- MODAL INPUT PESANAN -->
  <div class="modal fade" id="modalInputPesanan" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Tambah Pesanan & Pembayaran</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body"><div class="mb-3"><label class="form-label">Nama Pelanggan</label><input type="text" id="pesananNama" class="form-control"></div><div class="mb-3"><label class="form-label">Total Bayar (Rp)</label><input type="number" id="pesananTotal" class="form-control"></div><div class="mb-3"><label class="form-label">Status Pembayaran</label><select id="pesananStatus" class="form-select"><option value="Sukses">Sukses</option><option value="Pending">Pending</option><option value="Gagal">Gagal</option></select></div><div class="mb-3"><label class="form-label">Metode Pembayaran</label><input type="text" id="pesananMetode" class="form-control" placeholder="Transfer Bank / QRIS"></div></div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-success" id="simpanPesananBtn">Simpan Pesanan</button></div></div></div>
  </div>

  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <script>
    // ========== DATA STORAGE ==========
    let produkList = JSON.parse(localStorage.getItem('tokoku_produk')) || [];
    let pesananList = JSON.parse(localStorage.getItem('tokoku_pesanan')) || [];
    let invoiceList = JSON.parse(localStorage.getItem('tokoku_invoice')) || [];

    // Helper: format rupiah
    function formatRupiah(angka) {
      return 'Rp' + new Intl.NumberFormat('id-ID').format(angka);
    }

    // Hitung total pendapatan (dari pesanan dengan status Sukses)
    function hitungTotalPendapatan() {
      return pesananList.filter(p => p.status === 'Sukses').reduce((sum, p) => sum + p.total, 0);
    }

    // Update semua statistik & tabel dashboard
    function updateDashboard() {
      document.getElementById('totalProdukCount').innerText = produkList.length;
      document.getElementById('totalPesananCount').innerText = pesananList.length;
      document.getElementById('totalInvoiceCount').innerText = invoiceList.length;
      document.getElementById('totalPendapatan').innerText = formatRupiah(hitungTotalPendapatan());

      // Produk terbaru (5 terakhir berdasarkan createdAt)
      let produkTerbaru = [...produkList].sort((a,b) => new Date(b.createdAt) - new Date(a.createdAt)).slice(0,5);
      const tbodyProduk = document.getElementById('daftarProdukTerbaru');
      if (produkTerbaru.length === 0) {
        tbodyProduk.innerHTML = '<tr><td colspan="3" class="text-center text-muted">Belum ada produk</td></tr>';
      } else {
        tbodyProduk.innerHTML = produkTerbaru.map(p => `<tr><td>${p.nama}</td><td>${formatRupiah(p.harga)}</td><td>${p.stok}</td></tr>`).join('');
      }

      // Stok menipis (stok <= 5)
      let stokMenipis = produkList.filter(p => p.stok <= 5);
      const tbodyStok = document.getElementById('daftarStokMenipis');
      if (stokMenipis.length === 0) {
        tbodyStok.innerHTML = '<tr><td colspan="3" class="text-center text-muted">Semua stok aman</td></tr>';
      } else {
        tbodyStok.innerHTML = stokMenipis.map(p => `<tr><td>${p.nama}</td><td>${p.stok}</td><td><span class="badge bg-danger">Segera restok</span></td></tr>`).join('');
      }

      // Pesanan terbaru (5 terakhir berdasarkan tanggal)
      let pesananTerbaru = [...pesananList].sort((a,b) => new Date(b.tanggal) - new Date(a.tanggal)).slice(0,5);
      const tbodyPesanan = document.getElementById('daftarPesananTerbaru');
      if (pesananTerbaru.length === 0) {
        tbodyPesanan.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Belum ada pesanan</td></tr>';
      } else {
        tbodyPesanan.innerHTML = pesananTerbaru.map(p => `
          <tr>
            <td>${p.pelanggan}</td>
            <td>${formatRupiah(p.total)}</td>
            <td><span class="badge ${p.status === 'Sukses' ? 'bg-success' : (p.status === 'Pending' ? 'bg-warning' : 'bg-danger')}">${p.status}</span></td>
            <td>${p.metode}</td>
            <td>${new Date(p.tanggal).toLocaleDateString('id-ID')}</td>
          </tr>
        `).join('');
      }
    }

    // Tambah produk
    function tambahProduk(nama, harga, stok) {
      const newId = produkList.length > 0 ? Math.max(...produkList.map(p => p.id)) + 1 : 1;
      produkList.push({ id: newId, nama, harga: parseInt(harga), stok: parseInt(stok), createdAt: new Date().toISOString() });
      localStorage.setItem('tokoku_produk', JSON.stringify(produkList));
      updateDashboard();
    }

    // Tambah pesanan (otomatis buat invoice jika status Sukses)
    function tambahPesanan(pelanggan, total, status, metode) {
      const newId = pesananList.length > 0 ? Math.max(...pesananList.map(p => p.id)) + 1 : 1;
      const pesananBaru = { id: newId, pelanggan, total: parseInt(total), status, metode, tanggal: new Date().toISOString() };
      pesananList.push(pesananBaru);
      localStorage.setItem('tokoku_pesanan', JSON.stringify(pesananList));

      if (status === 'Sukses') {
        const newInvoiceId = invoiceList.length > 0 ? Math.max(...invoiceList.map(i => i.id)) + 1 : 1;
        invoiceList.push({ id: newInvoiceId, idPesanan: newId, pelanggan, total: parseInt(total), status: 'Lunas', tanggalInvoice: new Date().toISOString() });
        localStorage.setItem('tokoku_invoice', JSON.stringify(invoiceList));
      }
      updateDashboard();
    }

    // Event listener modal produk
    document.getElementById('simpanProdukBtn').addEventListener('click', () => {
      const nama = document.getElementById('produkNama').value.trim();
      const harga = document.getElementById('produkHarga').value;
      const stok = document.getElementById('produkStok').value;
      if (!nama || !harga || !stok) { alert('Harap isi semua field!'); return; }
      tambahProduk(nama, harga, stok);
      document.getElementById('produkNama').value = '';
      document.getElementById('produkHarga').value = '';
      document.getElementById('produkStok').value = '';
      bootstrap.Modal.getInstance(document.getElementById('modalInputProduk')).hide();
      alert(`Produk "${nama}" berhasil ditambahkan`);
    });

    // Event listener modal pesanan
    document.getElementById('simpanPesananBtn').addEventListener('click', () => {
      const nama = document.getElementById('pesananNama').value.trim();
      const total = document.getElementById('pesananTotal').value;
      const status = document.getElementById('pesananStatus').value;
      const metode = document.getElementById('pesananMetode').value.trim();
      if (!nama || !total || !metode) { alert('Harap isi semua field!'); return; }
      tambahPesanan(nama, total, status, metode);
      document.getElementById('pesananNama').value = '';
      document.getElementById('pesananTotal').value = '';
      document.getElementById('pesananMetode').value = '';
      bootstrap.Modal.getInstance(document.getElementById('modalInputPesanan')).hide();
      alert(`Pesanan dari ${nama} berhasil disimpan. ${status === 'Sukses' ? 'Invoice dibuat.' : ''}`);
    });

    // Sinkronisasi antar tab
    window.addEventListener('storage', (e) => {
      if (e.key === 'tokoku_produk') produkList = JSON.parse(e.newValue) || [];
      if (e.key === 'tokoku_pesanan') pesananList = JSON.parse(e.newValue) || [];
      if (e.key === 'tokoku_invoice') invoiceList = JSON.parse(e.newValue) || [];
      updateDashboard();
    });

    // Inisialisasi awal
    updateDashboard();
  </script>
</body>
</html>