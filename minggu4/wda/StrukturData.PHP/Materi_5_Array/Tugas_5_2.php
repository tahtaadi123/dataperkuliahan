<?php
$mahasiswa = ["Andi", "Budi", "Citra", "Dina", "Eko"];
$urutan = ["pertama", "kedua", "ketiga", "keempat", "kelima"];

for ($i = 0; $i < count($mahasiswa); $i++) {
    echo "Nama mahasiswa " . $urutan[$i] . " = " . $mahasiswa[$i] . "<br>";
}
?>