<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
 <?php
 $hometable = new Querys();
 $q1 = array();
 $q1 = $hometable->musteriler();
 $q2 = array();
 $q2 = $hometable->firmalar();
 $q3 = array();
 $q3 = $hometable->isler();

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
            <li><a href="satislar.php" class="active"><i class="fa fa-credit-card"></i><span>Satışlar</span></a></li>
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
							<h2 class="panel-title"><b>Satış Yap</h2>
						</div>
					<div class="panel-body">
            <div class="container-fluid">
              <div class="col">
              <form action="" method="post">
                  <table class="table">
                    <td>
                     Müşteri  :
                    </td>
                    <td>
                    <select id="cmbMake" name="musteri" onchange="document.getElementById('selected_musteri').value=this.options[this.selectedIndex].text">
                        <option value="">Müşteri Seçiniz</option>
                        <?php foreach ($q1 as $key => $value) { ?>
                        <option value="<?php echo $value['musteri_id'];?>"><?php echo $value['musteri_ad']." ".$value['musteri_soyad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_musteri" id="selected_musteri" value="" />
                  </td></tr>
                    <td>
                     Firma  :
                    </td>
                    <td>
                    <select id="cmbMake" name="firma" onchange="document.getElementById('selected_firma').value=this.options[this.selectedIndex].text">
                        <option value="">Firma Seçiniz</option>
                        <?php foreach ($q2 as $key => $value) { ?>
                        <option value="<?php echo $value['firma_id'];?>"><?php echo $value['firma_ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_firma" id="selected_firma" value="" />
                    </td></tr>
                    <td>
                     Yapılacak İş  :
                    </td>
                    <td>
                    <select id="cmbMake" name="is" onchange="document.getElementById('selected_is').value=this.options[this.selectedIndex].text">
                        <option value="">İş Seçiniz</option>
                        <?php foreach ($q3 as $key => $value) { ?>
                        <option value="<?php echo $value['is_id'];?>"><?php echo $value['is_ad']; ?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_is" id="selected_is" value="" />
                    </td></tr>

                    <td>Satış Tutarı :</td>
                    <td><input name="tutar" type="number" class="form-control" ></textarea></td>
                    </tr>
                    <td></td>
                    <td><input class="btn btn-primary"  type="submit" value="Satış Yap"></td>
                    </tr>

                  </table>
              </form>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

              <?php
                if ($_POST) {

                    if ($_POST['musteri'] === '') {
                          $_POST['musteri'] = 'NULL';
                          $musteri = $_POST['musteri'];
                        }

                  if ($_POST['firma'] === '') {
                        $_POST['firma'] = 'NULL';
                        $firma = $_POST['firma'];
                      }


                  $musteri = $_POST['musteri'];
                  $firma = $_POST['firma'];
                  $is = $_POST['is'];
                  $tutar = $_POST['tutar'];

                  if ($is<>"" && $tutar<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO satis (musteri_id,firma_id,is_id,s_tutar) VALUES ($musteri,$firma,$is,$tutar)"))
                      {
                          echo "Satış Yapıldı"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                      }
                      else
                      {
                          echo "Hata oluştu";
                      }

                  }

              }

              ?>
              </div>

							</div>
						</div>
					</div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Firmaya Satışlar</h2>
						</div>
						<div class="panel-body">
              <div class="col">
                </div>
                <table class="table">

                    <tr>
                        <th>Firma</th>
                        <th>İş</th>
                        <th>Satış Tarihi</th>
                        <th>Tutar</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT firmasatis.fsatis_id, firmasatis.firma_ad, firmasatis.is_ad, firmasatis.satis_tarih, concat(firmasatis.s_tutar,' TL') AS s_tutar FROM firmasatis"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $fsatisid = $sonuc['fsatis_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $firmaa = $sonuc['firma_ad'];
                $iss = $sonuc['is_ad'];
                $satistutar = $sonuc['s_tutar'];
                $satistarih = $sonuc['satis_tarih'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $firmaa; ?></td>
                        <td><?php echo $iss; ?></td>
                        <td><?php echo $satistarih; ?></td>
                        <td><?php echo $satistutar; ?></td>
                        <td><a href="fsatissil.php?fsatis_id=<?php echo $fsatisid; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Müşteriye Satışlar</h2>
						</div>
						<div class="panel-body">
              <div class="col">
                </div>
                <table class="table">

                    <tr>
                        <th>Müşteri</th>
                        <th>İş</th>
                        <th>Satış Tarihi</th>
                        <th>Tutar</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT musterisatis.msatis_id, musterisatis.musteri_ad, musterisatis.is_ad, musterisatis.satis_tarih, concat(musterisatis.s_tutar,' TL') AS s_tutar FROM musterisatis"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $msatisid = $sonuc['msatis_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $musterii = $sonuc['musteri_ad'];
                $iss = $sonuc['is_ad'];
                $satistutar = $sonuc['s_tutar'];
                $satistarih = $sonuc['satis_tarih'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $musterii; ?></td>
                        <td><?php echo $iss; ?></td>
                        <td><?php echo $satistarih; ?></td>
                        <td><?php echo $satistutar; ?></td>
                        <td><a href="msatissil.php?msatis_id=<?php echo $msatisid; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
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
  <script>
  var txt = $("#cmbMake1 option:selected").text();
  </script>
</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
