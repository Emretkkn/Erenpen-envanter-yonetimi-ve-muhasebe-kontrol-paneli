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
            <li><a href="islerim.php" class=""><i class="lnr lnr-cog"></i><span>İşlerim</span></a></li>
            <li><a href="malzemeler.php" class="active"><i class="fa fa-wrench"></i><span>Malzemeler</span></a></li>
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
          <div class="col-md-12">
  					<div class="panel panel-headline">
  						<div class="panel-heading">
  							<h2 class="panel-title"><b>Malzeme Özellikleri</h2>
  						</div>
  						<div class="panel-body">
               <div class="container-fluid">
                <div class="row">
                    <div class="col">
                   <form action="" method="post">
                    <table class="table">
                            <td>Malzeme Türü :</td>
                            <td><input name="türr" class="form-control" ></textarea></td>
                            <td><input class="btn btn-primary"  type="submit" value="Ekle"></td>
                        </tr>


                            <td>Malzeme Rengi :</td>
                            <td><input name="renkk" class="form-control" ></textarea></td>
                            <td><input class="btn btn-primary"  type="submit" value="Ekle"></td>
                        </tr>


                            <td>Malzeme Birimi :</td>
                            <td><input name="birimm" class="form-control" ></textarea></td>
                            <td><input class="btn btn-primary"  type="submit" value="Ekle"></td>
                        </tr>
                    </table>
                    </form>
                  <?php

                    if ($_POST) {
                      $türr = $_POST['türr'];
                      $renkk = $_POST['renkk'];
                      $birimm = $_POST['birimm'];
                        if ($_POST['türr']) {

                          if ($türr<>"") {
                            if ($conn->query("INSERT INTO m_tur (m_tur_ad) VALUES ('$türr')"))
                            {
                                echo "Tür Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                            }
                            else
                            {
                                echo "Hata oluştu";
                            }

                          }
                        }


                          if ($renkk<>"") {
                            if ($conn->query("INSERT INTO m_renk (m_renk_ad) VALUES ('$renkk')"))
                            {
                                echo "Renk Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                            }
                            else
                            {
                                echo "Hata oluştu";
                            }

                          }



                          if ($birimm<>"") {
                            if ($conn->query("INSERT INTO m_birim (m_birim_ad) VALUES ('$birimm')"))
                            {
                                echo "Birim Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
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
        <div class="col-md-4">
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Türler</h2>
						</div>
						<div class="panel-body">
              <div class="container-fluid">
              <div class="col"></div>
                <table class="table">

                    <tr>
                        <th>Tür Adı</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT * FROM m_tur"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $mturid = $sonuc['m_tur_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $mturad = $sonuc['m_tur_ad'];


                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $mturad; ?></td>
                        <td><a href="mtursil.php?m_tur_id=<?php echo $mturid; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Renkler</h2>
						</div>
						<div class="panel-body">
              <div class="container-fluid">
              <div class="col"></div>
                <table class="table">

                    <tr>
                        <th>Renk Adı</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT * FROM m_renk"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $mrenkid = $sonuc['m_renk_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $mrenkad = $sonuc['m_renk_ad'];


                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $mrenkad; ?></td>
                        <td><a href="mrenksil.php?m_renk_id=<?php echo $mrenkid; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Birimler</h2>
						</div>
						<div class="panel-body">
              <div class="container-fluid">
              <div class="col"></div>
                <table class="table">

                    <tr>
                        <th>Birim Adı</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT * FROM m_birim"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $mbirimid = $sonuc['birim_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $mbirimad = $sonuc['m_birim_ad'];


                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $mbirimad; ?></td>
                        <td><a href="mbirimsil.php?birim_id=<?php echo $mbirimid; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
              </div>
            </div>
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
