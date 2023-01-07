<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
 <?php
 $hometable = new Querys();
 $q1 = array();
 $q1 = $hometable->tur();
 $q2 = array();
 $q2 = $hometable->birim();
 $q3 = array();
 $q3 = $hometable->renk();

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
        <div class="col">
          <div class="panel panel-headline">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Malzeme Oluştur</h2>
						</div>
					<div class="panel-body">
            <div class="container-fluid">
              <div class="col">
              <form action="" method="post">
                  <table class="table">
                    <td>
                     Malzeme Türü  :
                    </td>
                    <td>
                    <select id="cmbMake" name="tür" onchange="document.getElementById('selected_tür').value=this.options[this.selectedIndex].text">
                        <option value="">Tür Seçiniz</option>
                        <?php foreach ($q1 as $key => $value) { ?>
                        <option value="<?php echo $value['m_tur_id'];?>"><?php echo $value['m_tur_ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_tür" id="selected_tür" value="" />
                    </td></tr>
                    <td>
                     Malzeme Birimi  :
                    </td>
                    <td>
                    <select id="cmbMake" name="birim" onchange="document.getElementById('selected_birim').value=this.options[this.selectedIndex].text">
                        <option value="">Birim Seçiniz</option>
                        <?php foreach ($q2 as $key => $value) { ?>
                        <option value="<?php echo $value['birim_id'];?>"><?php echo $value['m_birim_ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_birim" id="selected_birim" value="" />
                    </td></tr>
                    <td>
                     Malzeme Rengi  :
                    </td>
                    <td>
                    <select id="cmbMake" name="renk" onchange="document.getElementById('selected_renk').value=this.options[this.selectedIndex].text">
                        <option value="">Renk Seçiniz</option>
                        <?php foreach ($q3 as $key => $value) { ?>
                        <option value="<?php echo $value['m_renk_id'];?>"><?php echo $value['m_renk_ad']?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_renk" id="selected_renk" value="" />
                    </td></tr>

                    <td>Fiyat :</td>
                    <td><input name="fiyat" type="number" min="" max="50000" class="form-control" ></textarea></td>
                    </tr>
                    <td></td>
                    <td><input class="btn btn-primary"  type="submit" value="Malzeme Ekle"></td>
                    </tr>

                  </table>
              </form>
              <a href="malzemeozellik.php">
              <input class="btn btn-primary pull-right" type="submit" value="Malzeme Özelliklerini Düzenle">
              </a>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

              <?php

              if ($_POST) {
                if ($_POST['tür'] === '') {
                      $_POST['tür'] = 'NULL';
                      $tür = $_POST['tür'];
                    }

              if ($_POST['birim'] === '') {
                    $_POST['birim'] = 'NULL';
                    $birim = $_POST['birim'];
                  }

              if ($_POST['renk'] === '') {
                    $_POST['renk'] = 'NULL';
                    $renk = $_POST['renk'];
                  }

                  $tür = $_POST['tür'];
                  $birim = $_POST['birim'];
                  $renk = $_POST['renk'];
                  $fiyat = $_POST['fiyat'];



                  if ($fiyat<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO malzemeler (fiyat,m_tur_id,birim_id,m_renk_id) VALUES ($fiyat,$tür,$birim,$renk)"))
                      {
                          echo "Malzeme Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
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
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Malzemeler</h2>
						</div>
						<div class="panel-body">
              <div class="col">
                </div>
                <table class="table">

                    <tr>
                        <th>Malzeme</th>
                        <th>Fiyat</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("CALL malzemeliste()"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $malzemeid = $sonuc['m_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $turad = $sonuc['tur'];
                $birimad = $sonuc['birim'];
                $renkad = $sonuc['renk'];
                $fiyat = $sonuc['fiyat'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $birimad." ".$renkad." ".$turad; ?></td>
                        <td><?php echo $fiyat; ?></td>
                        <td><a href="malzemesil.php?m_id=<?php echo $malzemeid; ?>" class="btn btn-danger">Sil</a></td>
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
