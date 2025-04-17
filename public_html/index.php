<?php
require 'function.php';
//require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.php">Grosiran Snack</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>

    <!-- Tombol Toggle Dark Mode -->
    <div class="ms-auto me-3">
        <button id="toggleDarkMode" class="btn btn-sm btn-outline-light">
            <i class="fas fa-moon"></i>
        </button>
    </div>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">DASHBOARD</div>
                    <a class="nav-link" href="index.php"><div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>Stock Barang</a>
                    <a class="nav-link" href="masuk.php"><div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-down"></i></div>Barang Masuk</a>
                    <a class="nav-link" href="keluar.php"><div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-up"></i></div>Barang Keluar</a>
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Stok Barang</h1>
                <div class="card mb-4 shadow-sm rounded-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <div><i class="fas fa-boxes me-2"></i>Manajemen Stok Barang</div>
                        <div>
                            <button type="button" class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-plus"></i> Tambah Barang
                            </button>
                            <a href="export.php" class="btn btn-info btn-sm"><i class="fas fa-file-export"></i> Export Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $ambildatastock = mysqli_query($conn,"SELECT * FROM stock WHERE stock < 5");
                        while ($fetch = mysqli_fetch_array($ambildatastock)) {
                            $barang = $fetch['namabarang'];
                        ?>
                        <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <div><strong>Perhatian!</strong> Stok <?= $barang; ?> Hampir Habis</div>
                        </div>
                        <?php } ?>
                        <div class="table-responsive mt-4">
                            <table class="table table-hover table-striped table-bordered" id="mauexport" width="100%" cellspacing="0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi</th>
                                        <th>Stock/Box</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM stock");
                                    $i = 1;
                                    while($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                        $namabarang = $data['namabarang'];
                                        $deskripsi = $data['deskripsi'];
                                        $stock = $data['stock'];
                                        $idb = $data['idbarang'];
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $namabarang; ?></td>
                                        <td><?= $deskripsi; ?></td>
                                        <td><?= $stock; ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $idb; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idb; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?= $idb; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h4 class="modal-title text-dark">Edit Barang</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control" required><br>
                                                        <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" class="form-control" required><br>
                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                        <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete<?= $idb; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <strong><?= $namabarang; ?></strong>?
                                                        <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                        <br><br>
                                                        <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-3 mt-auto bg-dark text-white text-center">
            <div class="container">
                <small>&copy; <?= date('Y'); ?> Grosiran Snack. All rights reserved.</small>
            </div>
        </footer>
    </div>
</div>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script src="js/datatables-simple-demo.js"></script>

<!-- SCRIPT TOGGLE DARK MODE -->
<script>
    const toggleBtn = document.getElementById('toggleDarkMode');
    toggleBtn.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');

        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
            toggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
        } else {
            localStorage.setItem('dark-mode', 'disabled');
            toggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
        }
    });

    window.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.body.classList.add('dark-mode');
            toggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
        }
    });
</script>

<!-- MODAL TAMBAH BARANG -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Tambah Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required><br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi barang" class="form-control" required><br>
                    <input type="number" name="stock" placeholder="Stock" class="form-control" required><br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
