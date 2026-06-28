<?php
include 'koneksi.php';

// Logika admin saat mengupdate nomor resi
if (isset($_POST['update_resi'])) {
    $id_pesanan = mysqli_real_escape_string($koneksi, $_POST['id_pesanan']);
    $no_resi = mysqli_real_escape_string($koneksi, $_POST['no_resi']);
    
    $query_update = "UPDATE pesanan SET no_resi = '$no_resi', status_pesanan = 'dikemas' WHERE id_pesanan = '$id_pesanan'";
    mysqli_query($koneksi, $query_update);
    header("Location: pesanan.php");
    exit();
}

// Logika admin saat mengubah status lewat tombol aksi cepat
if (isset($_POST['ubah_status'])) {
    $id_pesanan = mysqli_real_escape_string($koneksi, $_POST['id_pesanan']);
    $status_baru = mysqli_real_escape_string($koneksi, $_POST['status_baru']);
    
    $query_status = "UPDATE pesanan SET status_pesanan = '$status_baru' WHERE id_pesanan = '$id_pesanan'";
    mysqli_query($koneksi, $query_status);
    header("Location: pesanan.php");
    exit();
}
?>
<!doctype php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tokoku - Admin Pesanan</title>
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
        <a class="d-flex justify-content-center" href="#">
          <img src="assets/images/" alt="" width="">
        </a>
      </div>

      <div class="d-lg-flex align-items-center gap-2">
        <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center"></h3>
        <div class="d-flex align-items-center justify-content-center gap-2">
          <div class="dropdown d-flex">
            <a class="btn btn-primary d-flex align-items-center gap-1 " href="javascript:void(0)" id="drop4"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="ti ti-shopping-cart fs-5"></i>
              Login
              <i class="ti ti-chevron-down fs-5"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

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
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="produk.php" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex"><i class="ti ti-aperture"></i></span>
                  <span class="hide-menu">Produk</span>
                </div>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="kategori.php" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex"><i class="ti ti-aperture"></i></span>
                  <span class="hide-menu">Kategori</span>
                </div>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="pesanan.php" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex"><i class="ti ti-shopping-cart"></i></span>
                  <span class="hide-menu">Pesanan</span>
                </div>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link justify-content-between" href="invoice.php" aria-expanded="false">
                <div class="d-flex align-items-center gap-3">
                  <span class="d-flex"><i class="ti ti-shopping-cart"></i></span>
                  <span class="hide-menu">Invoice</span>
                </div>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="body-wrapper">
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
        </nav>
      </header>

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="d-md-flex align-items-center">
                  <div>
                    <h4 class="card-title">Table Pesanan</h4>
                  </div>
                </div>
                <div class="table-responsive mt-4">
                  <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                    <thead>
                      <tr class="border-bottom bg-light">
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Tanggal Pesanan</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Total Bayar</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Status Pesanan</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Status Pembayaran</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold text-center">Tipe Pembayaran</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold text-center">No Resi / Aksi</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold text-center">Bukti Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM pesanan ORDER BY id_pesanan DESC";
                      $result = mysqli_query($koneksi, $query);

                      if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                              // Menentukan warna badge sesuai status database enum Anda
                              $badge_color = 'bg-secondary';
                              if ($row['status_pesanan'] == 'menunggu') $badge_color = 'bg-warning text-dark';
                              if ($row['status_pesanan'] == 'dikemas') $badge_color = 'bg-info text-dark';
                              if ($row['status_pesanan'] == 'diterima') $badge_color = 'bg-success';
                              if ($row['status_pesanan'] == 'batal') $badge_color = 'bg-danger';
                      ?>
                      <tr>
                        <td class="px-3 py-3 fw-medium"><?php echo date('d/m/y H:i', strtotime($row['tanggal_pesanan'])); ?></td>
                        <td class="px-3 py-3 fw-medium">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td class="px-3 py-3">
                          <span class="badge <?php echo $badge_color; ?> px-2 py-1 rounded text-uppercase mb-1 d-block text-center">
                            <?php echo htmlspecialchars($row['status_pesanan']); ?>
                          </span>
                          <form method="POST" action="" class="d-flex gap-1 justify-content-center">
                            <input type="hidden" name="id_pesanan" value="<?php echo $row['id_pesanan']; ?>">
                            <select name="status_baru" class="form-select form-select-sm py-0" style="font-size: 11px; max-width: 90px;" onchange="this.form.submit()">
                              <option value="">Pilih...</option>
                              <option value="menunggu">Menunggu</option>
                              <option value="batal">Batal</option>
                              <option value="diterima">Diterima</option>
                            </select>
                            <input type="hidden" name="ubah_status" value="1">
                          </form>
                        </td>
                        <td class="px-3 py-3 text-muted text-uppercase"><?php echo htmlspecialchars($row['status_pembayaran']); ?></td>
                        <td class="px-3 py-3 text-dark fw-medium text-center text-uppercase"><?php echo htmlspecialchars($row['tipe_pembayaran']); ?></td>
                        <td class="px-3 py-3 text-center">
                          <?php if (empty($row['no_resi'])): ?>
                            <form method="POST" action="" class="d-flex gap-1 justify-content-center">
                              <input type="hidden" name="id_pesanan" value="<?php echo $row['id_pesanan']; ?>">
                              <input type="text" name="no_resi" placeholder="Input Resi" class="form-control form-control-sm" style="max-width: 120px;" required>
                              <button type="submit" name="update_resi" class="btn btn-sm btn-primary py-1"><i class="fas fa-paper-plane"></i></button>
                            </form>
                          <?php else: ?>
                            <span class="text-success fw-bold"><i class="fas fa-check"></i> <?php echo htmlspecialchars($row['no_resi']); ?></span>
                          <?php endif; ?>
                        </td>
                        <td class="px-3 py-3 text-center">
                          <?php if(!empty($row['bukti_pembayaran'])): ?>
                            <img src="./assets/images/products/<?php echo $row['bukti_pembayaran']; ?>" class="rounded" width="45" height="45" alt="bukti" style="object-fit: cover; border: 1px solid #e9ecef;" onerror="this.src='https://placehold.co/45x45?text=📷'">
                          <?php else: ?>
                            <span class="text-muted">-</span>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <?php
                          }
                      } else {
                          echo "<tr><td colspan='7' class='text-center py-3 text-muted'>Belum ada data pesanan.</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>
</php>