<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['pass']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
	  //jika tidak ada (gagal), alihkan kembali ke halaman login
    header("location:index.php");
  }

	//menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="container">
        <div class="navbar1">
            <div class="logo">
              <img src="img/Logo Vannesa Laundry.png" alt="Logo">
              <span>Laundry<span class="vanessa">Vanessa</span></span>
            </div>
            <div class="contact">
              <div class="contact-icon">
                  <i class="fas fa-phone"></i>
              </div>
              <div class="contact-text">
                  <p>Contact Us</p>
                  <span>08XXXXXXXXXX</span>
              </div>
          </div>
      
          <button type="button" class="btn btn-primary rounded-5 fw-bold tolol" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>



          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                      <form action="" method="post">
                  <input
                    type="text"
                    name="user"
                    class="form-control my-4 py-2 rounded-4"
                    placeholder="Username"
                  />
                  <input
                    type="password"
                    name="pass"
                    class="form-control my-4 py-2 rounded-4"
                    placeholder="Password"
                  />
                  <div class="text-center my-3 d-flex gap-3">
                    <button class="btn btn-primary rounded-4">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

        </div>
            <div class="menu">
              <a href="#home">Home</a>
              <a href="#about">About</a>
              <a href="#">Service</a>
              <a href="#">Price</a>
              <a href="#">Contact</a>
            </div>
          </div>
            <section class="home" id="home">
              SELAMAT DATANG
            </section>
            <section class="about" id="about">
              <h1>MENGAPA HARUS MEMILIH KAMI</h1>
              <div class="fitur">
                  <div class="subfitur">
                      <div class="icon">
                          <i class="fas fa-bolt"></i>
                      </div>
                      <h3>Pengerjaan Cepat</h3>
                      <p>
                          Kami bekerja cepat agar pakaian Anda bersih,wangi, dan rapi dalam waktu singkat tanpa mengurangi kualitas.<br/>
                      </p>
                  </div>
                  <div class="subfitur">
                      <div class="icon">
                          <i class="fas fa-tags"></i>
                      </div>
                      <h3>Harga Terjangkau</h3>
                      <p>
                        Nikmati layanan laundry berkualitas dengan harga yang pas di kantong, cocok untuk semua kebutuhan Anda.<br/>
                      </p>
                  </div>
                  <div class="subfitur">
                      <div class="icon">
                          <i class="fas fa-shipping-fast"></i>
                      </div>
                      <h3>Pengiriman cepat</h3>
                      <p>
                        Layanan antar-jemput pakaian yang praktis dan tepat waktu, memastikan proses laundry jadi lebih mudah untuk Anda.<br/>
                      </p>
                  </div>
                  <div class="subfitur">
                      <div class="icon">
                          <i class="fas fa-award"></i>
                      </div>
                      <h3>Jaminan</h3>
                      <p>
                        Kami menjamin pakaian Anda bersih, aman, dan terawat dengan baik. Kepuasan Anda adalah prioritas kami.<br/>
                  </div>
              </div>
            </section>
            <button class="scroll-up-btn" id="scrollUpBtn">
                <i class="fas fa-arrow-up"></i>
            </button>
            <script src="script.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<?php
}
?>