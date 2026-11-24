<?php
$mahasiswa = ["Andi", "Budi", "Citra"];

echo "Data awal:<br>";
foreach ($mahasiswa as $nama) {
    echo $nama . "<br>";
}

// Menambahkan data baru
$mahasiswa[] = "Dina";
$mahasiswa[] = "Eko";

echo "<br>Data setelah ditambahkan:<br>";
foreach ($mahasiswa as $nama) {
    echo $nama . "<br>";
}
?>