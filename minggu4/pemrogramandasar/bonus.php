<?php 
 
$nomor = 3; 
 
switch ($nomor) { 
    case 1: 
        $namaHari = "Senin"; 
        break; 
    case 2: 
        $namaHari = "Selasa"; 
        break; 
    case 3: 
        $namaHari = "Rabu"; 
        break; 
    case 4: 
        $namaHari = "Kamis"; 
        break; 
    case 5: 
        $namaHari = "Jumat"; 
        break; 
    case 6: 
        $namaHari = "Sabtu"; 
break; 
case 7: 
$namaHari = "Minggu"; 
break; 
default: 
$namaHari = "Nomor tidak valid! Masukkan angka 1 sampai 7."; 
break; 
} 
echo "Nomor : $nomor\n"; 
echo "Hari  : $namaHari\n"; 
?>