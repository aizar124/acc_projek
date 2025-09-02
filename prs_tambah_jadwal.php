<?php
include "koneksi.php";

$id_movies = $_POST['id_movies'];


if(isset($_POST['tanggal'],$_POST['id_movies'],$_POST['tanggal_awal'])){
    if(empty($_POST['tanggal']) || empty($_POST['tanggal_awal'])){

    }else{
        $tanggal = $_POST['tanggal'];
        $tanggal_awal = $_POST['tanggal_awal'];
        // Hapus tanggal lama dari movie yang sama
        $sql1= "DELETE FROM jadwal_waktu WHERE id_movies = $id_movies";
        $query1 = mysqli_query($koneksi,$sql1);

        // Simpan tanggal baru
        $sql2 = "INSERT INTO jadwal_waktu (id_movies, tanggal,tanggal_mulai) VALUES ($id_movies, '$tanggal','$tanggal_awal')";
        $query2 = mysqli_query($koneksi,$sql2);
    }
    

}
if(isset($_POST['waktu'],$_POST['id_movies'])){
    
        $sql3 = "DELETE FROM tbl_waktu WHERE id_movies='$id_movies'";
        $query3 = mysqli_query($koneksi,$sql3);
        $waktu = $_POST['waktu'];
        for ($i = 0; $i < count($waktu); $i++) {
            $sql = "INSERT INTO tbl_waktu (waktu,id_movies) VALUES ('$waktu[$i]','$id_movies')";
            $query = mysqli_query($koneksi,$sql);
            echo $waktu[$i];
        }
    
    
}



if($query){
    header("location:admin_azfa.php?tambah_jadwal=sukses");
}else{
    header("location:admin_azfa.php?tambah_jadwal=gagal");
}

?>