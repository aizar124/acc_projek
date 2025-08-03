<?php
include "koneksi.php";
session_start();


$username = $_SESSION['username'];
$sql2 = "SELECT id_users FROM users WHERE username='$username'";
$query2 = mysqli_query($koneksi,$sql2);
$users = mysqli_fetch_assoc($query2);
$user = $users['id_users'];

$sql = "SELECT  m.id_movies,m.title, m.poster_image, b.total_price, b.status, p.mtd_payments, b.id_bookings FROM bookings b
        JOIN movies m ON b.id_movies = m.id_movies JOIN payments p ON p.id_payments = b.id_payments WHERE b.id_users = '$user'";
$query = mysqli_query($koneksi,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      .main {
  margin: 0px 50px 0px 50px;
  font-family: 'Poppins', system-ui, -apple-system, sans-serif;

}
@font-face {
  src: url('font/BalsamiqSans.ttf') format('truetype');
  font-family: 'BalsamiqSans';
}
      :root {
  --primary:rgb(252, 5, 5);
  --primary-dark:rgb(255, 16, 16);
  --primary-light: #ff3d3d;
  --secondary: #1a1a2e;
  --accent: #ffd700;
  --text: #333;
  --text-light: #777;
  --bg: #f8f9fa;
  --card-bg: #ffffff;
  --border: rgba(0,0,0,0.1);
  --shadow: 0 20px 50px rgba(209, 0, 0, 0.15);
  --transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px) scale(0.95); }
  to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes slideIn {
  from { transform: translateX(-30px); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-8px); }
  100% { transform: translateY(0px); }
}

@keyframes scaleIn {
  0% { transform: scale(0.95); opacity: 0; }
  100% { transform: scale(1); opacity: 1; }
}
@keyframes slideInItem {
  0% {
    opacity: 0;
    transform: translateX(10px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}
        /* === NAVBAR === */
    header {
      background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
      color: white;
      padding: 25px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
      border-radius: 0 0 30px 30px;
      box-shadow: 0 10px 30px rgba(198, 40, 40, 0.3);
      animation: navFadeIn 1s ease-in-out;
      font-family: 'BalsamiqSans';
    }

    @keyframes navFadeIn {
      0% { opacity: 0; transform: translateY(-50px) scale(0.9); }
      100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .logo {
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 28px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.03);
    }

    .logo img {
      margin-right: 10px;
      height: 50px;
      width: auto;
      filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.3));
    }

    nav a {
      margin: 0 18px;
      text-decoration: none;
      color: white;
      font-weight: bold;
      font-size: 18px;
      position: relative;
      transition: all 0.4s ease;
      padding: 8px 12px;
      border-radius: 8px;
    }

    nav a::after {
      content: '';
      display: block;
      width: 0;
      height: 2px;
      background: white;
      transition: width 0.3s;
      position: absolute;
      bottom: -5px;
      left: 0;
    }

    nav a:hover::after {
      width: 100%;
    }

    nav a:hover {
      transform: scale(1.1);
      background: rgba(255, 255, 255, 0.1);
    }

    .profile img {
      width: 50px;
      height: 50px;
      background-size: contain;
      border-radius: 50%;
      cursor: pointer;
      transition: transform 0.3s ease;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .profile:hover img {
      transform: scale(1.1);
    }

    .profile a {
      text-decoration: none;
    }

    .dropdown {
      position: absolute;
      top: 65px;
      right: 0;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(8px);
      padding: 10px;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      z-index: 100;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .dropdown.active {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown button {
      display: block;
      background: linear-gradient(to right, #ff8a80, #ff5252);
      color: white;
      font-size: 18px;
      font-weight: 500;
      padding: 12px 20px;
      margin: 10px 0;
      width: 200px;
      border: none;
      border-radius: 12px;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown button:hover {
      background: linear-gradient(to right, #ff1744, #e53935);
      transform: scale(1.05);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* isi */
    .movie-container {
      text-align: center;
      margin-top: 30px;
    }

    .movie-container h2 {
      font-size: 2rem;
      color: #b12a2a;
      animation: fadeIn 1s ease-in-out;
    }

    .movie-card {
      background-color: #fff4f4;
      margin: 30px auto;
      padding: 25px;
      width: 95%;
      max-width: 900px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      animation: fadeInUp 0.8s ease-in-out;
    }

    .movie-jarak {
      display: flex;
      gap: 30px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .poster {
      width: 200px;
      height: 80px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .info {
      display: flex;
      justify-content: space-between;
      text-align: left;
      flex-grow: 1;
      max-width: 500px;
      margin-left: 50px;
    }

    .info h4 {
      font-size: 1.3rem;
      color: #b12a2a;
      
    }

    .info p {
      font-size: 1rem;
      line-height: 1.5;
    }

    .info button {
      margin-top: 24px;
      width: 135px;
      height: 40px;
      border-radius: 10px;
      border : 1px solid #c5c0c0ff

    }
    .info button:hover {
      cursor: pointer;
    }

    table {
  width: 100%;
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 15px;
  min-width: 800px;
  overflow: hidden;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.08);
  animation: fadeIn 0.8s ease;
  position: relative;
  z-index: 1;
}

th {
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  
  color: white;
  padding: 16px 12px;
  text-align: left;
  font-weight: 500;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  font-size: 14px;
  position: sticky;
  top: 0;
}

td {
  padding: 14px 12px;
  border-bottom: 1px solid rgba(209, 0, 0, 0.1);
  vertical-align: middle;
  color: var(--text);
  background: white;
  transition: var(--transition);
}

tr:last-child td {
  border-bottom: none;
}

tr:hover td {
  background: rgba(209, 0, 0, 0.03);
  transform: scale(1.01);
}
@media (max-width: 768px) {
  .navbar {
    padding: 20px 25px;
  }
  .navbar .logo {
    font-size: 22px;
  }
  table {
    font-size: 14px;
  }
  th, td {
    padding: 12px 8px;
  }
}

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo_web.png" alt="AZFATICKET Logo">
            AZFATICKET.XXI
        </div>
        <nav>
            <a href="home.php">MOVIE</a>
            <a href="cinema.php">CINEMA</a>
            <a href="contact_azfa.php">CONTACT</a>
        </nav>
        <div class="profile" onclick="toggleDropdown()">
        <img src="userputih.jpg" alt="">
        <div class="dropdown" id="dropdownMenu">
            <?php if(isset($_SESSION['username'])){ ?>
              <a href="profil_azfa.php"><button>Profil <?= $_SESSION['username'] ?></button></a>
              <a href="keranjang.php"><button>Riwayat Transaksi</button></a>
              <a href="logout.php"><button>Logout</button></a>
                
            <?php }else{ ?>
                <a href="login.php"><button>Sign In</button></a>
                <a href="register.php"><button>Sign Up</button></a> 
            <?php } ?>
        </div>
        </div>
        
    </header>
    <script>
    function toggleDropdown() {
      document.getElementById("dropdownMenu").classList.toggle("active");
    }

    window.onclick = function(e) {
      if (!e.target.closest('.profile')) {
        document.getElementById("dropdownMenu").classList.remove("active");
      }
    }
  </script>

  <div class="main">
    <table>
    <tr>
      <th>Judul</th>
      <th>Total Harga</th>
      <th>Status</th>
    </tr>
    <?php while($pesanan = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><h4><?= $pesanan['title'] ?></h4></td>
                  <td><h4><?= $pesanan['total_price'] ?></h4></td>
                  <td><?php if($pesanan['status']== "terverifikasi"){?>
                    <form action="tiket.php" method="post">
                      <input type="hidden" name="id_movies" value="<?= $pesanan['id_movies'] ?>">
                      <input type="hidden" name="id_bookings" value= "<?= $pesanan['id_bookings'] ?>">
                      <input type="hidden" name="mtd_payments" value= "<?= $pesanan['mtd_payments'] ?>">
                      <div class="info"><button type="submit" style="background: linear-gradient(135deg, #f44336, #c62828); color: white;"><i class="fas fa-regular fa-eye"></i> View</button></div>
                    </form>
                <?php }else{ ?>
                    <div class="info"><button><?= strtoupper($pesanan['status']) ?></button></div>
                <?php } ?></td>
                
                </tr>
              
                
    <?php } ?>
</table>
  </div>
    
  
</body>
</html>