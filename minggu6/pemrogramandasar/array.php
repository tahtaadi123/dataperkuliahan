<?php 
 
$dataMahasiswa = [ 
    [ 
        "nama" => "Andi", 
        "NIM" => "E51368990", 
        "nilai tugas" => 85, 
        "nilai UTS" => 92, 
        "nilai UAS" => 94, 
    ], 
    [ 
        "nama" => "Sando", 
        "NIM" => "E51367520", 
        "nilai tugas" => 95, 
        "nilai UTS" => 80, 
        "nilai UAS" => 86, 
    ], 
    [ 
        "nama" => "Prabowo", 
        "NIM" => "E51362142", 
        "nilai tugas" => 95, 
        "nilai UTS" => 80, 
 
        "nilai UAS" => 86, 
    ], 
    [ 
        "nama" => "Sawit", 
        "NIM" => "E51368462", 
        "nilai tugas" => 85, 
        "nilai UTS" => 80, 
        "nilai UAS" => 86, 
    ], 
    [ 
        "nama" => "Jokowi", 
        "NIM" => "E51362973", 
        "nilai tugas" => 95, 
        "nilai UTS" => 80, 
        "nilai UAS" => 96, 
    ], 
]; 
?> 
<!DOCTYPE html> 
 
<html lang="id"> 
 
<head> 
 
<meta charset="UTF-8"> 
 
<title>Data Nilai Mahasiswa</title> 
 
<style> 
    table { 
 
      border-collapse: collapse; 
      width: 100%; 
    } 
    th, 
 
    td { 
      border: 1px solid #10122b; 
      padding: 8px; 
      text-align: left; 
    } 
    th { 
      background-color: #0f346f; 
      color: white; 
    } 
    tr:nth-child(even) { 
      background-color: #70a2ff; 
    } 
</style> 
 
</head> 
 
<body> 
 
  <h2>Data Nilai Mahasiswa</h2> 
  <p>Jumlah mahasiswa: <?= count($dataMahasiswa) ?></p> 
 
  <table> 
    <thead> 
      <tr> 
        <th>No</th> 
 
        <th>Nama</th> 
        <th>NIM</th> 
        <th>Nilai Tugas</th> 
        <th>Nilai UTS</th> 
        <th>Nilai UAS</th> 
        <th>Nilai Akhir</th> 
      </tr> 
    </thead> 
    <tbody> 
 
      <?php $no = 1; ?> 
 
      <?php foreach ($dataMahasiswa as $mhs) : ?> 
        <?php 
          $nilaiAkhir = ($mhs["nilai tugas"] * 0.30) 
                      + ($mhs["nilai UTS"] * 0.30) 
                      + ($mhs["nilai UAS"] * 0.40); 
        ?> 
        <tr> 
          <td><?= $no++ ?></td> 
          <td><?= htmlspecialchars($mhs["nama"]) ?></td> 
          <td><?= htmlspecialchars($mhs["NIM"]) ?></td> 
          <td><?= $mhs["nilai tugas"] ?></td> 
          <td><?= $mhs["nilai UTS"] ?></td> 
          <td><?= $mhs["nilai UAS"] ?></td> 
          <td><?= number_format($nilaiAkhir, 2) ?></td> 
        </tr> 
 
      <?php endforeach; ?> 
 
 
</tbody> 
</table> 
</body> 
</html>