<?php

class Querys
{
  public function get()
  {
    include("db_conn.php");
    $sorgu1 = $conn->query("CALL sorgu1()");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }


  public function musteri()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT musteriler.musteri_id, musteriler.musteri_ad, musteriler.musteri_soyad
                              FROM musteriler LEFT JOIN satis ON musteriler.musteri_id=satis.musteri_id
                              GROUP BY musteriler.musteri_ad
                              HAVING COUNT(satis.satis_id)=0");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }


  public function firma()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("CALL satisyapmayanfirma()");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }

  public function tur()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT * FROM m_tur");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }

  public function birim()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT * FROM m_birim");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }

  public function renk()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT * FROM m_renk");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }

  public function isler()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT * FROM isler");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }


  public function tedarik()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT * FROM tedarikciler");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }


  public function malzeme()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("CALL malzemealim()");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }


  public function musteriler()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT * FROM musteriler");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }


  public function firmalar()
  {
    include("db_conn.php");
      $sorgu1 = $conn->query("SELECT * FROM firmalar");
           $datas = array();
           while ($deu = $sorgu1->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }



}


?>
