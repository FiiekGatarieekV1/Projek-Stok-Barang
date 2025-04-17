<?php
session_start();   

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_barang1");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi bantu
function sanitize($conn, $data) {
    return mysqli_real_escape_string($conn, trim($data));
}

function ambilStock($conn, $idbarang) {
    $result = mysqli_query($conn, "SELECT stock FROM stock WHERE idbarang='$idbarang'");
    $data = mysqli_fetch_array($result);
    return $data['stock'];
}

// Tambah barang
if (isset($_POST['addnewbarang'])) {
    $namabarang = sanitize($conn, $_POST['namabarang']);
    $deskripsi = sanitize($conn, $_POST['deskripsi']);
    $stock = (int) $_POST['stock'];

    $addtotable = mysqli_query($conn, "INSERT INTO stock(namabarang, deskripsi, stock) VALUES('$namabarang','$deskripsi','$stock')");
    header('Location: index.php');
}

// Tambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = sanitize($conn, $_POST['barangnya']);
    $penerima = sanitize($conn, $_POST['penerima']);
    $qty = (int) $_POST['qty'];

    $stocksekarang = ambilStock($conn, $barangnya);
    $stockbaru = $stocksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) VALUES('$barangnya','$penerima','$qty')");
    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$stockbaru' WHERE idbarang='$barangnya'");
    header('Location: masuk.php');
}

// Tambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = sanitize($conn, $_POST['barangnya']);
    $penerima = sanitize($conn, $_POST['penerima']);
    $qty = (int) $_POST['qty'];

    $stocksekarang = ambilStock($conn, $barangnya);

    if ($stocksekarang >= $qty) {
        $stockbaru = $stocksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) VALUES('$barangnya','$penerima','$qty')");
        $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$stockbaru' WHERE idbarang='$barangnya'");
        header('Location: keluar.php');
    } else {
        echo "
        <script>
          alert('Stock saat ini kurang dari $stocksekarang :(');
          window.location.href='keluar.php';
        </script>";
    }
}

// Update barang
if (isset($_POST['updatebarang'])) {
    $idb = sanitize($conn, $_POST['idb']);
    $namabarang = sanitize($conn, $_POST['namabarang']);
    $deskripsi = sanitize($conn, $_POST['deskripsi']);

    mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', deskripsi='$deskripsi' WHERE idbarang='$idb'");
    header('Location: index.php');
}

// Hapus barang
if (isset($_POST['hapusbarang'])) {
    $idb = sanitize($conn, $_POST['idb']);
    mysqli_query($conn, "DELETE FROM stock WHERE idbarang='$idb'");
    header('Location: index.php');
}

// Update barang masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = sanitize($conn, $_POST['idb']);
    $idm = sanitize($conn, $_POST['idm']);
    $keterangan = sanitize($conn, $_POST['keterangan']);
    $qty = (int) $_POST['qty'];

    $stockskrg = ambilStock($conn, $idb);

    $qmasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT qty FROM masuk WHERE idmasuk='$idm'"));
    $qtylama = $qmasuk['qty'];

    $selisih = $qty - $qtylama;
    $stockbaru = $stockskrg + $selisih;

    mysqli_query($conn, "UPDATE stock SET stock='$stockbaru' WHERE idbarang='$idb'");
    mysqli_query($conn, "UPDATE masuk SET qty='$qty', keterangan='$keterangan' WHERE idmasuk='$idm'");
    header('Location: masuk.php');
}

// Hapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = sanitize($conn, $_POST['idb']);
    $qty = (int) $_POST['qty'];
    $idm = sanitize($conn, $_POST['idm']);

    $stok = ambilStock($conn, $idb);
    $stokbaru = $stok - $qty;

    mysqli_query($conn, "UPDATE stock SET stock='$stokbaru' WHERE idbarang='$idb'");
    mysqli_query($conn, "DELETE FROM masuk WHERE idmasuk='$idm'");
    header('Location: masuk.php');
}

// Update barang keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = sanitize($conn, $_POST['idb']);
    $idk = sanitize($conn, $_POST['idk']);
    $penerima = sanitize($conn, $_POST['penerima']);
    $qty = (int) $_POST['qty'];

    $stockskrg = ambilStock($conn, $idb);
    $qkeluar = mysqli_fetch_array(mysqli_query($conn, "SELECT qty FROM keluar WHERE idkeluar='$idk'"));
    $qtylama = $qkeluar['qty'];

    $selisih = $qtylama - $qty;
    $stockbaru = $stockskrg + $selisih;

    mysqli_query($conn, "UPDATE stock SET stock='$stockbaru' WHERE idbarang='$idb'");
    mysqli_query($conn, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk'");
    header('Location: keluar.php');
}

// Hapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = sanitize($conn, $_POST['idb']);
    $qty = (int) $_POST['qty'];
    $idk = sanitize($conn, $_POST['idk']);

    $stok = ambilStock($conn, $idb);
    $stokbaru = $stok + $qty;

    mysqli_query($conn, "UPDATE stock SET stock='$stokbaru' WHERE idbarang='$idb'");
    mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idk'");
    header('Location: keluar.php');
}

// Tambah admin
if (isset($_POST['addadmin'])) {
    $email = sanitize($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO login(email, password) VALUES ('$email','$password')");
    header('Location: admin.php');
}

// Update admin
if (isset($_POST['updateadmin'])) {
    $email = sanitize($conn, $_POST['emailadmin']);
    $password = password_hash($_POST['passwordbaru'], PASSWORD_DEFAULT);
    $id = sanitize($conn, $_POST['id']);

    mysqli_query($conn, "UPDATE login SET email='$email', password='$password' WHERE iduser='$id'");
    header('Location: admin.php');
}

// Hapus admin
if (isset($_POST['hapusadmin'])) {
    $id = sanitize($conn, $_POST['id']);
    mysqli_query($conn, "DELETE FROM login WHERE iduser='$id'");
    header('Location: admin.php');
}
?>
