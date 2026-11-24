<?php
$tugas = 80;
$uts = 75;
$uas = 90;

$nilaiakhir = 
    ($tugas * 0.30) +
    ($uts * 0.30) +
    ($uas * 0.40);

echo "Nilai Tugas : " . $tugas . "<br>";
echo "Nilai UTS   : " . $uts . "<br>";
echo "Nilai UAS   : " . $uas . "<br>";
echo "Nilai Akhir : " . $nilaiakhir . "<br>";
var_dump($nilaiakhir >= 75);

?>
```[cite: 3]