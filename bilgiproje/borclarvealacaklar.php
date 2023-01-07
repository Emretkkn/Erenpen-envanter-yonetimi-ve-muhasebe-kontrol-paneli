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
            <li><a href="malzemeler.php" class=""><i class="fa fa-wrench"></i><span>Malzemeler</span></a></li>
            <li><a href="satinalim.php" class=""><i class="fa fa-shopping-basket"></i><span>Satın Alımlarım</span></a></li>
            <li><a href="satislar.php" class=""><i class="fa fa-credit-card"></i><span>Satışlar</span></a></li>
            <li><a href="borclarvealacaklar.php" class="active"><i class="fa fa-money"></i><span>Borçlar ve Alacaklar</span></a></li>
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
        <div class="col-md-9">
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Tedarikçilere Borçlar</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                    <table class="table">

                        <tr>
                            <th>Tedarikçi</th>
                            <th>Borç Tutarı</th>
                            <th>Tarih</th>
                            <th>Sil</th>
                        </tr>

                    <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                    <?php



                    $sorgu = $conn->query("SELECT borclar.borc_id, borclar.tedarik_ad, concat(borclar.borctutar,' TL') AS borctutar, borclar.borctarih FROM borclar");

                    while ($sonuc = $sorgu->fetch_assoc()) {

                    $tedarikad = $sonuc['tedarik_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                    $borctutar = $sonuc['borctutar'];
                    $borctarih = $sonuc['borctarih'];
                    $borcid = $sonuc['borc_id'];


                    // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                    ?>

                        <tr>
                            <td><?php echo $tedarikad; ?></td>
                            <td><?php echo $borctutar; ?></td>
                            <td><?php echo $borctarih; ?></td>
                            <td><a href="borcsil.php?borc_id=<?php echo $borcid; ?>" class="btn btn-danger">Sil</a></td>
                        </tr>

                    <?php
                    }
                    // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                    ?>

                    </table>


              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
        <div class="col-md-3">
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Toplam Borç</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                    <table class="table">

                        <tr>
                            <th>Tedarikçi</th>
                            <th>Toplam Borç</th>
                        </tr>

                    <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                    <?php



                    $sorgu = $conn->query("SELECT borclar.tedarik_ad, concat(SUM(borclar.borctutar),' TL') AS toplamborc FROM borclar GROUP BY borclar.tedarik_ad ORDER BY toplamborc DESC");

                    while ($sonuc = $sorgu->fetch_assoc()) {

                    $tedarikad = $sonuc['tedarik_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                    $toplamborc = $sonuc['toplamborc'];


                    // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                    ?>

                        <tr>
                            <td><?php echo $tedarikad; ?></td>
                            <td><?php echo $toplamborc; ?></td>
                        </tr>

                    <?php
                    }
                    // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                    ?>

                    </table>


              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
        <div class="col-md-9">
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Müşteriden Alacaklar</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                    <table class="table">

                        <tr>
                            <th>Müşteri Adı</th>
                            <th>Alacak Tutarı</th>
                            <th>Tarih</th>
                            <th>Sil</th>
                        </tr>

                    <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                    <?php



                    $sorgu = $conn->query("SELECT musterialacak.malacak_id, musterialacak.musteri_ad, concat(musterialacak.alacaktutar,' TL') AS alacaktutar, musterialacak.alacaktarih FROM musterialacak");

                    while ($sonuc = $sorgu->fetch_assoc()) {

                    $musteriad = $sonuc['musteri_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                    $alacaktutar = $sonuc['alacaktutar'];
                    $alacaktarih = $sonuc['alacaktarih'];
                    $malacakid = $sonuc['malacak_id'];


                    // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                    ?>

                        <tr>
                            <td><?php echo $musteriad; ?></td>
                            <td><?php echo $alacaktutar; ?></td>
                            <td><?php echo $alacaktarih; ?></td>
                            <td><a href="malacaksil.php?malacak_id=<?php echo $malacakid; ?>" class="btn btn-danger">Sil</a></td>
                        </tr>

                    <?php
                    }
                    // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                    ?>

                    </table>


              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
        <div class="col-md-3">
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Toplam Alacak</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                    <table class="table">

                        <tr>
                            <th>Müşteri</th>
                            <th>Toplam Alacak</th>
                        </tr>

                    <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                    <?php



                    $sorgu = $conn->query("SELECT musterialacak.musteri_ad, concat(SUM(musterialacak.alacaktutar),' TL') AS alacaktutar FROM musterialacak GROUP BY musterialacak.musteri_ad ORDER BY alacaktutar DESC");

                    while ($sonuc = $sorgu->fetch_assoc()) {

                    $musteriad = $sonuc['musteri_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                    $alacaktutar = $sonuc['alacaktutar'];


                    // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                    ?>

                        <tr>
                            <td><?php echo $musteriad; ?></td>
                            <td><?php echo $alacaktutar; ?></td>
                        </tr>

                    <?php
                    }
                    // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                    ?>

                    </table>


              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
        <div class="col-md-9">
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Firmadan Alacaklar</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                    <table class="table">

                        <tr>
                            <th>Firma Adı</th>
                            <th>Alacak Tutarı</th>
                            <th>Tarih</th>
                            <th>Sil</th>
                        </tr>

                    <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                    <?php



                    $sorgu = $conn->query("SELECT firmaalacak.falacak_id, firmaalacak.firma_ad, concat(firmaalacak.alacaktutar,' TL') AS alacaktutar, firmaalacak.alacaktarih FROM firmaalacak");

                    while ($sonuc = $sorgu->fetch_assoc()) {

                    $firmaad = $sonuc['firma_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                    $alacaktutar = $sonuc['alacaktutar'];
                    $alacaktarih = $sonuc['alacaktarih'];
                    $falacakid = $sonuc['falacak_id'];


                    // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                    ?>

                        <tr>
                            <td><?php echo $firmaad; ?></td>
                            <td><?php echo $alacaktutar; ?></td>
                            <td><?php echo $alacaktarih; ?></td>
                            <td><a href="falacaksil.php?falacak_id=<?php echo $falacakid; ?>" class="btn btn-danger">Sil</a></td>
                        </tr>

                    <?php
                    }
                    // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                    ?>

                    </table>


              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
        <div class="col-md-3">
					<div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Toplam Alacak</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                    <table class="table">

                        <tr>
                            <th>Firma</th>
                            <th>Toplam Alacak</th>
                        </tr>

                    <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                    <?php



                    $sorgu = $conn->query("SELECT firmaalacak.firma_ad, concat(SUM(firmaalacak.alacaktutar),' TL') AS alacaktutar FROM firmaalacak GROUP BY firmaalacak.firma_ad ORDER BY alacaktutar DESC");

                    while ($sonuc = $sorgu->fetch_assoc()) {

                    $firmaad = $sonuc['firma_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                    $alacaktutar = $sonuc['alacaktutar'];


                    // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                    ?>

                        <tr>
                            <td><?php echo $firmaad; ?></td>
                            <td><?php echo $alacaktutar; ?></td>
                        </tr>

                    <?php
                    }
                    // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                    ?>

                    </table>


              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
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
