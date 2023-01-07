<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
 <?php

 $hometable = new Querys();
 $q1 = array();
 $q1 = $hometable->get();
 $q2 = array();
 $q2 = $hometable->musteri();
 $q3 = array();
 $q3 = $hometable->firma();



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
		<?php include_once 'ortak_sayfalar/solmenu.php'; ?>
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
					<!-- END OVERVIEW -->
          <div class="container-fluid">

            <!-- TABLE HOVER -->
            <div class="panel panel-headline">
              <div class="panel-heading">
                <h3 class="panel-title"><b>Erenpen Cam Balkon & Duşakabin Sistemleri</h3>
                  <p>Merhaba : <?php echo ucfirst($_SESSION['ad']) ?></p>
              </div>
              <div class="panel-body">
                <div class="row">
  								<div class="col-md-2">
  									<div class="metric">
  										<span class="icon"><i class="fa fa-money"></i></span>
  										<p>
  											<span class="number"><?php foreach ($q1 as $key => $value) {  echo $value['satissayi']; ?></span>
  											<span class="title">Toplam Yapılan İş</span>
  										</p>
  									</div>
  								</div>
  								<div class="col-md-2">
  									<div class="metric">
  										<span class="icon"><i class="fa fa-users"></i></span>
  										<p>
  											<span class="number"><?php echo $value['musterisayi']; ?></span>
  											<span class="title">Müşteri Sayısı</span>
  										</p>
  									</div>
  								</div>
  								<div class="col-md-2">
  									<div class="metric">
  										<span class="icon"><i class="fa fa-building"></i></span>
  										<p>
  											<span class="number"><?php echo $value['firmasayi']; ?></span>
  											<span class="title">Firma Sayısı</span>
  										</p>
  									</div>
  								</div>
  								<div class="col-md-3">
  									<div class="metric">
  										<span class="icon"><i class="fa fa-user"></i></span>
  										<p>
  											<span class="number"><?php echo $value['encoksatismusteri']; ?></span>
  											<span class="title">En Sık İş Yapılan Müşteri</span>
  										</p>
  									</div>
  								</div>
                  <div class="col-md-3">
  									<div class="metric">
  										<span class="icon"><i class="fa fa-flag"></i></span>
  										<p>
  											<span class="number"><?php echo $value['encoksatisfirma']; ?></span>
  											<span class="title">En Sık İş Yapılan Firma</span> <?php } ?>
  										</p>
  									</div>
  								</div>
              </div>
            </div>
          </div>
        </div>




            <!-- TABLE HOVER -->
            <div class="col-md-6">
            <div class="panel panel-headline">
              <div class="panel-heading">
                <h3 class="panel-title"><b>Stoktaki Malzeme Sayısı</h3>
              </div>
              <div class="panel-body">
                <div class="container-fluid">
                  <canvas id="myChart"></canvas>
                </div>
              </div>
            </div>
            <!-- END TABLE HOVER -->
          </div>

          <div class="col-md-6">
          <div class="panel panel-headline">
            <div class="panel-heading">
              <h3 class="panel-title"><b>İşlere Göre Satış Sayıları</h3>
            </div>
            <div class="panel-body">
              <div class="container-fluid">
                <canvas id="myChart3"></canvas>
              </div>
            </div>
          </div>
          <!-- END TABLE HOVER -->
        </div>

          <div class="col-md-4">
          <div class="panel panel-headline">
            <div class="panel-heading">
              <h3 class="panel-title"><b>Tedarikçilerin Toplam Alıma Oranı</h3>
            </div>
            <div class="panel-body">
              <div class="container-fluid">
                <canvas id="myChart1"></canvas>
              </div>
            </div>
          </div>
          <!-- END TABLE HOVER -->
        </div>


        <div class="col-md-4">
        <div class="panel panel-headline">
          <div class="panel-heading">
            <h3 class="panel-title"><b>Satış Oranı</h3>
          </div>
          <div class="panel-body">
            <div class="container-fluid">
              <canvas id="myChart2"></canvas>
            </div>
          </div>
        </div>
        <!-- END TABLE HOVER -->
      </div>


      <div class="col-md-4">
      <div class="panel panel-headline">
        <div class="panel-heading">
          <h3 class="panel-title"><b>Alacak Oranı</h3>
        </div>
        <div class="panel-body">
          <div class="container-fluid">
            <canvas id="myChart4"></canvas>
          </div>
        </div>
      </div>
      <!-- END TABLE HOVER -->
    </div>
          <!-- TABLE HOVER -->
			<!-- END MAIN CONTENT -->
      </div>
		</div>
		<!-- END MAIN -->
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  <?php   $sorgu = $conn->query("SELECT * FROM stok");
          while ($deu = $sorgu->fetch_assoc()){
              $malzemead[] = $deu['malzeme_ad'];
              $stoksayi[] = $deu['stoksayi'];
        }

        $sorgu2 = $conn->query("SELECT tedarikciler.tedarik_ad, ROUND(COUNT(alimlar.alim_id)/(SELECT COUNT(alimlar.alim_id) FROM alimlar)*100,2) AS oran
                                FROM tedarikciler LEFT JOIN alimlar ON tedarikciler.tedarik_id=alimlar.tedarik_id
                                GROUP BY tedarikciler.tedarik_ad");
                while ($deu = $sorgu2->fetch_assoc()){
                    $tedarikad[] = $deu['tedarik_ad'];
                    $oran[] = $deu['oran'];
              }


        $sorgu3 = $conn->query("SELECT (SELECT ROUND((SELECT COUNT(musterisatis.msatis_id) FROM musterisatis)/((SELECT COUNT(musterisatis.msatis_id) FROM musterisatis)+(SELECT COUNT(firmasatis.fsatis_id) FROM firmasatis))*100,2)) AS musterioran,
                               (SELECT ROUND((SELECT COUNT(firmasatis.fsatis_id) FROM firmasatis)/((SELECT COUNT(musterisatis.msatis_id) FROM musterisatis)+(SELECT COUNT(firmasatis.fsatis_id) FROM firmasatis))*100,2)) AS firmaoran");
                while ($deu = $sorgu3->fetch_assoc()){
                    $musterioran[] = $deu['musterioran'];
                    $firmaoran[] = $deu['firmaoran'];
              }


        $sorgu4 = $conn->query("SELECT isler.is_ad, COUNT(satis.satis_id) AS sayi
                                FROM isler LEFT JOIN satis ON isler.is_id=satis.is_id
                                GROUP BY isler.is_ad");
                while ($deu = $sorgu4->fetch_assoc()){
                    $isad[] = $deu['is_ad'];
                    $issayi[] = $deu['sayi'];
              }


        $sorgu5 = $conn->query("SELECT (SELECT ROUND((SELECT SUM(musterialacak.alacaktutar) FROM musterialacak)/((SELECT SUM(musterialacak.alacaktutar) FROM musterialacak)+(SELECT SUM(firmaalacak.alacaktutar) FROM firmaalacak))*100,2)) AS musterialacakoran,
                              (SELECT ROUND((SELECT SUM(firmaalacak.alacaktutar) FROM firmaalacak)/((SELECT SUM(musterialacak.alacaktutar) FROM musterialacak)+(SELECT SUM(firmaalacak.alacaktutar) FROM firmaalacak))*100,2)) AS firmaalacakoran");
                while ($deu = $sorgu5->fetch_assoc()){
                    $maoran[] = $deu['musterialacakoran'];
                    $faoran[] = $deu['firmaalacakoran'];
              }


  ?>
  const ctx = document.getElementById('myChart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($malzemead); ?>,
      datasets: [{
        label: 'Stok Sayısı',
        data: <?php echo json_encode($stoksayi); ?>,
        borderWidth: 1.5,
        backgroundColor:'#ed5d09',
        borderColor: '#000000',


      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctx1 = document.getElementById('myChart3');
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($isad); ?>,
      datasets: [{
        label: 'Satış Sayısı',
        data: <?php echo json_encode($issayi); ?>,
        borderWidth: 1.5,
        backgroundColor:'#ed5d09',
        borderColor: '#000000',
        fill: true,


      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });



  const data = {
    labels: <?php echo json_encode($tedarikad); ?>,
    datasets: [{
      label: 'Alım Oranı',
      data: <?php echo json_encode($oran); ?>,
      backgroundColor: [
        '#ed5d09',
        '#2b333e',
        'rgb(255, 205, 86)'
      ],
      hoverOffset: 4
    }]
    };

    const config = {
      type: 'pie',
      data: data,
    };

    const myChart = new Chart(
      document.getElementById('myChart1'),
      config
    );


    const data1 = {
      labels: ['Müşteri','Firma'],
      datasets: [{
        label: 'Satış Oranı',
        data: [<?php echo json_encode($musterioran); ?>,<?php echo json_encode($firmaoran); ?>],
        backgroundColor: [
          '#ed5d09',
          '#2b333e',
        ],
        hoverOffset: 4
      }]
      };

      const config1 = {
        type: 'pie',
        data: data1,
      };

      const myChart1 = new Chart(
        document.getElementById('myChart2'),
        config1
      );


      const data2 = {
        labels: ['Müşteriden Alacak','Firmadan Alacak'],
        datasets: [{
          label: 'Alacak Oranı',
          data: [<?php echo json_encode($maoran); ?>,<?php echo json_encode($faoran); ?>],
          backgroundColor: [
            '#ed5d09',
            '#2b333e',
          ],
          hoverOffset: 4
        }]
        };

        const config2 = {
          type: 'doughnut',
          data: data2,
        };

        const myChart2 = new Chart(
          document.getElementById('myChart4'),
          config2
        );





  </script>
<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
