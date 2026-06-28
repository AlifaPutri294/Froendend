<?php
include 'koneksi.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tokoku - Admin Invoice</title>
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
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Nama</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">No HP</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Alamat</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Kurir</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Total Tagihan</th>
                        <th scope="col" class="px-3 py-3 text-dark fw-semibold">Tanggal Pesanan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM pesanan ORDER BY id_pesanan DESC";
                      $result = mysqli_query($koneksi, $query);

                      if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td class="px-3 py-3 fw-medium"><?php echo htmlspecialchars($row['nama_penerima']); ?></td>
                        <td class="px-3 py-3 fw-medium"><?php echo htmlspecialchars($row['no_telp']); ?></td>
                        <td class="px-3 py-3 fw-medium" style="white-space: normal; max-width: 200px;"><?php echo htmlspecialchars($row['alamat_penerima']); ?></td>
                        <td class="px-3 py-3 text-uppercase fw-semibold text-primary"><?php echo htmlspecialchars($row['ekspedisi']); ?></td>
                        <td class="px-3 py-3 fw-bold">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td class="px-3 py-3"><?php echo date('d/m/y H:i', strtotime($row['tanggal_pesanan'])); ?> WIB</td>
                      </tr>
                      <?php
                          }
                      } else {
                          echo "<tr><td colspan='6' class='text-center py-3 text-muted'>Belum ada rincian invoice.</td></tr>";
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
</html>