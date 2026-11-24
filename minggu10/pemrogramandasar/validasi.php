<?php 
function e($teks) { 
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8'); 
} 
 
function ambil($kunci) { 
    $nilai = $_POST[$kunci] ?? ""; 
    return is_string($nilai) ? trim($nilai) : ""; 
} 
 
function err($errors, $k) { 
    if (isset($errors[$k])) { 
        $kelas = ($k === 'umur' && !empty($GLOBALS['umurPeringatan'])) 
? 'peringatan' : 'pesan'; 
        $ikon  = ($kelas === 'pesan') ? '&#10006;' : '&#9888;'; 
        return '<p class="' . $kelas . '" id="err-' . $k . '" 
role="alert">' 
             . $ikon . ' ' . e($errors[$k]) . '</p>'; 
    } 
    return ""; 
} 
 
$daftarKategori = [ 
 
    "Logika & Algoritma", 
    "Pengembangan Web", 
    "Desain UI/UX", 
    "Dasar Pemrograman PHP", 
]; 
$daftarPeserta = ["Individu", "Tim"]; 
 
$errors = []; 
$sukses = false; 
$umurPeringatan = false; 
$nama = $email = $hp = $umur = $github = $kategori = $peserta = ""; 
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nama     = ambil('nama'); 
    $email    = ambil('email'); 
    $hp       = ambil('hp'); 
    $umur     = ambil('umur'); 
    $github   = ambil('github'); 
    $kategori = ambil('kategori'); 
    $peserta  = ambil('peserta'); 
 
    if ($nama === "") { 
        $errors['nama'] = "Nama wajib diisi."; 
    } elseif (mb_strlen($nama, 'UTF-8') < 3 || mb_strlen($nama, 
'UTF-8') > 50) { 
        $errors['nama'] = "Nama harus 3-50 karakter (sekarang " 
                        . mb_strlen($nama, 'UTF-8') . " karakter)."; 
    } 
 
    if ($email === "") { 
 
        $errors['email'] = "Email wajib diisi."; 
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) { 
        $errors['email'] = "Format email tidak valid (contoh: 
asta@kampus.ac.id)."; 
    } 
 
    $hpBersih = str_replace([' ', '-'], '', $hp); 
    $opsiHp   = ["options" => ["regexp" => "/^08[0-9]{8,11}$/"]]; 
    if ($hp === "") { 
        $errors['hp'] = "Nomor HP wajib diisi."; 
    } elseif (filter_var($hpBersih, FILTER_VALIDATE_REGEXP, $opsiHp) 
=== false) { 
        $errors['hp'] = "Nomor HP harus diawali 08 dan 10-13 digit 
(contoh: 081234567890)."; 
    } 
 
    if ($umur === "") { 
        $errors['umur'] = "Umur wajib diisi."; 
    } elseif (filter_var($umur, FILTER_VALIDATE_INT) === false) { 
        $errors['umur'] = "Umur harus berupa angka bulat, contoh: 18."; 
    } else { 
        $opsiUmur = ["options" => ["min_range" => 17, "max_range" => 
19]]; 
        if (filter_var($umur, FILTER_VALIDATE_INT, $opsiUmur) === 
false) { 
            $umurPeringatan = true; 
            $errors['umur'] = "Peringatan: umur " . (int)$umur . " 
tahun di luar rentang. " 
                            . "Lomba ini hanya untuk peserta 17-19 
tahun, " 
                            . "sehingga pendaftaran tidak bisa 
disimpan."; 
 
        } 
    } 
 
    if ($github !== "") { 
        if (filter_var($github, FILTER_VALIDATE_URL) === false) { 
            $errors['github'] = "URL tidak valid (contoh: 
https://github.com/username/proyek)."; 
        } else { 
            $skema = strtolower((string) parse_url($github, 
PHP_URL_SCHEME)); 
            $host  = strtolower((string) parse_url($github, 
PHP_URL_HOST)); 
            if (!in_array($skema, ["http", "https"], true)) { 
                $errors['github'] = "URL hanya boleh memakai http atau 
https."; 
            } elseif (!in_array($host, ["github.com", 
"www.github.com"], true)) { 
                $errors['github'] = "URL harus mengarah ke 
github.com."; 
            } 
        } 
    } 
 
    if (!in_array($kategori, $daftarKategori, true)) { 
        $errors['kategori'] = "Pilih kategori lomba yang tersedia."; 
    } 
    if (!in_array($peserta, $daftarPeserta, true)) { 
        $errors['peserta'] = "Pilih jenis peserta (Individu atau 
Tim)."; 
    } 
 
    $sukses = empty($errors); 
 
} 
 
$jumlahError = count($errors); 
?> 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>Registrasi Lomba Coding | Ujian Ksatria Sihir</title> 
<style> 
  :root { 
    --bg: #0a0c0f; 
    --panel: #12161b; 
    --panel-2: #181e25; 
    --garis: #2a323b; 
    --teks: #eef2f5; 
    --redup: #9aa7b2; 
    --hijau: #3ddc84; 
    --emas: #f5c451; 
    --merah: #ff6b6b; 
    --kuning: #ffb020; 
  } 
  * { box-sizing: border-box; } 
  html { scroll-behavior: smooth; } 
  body { 
    margin: 0; 
    min-height: 100vh; 
    font-family: "Segoe UI", system-ui, -apple-system, Roboto, Arial, 
sans-serif; 
 
    color: var(--teks); 
    line-height: 1.55; 
 
    background: 
      radial-gradient(900px 500px at 15% -10%, rgba(61,220,132,.18), 
transparent 60%), 
      radial-gradient(800px 500px at 100% 10%, rgba(245,196,81,.12), 
transparent 60%), 
      linear-gradient(rgba(10,12,15,.72), rgba(10,12,15,.9)), 
      url("bg-blackclover.jpg") center / cover no-repeat fixed, 
      var(--bg); 
    padding: 24px 16px 56px; 
  } 
  .bungkus { max-width: 720px; margin: 0 auto; } 
 
  header { text-align: center; padding: 8px 0 22px; } 
  header svg { width: 84px; height: 84px; filter: drop-shadow(0 0 14px 
rgba(61,220,132,.55)); } 
  .lencana { 
    display: inline-block; margin-top: 6px; padding: 3px 12px; 
    font-size: .78rem; letter-spacing: .12em; text-transform: 
uppercase; 
    color: var(--emas); border: 1px solid rgba(245,196,81,.5); 
border-radius: 999px; 
  } 
  h1 { margin: 10px 0 6px; font-size: clamp(1.7rem, 5vw, 2.4rem); 
letter-spacing: .01em; } 
  h1 span { color: var(--hijau); } 
  .sub { margin: 0 auto; max-width: 520px; color: var(--redup); } 
 
  .kartu { 
 
    background: linear-gradient(180deg, var(--panel-2), var(--panel)); 
    border: 1px solid var(--garis); 
    border-top: 3px solid var(--hijau); 
    border-radius: 16px; 
    padding: 26px 22px; 
    box-shadow: 0 18px 50px rgba(0,0,0,.45); 
  } 
  .info-umum { 
    display: flex; flex-wrap: wrap; gap: 8px; margin: 0 0 20px; 
padding: 0; list-style: none; 
  } 
  .info-umum li { 
    font-size: .85rem; color: var(--redup); 
    background: rgba(255,255,255,.04); border: 1px solid var(--garis); 
    border-radius: 999px; padding: 4px 12px; 
  } 
  .info-umum b { color: var(--emas); font-weight: 600; } 
 
  .ringkasan { 
    background: rgba(255,107,107,.1); border: 1px solid 
rgba(255,107,107,.5); 
    border-radius: 12px; padding: 14px 16px; margin-bottom: 20px; 
  } 
  .ringkasan strong { color: var(--merah); } 
  .ringkasan ul { margin: 8px 0 0; padding-left: 20px; } 
  .ringkasan a { color: var(--teks); } 
 
  .field { margin-bottom: 20px; } 
  label, .judul-field { display: block; font-weight: 600; 
margin-bottom: 6px; } 
 
  .wajib { color: var(--merah); margin-left: 2px; } 
  .opsional { color: var(--redup); font-weight: 400; font-size: .85rem; 
} 
  .bantuan { margin: 5px 0 0; font-size: .83rem; color: var(--redup); } 
 
  input[type=text], input[type=email], input[type=tel], 
input[type=url], select { 
    width: 100%; padding: 12px 14px; font: inherit; color: var(--teks); 
    background: #0d1115; border: 1.5px solid var(--garis); 
border-radius: 10px; 
    transition: border-color .15s, box-shadow .15s; 
  } 
  select { cursor: pointer; } 
  input::placeholder { color: #5d6a75; } 
  input:focus, select:focus { 
    outline: none; border-color: var(--hijau); box-shadow: 0 0 0 3px 
rgba(61,220,132,.25); 
  } 
  .ada-error input, .ada-error select { border-color: var(--merah); } 
  .ada-peringatan input { border-color: var(--kuning); } 
 
  .pesan, .peringatan { margin: 7px 0 0; font-size: .88rem; } 
  .pesan { color: var(--merah); } 
  .peringatan { color: var(--kuning); } 
 
  .baris { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; } 
  .hitung { float: right; font-weight: 400; font-size: .8rem; color: 
var(--redup); } 
 
  .pilihan { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; 
} 
 
  .pilihan > div { position: relative; } 
  .pilihan input { position: absolute; opacity: 0; pointer-events: 
none; } 
  .pilihan label { 
    margin: 0; cursor: pointer; padding: 14px; text-align: center; 
    background: #0d1115; border: 1.5px solid var(--garis); 
border-radius: 12px; 
    transition: border-color .15s, background .15s; 
  } 
  .pilihan label small { display: block; font-weight: 400; color: 
var(--redup); } 
  .pilihan label:hover { border-color: var(--emas); } 
  .pilihan input:checked + label { 
    border-color: var(--hijau); background: rgba(61,220,132,.1); 
    box-shadow: 0 0 0 1px var(--hijau) inset; 
  } 
  .pilihan input:focus-visible + label { box-shadow: 0 0 0 3px 
rgba(61,220,132,.35); } 
  .ada-error .pilihan label { border-color: var(--merah); } 
 
  .aksi { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 8px; } 
  button, .tombol { 
    font: inherit; font-weight: 700; cursor: pointer; text-decoration: 
none; 
    padding: 13px 22px; border-radius: 10px; border: 0; text-align: 
center; 
  } 
  .utama { 
    flex: 1 1 220px; color: #06210f; 
    background: linear-gradient(90deg, var(--hijau), #8bf0b3); 
    transition: transform .12s, box-shadow .12s; 
 
  } 
  .utama:hover { transform: translateY(-2px); box-shadow: 0 8px 22px 
rgba(61,220,132,.35); } 
  .sekunder { color: var(--teks); background: transparent; border: 
1.5px solid var(--garis); } 
  .sekunder:hover { border-color: var(--emas); color: var(--emas); } 
 
  .grimoire { text-align: center; } 
  .grimoire h2 { margin: 6px 0 4px; color: var(--emas); } 
  .data { text-align: left; margin: 20px 0; border: 1px solid 
var(--garis); border-radius: 12px; overflow: hidden; } 
  .data div { display: flex; gap: 12px; padding: 11px 14px; 
border-bottom: 1px solid var(--garis); } 
  .data div:last-child { border-bottom: 0; } 
  .data dt { flex: 0 0 130px; color: var(--redup); } 
  .data dd { margin: 0; word-break: break-word; } 
 
  footer { text-align: center; margin-top: 22px; font-size: .82rem; 
color: var(--redup); } 
 
  @media (max-width: 560px) { 
    .baris, .pilihan { grid-template-columns: 1fr; } 
    .kartu { padding: 22px 16px; } 
    .data div { flex-direction: column; gap: 2px; } 
  } 
  @media (prefers-reduced-motion: reduce) { 
    * { transition: none !important; scroll-behavior: auto !important; 
} 
  } 
</style> 
</head> 
 
<body> 
<div class="bungkus"> 
 
  <header> 
 
    <svg viewBox="-50 -50 100 100" role="img" aria-label="Semanggi daun 
lima"> 
      <g fill="#3ddc84"> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(0)"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(72)"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(144)"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(216)"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(288)"/> 
      </g> 
      <circle r="6" fill="#0a0c0f"/> 
      <circle r="3" fill="#f5c451"/> 
    </svg><br> 
    <span class="lencana">Magic Knights Code Exam</span> 
    <h1>Registrasi <span>Lomba Coding</span></h1> 
    <p class="sub">Jadi Kaisar Sihir dimulai dari satu baris kode. Isi 
grimoire pendaftaranmu di bawah ini.</p> 
  </header> 
 
<?php if ($sukses): ?> 
 
  <main class="kartu grimoire"> 
 
    <svg viewBox="-50 -50 100 100" width="64" height="64" 
aria-hidden="true"> 
      <g fill="#f5c451"> 
        <ellipse cx="0" cy="-22" rx="13" ry="21"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(72)"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(144)"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(216)"/> 
        <ellipse cx="0" cy="-22" rx="13" ry="21" 
transform="rotate(288)"/> 
      </g> 
    </svg> 
    <h2>Pendaftaran berhasil!</h2> 
    <p>Selamat bergabung, <strong><?= e($nama) ?></strong>. Grimoire-mu 
sudah tercatat.</p> 
 
    <dl class="data"> 
      <div><dt>Nama</dt><dd><?= e($nama) ?></dd></div> 
      <div><dt>Email</dt><dd><?= e($email) ?></dd></div> 
      <div><dt>Nomor HP</dt><dd><?= e($hp) ?></dd></div> 
      <div><dt>Umur</dt><dd><?= e($umur) ?> tahun</dd></div> 
      <div><dt>GitHub</dt><dd><?= $github !== "" ? e($github) : "Tidak 
diisi" ?></dd></div> 
      <div><dt>Kategori</dt><dd><?= e($kategori) ?></dd></div> 
      <div><dt>Peserta</dt><dd><?= e($peserta) ?></dd></div> 
    </dl> 
 
    <a class="tombol utama" href="<?= e($_SERVER['PHP_SELF']) 
?>">Daftarkan peserta lain</a> 
  </main> 
 
 
<?php else: ?> 
 
  <main class="kartu"> 
    <ul class="info-umum"> 
      <li>Umur peserta <b>17-19 tahun</b></li> 
      <li>Tanda <span class="wajib">*</span> = wajib diisi</li> 
      <li>GitHub boleh dikosongkan</li> 
    </ul> 
 
    <?php if ($jumlahError > 0): ?> 
      <div class="ringkasan" role="alert" id="ringkasan"> 
        <strong>Ada <?= $jumlahError ?> isian yang perlu 
diperbaiki.</strong> 
        <ul> 
          <?php foreach ($errors as $kunci => $pesan): ?> 
            <li><a href="#<?= e($kunci) ?>"><?= e($pesan) ?></a></li> 
          <?php endforeach; ?> 
        </ul> 
      </div> 
    <?php endif; ?> 
 
    <form method="post" action="" novalidate> 
 
      <div class="field <?= isset($errors['nama']) ? 'ada-error' : '' 
?>"> 
        <label for="nama">Nama lengkap <span class="wajib">*</span> 
          <span class="hitung" id="hitungNama" 
aria-hidden="true"></span></label> 
        <input type="text" id="nama" name="nama" maxlength="60" 
autocomplete="name" 
 
               placeholder="Contoh: Asta Clover" 
               value="<?= e($nama) ?>" 
               aria-describedby="bantuan-nama err-nama" 
               <?= isset($errors['nama']) ? 'aria-invalid="true"' : '' 
?>> 
        <p class="bantuan" id="bantuan-nama">3-50 karakter.</p> 
        <?= err($errors, 'nama') ?> 
      </div> 
 
      <div class="baris"> 
        <div class="field <?= isset($errors['email']) ? 'ada-error' : 
'' ?>"> 
          <label for="email">Email <span class="wajib">*</span></label> 
          <input type="email" id="email" name="email" 
autocomplete="email" 
                 placeholder="nama@kampus.ac.id" 
                 value="<?= e($email) ?>" 
                 aria-describedby="err-email" 
                 <?= isset($errors['email']) ? 'aria-invalid="true"' : 
'' ?>> 
          <?= err($errors, 'email') ?> 
        </div> 
 
        <div class="field <?= isset($errors['hp']) ? 'ada-error' : '' 
?>"> 
          <label for="hp">Nomor HP <span class="wajib">*</span></label> 
          <input type="tel" id="hp" name="hp" inputmode="numeric" 
autocomplete="tel" 
                 placeholder="081234567890" 
                 value="<?= e($hp) ?>" 
                 aria-describedby="bantuan-hp err-hp" 
 
                 <?= isset($errors['hp']) ? 'aria-invalid="true"' : '' 
?>> 
          <p class="bantuan" id="bantuan-hp">Awali 08, boleh pakai 
spasi atau tanda -</p> 
          <?= err($errors, 'hp') ?> 
        </div> 
      </div> 
 
      <div class="baris"> 
        <div class="field <?= isset($errors['umur']) ? ($umurPeringatan 
? 'ada-peringatan' : 'ada-error') : '' ?>"> 
          <label for="umur">Umur <span class="wajib">*</span></label> 
          <input type="text" id="umur" name="umur" inputmode="numeric" 
maxlength="3" 
                 placeholder="17 - 19" 
                 value="<?= e($umur) ?>" 
                 aria-describedby="bantuan-umur err-umur" 
                 <?= isset($errors['umur']) ? 'aria-invalid="true"' : 
'' ?>> 
          <p class="bantuan" id="bantuan-umur">Khusus usia 17-19 
tahun.</p> 
          <?= err($errors, 'umur') ?> 
        </div> 
 
        <div class="field <?= isset($errors['github']) ? 'ada-error' : 
'' ?>"> 
          <label for="github">Repositori GitHub <span 
class="opsional">(opsional)</span></label> 
          <input type="url" id="github" name="github" 
autocomplete="url" 
                 placeholder="https://github.com/username/proyek" 
                 value="<?= e($github) ?>" 
 
                 aria-describedby="err-github" 
                 <?= isset($errors['github']) ? 'aria-invalid="true"' : 
'' ?>> 
          <?= err($errors, 'github') ?> 
        </div> 
      </div> 
 
      <div class="field <?= isset($errors['kategori']) ? 'ada-error' : 
'' ?>"> 
        <label for="kategori">Kategori lomba <span 
class="wajib">*</span></label> 
        <select id="kategori" name="kategori" 
aria-describedby="err-kategori" 
                <?= isset($errors['kategori']) ? 'aria-invalid="true"' 
: '' ?>> 
          <option value="">-- Pilih kategori --</option> 
          <?php foreach ($daftarKategori as $k): ?> 
            <option value="<?= e($k) ?>" <?= $kategori === $k ? 
"selected" : "" ?>><?= e($k) ?></option> 
          <?php endforeach; ?> 
        </select> 
        <?= err($errors, 'kategori') ?> 
      </div> 
 
      <div class="field <?= isset($errors['peserta']) ? 'ada-error' : 
'' ?>" id="peserta"> 
        <span class="judul-field" id="judulPeserta">Jenis peserta <span 
class="wajib">*</span></span> 
        <div class="pilihan" role="radiogroup" 
aria-labelledby="judulPeserta"> 
          <?php 
          $ketPeserta = ["Individu" => "Berjuang sendiri", "Tim" => 
"Satu skuad ksatria"]; 
 
          foreach ($daftarPeserta as $p): 
              $id = "peserta_" . strtolower($p); 
          ?> 
            <div> 
              <input type="radio" id="<?= e($id) ?>" name="peserta" 
value="<?= e($p) ?>" 
                     <?= $peserta === $p ? "checked" : "" ?>> 
              <label for="<?= e($id) ?>"><?= e($p) ?><small><?= 
e($ketPeserta[$p]) ?></small></label> 
            </div> 
          <?php endforeach; ?> 
        </div> 
        <?= err($errors, 'peserta') ?> 
      </div> 
 
      <div class="aksi"> 
        <button type="submit" class="utama">Kirim Pendaftaran</button> 
        <a class="tombol sekunder" href="<?= e($_SERVER['PHP_SELF']) 
?>">Kosongkan</a> 
      </div> 
    </form> 
  </main> 
 
<?php endif; ?> 
 
  <footer>Tugas Pertemuan 10 &middot; Validasi Form dengan filter_var() 
&middot; Teknik Informatika</footer> 
</div> 
 
<script> 
  var nama = document.getElementById('nama'); 
 
var hitung = document.getElementById('hitungNama'); 
if (nama && hitung) { 
var perbarui = function () { hitung.textContent = 
nama.value.trim().length + '/50'; }; 
nama.addEventListener('input', perbarui); 
perbarui(); 
} 
var ringkasan = document.getElementById('ringkasan'); 
if (ringkasan) { ringkasan.scrollIntoView({ block: 'center' }); } 
</script> 
</body> 
</html>