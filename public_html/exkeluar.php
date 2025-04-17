<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Barang Keluar</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <style>
    body.dark-mode {
        background-color: #121212;
        color: #e0e0e0;
    }
    .dark-mode .table {
        background-color: #1f1f1f;
        color: #fff;
    }
    .dark-mode .table thead {
        background-color: #343a40;
        color: #fff;
    }
    .dark-mode .btn {
        color: #fff;
    }
    .dark-toggle {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }
  </style>
</head>

<body>
<!-- Tombol Dark Mode -->
<div class="dark-toggle">
    <button id="toggleDarkMode" class="btn btn-sm btn-dark">
        <i class="fas fa-moon"></i>
    </button>
</div>

<div class="container mt-5">
    <h2>Barang Keluar</h2>
    <h4>(Inventory)</h4>
    <div class="data-tables datatable-dark mt-4">
        <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Penerima</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang = k.idbarang");
                while($data = mysqli_fetch_array($ambilsemuadatastock)){
                    $tanggal = $data['tanggal'];
                    $namabarang = $data['namabarang'];
                    $qty = $data['qty'];
                    $penerima = $data['penerima'];
                ?>
                <tr>
                    <td><?= $tanggal; ?></td>
                    <td><?= $namabarang; ?></td>
                    <td><?= $qty; ?></td>
                    <td><?= $penerima; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTables & Export -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<!-- Inisialisasi DataTables -->
<script>
$(document).ready(function() {
    $('#mauexport').DataTable({
        dom: 'Bfrtip',
        buttons: ['csv', 'excel', 'pdf', 'print']
    });
});
</script>

<!-- Script Dark Mode -->
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

</body>
</html>
