<?php
include "database.php";

$db = new Database();

$data = [
    "nim"    => $_POST['nim'],
    "nama"   => $_POST['nama'],
    "alamat" => $_POST['alamat']
];

$save = $db->insert("mahasiswa", $data);

if ($save) {
    echo "Data berhasil disimpan!";
} else {
    echo "Gagal menyimpan data.";
}
?>