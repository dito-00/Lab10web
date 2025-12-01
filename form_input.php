<?php
include "form.php";
include "database.php";

echo "<h2>Form Input Mahasiswa</h2>";

$form = new Form("simpan.php", "Simpan Data");
$form->addField("nim", "NIM");
$form->addField("nama", "Nama");
$form->addField("alamat", "Alamat");

$form->displayForm();
?>