<?php
include "koneksi.php";
session_start();

$username = $_SESSION['username'];
$sql3 = "SELECT id_users FROM users WHERE username= '$username'";
$query3 = mysqli_query($koneksi, $sql3);
$id_users = mysqli_fetch_assoc($query3);
$id_user = $id_users['id_users'];
$kursi = $_POST['kursi'];
$id_movies = $_POST['id_movies'];
$waktu= $_POST['waktu'];
$tanggal = $_POST['tanggal'];
$total = $_POST['total'];
$price = $_POST['price'];

$tempat_gmbr = "bukti_pembayaran/";
$nama_random = uniqid().".jpg";
$target_file = $tempat_gmbr . $nama_random;
$syaratUPLD = 1;

// check apakah gambar itu betul gambar atau bukan
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["payment_proof"]["tmp_name"]);
  if($check == true) {
    $syaratUPLD = 1;
  } else {
    
    $syaratUPLD = 0;
  }
}



// Check apakah $syaratUPLD ada 0 nya
if ($syaratUPLD == 0) {
// jika semua ok, lanjut upload filenya
} else {
  if (move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $target_file)) {
    
    echo "The file ". htmlspecialchars( basename( $_FILES["payment_proof"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
$method_payments = $_POST['payment_method'];
$datetime = date('Y-m-d H:i:s');
$sql4 = "INSERT INTO payments (payment_date,total_price,mtd_payments,mtd_image,id_users) VALUES ('$datetime','$total','$method_payments','$nama_random','$id_user')";
$query4 = mysqli_query($koneksi,$sql4);
$sql5 = "SELECT id_payments FROM payments ORDER BY id_payments DESC";
$query5 = mysqli_query($koneksi,$sql5);
while($payments = mysqli_fetch_assoc($query5)){
    $id_payments = $payments['id_payments'];
    break;
}


foreach ($kursi as $item) {
        $nm_kursi = [
    '1' => 'A1', '2' => 'A2', '3' => 'A3', '4' => 'A4', '5' => 'A5', '6' => 'A6', '7' => 'A7', '8' => 'A8', '9' => 'A9', '10' => 'A10',
     '11' => 'A11', '12' => 'A12', '13' => 'B1', '14' => 'B2', '15' => 'B3', '16' => 'B4', '17' => 'B5', '18' => 'B6', '19' => 'B7', '20' => 'B8', 
     '21' => 'B9', '22' => 'B10', '23' => 'B11', '24' => 'B12', '25' => 'B13' , '26' => 'B14', '27' => 'C1', '28' => 'C2', '29' => 'C3',
     '30' => 'C4', '31' => 'C5', '32' => 'C6', '33' => 'C7', '34' => 'C8', '35' => 'C9', '36' => 'C10', '37' => 'C11', '38' => 'C12',
     '39' => 'D1', '40' => 'D2', '41' => 'D3', '42' => 'D4', '43' => 'D5', '44' => 'D6', '45' => 'D7', '46' => 'D8', '47' => 'D9', 
     '48' => 'D10', '49' => 'D11', '50' => 'E1', '51' => 'E2', '52' => 'E3', '53' => 'E4', '54' => 'E5', '55' => 'E6', '56' => 'E7', 
     '57' => 'E8', '58' => 'E9', '59' => 'E10', '60' => 'E11' , '61' => 'E12', '62' => 'E13'
];
        $namesi = $nm_kursi[$item];
        $sql = "INSERT INTO bookings (id_users,seats_booked,price,booking_date,booking_time,id_movies,id_payments,kursi) VALUES ('$id_user','$item','$price','$tanggal','$waktu','$id_movies','$id_payments','$namesi')";;
        $query = mysqli_query($koneksi,$sql);
        $sql2 = "SELECT * FROM bookings ORDER BY id_bookings DESC ";
        $query2 = mysqli_query($koneksi,$sql2);
        while($bookings = mysqli_fetch_assoc($query2)){
            $id_bookings[] = $bookings['id_bookings'];
            break;
        }
        $bangku[] = $item;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="formku" action="print_tiket.php" method="post">
        <input type="hidden" name="id_movies" value="<?= $id_movies ?>">
        <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
        <input type="hidden" name="waktu" value="<?= $waktu ?>" >
        <input type="hidden" name="total" value="<?= $total ?>">
        <input type="hidden" name="method_payments" value="<?= $method_payments ?>">
        <?php foreach($bangku as $chair){ ?>
            <input type="hidden" name="kursi[]" value="<?= $chair ?>">
        <?php } ?>
        <?php foreach($id_bookings as $id){?>
            <input type="hidden" name="id_bookings[]" value="<?= $id ?>">
        <?php } ?>
    </form>

    <script>
    document.getElementById("formku").submit();
    </script>
</body>
</html>
