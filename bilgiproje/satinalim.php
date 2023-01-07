<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
 <?php
 $hometable = new Querys();
 $q1 = array();
 $q1 = $hometable->isler();
 $q2 = array();
 $q2 = $hometable->tedarik();
 $q3 = array();
 $q3 = $hometable->malzeme();

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
            <li><a href="satinalim.php" class="active"><i class="fa fa-shopping-basket"></i><span>Satın Alımlarım</span></a></li>
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
							<h2 class="panel-title"><b>Alım Yap</h2>
						</div>
					<div class="panel-body">
            <div class="container-fluid">
              <div class="col">
              <form action="" method="post">
                  <table class="table">
                    <td>
                     Malzemenin Kullanılacağı İş  :
                    </td>
                    <td>
                    <select id="cmbMake" name="is" onchange="document.getElementById('selected_is').value=this.options[this.selectedIndex].text">
                        <option value="">İş Seçiniz</option>
                        <?php foreach ($q1 as $key => $value) { ?>
                        <option value="<?php echo $value['is_id'];?>"><?php echo $value['is_ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_is" id="selected_is" value="" />
                    </td></tr>
                    <td>
                     Tedarikçi  :
                    </td>
                    <td>
                    <select id="cmbMake" name="tedarik" onchange="document.getElementById('selected_tedarik').value=this.options[this.selectedIndex].text">
                        <option value="">Tedarikçi Seçiniz</option>
                        <?php foreach ($q2 as $key => $value) { ?>
                        <option value="<?php echo $value['tedarik_id'];?>"><?php echo $value['tedarik_ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_tedarik" id="selected_tedarik" value="" />
                    </td></tr>
                    <td>
                     Malzeme  :
                    </td>
                    <td>
                    <select id="cmbMake" name="malzeme" onchange="document.getElementById('selected_malzeme').value=this.options[this.selectedIndex].text">
                        <option value="">Malzeme Seçiniz</option>
                        <?php foreach ($q3 as $key => $value) { ?>
                        <option value="<?php echo $value['m_id'];?>"><?php echo $value['birim']." ".$value['renk']." ".$value['tur']?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_malzeme" id="selected_malzeme" value="" />
                    </td></tr>

                    <td>Adet :</td>
                    <td><input name="adet" type="number" class="form-control" ></textarea></td>
                    </tr>
                    <td></td>
                    <td><input class="btn btn-primary"  type="submit" value="Alım Yap"></td>
                    </tr>

                  </table>
              </form>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

              <?php
                if ($_POST) {

                  $iss = $_POST['is'];
                  $tedarik = $_POST['tedarik'];
                  $malzeme = $_POST['malzeme'];
                  $adet = $_POST['adet'];

                  if ($iss<>"" && $tedarik<>"" && $malzeme<>"" && $adet<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO alimlar (is_id,tedarik_id,adet,m_id) VALUES ($iss,$tedarik,$adet,$malzeme)"))
                      {
                          echo "Alım Yapıldı"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
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
        <div class="col-md-8">
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Satın Alımlar</h2>
						</div>
						<div class="panel-body">
              <div class="col">
                </div>
                <table class="table">

                    <tr>
                        <th>Tedarikçi</th>
                        <th>Kullanılacak İş</th>
                        <th>Malzeme</th>
                        <th>Adet</th>
                        <th>Alım Tarihi</th>
                        <th>Tutar</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT alimlar.alim_id, tedarikciler.tedarik_ad, isler.is_ad, (CASE WHEN m_birim.m_birim_ad IS NULL THEN '' ELSE m_birim.m_birim_ad END) AS birim, (CASE WHEN m_renk.m_renk_ad IS NULL THEN '' ELSE m_renk.m_renk_ad END) AS renk, (CASE WHEN m_tur.m_tur_ad IS NULL THEN '' ELSE m_tur.m_tur_ad END) AS tur, alimlar.adet, concat(alimlar.alimtutar,' TL') AS alimtutar, alimlar.alimtarih
                                      FROM alimlar LEFT JOIN tedarikciler ON alimlar.tedarik_id=tedarikciler.tedarik_id LEFT JOIN isler ON alimlar.is_id=isler.is_id LEFT JOIN malzemeler ON alimlar.m_id=malzemeler.m_id LEFT JOIN m_tur ON malzemeler.m_tur_id=m_tur.m_tur_id LEFT JOIN m_birim ON malzemeler.birim_id=m_birim.birim_id LEFT JOIN m_renk ON malzemeler.m_renk_id=m_renk.m_renk_id
                                      GROUP BY alimlar.alim_id"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $alimid = $sonuc['alim_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $tedarikad = $sonuc['tedarik_ad'];
                $birim = $sonuc['birim'];
                $is = $sonuc['is_ad'];
                $renk = $sonuc['renk'];
                $tur = $sonuc['tur'];
                $adet = $sonuc['adet'];
                $alimtutar = $sonuc['alimtutar'];
                $alimtarih = $sonuc['alimtarih'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $tedarikad; ?></td>
                        <td><?php echo $is; ?></td>
                        <td><?php echo $birim.' '.$renk.' '.$tur; ?></td>
                        <td><?php echo $adet; ?></td>
                        <td><?php echo $alimtarih; ?></td>
                        <td><?php echo $alimtutar; ?></td>
                        <td><a href="alimsil.php?alim_id=<?php echo $alimid; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Envanter</h2>
						</div>
						<div class="panel-body">
              <div class="col">
                </div>
                <table class="table">

                    <tr>
                        <th>Malzeme Adı</th>
                        <th>Stok Sayısı</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("SELECT stok.stok_id, stok.malzeme_ad, SUM(stok.stoksayi) AS stoksayi FROM stok GROUP BY stok.malzeme_ad"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $stokid = $sonuc['stok_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $malzemead = $sonuc['malzeme_ad'];
                $stoksayi = $sonuc['stoksayi'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $malzemead; ?></td>
                        <td><a href="arttir.php?stok_id=<?php echo $stokid; ?>" class="fa fa-arrow-up">&nbsp</a><?php echo $stoksayi; ?>&nbsp<a href="azalt.php?stok_id=<?php echo $stokid; ?>" class="fa fa-arrow-down"></a></td>
                        <td><a href="stoksil.php?stok_id=<?php echo $stokid; ?>" class="btn btn-danger">Sil</a></td>
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
