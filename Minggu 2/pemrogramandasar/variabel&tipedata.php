<?php
$nama = "Tahta Adi Saputra";
$nim = "E41262689";
$prodi = "Teknik Informatika";
$umur = 18;
$ipk = 4.0;
$aktif = true;

$teks_aktif = $aktif ? "aktif" : "tidak_aktif";

echo "<br>";
echo "Nama             :" . $nama . "<br>";
echo "NIM              :" . $nim . "<br>";
echo "Program Studi    :" . $prodi . "<br>";
echo "Umur             :" . $umur . "<br>";
echo "IPK              :" . $ipk . "<br>";
echo "Status Mahasiswa :" . $aktif . "<br>";
echo "<br>";

var_dump($nama); echo "<br>";
var_dump($nim); echo "<br>";
var_dump($umur); echo "<br>";
var_dump($ipk); echo "<br>";
var_dump($aktif); echo "<br>";
?>
```[cite: 2]