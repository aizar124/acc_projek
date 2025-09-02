<?php
include "koneksi.php";

$id_bookings = $_GET['id'];
    
    // Update status booking menjadi 'tertolak'
    foreach($id_bookings as $id_booking){
        $sql = "UPDATE bookings SET status = 'tertolak' WHERE id_bookings = '$id_booking'";
        $query = mysqli_query($koneksi, $sql);
    }
    
    
    if($query) {
        header("location:admin_azfa.php?success=1");
    } else {
        header("location:admin-azfa.php?error=1");  
    }
?>