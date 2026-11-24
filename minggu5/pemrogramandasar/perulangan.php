<?php 
 
 
$angka = 4; 
 
for ($i = 1; $i <= 10; $i++) { 
    echo "$angka x $i = " . ($angka * $i) . "<br>"; 
} 
 
 
echo "<br><br>"; 
 
 
$i = 1; 
while ($i <= 10) { 
    $keterangan = ($i % 2 == 0) ? "Genap" : "Ganjil"; 
    echo "$i = $keterangan<br>"; 
    $i++; 
} 
 
echo "<br><br>"; 
 
$j = 10; 
do { 
$keterangan = ($j % 2 == 0) ? "Genap" : "Ganjil"; 
echo "$j = $keterangan<br>"; 
$j--; 
} while ($j >= 1);