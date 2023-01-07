<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>


<!doctype html>
<html lang="tr">
<?php include_once 'ortak_sayfalar/header.php'; ?>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php include_once 'ortak_sayfalar/navbar.php'?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="anasayfa.php" class=""><i class="lnr lnr-home"></i><span>Ana Sayfa</span></a></li>
            <li><a href="musteriler.php" class=""><i class="lnr lnr-users"></i><span>Müşteriler</span></a></li>
            <li><a href="firmalar.php" class=""><i class="lnr lnr-apartment"></i><span>Firmalar</span></a></li>
            <li><a href="tedarikciler.php" class=""><i class="fa fa-phone"></i><span>Tedarikçiler</span></a></li>
            <li><a href="islerim.php" class="active"><i class="lnr lnr-cog"></i><span>İşlerim</span></a></li>
            <li><a href="malzemeler.php" class=""><i class="fa fa-wrench"></i><span>Malzemeler</span></a></li>
            <li><a href="satinalim.php" class=""><i class="fa fa-shopping-basket"></i><span>Satın Alımlarım</span></a></li>
            <li><a href="satislar.php" class=""><i class="fa fa-credit-card"></i><span>Satışlar</span></a></li>
            <li><a href="borclarvealacaklar.php" class=""><i class="fa fa-money"></i><span>Borçlar ve Alacaklar</span></a></li>
            <li><a href="logout.php" class=""><i class="lnr lnr-exit"></i><span>Çıkış</span></a></li>
          </ul>
        </nav>
      </div>
    </div>


    <div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
        <div class="col">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h2 class="panel-title"><b>İş Ekle</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                 <form action="" method="post">
                  <table class="table">
                          <td>İş Adı :</td>
                          <td><input name="ad" class="form-control" ></textarea></td>
                      </tr>

                          <tr>
                          <td></td>
                          <td><input class="btn btn-primary"  type="submit" value="İş Ekle"></td>
                          </tr>

                  </table>
              </form>
              <?php

              if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                  // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $ad = $_POST['ad'];

              //yeni


                  if ($ad<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO isler (is_ad) VALUES ('$ad')"))
                      {
                          echo "İş Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                      }
                      else
                      {
                          echo "Hata oluştu";
                      }

                  }

              }

              ?>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
          <div class="panel">
						<div class="panel-heading">
							<h2 class="panel-title"><b>İşlerim</h2>
						</div>
						<div class="panel-body">
              <div class="col">

                </div>
                <table class="table">

                    <tr>
                        <th>İş Adı</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT * FROM isler"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $is_id = $sonuc['is_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $isad = $sonuc['is_ad'];


                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $isad; ?></td>
                        <td><a href="issil.php?is_id=<?php echo $is_id; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
            </div>
          </div>

					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<div class="clearfix"></div>
			<?php include_once 'ortak_sayfalar/footer.php'; ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/renault-common.js"></script>
</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
