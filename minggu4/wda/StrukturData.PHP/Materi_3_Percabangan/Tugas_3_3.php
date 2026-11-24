<?php
$nama = "Tahta Adi Saputra"; 
$nilai = 82;

if ($nilai >= 85 && $nilai <= 100) {
    $predikat = "Sangat Baik";
} elseif ($nilai >= 70 && $nilai <= 84) {
    $predikat = "Baik";
} elseif ($nilai >= 60 && $nilai <= 69) {
    $predikat = "Cukup";
} elseif ($nilai >= 50 && $nilai <= 59) {
    $predikat = "Kurang";
} else {
    $predikat = "Sangat Kurang";
}

echo "Nama: " . $nama . "<br>";
echo "Nilai: " . $nilai . "<br>";
echo "Predikat: " . $predikat;
?>