<?php
include "koneksi.php";
$id_movies = 19;

$result = $koneksi->query("SELECT tanggal,tanggal_mulai FROM jadwal_waktu WHERE id_movies = $id_movies LIMIT 1");
    $row = $result->fetch_assoc();
    $tanggal_akhir = $row ? $row['tanggal'] : null;
$id = 300;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
                  $nama_hari = [
                    'Monday' => 'SENIN', 'Tuesday' => 'SELASA', 'Wednesday' => 'RABU', 'Thursday' => 'KAMIS',
                    'Friday' => 'JUMAT', 'Saturday' => 'SABTU', 'Sunday' => 'MINGGU'
                  ];
                  $tanggal_mulai = $row['tanggal_mulai'];
                //   $tanggal_mulai = date("Y-m-d", strtotime("+1 day"));
                    // $batas_akhir = min($tanggal_akhir, date("Y-m-d", strtotime("+7 days")));
                    $selisih = (strtotime($tanggal_akhir) - strtotime($tanggal_mulai)) / (60 * 60 * 24);
                    $jumlah_hari = min(7, $selisih + 1);
                    echo "hai ".$jumlah_hari;
                for ($i = 0; $i < $jumlah_hari; $i++) {
                    $tgl = date("Y-m-d", strtotime("+$i days", strtotime($tanggal_mulai)));
                    $label = date("d/m/Y", strtotime($tgl));
                    $hari = date("l", strtotime($tgl));
                    $tanggal_hari = date("d", strtotime($tgl));
                 
            
                ?>
                  <input type="radio" id="<?= $id ?>" name="tanggal" value="<?= $tgl ?>">
                  <label for="<?= $id ?>"><?= ucfirst($nama_hari[$hari]) ?><br><?= $tanggal_hari ?></label>
<?php $id++; } ?>
</body>
</html>