<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
/**
* 
*/
class Ahp extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('getdata');
	}

	public function indeksrandom($n)
    {
        if ($n == 2) {
            return $ir = 0;
        } elseif ($n == 3) {
            return $ir = 0.58;
        } elseif ($n == 4) {
            return $ir = 0.90;
        } elseif ($n == 5) {
            return $ir = 1.12;
        } elseif ($n == 6) {
            return $ir = 1.24;
        } elseif ($n == 7) {
            return $ir = 1.32;
        } elseif ($n == 8) {
            return $ir = 1.41;
        }
    }
  
  // Kriteria Utama FIX
  public function kriteriautama($id,$total)
    {
      $id = $id-1;
      $n = 4;
      $id_keu = $id+1;
      $data_keuangan = $this->getdata->getdatakeuangan($id);
      // $row = $this->getdata->getDataBy($id);

       $datatotal1 = $data_keuangan->jml_bp;
       $datatotal2 = $data_keuangan->jml_bb;
       $datatotal3 = $data_keuangan->jml_bpr;
       $datatotal4 = $data_keuangan->jml_bll;

      // $datatotal1 = $row->jml_bp;
      // $datatotal2 = $row->jml_bb;
      // $datatotal3 = $row->jml_bpr;
      // $datatotal4 = $row->jml_bll;

      $data1 = array();
      $data2 = array();
      $data3 = array();
      $data4 = array();

      // pembobotan elemen-elemen pada setiap level dan hierarki
      $data1[] = $datatotal1/$datatotal1;
      $data1[] = $datatotal1/$datatotal2;
      $data1[] = $datatotal1/$datatotal3;
      $data1[] = $datatotal1/$datatotal4;

      $data2[] = $datatotal2/$datatotal1;
      $data2[] = $datatotal2/$datatotal2;
      $data2[] = $datatotal2/$datatotal3;
      $data2[] = $datatotal2/$datatotal4;

      $data3[] = $datatotal3/$datatotal1;
      $data3[] = $datatotal3/$datatotal2;
      $data3[] = $datatotal3/$datatotal3;
      $data3[] = $datatotal3/$datatotal4;

      $data4[] = $datatotal4/$datatotal1;
      $data4[] = $datatotal4/$datatotal2;
      $data4[] = $datatotal4/$datatotal3;
      $data4[] = $datatotal4/$datatotal4;

      // perkalian matriks iterasi pertama
      $data5 = array();
      $data5[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0])+($data1[2]*$data3[0])+($data1[3]*$data4[0]);
      $data5[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1])+($data1[2]*$data3[1])+($data1[3]*$data4[1]);
      $data5[] = ($data1[0]*$data1[2])+($data1[1]*$data2[2])+($data1[2]*$data3[2])+($data1[3]*$data4[2]);
      $data5[] = ($data1[0]*$data1[3])+($data1[1]*$data2[3])+($data1[2]*$data3[3])+($data1[3]*$data4[3]);

      $data6 = array();
      $data6[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0])+($data2[2]*$data3[0])+($data2[3]*$data4[0]);
      $data6[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1])+($data2[2]*$data3[1])+($data2[3]*$data4[1]);
      $data6[] = ($data2[0]*$data1[2])+($data2[1]*$data2[2])+($data2[2]*$data3[2])+($data2[3]*$data4[2]);
      $data6[] = ($data2[0]*$data1[3])+($data2[1]*$data2[3])+($data2[2]*$data3[3])+($data2[3]*$data4[3]);

      $data7 = array();
      $data7[] = ($data3[0]*$data1[0])+($data3[1]*$data2[0])+($data3[2]*$data3[0])+($data3[3]*$data4[0]);
      $data7[] = ($data3[0]*$data1[1])+($data3[1]*$data2[1])+($data3[2]*$data3[1])+($data3[3]*$data4[1]);
      $data7[] = ($data3[0]*$data1[2])+($data3[1]*$data2[2])+($data3[2]*$data3[2])+($data3[3]*$data4[2]);
      $data7[] = ($data3[0]*$data1[3])+($data3[1]*$data2[3])+($data3[2]*$data3[3])+($data3[3]*$data4[3]);

      $data8 = array();
      $data8[] = ($data4[0]*$data1[0])+($data4[1]*$data2[0])+($data4[2]*$data3[0])+($data4[3]*$data4[0]);
      $data8[] = ($data4[0]*$data1[1])+($data4[1]*$data2[1])+($data4[2]*$data3[1])+($data4[3]*$data4[1]);
      $data8[] = ($data4[0]*$data1[2])+($data4[1]*$data2[2])+($data4[2]*$data3[2])+($data4[3]*$data4[2]);
      $data8[] = ($data4[0]*$data1[3])+($data4[1]*$data2[3])+($data4[3]*$data3[2])+($data4[3]*$data4[3]);
  
      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data5[0]+$data5[1]+$data5[2]+$data5[3];
      $totaldata2 = $data6[0]+$data6[1]+$data6[2]+$data6[3];
      $totaldata3 = $data7[0]+$data7[1]+$data7[2]+$data7[3];
      $totaldata4 = $data8[0]+$data8[1]+$data8[2]+$data8[3];
      $sumtotal = $totaldata1+$totaldata2+$totaldata3+$totaldata4;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      $eigenvector3 = $totaldata3/$sumtotal;
      $eigenvector4 = $totaldata4/$sumtotal;
      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1+$eigenvector2+$eigenvector3+$eigenvector4;

      // perkalian matriks iterasi ke 2
      $data9 = array();
      $data9[] = ($data5[0]*$data5[0])+($data5[1]*$data6[0])+($data5[2]*$data7[0])+($data5[3]*$data8[0]);
      $data9[] = ($data5[0]*$data5[1])+($data5[1]*$data6[1])+($data5[2]*$data7[1])+($data5[3]*$data8[1]);
      $data9[] = ($data5[0]*$data5[2])+($data5[1]*$data6[2])+($data5[2]*$data7[2])+($data5[3]*$data8[2]);
      $data9[] = ($data5[0]*$data5[3])+($data5[1]*$data6[3])+($data5[2]*$data7[3])+($data5[3]*$data8[3]);

      $data10 = array();
      $data10[] = ($data6[0]*$data5[0])+($data6[1]*$data6[0])+($data6[2]*$data7[0])+($data6[3]*$data8[0]);
      $data10[] = ($data6[0]*$data5[1])+($data6[1]*$data6[1])+($data6[2]*$data7[1])+($data6[3]*$data8[1]);
      $data10[] = ($data6[0]*$data5[2])+($data6[1]*$data6[2])+($data6[2]*$data7[2])+($data6[3]*$data8[2]);
      $data10[] = ($data6[0]*$data5[3])+($data6[1]*$data6[3])+($data6[2]*$data7[3])+($data6[3]*$data8[3]);

      $data11 = array();
      $data11[] = ($data7[0]*$data5[0])+($data7[1]*$data6[0])+($data7[2]*$data7[0])+($data7[3]*$data8[0]);
      $data11[] = ($data7[0]*$data5[1])+($data7[1]*$data6[1])+($data7[2]*$data7[1])+($data7[3]*$data8[1]);
      $data11[] = ($data7[0]*$data5[2])+($data7[1]*$data6[2])+($data7[2]*$data7[2])+($data7[3]*$data8[2]);
      $data11[] = ($data7[0]*$data5[3])+($data7[1]*$data6[3])+($data7[2]*$data7[3])+($data7[3]*$data8[3]);

      $data12 = array();
      $data12[] = ($data8[0]*$data5[0])+($data8[1]*$data6[0])+($data8[2]*$data7[0])+($data8[3]*$data8[0]);
      $data12[] = ($data8[0]*$data5[1])+($data8[1]*$data6[1])+($data8[2]*$data7[1])+($data8[3]*$data8[1]);
      $data12[] = ($data8[0]*$data5[2])+($data8[1]*$data6[2])+($data8[2]*$data7[2])+($data8[3]*$data8[2]);
      $data12[] = ($data8[0]*$data5[3])+($data8[1]*$data6[3])+($data8[2]*$data7[3])+($data8[3]*$data8[3]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata5 = $data9[0]+$data9[1]+$data9[2]+$data9[3];
      $totaldata6 = $data10[0]+$data10[1]+$data10[2]+$data10[3];
      $totaldata7 = $data11[0]+$data10[1]+$data11[2]+$data11[3];
      $totaldata8 = $data12[0]+$data10[1]+$data12[2]+$data12[3];
      $sumtotal2 = $totaldata5+$totaldata6+$totaldata7+$totaldata8;
      
      // hasil normalisasi iterasi kedua
      $eigenvector5 = $totaldata5/$sumtotal2;
      $eigenvector6 = $totaldata6/$sumtotal2;
      $eigenvector7 = $totaldata7/$sumtotal2;
      $eigenvector8 = $totaldata8/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector5+$eigenvector6+$eigenvector7+$eigenvector8;

      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector5*100;
      $pengeluaran1 = ($persentase1*$total)/100;
      $persentase2 = $eigenvector6*100;
      $pengeluaran2 = ($persentase2*$total)/100;
      $persentase3 = $eigenvector7*100;
      $pengeluaran3 = ($persentase3*$total)/100;
      $persentase4 = $eigenvector8*100;
      $pengeluaran4 = ($persentase4*$total)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector5,$persentase1,29,1,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector5,$persentase1,1,4,$pengeluaran1);
      $this->subkriteriabb($id_keu,$pengeluaran2);
      $this->inputdata->inputhasil($id_keu,$eigenvector6,$persentase2,30,1,$pengeluaran2);
      $this->subkriteriabpr($id_keu,$pengeluaran3);
      $this->inputdata->inputhasil($id_keu,$eigenvector7,$persentase3,31,1,$pengeluaran3);
      $this->inputdata->inputhasil($id_keu,$eigenvector8,$persentase4,32,1,$pengeluaran4);
      $this->inputdata->inputhasil($id_keu,$eigenvector1,$persentase1,28,5,$pengeluaran4);

      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector5-$eigenvector1;
      $hasil2 = $eigenvector6-$eigenvector2;
      $hasil3 = $eigenvector7-$eigenvector3;
      $hasil4 = $eigenvector8-$eigenvector4;

      // nilai eigen yang akan digunakan
      // $dataeigenvector[0]=$eigenvector5; 
      // $dataeigenvector[1]=$eigenvector6; 
      // $dataeigenvector[2]=$eigenvector7;
      // $dataeigenvector[3]=$eigenvector8;

      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector5*$data1[0];
      $vektorsum1[] = $eigenvector6*$data1[1];
      $vektorsum1[] = $eigenvector7*$data1[2];
      $vektorsum1[] = $eigenvector8*$data1[3];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector5*$data2[0];
      $vektorsum2[] = $eigenvector6*$data2[1];
      $vektorsum2[] = $eigenvector7*$data2[2];
      $vektorsum2[] = $eigenvector8*$data2[3];

      $vektorsum3 = array();
      $vektorsum3[] = $eigenvector5*$data3[0];
      $vektorsum3[] = $eigenvector6*$data3[1];
      $vektorsum3[] = $eigenvector7*$data3[2];
      $vektorsum3[] = $eigenvector8*$data3[3];

      $vektorsum4 = array();
      $vektorsum4[] = $eigenvector5*$data4[0];
      $vektorsum4[] = $eigenvector6*$data4[1];
      $vektorsum4[] = $eigenvector7*$data4[2];
      $vektorsum4[] = $eigenvector8*$data4[3];

      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1]+$vektorsum1[2]+$vektorsum1[3];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1]+$vektorsum2[2]+$vektorsum2[3];
      $jumlahvektorsum3 = $vektorsum3[0]+$vektorsum3[1]+$vektorsum3[2]+$vektorsum3[3];
      $jumlahvektorsum4 = $vektorsum4[0]+$vektorsum4[1]+$vektorsum4[2]+$vektorsum4[3];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector5;
      $vk2 = $jumlahvektorsum2/$eigenvector6;
      $vk3 = $jumlahvektorsum3/$eigenvector7;
      $vk4 = $jumlahvektorsum4/$eigenvector8;

      // nilai lamda maks
      $lamda              = ($vk1+$vk2+$vk3+$vk4)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi  = ($lamda - $n)/($n-1);

      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }

    function subkriteriabpr($id,$pengeluaranbpr)
    {
        // get data dari database
        $id = $id-1;
        $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
        $n = 2;
        $id_keu = $id+1;
        // get data dengan tipe pengeluaran
        $databpr1 = $value[25];
        $databpr2 = $value[26];

        $data1 = array();
        $data2 = array();

        // pembobotan elemen-elemen pada setiap level dan hierarki
        $data1[] = $databpr1/$databpr1;
        $data1[] = $databpr1/$databpr2;

        $data2[] = $databpr2/$databpr1;
        $data2[] = $databpr2/$databpr2;

      // perkalian matriks iterasi pertama
      $data5 = array();
      $data5[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0]);
      $data5[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1]);

      $data6 = array();
      $data6[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0]);
      $data6[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1]);

      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data5[0]+$data5[1];
      $totaldata2 = $data6[0]+$data6[1];
      $sumtotal = $totaldata1+$totaldata2;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;

      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1+$eigenvector2;  

      // perkalian matriks iterasi ke 2    
      $data9 = array();
      $data9[] = ($data5[0]*$data5[0])+($data5[1]*$data6[0]);
      $data9[] = ($data5[0]*$data5[1])+($data5[1]*$data6[1]);

      $data10 = array();
      $data10[] = ($data6[0]*$data5[0])+($data6[1]*$data6[0]);
      $data10[] = ($data6[0]*$data5[1])+($data6[1]*$data6[1]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata5 = $data9[0]+$data9[1];
      $totaldata6 = $data10[0]+$data10[1];
      $sumtotal2 = $totaldata5+$totaldata6;
      
      // hasil normalisasi iterasi kedua
      $eigenvector5 = $totaldata5/$sumtotal2;
      $eigenvector6 = $totaldata6/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector5+$eigenvector6;

      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector5*100;
      $pengeluaran1 = ($persentase1*$pengeluaranbpr)/100;
      $persentase2 = $eigenvector6*100;
      $pengeluaran2 = ($persentase2*$pengeluaranbpr)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector5,$persentase1,26,3, $pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector6,$persentase2,27,3,$pengeluaran2);
      
      // // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector5-$eigenvector1;
      $hasil2 = $eigenvector6-$eigenvector2;

      // $dataeigenvector[0]=$eigenvector5; 
      // $dataeigenvector[1]=$eigenvector6; 

      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector5*$data1[0];
      $vektorsum1[] = $eigenvector6*$data1[1];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector5*$data2[0];
      $vektorsum2[] = $eigenvector6*$data2[1];

      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector5;
      $vk2 = $jumlahvektorsum2/$eigenvector6;

      // nilai lamda maks
      $lamda = ($vk1+$vk2)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);
      
      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }

    public function subkriteriabb($id,$pengeluaranbb)
    {
      // get data dari database
      $id = $id-1;
      $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
      $n = 7;
      $id_keu = $id+1;
       $row = $this->getdata->getDataBy($id);

       // get data dengan tipe pengeluaran
        $databb1 = $value[1]+$value[2]+$value[3]+$value[4];
        $databb2 = $value[5]+$value[6];
        $databb3 = $value[7]+$value[8];
        $databb4 = $value[9]+$value[10]+$value[11]+$value[12]+$value[13]+$value[14]+$value[15]+$value[16];
        $databb5 = $value[17]+$value[18]+$value[19]+$value[20]+$value[21];
        $databb6 = $value[22]+$value[23];
        $databb7 = $value[24];

       $data1 = array();
       $data2 = array();
       $data3 = array();
       $data4 = array();
       $data5 = array();
       $data6 = array();
       $data7 = array();

      // pembobotan elemen-elemen pada setiap level dan hierarki
      $data1[] = $databb1/$databb1;
      $data1[] = $databb1/$databb2;
      $data1[] = $databb1/$databb3;
      $data1[] = $databb1/$databb4;
      $data1[] = $databb1/$databb5;
      $data1[] = $databb1/$databb6;
      $data1[] = $databb1/$databb7;

      $data2[] = $databb2/$databb1;
      $data2[] = $databb2/$databb2;
      $data2[] = $databb2/$databb3;
      $data2[] = $databb2/$databb4;
      $data2[] = $databb2/$databb5;
      $data2[] = $databb2/$databb6;
      $data2[] = $databb2/$databb7;

      $data3[] = $databb3/$databb1;
      $data3[] = $databb3/$databb2;
      $data3[] = $databb3/$databb3;
      $data3[] = $databb3/$databb4;
      $data3[] = $databb3/$databb5;
      $data3[] = $databb3/$databb6;
      $data3[] = $databb3/$databb7;

      $data4[] = $databb4/$databb1;
      $data4[] = $databb4/$databb2;
      $data4[] = $databb4/$databb3;
      $data4[] = $databb4/$databb4;
      $data4[] = $databb4/$databb5;
      $data4[] = $databb4/$databb6;
      $data4[] = $databb4/$databb7;

      $data5[] = $databb5/$databb1;
      $data5[] = $databb5/$databb2;
      $data5[] = $databb5/$databb3;
      $data5[] = $databb5/$databb4;
      $data5[] = $databb5/$databb5;
      $data5[] = $databb5/$databb6;
      $data5[] = $databb5/$databb7;

      $data6[] = $databb6/$databb1;
      $data6[] = $databb6/$databb2;
      $data6[] = $databb6/$databb3;
      $data6[] = $databb6/$databb4;
      $data6[] = $databb6/$databb5;
      $data6[] = $databb6/$databb6;
      $data6[] = $databb6/$databb7;

      $data7[] = $databb7/$databb1;
      $data7[] = $databb7/$databb2;
      $data7[] = $databb7/$databb3;
      $data7[] = $databb7/$databb4;
      $data7[] = $databb7/$databb5;
      $data7[] = $databb7/$databb6;
      $data7[] = $databb7/$databb7;
      
      // perkalian matriks iterasi pertama
      $data8 = array();
      $data8[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0])+($data1[2]*$data3[0])+($data1[3]*$data4[0])+($data1[4]*$data5[0])+($data1[5]*$data6[0])+($data1[6]*$data7[0]);
      $data8[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1])+($data1[2]*$data3[1])+($data1[3]*$data4[1])+($data1[4]*$data5[1])+($data1[5]*$data6[1])+($data1[6]*$data7[1]);
      $data8[] = ($data1[0]*$data1[2])+($data1[1]*$data2[2])+($data1[2]*$data3[2])+($data1[3]*$data4[2])+($data1[4]*$data5[2])+($data1[5]*$data6[2])+($data1[6]*$data7[2]);
      $data8[] = ($data1[0]*$data1[3])+($data1[1]*$data2[3])+($data1[2]*$data3[3])+($data1[3]*$data4[3])+($data1[4]*$data5[3])+($data1[5]*$data6[3])+($data1[6]*$data7[3]);
      $data8[] = ($data1[0]*$data1[4])+($data1[1]*$data2[4])+($data1[2]*$data3[4])+($data1[3]*$data4[4])+($data1[4]*$data5[4])+($data1[5]*$data6[4])+($data1[6]*$data7[4]);
      $data8[] = ($data1[0]*$data1[5])+($data1[1]*$data2[5])+($data1[2]*$data3[5])+($data1[3]*$data4[5])+($data1[4]*$data5[5])+($data1[5]*$data6[5])+($data1[6]*$data7[5]);
      $data8[] = ($data1[0]*$data1[6])+($data1[1]*$data2[6])+($data1[2]*$data3[6])+($data1[3]*$data4[6])+($data1[4]*$data5[6])+($data1[5]*$data6[6])+($data1[6]*$data7[6]);

      $data9 = array();
      $data9[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0])+($data2[2]*$data3[0])+($data2[3]*$data4[0])+($data2[4]*$data5[0])+($data2[5]*$data6[0])+($data2[6]*$data7[0]);
      $data9[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1])+($data2[2]*$data3[1])+($data2[3]*$data4[1])+($data2[4]*$data5[1])+($data2[5]*$data6[1])+($data2[6]*$data7[1]);
      $data9[] = ($data2[0]*$data1[2])+($data2[1]*$data2[2])+($data2[2]*$data3[2])+($data2[3]*$data4[2])+($data2[4]*$data5[2])+($data2[5]*$data6[2])+($data2[6]*$data7[2]);
      $data9[] = ($data2[0]*$data1[3])+($data2[1]*$data2[3])+($data2[2]*$data3[3])+($data2[3]*$data4[3])+($data2[4]*$data5[3])+($data2[5]*$data6[3])+($data2[6]*$data7[3]);
      $data9[] = ($data2[0]*$data1[4])+($data2[1]*$data2[4])+($data2[2]*$data3[4])+($data2[3]*$data4[4])+($data2[4]*$data5[4])+($data2[5]*$data6[4])+($data2[6]*$data7[4]);
      $data9[] = ($data2[0]*$data1[5])+($data2[1]*$data2[5])+($data2[2]*$data3[5])+($data2[3]*$data4[5])+($data2[4]*$data5[5])+($data2[5]*$data6[5])+($data2[6]*$data7[5]);
      $data9[] = ($data2[0]*$data1[6])+($data2[1]*$data2[6])+($data2[2]*$data3[6])+($data2[3]*$data4[6])+($data2[4]*$data5[6])+($data2[5]*$data6[6])+($data2[6]*$data7[6]);
      

      $data10 = array();
      $data10[] = ($data3[0]*$data1[0])+($data3[1]*$data2[0])+($data3[2]*$data3[0])+($data3[3]*$data4[0])+($data3[4]*$data5[0])+($data3[5]*$data6[0])+($data3[6]*$data7[0]);
      $data10[] = ($data3[0]*$data1[1])+($data3[1]*$data2[1])+($data3[2]*$data3[1])+($data3[3]*$data4[1])+($data3[4]*$data5[1])+($data3[5]*$data6[1])+($data3[6]*$data7[1]);
      $data10[] = ($data3[0]*$data1[2])+($data3[1]*$data2[2])+($data3[2]*$data3[2])+($data3[3]*$data4[2])+($data3[4]*$data5[2])+($data3[5]*$data6[2])+($data3[6]*$data7[2]);
      $data10[] = ($data3[0]*$data1[3])+($data3[1]*$data2[3])+($data3[2]*$data3[3])+($data3[3]*$data4[3])+($data3[4]*$data5[3])+($data3[5]*$data6[3])+($data3[6]*$data7[3]);
      $data10[] = ($data3[0]*$data1[4])+($data3[1]*$data2[4])+($data3[2]*$data3[4])+($data3[3]*$data4[4])+($data3[4]*$data5[4])+($data3[5]*$data6[4])+($data3[6]*$data7[4]);
      $data10[] = ($data3[0]*$data1[5])+($data3[1]*$data2[5])+($data3[2]*$data3[5])+($data3[3]*$data4[5])+($data3[4]*$data5[5])+($data3[5]*$data6[5])+($data3[6]*$data7[5]);
      $data10[] = ($data3[0]*$data1[6])+($data3[1]*$data2[6])+($data3[2]*$data3[6])+($data3[3]*$data4[6])+($data3[4]*$data5[6])+($data3[5]*$data6[6])+($data3[6]*$data7[6]);

      $data11 = array();
      $data11[] = ($data4[0]*$data1[0])+($data4[1]*$data2[0])+($data4[2]*$data3[0])+($data4[3]*$data4[0])+($data4[4]*$data5[0])+($data4[5]*$data6[0])+($data4[6]*$data7[0]);
      $data11[] = ($data4[0]*$data1[1])+($data4[1]*$data2[1])+($data4[2]*$data3[1])+($data4[3]*$data4[1])+($data4[4]*$data5[1])+($data4[5]*$data6[1])+($data4[6]*$data7[1]);
      $data11[] = ($data4[0]*$data1[2])+($data4[1]*$data2[2])+($data4[2]*$data3[2])+($data4[3]*$data4[2])+($data4[4]*$data5[2])+($data4[5]*$data6[2])+($data4[6]*$data7[2]);
      $data11[] = ($data4[0]*$data1[3])+($data4[1]*$data2[3])+($data4[2]*$data3[3])+($data4[3]*$data4[3])+($data4[4]*$data5[3])+($data4[5]*$data6[3])+($data4[6]*$data7[3]);
      $data11[] = ($data4[0]*$data1[4])+($data4[1]*$data2[4])+($data4[2]*$data3[4])+($data4[3]*$data4[4])+($data4[4]*$data5[4])+($data4[5]*$data6[4])+($data4[6]*$data7[4]);
      $data11[] = ($data4[0]*$data1[5])+($data4[1]*$data2[5])+($data4[2]*$data3[5])+($data4[3]*$data4[5])+($data4[4]*$data5[5])+($data4[5]*$data6[5])+($data4[6]*$data7[5]);
      $data11[] = ($data4[0]*$data1[6])+($data4[1]*$data2[6])+($data4[2]*$data3[6])+($data4[3]*$data4[6])+($data4[4]*$data5[6])+($data4[5]*$data6[6])+($data4[6]*$data7[6]);
      
      $data12 = array();
      $data12[] = ($data5[0]*$data1[0])+($data5[1]*$data2[0])+($data5[2]*$data3[0])+($data5[3]*$data4[0])+($data5[4]*$data5[0])+($data5[5]*$data6[0])+($data5[6]*$data7[0]);
      $data12[] = ($data5[0]*$data1[1])+($data5[1]*$data2[1])+($data5[2]*$data3[1])+($data5[3]*$data4[1])+($data5[4]*$data5[1])+($data5[5]*$data6[1])+($data5[6]*$data7[1]);
      $data12[] = ($data5[0]*$data1[2])+($data5[1]*$data2[2])+($data5[2]*$data3[2])+($data5[3]*$data4[2])+($data5[4]*$data5[2])+($data5[5]*$data6[2])+($data5[6]*$data7[2]);
      $data12[] = ($data5[0]*$data1[3])+($data5[1]*$data2[3])+($data5[2]*$data3[3])+($data5[3]*$data4[3])+($data5[4]*$data5[3])+($data5[5]*$data6[3])+($data5[6]*$data7[3]);
      $data12[] = ($data5[0]*$data1[4])+($data5[1]*$data2[4])+($data5[2]*$data3[4])+($data5[3]*$data4[4])+($data5[4]*$data5[4])+($data5[5]*$data6[4])+($data5[6]*$data7[4]);
      $data12[] = ($data5[0]*$data1[5])+($data5[1]*$data2[5])+($data5[2]*$data3[5])+($data5[3]*$data4[5])+($data5[4]*$data5[5])+($data5[5]*$data6[5])+($data5[6]*$data7[5]);
      $data12[] = ($data5[0]*$data1[6])+($data5[1]*$data2[6])+($data5[2]*$data3[6])+($data5[3]*$data4[6])+($data5[4]*$data5[6])+($data5[5]*$data6[6])+($data5[6]*$data7[6]);

      $data13 = array();
      $data13[] = ($data6[0]*$data1[0])+($data6[1]*$data2[0])+($data6[2]*$data3[0])+($data6[3]*$data4[0])+($data6[4]*$data5[0])+($data6[5]*$data6[0])+($data6[6]*$data7[0]);
      $data13[] = ($data6[0]*$data1[1])+($data6[1]*$data2[1])+($data6[2]*$data3[1])+($data6[3]*$data4[1])+($data6[4]*$data5[1])+($data6[5]*$data6[1])+($data6[6]*$data7[1]);
      $data13[] = ($data6[0]*$data1[2])+($data6[1]*$data2[2])+($data6[2]*$data3[2])+($data6[3]*$data4[2])+($data6[4]*$data5[2])+($data6[5]*$data6[2])+($data6[6]*$data7[2]);
      $data13[] = ($data6[0]*$data1[3])+($data6[1]*$data2[3])+($data6[2]*$data3[3])+($data6[3]*$data4[3])+($data6[4]*$data5[3])+($data6[5]*$data6[3])+($data6[6]*$data7[3]);
      $data13[] = ($data6[0]*$data1[4])+($data6[1]*$data2[4])+($data6[2]*$data3[4])+($data6[3]*$data4[4])+($data6[4]*$data5[4])+($data6[5]*$data6[4])+($data6[6]*$data7[4]);
      $data13[] = ($data6[0]*$data1[5])+($data6[1]*$data2[5])+($data6[2]*$data3[5])+($data6[3]*$data4[5])+($data6[4]*$data5[5])+($data6[5]*$data6[5])+($data6[6]*$data7[5]);
      $data13[] = ($data6[0]*$data1[6])+($data6[1]*$data2[6])+($data6[2]*$data3[6])+($data6[3]*$data4[6])+($data6[4]*$data5[6])+($data6[5]*$data6[6])+($data6[6]*$data7[6]);

      $data14 = array();
      $data14[] = ($data7[0]*$data1[0])+($data7[1]*$data2[0])+($data7[2]*$data3[0])+($data7[3]*$data4[0])+($data7[4]*$data5[0])+($data7[5]*$data6[0])+($data7[6]*$data7[0]);
      $data14[] = ($data7[0]*$data1[1])+($data7[1]*$data2[1])+($data7[2]*$data3[1])+($data7[3]*$data4[1])+($data7[4]*$data5[1])+($data7[5]*$data6[1])+($data7[6]*$data7[1]);
      $data14[] = ($data7[0]*$data1[2])+($data7[1]*$data2[2])+($data7[2]*$data3[2])+($data7[3]*$data4[2])+($data7[4]*$data5[2])+($data7[5]*$data6[2])+($data7[6]*$data7[2]);
      $data14[] = ($data7[0]*$data1[3])+($data7[1]*$data2[3])+($data7[2]*$data3[3])+($data7[3]*$data4[3])+($data7[4]*$data5[3])+($data7[5]*$data6[3])+($data7[6]*$data7[3]);
      $data14[] = ($data7[0]*$data1[4])+($data7[1]*$data2[4])+($data7[2]*$data3[4])+($data7[3]*$data4[4])+($data7[4]*$data5[4])+($data7[5]*$data6[4])+($data7[6]*$data7[4]);
      $data14[] = ($data7[0]*$data1[5])+($data7[1]*$data2[5])+($data7[2]*$data3[5])+($data7[3]*$data4[5])+($data7[4]*$data5[5])+($data7[5]*$data6[5])+($data7[6]*$data7[5]);
      $data14[] = ($data7[0]*$data1[6])+($data7[1]*$data2[6])+($data7[2]*$data3[6])+($data7[3]*$data4[6])+($data7[4]*$data5[6])+($data7[5]*$data6[6])+($data7[6]*$data7[6]);

      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data8[0]+$data8[1]+$data8[2]+$data8[3]+$data8[4]+$data8[5]+$data8[6];
      $totaldata2 = $data9[0]+$data9[1]+$data9[2]+$data9[3]+$data9[4]+$data9[5]+$data9[6];
      $totaldata3 = $data10[0]+$data10[1]+$data10[2]+$data10[3]+$data10[4]+$data10[5]+$data10[6];
      $totaldata4 = $data11[0]+$data11[1]+$data11[2]+$data11[3]+$data11[4]+$data11[5]+$data11[6];
      $totaldata5 = $data12[0]+$data12[1]+$data12[2]+$data12[3]+$data12[4]+$data12[5]+$data12[6];
      $totaldata6 = $data13[0]+$data13[1]+$data13[2]+$data13[3]+$data13[4]+$data13[5]+$data13[6];
      $totaldata7 = $data14[0]+$data14[1]+$data14[2]+$data14[3]+$data14[4]+$data14[5]+$data14[6];
      $sumtotal = $totaldata1+$totaldata2+$totaldata3+$totaldata4+$totaldata5+$totaldata6+$totaldata7;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      $eigenvector3 = $totaldata3/$sumtotal;
      $eigenvector4 = $totaldata4/$sumtotal;
      $eigenvector5 = $totaldata5/$sumtotal;
      $eigenvector6 = $totaldata6/$sumtotal;
      $eigenvector7 = $totaldata7/$sumtotal;

      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1 + $eigenvector2 + $eigenvector3 + $eigenvector4 + $eigenvector5 + $eigenvector6 + $eigenvector7;
      
      // perkalian matriks iterasi ke 2    
      $data15 = array();
      $data15[] = ($data8[0]*$data8[0])+($data8[1]*$data9[0])+($data8[2]*$data10[0])+($data8[3]*$data11[0])+($data8[4]*$data12[0])+($data8[5]*$data13[0])+($data8[6]*$data14[0]);
      $data15[] = ($data8[0]*$data8[1])+($data8[1]*$data9[1])+($data8[2]*$data10[1])+($data8[3]*$data11[1])+($data8[4]*$data12[1])+($data8[5]*$data13[1])+($data8[6]*$data14[1]);
      $data15[] = ($data8[0]*$data8[2])+($data8[1]*$data9[2])+($data8[2]*$data10[2])+($data8[3]*$data11[2])+($data8[4]*$data12[2])+($data8[5]*$data13[2])+($data8[6]*$data14[2]);
      $data15[] = ($data8[0]*$data8[3])+($data8[1]*$data9[3])+($data8[2]*$data10[3])+($data8[3]*$data11[3])+($data8[4]*$data12[3])+($data8[5]*$data13[3])+($data8[6]*$data14[3]);
      $data15[] = ($data8[0]*$data8[4])+($data8[1]*$data9[4])+($data8[2]*$data10[4])+($data8[3]*$data11[4])+($data8[4]*$data12[4])+($data8[5]*$data13[4])+($data8[6]*$data14[4]);
      $data15[] = ($data8[0]*$data8[5])+($data8[1]*$data9[5])+($data8[2]*$data10[5])+($data8[3]*$data11[5])+($data8[4]*$data12[5])+($data8[5]*$data13[5])+($data8[6]*$data14[5]);
      $data15[] = ($data8[0]*$data8[6])+($data8[1]*$data9[6])+($data8[2]*$data10[6])+($data8[3]*$data11[6])+($data8[4]*$data12[6])+($data8[5]*$data13[6])+($data8[6]*$data14[6]);

      $data16 = array();
      $data16[] = ($data9[0]*$data8[0])+($data9[1]*$data9[0])+($data9[2]*$data10[0])+($data9[3]*$data11[0])+($data9[4]*$data12[0])+($data9[5]*$data13[0])+($data9[6]*$data14[0]);
      $data16[] = ($data9[0]*$data8[1])+($data9[1]*$data9[1])+($data9[2]*$data10[1])+($data9[3]*$data11[1])+($data9[4]*$data12[1])+($data9[5]*$data13[1])+($data9[6]*$data14[1]);
      $data16[] = ($data9[0]*$data8[2])+($data9[1]*$data9[2])+($data9[2]*$data10[2])+($data9[3]*$data11[2])+($data9[4]*$data12[2])+($data9[5]*$data13[2])+($data9[6]*$data14[2]);
      $data16[] = ($data9[0]*$data8[3])+($data9[1]*$data9[3])+($data9[2]*$data10[3])+($data9[3]*$data11[3])+($data9[4]*$data12[3])+($data9[5]*$data13[3])+($data9[6]*$data14[3]);
      $data16[] = ($data9[0]*$data8[4])+($data9[1]*$data9[4])+($data9[2]*$data10[4])+($data9[3]*$data11[4])+($data9[4]*$data12[4])+($data9[5]*$data13[4])+($data9[6]*$data14[4]);
      $data16[] = ($data9[0]*$data8[5])+($data9[1]*$data9[5])+($data9[2]*$data10[5])+($data9[3]*$data11[5])+($data9[4]*$data12[5])+($data9[5]*$data13[5])+($data9[6]*$data14[5]);
      $data16[] = ($data9[0]*$data8[6])+($data9[1]*$data9[6])+($data9[2]*$data10[6])+($data9[3]*$data11[6])+($data9[4]*$data12[6])+($data9[5]*$data13[6])+($data9[6]*$data14[6]);


      $data17 = array();
      $data17[] = ($data10[0]*$data8[0])+($data10[1]*$data9[0])+($data10[2]*$data10[0])+($data10[3]*$data11[0])+($data10[4]*$data12[0])+($data10[5]*$data13[0])+($data10[6]*$data14[0]);
      $data17[] = ($data10[0]*$data8[1])+($data10[1]*$data9[1])+($data10[2]*$data10[1])+($data10[3]*$data11[1])+($data10[4]*$data12[1])+($data10[5]*$data13[1])+($data10[6]*$data14[1]);
      $data17[] = ($data10[0]*$data8[2])+($data10[1]*$data9[2])+($data10[2]*$data10[2])+($data10[3]*$data11[2])+($data10[4]*$data12[2])+($data10[5]*$data13[2])+($data10[6]*$data14[2]);
      $data17[] = ($data10[0]*$data8[3])+($data10[1]*$data9[3])+($data10[2]*$data10[3])+($data10[3]*$data11[3])+($data10[4]*$data12[3])+($data10[5]*$data13[3])+($data10[6]*$data14[3]);
      $data17[] = ($data10[0]*$data8[4])+($data10[1]*$data9[4])+($data10[2]*$data10[4])+($data10[3]*$data11[4])+($data10[4]*$data12[4])+($data10[5]*$data13[4])+($data10[6]*$data14[4]);
      $data17[] = ($data10[0]*$data8[5])+($data10[1]*$data9[5])+($data10[2]*$data10[5])+($data10[3]*$data11[5])+($data10[4]*$data12[5])+($data10[5]*$data13[5])+($data10[6]*$data14[5]);
      $data17[] = ($data10[0]*$data8[6])+($data10[1]*$data9[6])+($data10[2]*$data10[6])+($data10[3]*$data11[6])+($data10[4]*$data12[6])+($data10[5]*$data13[6])+($data10[6]*$data14[6]);
      

      $data18 = array();
      $data18[] = ($data11[0]*$data8[0])+($data11[1]*$data9[0])+($data11[2]*$data10[0])+($data11[3]*$data11[0])+($data11[4]*$data12[0])+($data11[5]*$data13[0])+($data11[6]*$data14[0]);
      $data18[] = ($data11[0]*$data8[1])+($data11[1]*$data9[1])+($data11[2]*$data10[1])+($data11[3]*$data11[1])+($data11[4]*$data12[1])+($data11[5]*$data13[1])+($data11[6]*$data14[1]);
      $data18[] = ($data11[0]*$data8[2])+($data11[1]*$data9[2])+($data11[2]*$data10[2])+($data11[3]*$data11[2])+($data11[4]*$data12[2])+($data11[5]*$data13[2])+($data11[6]*$data14[2]);
      $data18[] = ($data11[0]*$data8[3])+($data11[1]*$data9[3])+($data11[2]*$data10[3])+($data11[3]*$data11[3])+($data11[4]*$data12[3])+($data11[5]*$data13[3])+($data11[6]*$data14[3]);
      $data18[] = ($data11[0]*$data8[4])+($data11[1]*$data9[4])+($data11[2]*$data10[4])+($data11[3]*$data11[4])+($data11[4]*$data12[4])+($data11[5]*$data13[4])+($data11[6]*$data14[4]);
      $data18[] = ($data11[0]*$data8[5])+($data11[1]*$data9[5])+($data11[2]*$data10[5])+($data11[3]*$data11[5])+($data11[4]*$data12[5])+($data11[5]*$data13[5])+($data11[6]*$data14[5]);
      $data18[] = ($data11[0]*$data8[6])+($data11[1]*$data9[6])+($data11[2]*$data10[6])+($data11[3]*$data11[6])+($data11[4]*$data12[6])+($data11[5]*$data13[6])+($data11[6]*$data14[6]);

      $data19 = array();
      $data19[] = ($data12[0]*$data8[0])+($data12[1]*$data9[0])+($data12[2]*$data10[0])+($data12[3]*$data11[0])+($data12[4]*$data12[0])+($data12[5]*$data13[0])+($data12[6]*$data14[0]);
      $data19[] = ($data12[0]*$data8[1])+($data12[1]*$data9[1])+($data12[2]*$data10[1])+($data12[3]*$data11[1])+($data12[4]*$data12[1])+($data12[5]*$data13[1])+($data12[6]*$data14[1]);
      $data19[] = ($data12[0]*$data8[2])+($data12[1]*$data9[2])+($data12[2]*$data10[2])+($data12[3]*$data11[2])+($data12[4]*$data12[2])+($data12[5]*$data13[2])+($data12[6]*$data14[2]);
      $data19[] = ($data12[0]*$data8[3])+($data12[1]*$data9[3])+($data12[2]*$data10[3])+($data12[3]*$data11[3])+($data12[4]*$data12[3])+($data12[5]*$data13[3])+($data12[6]*$data14[3]);
      $data19[] = ($data12[0]*$data8[4])+($data12[1]*$data9[4])+($data12[2]*$data10[4])+($data12[3]*$data11[4])+($data12[4]*$data12[4])+($data12[5]*$data13[4])+($data12[6]*$data14[4]);
      $data19[] = ($data12[0]*$data8[5])+($data12[1]*$data9[5])+($data12[2]*$data10[5])+($data12[3]*$data11[5])+($data12[4]*$data12[5])+($data12[5]*$data13[5])+($data12[6]*$data14[5]);
      $data19[] = ($data12[0]*$data8[6])+($data12[1]*$data9[6])+($data12[2]*$data10[6])+($data12[3]*$data11[6])+($data12[4]*$data12[6])+($data12[5]*$data13[6])+($data12[6]*$data14[6]);

      $data20 = array();
      $data20[] = ($data13[0]*$data8[0])+($data13[1]*$data9[0])+($data13[2]*$data10[0])+($data13[3]*$data11[0])+($data13[4]*$data12[0])+($data13[5]*$data13[0])+($data13[6]*$data14[0]);
      $data20[] = ($data13[0]*$data8[1])+($data13[1]*$data9[1])+($data13[2]*$data10[1])+($data13[3]*$data11[1])+($data13[4]*$data12[1])+($data13[5]*$data13[1])+($data13[6]*$data14[1]);
      $data20[] = ($data13[0]*$data8[2])+($data13[1]*$data9[2])+($data13[2]*$data10[2])+($data13[3]*$data11[2])+($data13[4]*$data12[2])+($data13[5]*$data13[2])+($data13[6]*$data14[2]);
      $data20[] = ($data13[0]*$data8[3])+($data13[1]*$data9[3])+($data13[2]*$data10[3])+($data13[3]*$data11[3])+($data13[4]*$data12[3])+($data13[5]*$data13[3])+($data13[6]*$data14[3]);
      $data20[] = ($data13[0]*$data8[4])+($data13[1]*$data9[4])+($data13[2]*$data10[4])+($data13[3]*$data11[4])+($data13[4]*$data12[4])+($data13[5]*$data13[4])+($data13[6]*$data14[4]);
      $data20[] = ($data13[0]*$data8[5])+($data13[1]*$data9[5])+($data13[2]*$data10[5])+($data13[3]*$data11[5])+($data13[4]*$data12[5])+($data13[5]*$data13[5])+($data13[6]*$data14[5]);
      $data20[] = ($data13[0]*$data8[6])+($data13[1]*$data9[6])+($data13[2]*$data10[6])+($data13[3]*$data11[6])+($data13[4]*$data12[6])+($data13[5]*$data13[6])+($data13[6]*$data14[6]);

      $data21 = array();
      $data21[] = ($data14[0]*$data8[0])+($data14[1]*$data9[0])+($data14[2]*$data10[0])+($data14[3]*$data11[0])+($data14[4]*$data12[0])+($data14[5]*$data13[0])+($data14[6]*$data14[0]);
      $data21[] = ($data14[0]*$data8[1])+($data14[1]*$data9[1])+($data14[2]*$data10[1])+($data14[3]*$data11[1])+($data14[4]*$data12[1])+($data14[5]*$data13[1])+($data14[6]*$data14[1]);
      $data21[] = ($data14[0]*$data8[2])+($data14[1]*$data9[2])+($data14[2]*$data10[2])+($data14[3]*$data11[2])+($data14[4]*$data12[2])+($data14[5]*$data13[2])+($data14[6]*$data14[2]);
      $data21[] = ($data14[0]*$data8[3])+($data14[1]*$data9[3])+($data14[2]*$data10[3])+($data14[3]*$data11[3])+($data14[4]*$data12[3])+($data14[5]*$data13[3])+($data14[6]*$data14[3]);
      $data21[] = ($data14[0]*$data8[4])+($data14[1]*$data9[4])+($data14[2]*$data10[4])+($data14[3]*$data11[4])+($data14[4]*$data12[4])+($data14[5]*$data13[4])+($data14[6]*$data14[4]);
      $data21[] = ($data14[0]*$data8[5])+($data14[1]*$data9[5])+($data14[2]*$data10[5])+($data14[3]*$data11[5])+($data14[4]*$data12[5])+($data14[5]*$data13[5])+($data14[6]*$data14[5]);
      $data21[] = ($data14[0]*$data8[6])+($data14[1]*$data9[6])+($data14[2]*$data10[6])+($data14[3]*$data11[6])+($data14[4]*$data12[6])+($data14[5]*$data13[6])+($data14[6]*$data14[6]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata8  = $data15[0]+$data15[1]+$data15[2]+$data15[3]+$data15[4]+$data15[5]+$data15[6];
      $totaldata9  = $data16[0]+$data16[1]+$data16[2]+$data16[3]+$data16[4]+$data16[5]+$data16[6];
      $totaldata10 = $data17[0]+$data17[1]+$data17[2]+$data17[3]+$data17[4]+$data17[5]+$data17[6];
      $totaldata11 = $data18[0]+$data18[1]+$data18[2]+$data18[3]+$data18[4]+$data18[5]+$data18[6];
      $totaldata12 = $data19[0]+$data19[1]+$data19[2]+$data19[3]+$data19[4]+$data19[5]+$data19[6];
      $totaldata13 = $data20[0]+$data20[1]+$data20[2]+$data20[3]+$data20[4]+$data20[5]+$data20[6];
      $totaldata14 = $data21[0]+$data21[1]+$data21[2]+$data21[3]+$data21[4]+$data21[5]+$data21[6];
      $sumtotal2 = $totaldata8+$totaldata9+$totaldata10+$totaldata11+$totaldata12+$totaldata13+$totaldata14;
      
      // hasil normalisasi iterasi kedua
      $eigenvector8 = $totaldata8/$sumtotal2;
      $eigenvector9 = $totaldata9/$sumtotal2;
      $eigenvector10 = $totaldata10/$sumtotal2;
      $eigenvector11 = $totaldata11/$sumtotal2;
      $eigenvector12 = $totaldata12/$sumtotal2;
      $eigenvector13 = $totaldata13/$sumtotal2;
      $eigenvector14 = $totaldata14/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector8+$eigenvector9+$eigenvector10+$eigenvector11+$eigenvector12+$eigenvector13+$eigenvector14;

      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector8*100;
      $pengeluaran1 = ($persentase1*$pengeluaranbb)/100;
      $persentase2 = $eigenvector9*100;
      $pengeluaran2 = ($persentase2*$pengeluaranbb)/100;
      $persentase3 = $eigenvector10*100;
      $pengeluaran3 = ($persentase3*$pengeluaranbb)/100;
      $persentase4 = $eigenvector11*100;
      $pengeluaran4 = ($persentase4*$pengeluaranbb)/100;
      $persentase5 = $eigenvector12*100;
      $pengeluaran5 = ($persentase5*$pengeluaranbb)/100;
      $persentase6 = $eigenvector13*100;
      $pengeluaran6 = ($persentase6*$pengeluaranbb)/100;
      $persentase7 = $eigenvector14*100;
      $pengeluaran7 = ($persentase7*$pengeluaranbb)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector8,$persentase1,33,2,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector9,$persentase2,34,2,$pengeluaran2);
      $this->inputdata->inputhasil($id_keu,$eigenvector10,$persentase3,35,2,$pengeluaran3);
      $this->inputdata->inputhasil($id_keu,$eigenvector11,$persentase4,36,2,$pengeluaran4);
      $this->inputdata->inputhasil($id_keu,$eigenvector12,$persentase5,37,2,$pengeluaran5);
      $this->inputdata->inputhasil($id_keu,$eigenvector13,$persentase6,38,2,$pengeluaran6);
      $this->inputdata->inputhasil($id_keu,$eigenvector14,$persentase7,39,2,$pengeluaran7);
      $this->inputdata->inputhasil($id_keu,$eigenvector14,$persentase7,25,2,$pengeluaran7);
      
      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector8-$eigenvector1;
      $hasil2 = $eigenvector9-$eigenvector2;
      $hasil3 = $eigenvector10-$eigenvector3;
      $hasil4 = $eigenvector11-$eigenvector4;
      $hasil5 = $eigenvector12-$eigenvector5;
      $hasil6 = $eigenvector13-$eigenvector6;
      $hasil7 = $eigenvector14-$eigenvector7;

      // $dataeigenvector[0]=$eigenvector1; 
      // $dataeigenvector[1]=$eigenvector2; 
      // $dataeigenvector[2]=$eigenvector3;
      // $dataeigenvector[3]=$eigenvector4;
      // $dataeigenvector[4]=$eigenvector5;
      // $dataeigenvector[5]=$eigenvector6;
      // $dataeigenvector[6]=$eigenvector7;

      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector8*$data1[0];
      $vektorsum1[] = $eigenvector9*$data1[1];
      $vektorsum1[] = $eigenvector10*$data1[2];
      $vektorsum1[] = $eigenvector11*$data1[3];
      $vektorsum1[] = $eigenvector12*$data1[4];
      $vektorsum1[] = $eigenvector13*$data1[5];
      $vektorsum1[] = $eigenvector14*$data1[6];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector8*$data2[0];
      $vektorsum2[] = $eigenvector9*$data2[1];
      $vektorsum2[] = $eigenvector10*$data2[2];
      $vektorsum2[] = $eigenvector11*$data2[3];
      $vektorsum2[] = $eigenvector12*$data2[4];
      $vektorsum2[] = $eigenvector13*$data2[5];
      $vektorsum2[] = $eigenvector14*$data2[6];

      $vektorsum3 = array();
      $vektorsum3[] = $eigenvector8*$data3[0];
      $vektorsum3[] = $eigenvector9*$data3[1];
      $vektorsum3[] = $eigenvector10*$data3[2];
      $vektorsum3[] = $eigenvector11*$data3[3];
      $vektorsum3[] = $eigenvector12*$data3[4];
      $vektorsum3[] = $eigenvector13*$data3[5];
      $vektorsum3[] = $eigenvector14*$data3[6];

      $vektorsum4 = array();
      $vektorsum4[] = $eigenvector8*$data4[0];
      $vektorsum4[] = $eigenvector9*$data4[1];
      $vektorsum4[] = $eigenvector10*$data4[2];
      $vektorsum4[] = $eigenvector11*$data4[3];
      $vektorsum4[] = $eigenvector12*$data4[4];
      $vektorsum4[] = $eigenvector13*$data4[5];
      $vektorsum4[] = $eigenvector14*$data4[6];

      $vektorsum5 = array();
      $vektorsum5[] = $eigenvector8*$data5[0];
      $vektorsum5[] = $eigenvector9*$data5[1];
      $vektorsum5[] = $eigenvector10*$data5[2];
      $vektorsum5[] = $eigenvector11*$data5[3];
      $vektorsum5[] = $eigenvector12*$data5[4];
      $vektorsum5[] = $eigenvector13*$data5[5];
      $vektorsum5[] = $eigenvector14*$data5[6];

      $vektorsum6 = array();
      $vektorsum6[] = $eigenvector8*$data6[0];
      $vektorsum6[] = $eigenvector9*$data6[1];
      $vektorsum6[] = $eigenvector10*$data6[2];
      $vektorsum6[] = $eigenvector11*$data6[3];
      $vektorsum6[] = $eigenvector12*$data6[4];
      $vektorsum6[] = $eigenvector13*$data6[5];
      $vektorsum6[] = $eigenvector14*$data6[6];

      $vektorsum7 = array();
      $vektorsum7[] = $eigenvector8*$data7[0];
      $vektorsum7[] = $eigenvector9*$data7[1];
      $vektorsum7[] = $eigenvector10*$data7[2];
      $vektorsum7[] = $eigenvector11*$data7[3];
      $vektorsum7[] = $eigenvector12*$data7[4];
      $vektorsum7[] = $eigenvector13*$data7[5];
      $vektorsum7[] = $eigenvector14*$data7[6];
      
      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1]+$vektorsum1[2]+$vektorsum1[3]+$vektorsum1[4]+$vektorsum1[5]+$vektorsum1[6];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1]+$vektorsum2[2]+$vektorsum2[3]+$vektorsum2[4]+$vektorsum2[5]+$vektorsum2[6];
      $jumlahvektorsum3 = $vektorsum3[0]+$vektorsum3[1]+$vektorsum3[2]+$vektorsum3[3]+$vektorsum3[4]+$vektorsum3[5]+$vektorsum3[6];
      $jumlahvektorsum4 = $vektorsum4[0]+$vektorsum4[1]+$vektorsum4[2]+$vektorsum4[3]+$vektorsum4[4]+$vektorsum4[5]+$vektorsum4[6];
      $jumlahvektorsum5 = $vektorsum5[0]+$vektorsum5[1]+$vektorsum5[2]+$vektorsum5[3]+$vektorsum5[4]+$vektorsum5[5]+$vektorsum5[6];
      $jumlahvektorsum6 = $vektorsum6[0]+$vektorsum6[1]+$vektorsum6[2]+$vektorsum6[3]+$vektorsum6[4]+$vektorsum6[5]+$vektorsum6[6];
      $jumlahvektorsum7 = $vektorsum7[0]+$vektorsum7[1]+$vektorsum7[2]+$vektorsum7[3]+$vektorsum7[4]+$vektorsum7[5]+$vektorsum7[6];
      
      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector8;
      $vk2 = $jumlahvektorsum2/$eigenvector9;
      $vk3 = $jumlahvektorsum3/$eigenvector10;
      $vk4 = $jumlahvektorsum4/$eigenvector11;
      $vk5 = $jumlahvektorsum5/$eigenvector12;
      $vk6 = $jumlahvektorsum6/$eigenvector13;
      $vk7 = $jumlahvektorsum7/$eigenvector14;
      
      // nilai lamda maks
      $lamda = ($vk1+$vk2+$vk3+$vk4+$vk5+$vk6+$vk7)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);

      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }
    // fix
    public function kriteriapp($id,$pengeluaranpp)
    {
        // get data dari database
        $id = $id-1;
        $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
        $n = 2;
        $id_keu = $id+1;
        $row = $this->getdata->getDataBy($id);
        // get data dengan tipe pengeluaran
        $datapp1 = $value[22];
        $datapp2 = $value[23];
    
        $data1 = array();
        $data2 = array();

        // pembobotan elemen-elemen pada setiap level dan hierarki
        $data1[] = $datapp1/$datapp1;
        $data1[] = $datapp1/$datapp2;

        $data2[] = $datapp2/$datapp1;
        $data2[] = $datapp2/$datapp2;

      // perkalian matriks iterasi pertama
      $data5 = array();
      $data5[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0]);
      $data5[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1]);

      $data6 = array();
      $data6[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0]);
      $data6[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1]);
    
      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data5[0]+$data5[1];
      $totaldata2 = $data6[0]+$data6[1];
      $sumtotal = $totaldata1+$totaldata2;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      
      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1+$eigenvector2;      

      // perkalian matriks iterasi ke 2    
      $data9 = array();
      $data9[] = ($data5[0]*$data5[0])+($data5[1]*$data6[0]);
      $data9[] = ($data5[0]*$data5[1])+($data5[1]*$data6[1]);

      $data10 = array();
      $data10[] = ($data6[0]*$data5[0])+($data6[1]*$data6[0]);
      $data10[] = ($data6[0]*$data5[1])+($data6[1]*$data6[1]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata5 = $data9[0]+$data9[1];
      $totaldata6 = $data10[0]+$data10[1];
      $sumtotal2 = $totaldata5+$totaldata6;
      
      // hasil normalisasi iterasi kedua
      $eigenvector5 = $totaldata5/$sumtotal2;
      $eigenvector6 = $totaldata6/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector5+$eigenvector6;

      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector5*100;
      $pengeluaran1 = ($persentase1*$pengeluaranpp)/100;
      $persentase2 = $eigenvector6*100;
      $pengeluaran2 = ($persentase2*$pengeluaranpp)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector5,$persentase1,23,2,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector6,$persentase2,24,2,$pengeluaran2);
      
      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector5-$eigenvector1;
      $hasil2 = $eigenvector6-$eigenvector2;

      // $dataeigenvector[0]=$eigenvector1; 
      // $dataeigenvector[1]=$eigenvector2; 
      
      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector5*$data1[0];
      $vektorsum1[] = $eigenvector6*$data1[1];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector5*$data2[0];
      $vektorsum2[] = $eigenvector6*$data2[1];


      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector5;
      $vk2 = $jumlahvektorsum2/$eigenvector6;

      // nilai lamda maks
      $lamda = ($vk1+$vk2)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);
      
      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }

    // fix
    public function kriteriabhp($id,$pengeluaranbhp)
    {      
        // get data dari database
        $id = $id-1;
        $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
        $n = 2;
        $id_keu = $id+1;
        $row = $this->getdata->getDataBy($id);
        // get data dengan tipe pengeluaran
        $databhp1 = $value[5];
        $databhp2 = $value[6];
    
        $data1 = array();
        $data2 = array();

        // pembobotan elemen-elemen pada setiap level dan hierarki
        $data1[] = $databhp1/$databhp1;
        $data1[] = $databhp1/$databhp2;

        $data2[] = $databhp2/$databhp1;
        $data2[] = $databhp2/$databhp2;

      // perkalian matriks iterasi pertama
      $data5 = array();
      $data5[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0]);
      $data5[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1]);

      $data6 = array();
      $data6[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0]);
      $data6[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1]);
    

      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data5[0]+$data5[1];
      $totaldata2 = $data6[0]+$data6[1];
      $sumtotal = $totaldata1+$totaldata2;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      
      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1+$eigenvector2;      

      // perkalian matriks iterasi ke 2    
      $data9 = array();
      $data9[] = ($data5[0]*$data5[0])+($data5[1]*$data6[0]);
      $data9[] = ($data5[0]*$data5[1])+($data5[1]*$data6[1]);

      $data10 = array();
      $data10[] = ($data6[0]*$data5[0])+($data6[1]*$data6[0]);
      $data10[] = ($data6[0]*$data5[1])+($data6[1]*$data6[1]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata5 = $data9[0]+$data9[1];
      $totaldata6 = $data10[0]+$data10[1];
      $sumtotal2 = $totaldata5+$totaldata6;
      
      // hasil normalisasi iterasi kedua
      $eigenvector5 = $totaldata5/$sumtotal2;
      $eigenvector6 = $totaldata6/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector5+$eigenvector6;
      
      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector5*100;  
      $pengeluaran1 = ($persentase1*$pengeluaranbhp)/100;
      $persentase2 = $eigenvector6*100;
      $pengeluaran2 = ($persentase2*$pengeluaranbhp)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector5,$persentase1,6,2,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector6,$persentase2,7,2,$pengeluaran2);

      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector5-$eigenvector1;
      $hasil2 = $eigenvector6-$eigenvector2;

      // $dataeigenvector[0]=$eigenvector1; 
      // $dataeigenvector[1]=$eigenvector2; 
      
      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector5*$data1[0];
      $vektorsum1[] = $eigenvector6*$data1[1];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector5*$data2[0];
      $vektorsum2[] = $eigenvector6*$data2[1];


      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector5;
      $vk2 = $jumlahvektorsum2/$eigenvector6;

      // nilai lamda maks
      $lamda = ($vk1+$vk2)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);
      
      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }
    // fix
    public function kriterialdj($id,$pengeluaranldj)
    {
        // get data dari database
        $id = $id-1;
        $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
        $n = 2;
        $id_keu = $id+1;
        $row = $this->getdata->getDataBy($id);
        // get data dengan tipe pengeluaran
        $dataldj1 = $value[7];
        $dataldj2 = $value[8];
    
        $data1 = array();
        $data2 = array();
        
        // pembobotan elemen-elemen pada setiap level dan hierarki
        $data1[] = $dataldj1/$dataldj1;
        $data1[] = $dataldj1/$dataldj2;

        $data2[] = $dataldj2/$dataldj1;
        $data2[] = $dataldj2/$dataldj2;

      // perkalian matriks iterasi pertama
      $data5 = array();
      $data5[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0]);
      $data5[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1]);

      $data6 = array();
      $data6[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0]);
      $data6[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1]);
    
      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data5[0]+$data5[1];
      $totaldata2 = $data6[0]+$data6[1];
      $sumtotal = $totaldata1+$totaldata2;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1+$eigenvector2;
      
      // perkalian matriks iterasi ke 2              
      $data9 = array();
      $data9[] = ($data5[0]*$data5[0])+($data5[1]*$data6[0]);
      $data9[] = ($data5[0]*$data5[1])+($data5[1]*$data6[1]);

      $data10 = array();
      $data10[] = ($data6[0]*$data5[0])+($data6[1]*$data6[0]);
      $data10[] = ($data6[0]*$data5[1])+($data6[1]*$data6[1]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata5 = $data9[0]+$data9[1];
      $totaldata6 = $data10[0]+$data10[1];
      $sumtotal2 = $totaldata5+$totaldata6;
      
      // hasil normalisasi iterasi kedua
      $eigenvector5 = $totaldata5/$sumtotal2;
      $eigenvector6 = $totaldata6/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector5+$eigenvector6;

      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector5*100;
      $pengeluaran1 = ($persentase1*$pengeluaranldj)/100;
      $persentase2 = $eigenvector6*100;
      $pengeluaran2 = ($persentase2*$pengeluaranldj)/100;
      
      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector5,$persentase1,8,2,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector6,$persentase2,9,2,$pengeluaran2);

      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector5-$eigenvector1;
      $hasil2 = $eigenvector6-$eigenvector2;

      // $dataeigenvector[0]=$eigenvector1; 
      // $dataeigenvector[1]=$eigenvector2; 

      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector5*$data1[0];
      $vektorsum1[] = $eigenvector6*$data1[1];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector5*$data2[0];
      $vektorsum2[] = $eigenvector6*$data2[1];

      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector5;
      $vk2 = $jumlahvektorsum2/$eigenvector6;

      // nilai lamda maks
      $lamda = ($vk1+$vk2)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);
      
      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }

    // fix
    public function kriteriaatk($id,$total)
    {
      // get data dari database
      $id = $id-1;
      $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
      $n = 4;
      $id_keu = $id+1;
       $row = $this->getdata->getDataBy($id);
        // get data dengan tipe pengeluaran
        $datatotal1 = $value[1];
        $datatotal2 = $value[2];
        $datatotal3 = $value[3];
        $datatotal4 = $value[4];

      $data1 = array();
      $data2 = array();
      $data3 = array();
      $data4 = array();

      // pembobotan elemen-elemen pada setiap level dan hierarki
      $data1[] = $datatotal1/$datatotal1;
      $data1[] = $datatotal1/$datatotal2;
      $data1[] = $datatotal1/$datatotal3;
      $data1[] = $datatotal1/$datatotal4;

      $data2[] = $datatotal2/$datatotal1;
      $data2[] = $datatotal2/$datatotal2;
      $data2[] = $datatotal2/$datatotal3;
      $data2[] = $datatotal2/$datatotal4;

      $data3[] = $datatotal3/$datatotal1;
      $data3[] = $datatotal3/$datatotal2;
      $data3[] = $datatotal3/$datatotal3;
      $data3[] = $datatotal3/$datatotal4;

      $data4[] = $datatotal4/$datatotal1;
      $data4[] = $datatotal4/$datatotal2;
      $data4[] = $datatotal4/$datatotal3;
      $data4[] = $datatotal4/$datatotal4;

      // perkalian matriks iterasi pertama
      $data5 = array();
      $data5[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0])+($data1[2]*$data3[0])+($data1[3]*$data4[0]);
      $data5[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1])+($data1[2]*$data3[1])+($data1[3]*$data4[1]);
      $data5[] = ($data1[0]*$data1[2])+($data1[1]*$data2[2])+($data1[2]*$data3[2])+($data1[3]*$data4[2]);
      $data5[] = ($data1[0]*$data1[3])+($data1[1]*$data2[3])+($data1[2]*$data3[3])+($data1[3]*$data4[3]);

      $data6 = array();
      $data6[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0])+($data2[2]*$data3[0])+($data2[3]*$data4[0]);
      $data6[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1])+($data2[2]*$data3[1])+($data2[3]*$data4[1]);
      $data6[] = ($data2[0]*$data1[2])+($data2[1]*$data2[2])+($data2[2]*$data3[2])+($data2[3]*$data4[2]);
      $data6[] = ($data2[0]*$data1[3])+($data2[1]*$data2[3])+($data2[2]*$data3[3])+($data2[3]*$data4[3]);

      $data7 = array();
      $data7[] = ($data3[0]*$data1[0])+($data3[1]*$data2[0])+($data3[2]*$data3[0])+($data3[3]*$data4[0]);
      $data7[] = ($data3[0]*$data1[1])+($data3[1]*$data2[1])+($data3[2]*$data3[1])+($data3[3]*$data4[1]);
      $data7[] = ($data3[0]*$data1[2])+($data3[1]*$data2[2])+($data3[2]*$data3[2])+($data3[3]*$data4[2]);
      $data7[] = ($data3[0]*$data1[3])+($data3[1]*$data2[3])+($data3[2]*$data3[3])+($data3[3]*$data4[3]);

      $data8 = array();
      $data8[] = ($data4[0]*$data1[0])+($data4[1]*$data2[0])+($data4[2]*$data3[0])+($data4[3]*$data4[0]);
      $data8[] = ($data4[0]*$data1[1])+($data4[1]*$data2[1])+($data4[2]*$data3[1])+($data4[3]*$data4[1]);
      $data8[] = ($data4[0]*$data1[2])+($data4[1]*$data2[2])+($data4[2]*$data3[2])+($data4[3]*$data4[2]);
      $data8[] = ($data4[0]*$data1[3])+($data4[1]*$data2[3])+($data4[3]*$data3[2])+($data4[3]*$data4[3]);
  
      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data5[0]+$data5[1]+$data5[2]+$data5[3];
      $totaldata2 = $data6[0]+$data6[1]+$data6[2]+$data6[3];
      $totaldata3 = $data7[0]+$data7[1]+$data7[2]+$data7[3];
      $totaldata4 = $data8[0]+$data8[1]+$data8[2]+$data8[3];
      $sumtotal = $totaldata1+$totaldata2+$totaldata3+$totaldata4;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      $eigenvector3 = $totaldata3/$sumtotal;
      $eigenvector4 = $totaldata4/$sumtotal;
      
      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1+$eigenvector2+$eigenvector3+$eigenvector4;

      // perkalian matriks iterasi ke 2              
      $data9 = array();
      $data9[] = ($data5[0]*$data5[0])+($data5[1]*$data6[0])+($data5[2]*$data7[0])+($data5[3]*$data8[0]);
      $data9[] = ($data5[0]*$data5[1])+($data5[1]*$data6[1])+($data5[2]*$data7[1])+($data5[3]*$data8[1]);
      $data9[] = ($data5[0]*$data5[2])+($data5[1]*$data6[2])+($data5[2]*$data7[2])+($data5[3]*$data8[2]);
      $data9[] = ($data5[0]*$data5[3])+($data5[1]*$data6[3])+($data5[2]*$data7[3])+($data5[3]*$data8[3]);

      $data10 = array();
      $data10[] = ($data6[0]*$data5[0])+($data6[1]*$data6[0])+($data6[2]*$data7[0])+($data6[3]*$data8[0]);
      $data10[] = ($data6[0]*$data5[1])+($data6[1]*$data6[1])+($data6[2]*$data7[1])+($data6[3]*$data8[1]);
      $data10[] = ($data6[0]*$data5[2])+($data6[1]*$data6[2])+($data6[2]*$data7[2])+($data6[3]*$data8[2]);
      $data10[] = ($data6[0]*$data5[3])+($data6[1]*$data6[3])+($data6[2]*$data7[3])+($data6[3]*$data8[3]);

      $data11 = array();
      $data11[] = ($data7[0]*$data5[0])+($data7[1]*$data6[0])+($data7[2]*$data7[0])+($data7[3]*$data8[0]);
      $data11[] = ($data7[0]*$data5[1])+($data7[1]*$data6[1])+($data7[2]*$data7[1])+($data7[3]*$data8[1]);
      $data11[] = ($data7[0]*$data5[2])+($data7[1]*$data6[2])+($data7[2]*$data7[2])+($data7[3]*$data8[2]);
      $data11[] = ($data7[0]*$data5[3])+($data7[1]*$data6[3])+($data7[2]*$data7[3])+($data7[3]*$data8[3]);

      $data12 = array();
      $data12[] = ($data8[0]*$data5[0])+($data8[1]*$data6[0])+($data8[2]*$data7[0])+($data8[3]*$data8[0]);
      $data12[] = ($data8[0]*$data5[1])+($data8[1]*$data6[1])+($data8[2]*$data7[1])+($data8[3]*$data8[1]);
      $data12[] = ($data8[0]*$data5[2])+($data8[1]*$data6[2])+($data8[2]*$data7[2])+($data8[3]*$data8[2]);
      $data12[] = ($data8[0]*$data5[3])+($data8[1]*$data6[3])+($data8[2]*$data7[3])+($data8[3]*$data8[3]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata5 = $data9[0]+$data9[1]+$data9[2]+$data9[3];
      $totaldata6 = $data10[0]+$data10[1]+$data10[2]+$data10[3];
      $totaldata7 = $data11[0]+$data10[1]+$data11[2]+$data11[3];
      $totaldata8 = $data12[0]+$data10[1]+$data12[2]+$data12[3];
      $sumtotal2 = $totaldata5+$totaldata6+$totaldata7+$totaldata8;
      
      // hasil normalisasi iterasi kedua
      $eigenvector5 = $totaldata5/$sumtotal2;
      $eigenvector6 = $totaldata6/$sumtotal2;
      $eigenvector7 = $totaldata7/$sumtotal2;
      $eigenvector8 = $totaldata8/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector5+$eigenvector6+$eigenvector7+$eigenvector8;
      
      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector5*100;
      $pengeluaran1 = ($persentase1*$total)/100;
      $persentase2 = $eigenvector6*100;
      $pengeluaran2 = ($persentase2*$total)/100;
      $persentase3 = $eigenvector7*100;
      $pengeluaran3 = ($persentase3*$total)/100;
      $persentase4 = $eigenvector8*100;
      $pengeluaran4 = ($persentase4*$total)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector5,$persentase1,2,2,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector6,$persentase2,3,2,$pengeluaran2);
      $this->inputdata->inputhasil($id_keu,$eigenvector7,$persentase3,4,2,$pengeluaran3);
      $this->inputdata->inputhasil($id_keu,$eigenvector8,$persentase4,5,2,$pengeluaran4);

      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector5-$eigenvector1;
      $hasil2 = $eigenvector6-$eigenvector2;
      $hasil3 = $eigenvector7-$eigenvector3;
      $hasil4 = $eigenvector8-$eigenvector4;

      // $dataeigenvector[0]=$eigenvector1; 
      // $dataeigenvector[1]=$eigenvector2; 
      // $dataeigenvector[2]=$eigenvector3;
      // $dataeigenvector[3]=$eigenvector4;

      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector5*$data1[0];
      $vektorsum1[] = $eigenvector6*$data1[1];
      $vektorsum1[] = $eigenvector7*$data1[2];
      $vektorsum1[] = $eigenvector8*$data1[3];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector5*$data2[0];
      $vektorsum2[] = $eigenvector6*$data2[1];
      $vektorsum2[] = $eigenvector7*$data2[2];
      $vektorsum2[] = $eigenvector8*$data2[3];

      $vektorsum3 = array();
      $vektorsum3[] = $eigenvector5*$data3[0];
      $vektorsum3[] = $eigenvector6*$data3[1];
      $vektorsum3[] = $eigenvector7*$data3[2];
      $vektorsum3[] = $eigenvector8*$data3[3];

      $vektorsum4 = array();
      $vektorsum4[] = $eigenvector5*$data4[0];
      $vektorsum4[] = $eigenvector6*$data4[1];
      $vektorsum4[] = $eigenvector7*$data4[2];
      $vektorsum4[] = $eigenvector8*$data4[3];

      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1]+$vektorsum1[2]+$vektorsum1[3];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1]+$vektorsum2[2]+$vektorsum2[3];
      $jumlahvektorsum3 = $vektorsum3[0]+$vektorsum3[1]+$vektorsum3[2]+$vektorsum3[3];
      $jumlahvektorsum4 = $vektorsum4[0]+$vektorsum4[1]+$vektorsum4[2]+$vektorsum4[3];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector5;
      $vk2 = $jumlahvektorsum2/$eigenvector6;
      $vk3 = $jumlahvektorsum3/$eigenvector7;
      $vk4 = $jumlahvektorsum4/$eigenvector8;

      // nilai lamda maks
      $lamda = ($vk1+$vk2+$vk3+$vk4)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);

      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }
    // fix
    public function kriteriaks($id,$total)
    {
      // get data dari database      
      $id = $id-1;
      $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
      $n = 5;
      $id_keu = $id+1;
       $row = $this->getdata->getDataBy($id);
        
        // get data dengan tipe pengeluaran
        $datatotal1 = $value[17];
        $datatotal2 = $value[18];
        $datatotal3 = $value[19];
        $datatotal4 = $value[20];
        $datatotal5 = $value[21];

       $data1 = array();
       $data2 = array();
       $data3 = array();
       $data4 = array();
       $data5 = array();

      // pembobotan elemen-elemen pada setiap level dan hierarki
      $data1[] = $datatotal1/$datatotal1;
      $data1[] = $datatotal1/$datatotal2;
      $data1[] = $datatotal1/$datatotal3;
      $data1[] = $datatotal1/$datatotal4;
      $data1[] = $datatotal1/$datatotal5;

      $data2[] = $datatotal2/$datatotal1;
      $data2[] = $datatotal2/$datatotal2;
      $data2[] = $datatotal2/$datatotal3;
      $data2[] = $datatotal2/$datatotal4;
      $data2[] = $datatotal2/$datatotal5;

      $data3[] = $datatotal3/$datatotal1;
      $data3[] = $datatotal3/$datatotal2;
      $data3[] = $datatotal3/$datatotal3;
      $data3[] = $datatotal3/$datatotal4;
      $data3[] = $datatotal3/$datatotal5;

      $data4[] = $datatotal4/$datatotal1;
      $data4[] = $datatotal4/$datatotal2;
      $data4[] = $datatotal4/$datatotal3;
      $data4[] = $datatotal4/$datatotal4;
      $data4[] = $datatotal4/$datatotal5;

      $data5[] = $datatotal5/$datatotal1;
      $data5[] = $datatotal5/$datatotal2;
      $data5[] = $datatotal5/$datatotal3;
      $data5[] = $datatotal5/$datatotal4;
      $data5[] = $datatotal5/$datatotal5;

      // perkalian matriks iterasi pertama
      $data8 = array();
      $data8[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0])+($data1[2]*$data3[0])+($data1[3]*$data4[0])+($data1[4]*$data5[0]);
      $data8[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1])+($data1[2]*$data3[1])+($data1[3]*$data4[1])+($data1[4]*$data5[1]);
      $data8[] = ($data1[0]*$data1[2])+($data1[1]*$data2[2])+($data1[2]*$data3[2])+($data1[3]*$data4[2])+($data1[4]*$data5[2]);
      $data8[] = ($data1[0]*$data1[3])+($data1[1]*$data2[3])+($data1[2]*$data3[3])+($data1[3]*$data4[3])+($data1[4]*$data5[3]);
      $data8[] = ($data1[0]*$data1[4])+($data1[1]*$data2[4])+($data1[2]*$data3[4])+($data1[3]*$data4[4])+($data1[4]*$data5[4]);

      $data9 = array();
      $data9[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0])+($data2[2]*$data3[0])+($data2[3]*$data4[0])+($data2[4]*$data5[0]);
      $data9[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1])+($data2[2]*$data3[1])+($data2[3]*$data4[1])+($data2[4]*$data5[1]);
      $data9[] = ($data2[0]*$data1[2])+($data2[1]*$data2[2])+($data2[2]*$data3[2])+($data2[3]*$data4[2])+($data2[4]*$data5[2]);
      $data9[] = ($data2[0]*$data1[3])+($data2[1]*$data2[3])+($data2[2]*$data3[3])+($data2[3]*$data4[3])+($data2[4]*$data5[3]);
      $data9[] = ($data2[0]*$data1[4])+($data2[1]*$data2[4])+($data2[2]*$data3[4])+($data2[3]*$data4[4])+($data2[4]*$data5[4]);
      

      $data10 = array();
      $data10[] = ($data3[0]*$data1[0])+($data3[1]*$data2[0])+($data3[2]*$data3[0])+($data3[3]*$data4[0])+($data3[4]*$data5[0]);
      $data10[] = ($data3[0]*$data1[1])+($data3[1]*$data2[1])+($data3[2]*$data3[1])+($data3[3]*$data4[1])+($data3[4]*$data5[1]);
      $data10[] = ($data3[0]*$data1[2])+($data3[1]*$data2[2])+($data3[2]*$data3[2])+($data3[3]*$data4[2])+($data3[4]*$data5[2]);
      $data10[] = ($data3[0]*$data1[3])+($data3[1]*$data2[3])+($data3[2]*$data3[3])+($data3[3]*$data4[3])+($data3[4]*$data5[3]);
      $data10[] = ($data3[0]*$data1[4])+($data3[1]*$data2[4])+($data3[2]*$data3[4])+($data3[3]*$data4[4])+($data3[4]*$data5[4]);

      $data11 = array();
      $data11[] = ($data4[0]*$data1[0])+($data4[1]*$data2[0])+($data4[2]*$data3[0])+($data4[3]*$data4[0])+($data4[4]*$data5[0]);
      $data11[] = ($data4[0]*$data1[1])+($data4[1]*$data2[1])+($data4[2]*$data3[1])+($data4[3]*$data4[1])+($data4[4]*$data5[1]);
      $data11[] = ($data4[0]*$data1[2])+($data4[1]*$data2[2])+($data4[2]*$data3[2])+($data4[3]*$data4[2])+($data4[4]*$data5[2]);
      $data11[] = ($data4[0]*$data1[3])+($data4[1]*$data2[3])+($data4[2]*$data3[3])+($data4[3]*$data4[3])+($data4[4]*$data5[3]);
      $data11[] = ($data4[0]*$data1[4])+($data4[1]*$data2[4])+($data4[2]*$data3[4])+($data4[3]*$data4[4])+($data4[4]*$data5[4]);
      
      
      $data12 = array();
      $data12[] = ($data5[0]*$data1[0])+($data5[1]*$data2[0])+($data5[2]*$data3[0])+($data5[3]*$data4[0])+($data5[4]*$data5[0]);
      $data12[] = ($data5[0]*$data1[1])+($data5[1]*$data2[1])+($data5[2]*$data3[1])+($data5[3]*$data4[1])+($data5[4]*$data5[1]);
      $data12[] = ($data5[0]*$data1[2])+($data5[1]*$data2[2])+($data5[2]*$data3[2])+($data5[3]*$data4[2])+($data5[4]*$data5[2]);
      $data12[] = ($data5[0]*$data1[3])+($data5[1]*$data2[3])+($data5[2]*$data3[3])+($data5[3]*$data4[3])+($data5[4]*$data5[3]);
      $data12[] = ($data5[0]*$data1[4])+($data5[1]*$data2[4])+($data5[2]*$data3[4])+($data5[3]*$data4[4])+($data5[4]*$data5[4]);

      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data8[0]+$data8[1]+$data8[2]+$data8[3]+$data8[4];
      $totaldata2 = $data9[0]+$data9[1]+$data9[2]+$data9[3]+$data9[4];
      $totaldata3 = $data10[0]+$data10[1]+$data10[2]+$data10[3]+$data10[4];
      $totaldata4 = $data11[0]+$data11[1]+$data11[2]+$data11[3]+$data11[4];
      $totaldata5 = $data12[0]+$data12[1]+$data12[2]+$data12[3]+$data12[4];
      $sumtotal = $totaldata1+$totaldata2+$totaldata3+$totaldata4+$totaldata5;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      $eigenvector3 = $totaldata3/$sumtotal;
      $eigenvector4 = $totaldata4/$sumtotal;
      $eigenvector5 = $totaldata5/$sumtotal;
      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1 + $eigenvector2 + $eigenvector3 + $eigenvector4 + $eigenvector5;

      // perkalian matriks iterasi ke 2              
      $data15 = array();
      $data15[] = ($data8[0]*$data8[0])+($data8[1]*$data9[0])+($data8[2]*$data10[0])+($data8[3]*$data11[0])+($data8[4]*$data12[0]);
      $data15[] = ($data8[0]*$data8[1])+($data8[1]*$data9[1])+($data8[2]*$data10[1])+($data8[3]*$data11[1])+($data8[4]*$data12[1]);
      $data15[] = ($data8[0]*$data8[2])+($data8[1]*$data9[2])+($data8[2]*$data10[2])+($data8[3]*$data11[2])+($data8[4]*$data12[2]);
      $data15[] = ($data8[0]*$data8[3])+($data8[1]*$data9[3])+($data8[2]*$data10[3])+($data8[3]*$data11[3])+($data8[4]*$data12[3]);
      $data15[] = ($data8[0]*$data8[4])+($data8[1]*$data9[4])+($data8[2]*$data10[4])+($data8[3]*$data11[4])+($data8[4]*$data12[4]);

      $data16 = array();
      $data16[] = ($data9[0]*$data8[0])+($data9[1]*$data9[0])+($data9[2]*$data10[0])+($data9[3]*$data11[0])+($data9[4]*$data12[0]);
      $data16[] = ($data9[0]*$data8[1])+($data9[1]*$data9[1])+($data9[2]*$data10[1])+($data9[3]*$data11[1])+($data9[4]*$data12[1]);
      $data16[] = ($data9[0]*$data8[2])+($data9[1]*$data9[2])+($data9[2]*$data10[2])+($data9[3]*$data11[2])+($data9[4]*$data12[2]);
      $data16[] = ($data9[0]*$data8[3])+($data9[1]*$data9[3])+($data9[2]*$data10[3])+($data9[3]*$data11[3])+($data9[4]*$data12[3]);
      $data16[] = ($data9[0]*$data8[4])+($data9[1]*$data9[4])+($data9[2]*$data10[4])+($data9[3]*$data11[4])+($data9[4]*$data12[4]);

      $data17 = array();
      $data17[] = ($data10[0]*$data8[0])+($data10[1]*$data9[0])+($data10[2]*$data10[0])+($data10[3]*$data11[0])+($data10[4]*$data12[0]);
      $data17[] = ($data10[0]*$data8[1])+($data10[1]*$data9[1])+($data10[2]*$data10[1])+($data10[3]*$data11[1])+($data10[4]*$data12[1]);
      $data17[] = ($data10[0]*$data8[2])+($data10[1]*$data9[2])+($data10[2]*$data10[2])+($data10[3]*$data11[2])+($data10[4]*$data12[2]);
      $data17[] = ($data10[0]*$data8[3])+($data10[1]*$data9[3])+($data10[2]*$data10[3])+($data10[3]*$data11[3])+($data10[4]*$data12[3]);
      $data17[] = ($data10[0]*$data8[4])+($data10[1]*$data9[4])+($data10[2]*$data10[4])+($data10[3]*$data11[4])+($data10[4]*$data12[4]);
      

      $data18 = array();
      $data18[] = ($data11[0]*$data8[0])+($data11[1]*$data9[0])+($data11[2]*$data10[0])+($data11[3]*$data11[0])+($data11[4]*$data12[0]);
      $data18[] = ($data11[0]*$data8[1])+($data11[1]*$data9[1])+($data11[2]*$data10[1])+($data11[3]*$data11[1])+($data11[4]*$data12[1]);
      $data18[] = ($data11[0]*$data8[2])+($data11[1]*$data9[2])+($data11[2]*$data10[2])+($data11[3]*$data11[2])+($data11[4]*$data12[2]);
      $data18[] = ($data11[0]*$data8[3])+($data11[1]*$data9[3])+($data11[2]*$data10[3])+($data11[3]*$data11[3])+($data11[4]*$data12[3]);
      $data18[] = ($data11[0]*$data8[4])+($data11[1]*$data9[4])+($data11[2]*$data10[4])+($data11[3]*$data11[4])+($data11[4]*$data12[4]);

      $data19 = array();
      $data19[] = ($data12[0]*$data8[0])+($data12[1]*$data9[0])+($data12[2]*$data10[0])+($data12[3]*$data11[0])+($data12[4]*$data12[0]);
      $data19[] = ($data12[0]*$data8[1])+($data12[1]*$data9[1])+($data12[2]*$data10[1])+($data12[3]*$data11[1])+($data12[4]*$data12[1]);
      $data19[] = ($data12[0]*$data8[2])+($data12[1]*$data9[2])+($data12[2]*$data10[2])+($data12[3]*$data11[2])+($data12[4]*$data12[2]);
      $data19[] = ($data12[0]*$data8[3])+($data12[1]*$data9[3])+($data12[2]*$data10[3])+($data12[3]*$data11[3])+($data12[4]*$data12[3]);
      $data19[] = ($data12[0]*$data8[4])+($data12[1]*$data9[4])+($data12[2]*$data10[4])+($data12[3]*$data11[4])+($data12[4]*$data12[4]);

      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata8 = $data15[0]+$data15[1]+$data15[2]+$data15[3]+$data15[4];
      $totaldata9 = $data16[0]+$data16[1]+$data16[2]+$data16[3]+$data16[4];
      $totaldata10 = $data17[0]+$data17[1]+$data17[2]+$data17[3]+$data17[4];
      $totaldata11 = $data18[0]+$data18[1]+$data18[2]+$data18[3]+$data18[4];
      $totaldata12 = $data19[0]+$data19[1]+$data19[2]+$data19[3]+$data19[4];
      $sumtotal2 = $totaldata8+$totaldata9+$totaldata10+$totaldata11+$totaldata12;
      
      // hasil normalisasi iterasi kedua
      $eigenvector8 = $totaldata8/$sumtotal2;
      $eigenvector9 = $totaldata9/$sumtotal2;
      $eigenvector10 = $totaldata10/$sumtotal2;
      $eigenvector11 = $totaldata11/$sumtotal2;
      $eigenvector12 = $totaldata12/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector8+$eigenvector9+$eigenvector10+$eigenvector11+$eigenvector12;

      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector8*100;
      $pengeluaran1 = ($persentase1*$total)/100;
      $persentase2 = $eigenvector9*100;
      $pengeluaran2 = ($persentase2*$total)/100;
      $persentase3 = $eigenvector10*100;
      $pengeluaran3 = ($persentase3*$total)/100;
      $persentase4 = $eigenvector11*100;
      $pengeluaran4 = ($persentase4*$total)/100;
      $persentase5 = $eigenvector12*100;
      $pengeluaran5 = ($persentase5*$total)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector8,$persentase1,18,2,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector9,$persentase2,19,2,$pengeluaran2);
      $this->inputdata->inputhasil($id_keu,$eigenvector10,$persentase3,20,2,$pengeluaran3);
      $this->inputdata->inputhasil($id_keu,$eigenvector11,$persentase4,21,2,$pengeluaran4);
      $this->inputdata->inputhasil($id_keu,$eigenvector12,$persentase5,22,2,$pengeluaran5);

      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.
      $hasil1 = $eigenvector8-$eigenvector8;
      $hasil2 = $eigenvector9-$eigenvector9;
      $hasil3 = $eigenvector10-$eigenvector10;
      $hasil4 = $eigenvector11-$eigenvector11;
      $hasil5 = $eigenvector12-$eigenvector12;

      // $dataeigenvector[0]=$eigenvector1; 
      // $dataeigenvector[1]=$eigenvector2; 
      // $dataeigenvector[2]=$eigenvector3;
      // $dataeigenvector[3]=$eigenvector4;
      // $dataeigenvector[4]=$eigenvector5;

      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector8*$data1[0];
      $vektorsum1[] = $eigenvector9*$data1[1];
      $vektorsum1[] = $eigenvector10*$data1[2];
      $vektorsum1[] = $eigenvector11*$data1[3];
      $vektorsum1[] = $eigenvector12*$data1[4];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector8*$data2[0];
      $vektorsum2[] = $eigenvector9*$data2[1];
      $vektorsum2[] = $eigenvector10*$data2[2];
      $vektorsum2[] = $eigenvector11*$data2[3];
      $vektorsum2[] = $eigenvector12*$data2[4];

      $vektorsum3 = array();
      $vektorsum3[] = $eigenvector8*$data3[0];
      $vektorsum3[] = $eigenvector9*$data3[1];
      $vektorsum3[] = $eigenvector10*$data3[2];
      $vektorsum3[] = $eigenvector11*$data3[3];
      $vektorsum3[] = $eigenvector12*$data3[4];

      $vektorsum4 = array();
      $vektorsum4[] = $eigenvector8*$data4[0];
      $vektorsum4[] = $eigenvector9*$data4[1];
      $vektorsum4[] = $eigenvector10*$data4[2];
      $vektorsum4[] = $eigenvector11*$data4[3];
      $vektorsum4[] = $eigenvector12*$data4[4];

      $vektorsum5 = array();
      $vektorsum5[] = $eigenvector8*$data5[0];
      $vektorsum5[] = $eigenvector9*$data5[1];
      $vektorsum5[] = $eigenvector10*$data5[2];
      $vektorsum5[] = $eigenvector11*$data5[3];
      $vektorsum5[] = $eigenvector12*$data5[4];

      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1]+$vektorsum1[2]+$vektorsum1[3]+$vektorsum1[4];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1]+$vektorsum2[2]+$vektorsum2[3]+$vektorsum2[4];
      $jumlahvektorsum3 = $vektorsum3[0]+$vektorsum3[1]+$vektorsum3[2]+$vektorsum3[3]+$vektorsum3[4];
      $jumlahvektorsum4 = $vektorsum4[0]+$vektorsum4[1]+$vektorsum4[2]+$vektorsum4[3]+$vektorsum4[4];
      $jumlahvektorsum5 = $vektorsum5[0]+$vektorsum5[1]+$vektorsum5[2]+$vektorsum5[3]+$vektorsum5[4];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector8;
      $vk2 = $jumlahvektorsum2/$eigenvector9;
      $vk3 = $jumlahvektorsum3/$eigenvector10;
      $vk4 = $jumlahvektorsum4/$eigenvector11;
      $vk5 = $jumlahvektorsum5/$eigenvector12;

      // nilai lamda maks
      $lamda = ($vk1+$vk2+$vk3+$vk4+$vk5)/$n;
      
      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);

      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }

    public function kriteriakbm($id,$pengeluarankbm)
    {
      // get data dari database      
      $id = $id-1;
      $data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
      $n = 8;
      $id_keu = $id+1;
       $row = $this->getdata->getDataBy($id);

        // get data dengan tipe pengeluaran
        $datakbm1 = $value[9];
        $datakbm2 = $value[10];
        $datakbm3 = $value[11];
        $datakbm4 = $value[12];
        $datakbm5 = $value[13];
        $datakbm6 = $value[14];
        $datakbm7 = $value[15];
        $datakbm8 = $value[16];

       $data1 = array();
       $data2 = array();
       $data3 = array();
       $data4 = array();
       $data5 = array();
       $data6 = array();
       $data7 = array();
       $data8 = array();
      
      // pembobotan elemen-elemen pada setiap level dan hierarki
      $data1[] = $datakbm1/$datakbm1;
      $data1[] = $datakbm1/$datakbm2;
      $data1[] = $datakbm1/$datakbm3;
      $data1[] = $datakbm1/$datakbm4;
      $data1[] = $datakbm1/$datakbm5;
      $data1[] = $datakbm1/$datakbm6;
      $data1[] = $datakbm1/$datakbm7;
      $data1[] = $datakbm1/$datakbm8;

      $data2[] = $datakbm2/$datakbm1;
      $data2[] = $datakbm2/$datakbm2;
      $data2[] = $datakbm2/$datakbm3;
      $data2[] = $datakbm2/$datakbm4;
      $data2[] = $datakbm2/$datakbm5;
      $data2[] = $datakbm2/$datakbm6;
      $data2[] = $datakbm2/$datakbm7;
      $data2[] = $datakbm2/$datakbm8;

      $data3[] = $datakbm3/$datakbm1;
      $data3[] = $datakbm3/$datakbm2;
      $data3[] = $datakbm3/$datakbm3;
      $data3[] = $datakbm3/$datakbm4;
      $data3[] = $datakbm3/$datakbm5;
      $data3[] = $datakbm3/$datakbm6;
      $data3[] = $datakbm3/$datakbm7;
      $data3[] = $datakbm3/$datakbm8;

      $data4[] = $datakbm4/$datakbm1;
      $data4[] = $datakbm4/$datakbm2;
      $data4[] = $datakbm4/$datakbm3;
      $data4[] = $datakbm4/$datakbm4;
      $data4[] = $datakbm4/$datakbm5;
      $data4[] = $datakbm4/$datakbm6;
      $data4[] = $datakbm4/$datakbm7;
      $data4[] = $datakbm4/$datakbm8;

      $data5[] = $datakbm5/$datakbm1;
      $data5[] = $datakbm5/$datakbm2;
      $data5[] = $datakbm5/$datakbm3;
      $data5[] = $datakbm5/$datakbm4;
      $data5[] = $datakbm5/$datakbm5;
      $data5[] = $datakbm5/$datakbm6;
      $data5[] = $datakbm5/$datakbm7;
      $data5[] = $datakbm5/$datakbm8;

      $data6[] = $datakbm6/$datakbm1;
      $data6[] = $datakbm6/$datakbm2;
      $data6[] = $datakbm6/$datakbm3;
      $data6[] = $datakbm6/$datakbm4;
      $data6[] = $datakbm6/$datakbm5;
      $data6[] = $datakbm6/$datakbm6;
      $data6[] = $datakbm6/$datakbm7;
      $data6[] = $datakbm6/$datakbm8;

      $data7[] = $datakbm7/$datakbm1;
      $data7[] = $datakbm7/$datakbm2;
      $data7[] = $datakbm7/$datakbm3;
      $data7[] = $datakbm7/$datakbm4;
      $data7[] = $datakbm7/$datakbm5;
      $data7[] = $datakbm7/$datakbm6;
      $data7[] = $datakbm7/$datakbm7;
      $data7[] = $datakbm7/$datakbm8;

      $data8[] = $datakbm8/$datakbm1;
      $data8[] = $datakbm8/$datakbm2;
      $data8[] = $datakbm8/$datakbm3;
      $data8[] = $datakbm8/$datakbm4;
      $data8[] = $datakbm8/$datakbm5;
      $data8[] = $datakbm8/$datakbm6;
      $data8[] = $datakbm8/$datakbm7;
      $data8[] = $datakbm8/$datakbm8;
      
      // perkalian matriks iterasi pertama
      $data9 = array();
      $data9[] = ($data1[0]*$data1[0])+($data1[1]*$data2[0])+($data1[2]*$data3[0])+($data1[3]*$data4[0])+($data1[4]*$data5[0])+($data1[5]*$data6[0])+($data1[6]*$data7[0])+($data1[7]*$data8[0]);
      $data9[] = ($data1[0]*$data1[1])+($data1[1]*$data2[1])+($data1[2]*$data3[1])+($data1[3]*$data4[1])+($data1[4]*$data5[1])+($data1[5]*$data6[1])+($data1[6]*$data7[1])+($data1[7]*$data8[1]);
      $data9[] = ($data1[0]*$data1[2])+($data1[1]*$data2[2])+($data1[2]*$data3[2])+($data1[3]*$data4[2])+($data1[4]*$data5[2])+($data1[5]*$data6[2])+($data1[6]*$data7[2])+($data1[7]*$data8[2]);
      $data9[] = ($data1[0]*$data1[3])+($data1[1]*$data2[3])+($data1[2]*$data3[3])+($data1[3]*$data4[3])+($data1[4]*$data5[3])+($data1[5]*$data6[3])+($data1[6]*$data7[3])+($data1[7]*$data8[3]);
      $data9[] = ($data1[0]*$data1[4])+($data1[1]*$data2[4])+($data1[2]*$data3[4])+($data1[3]*$data4[4])+($data1[4]*$data5[4])+($data1[5]*$data6[4])+($data1[6]*$data7[4])+($data1[7]*$data8[4]);
      $data9[] = ($data1[0]*$data1[5])+($data1[1]*$data2[5])+($data1[2]*$data3[5])+($data1[3]*$data4[5])+($data1[4]*$data5[5])+($data1[5]*$data6[5])+($data1[6]*$data7[5])+($data1[7]*$data8[5]);
      $data9[] = ($data1[0]*$data1[6])+($data1[1]*$data2[6])+($data1[2]*$data3[6])+($data1[3]*$data4[6])+($data1[4]*$data5[6])+($data1[5]*$data6[6])+($data1[6]*$data7[6])+($data1[7]*$data8[6]);
      $data9[] = ($data1[0]*$data1[7])+($data1[1]*$data2[7])+($data1[2]*$data3[7])+($data1[3]*$data4[7])+($data1[4]*$data5[7])+($data1[5]*$data6[7])+($data1[6]*$data7[7])+($data1[7]*$data8[7]);

      $data10 = array();
      $data10[] = ($data2[0]*$data1[0])+($data2[1]*$data2[0])+($data2[2]*$data3[0])+($data2[3]*$data4[0])+($data2[4]*$data5[0])+($data2[5]*$data6[0])+($data2[6]*$data7[0])+($data2[7]*$data8[0]);
      $data10[] = ($data2[0]*$data1[1])+($data2[1]*$data2[1])+($data2[2]*$data3[1])+($data2[3]*$data4[1])+($data2[4]*$data5[1])+($data2[5]*$data6[1])+($data2[6]*$data7[1])+($data2[7]*$data8[1]);
      $data10[] = ($data2[0]*$data1[2])+($data2[1]*$data2[2])+($data2[2]*$data3[2])+($data2[3]*$data4[2])+($data2[4]*$data5[2])+($data2[5]*$data6[2])+($data2[6]*$data7[2])+($data2[7]*$data8[2]);
      $data10[] = ($data2[0]*$data1[3])+($data2[1]*$data2[3])+($data2[2]*$data3[3])+($data2[3]*$data4[3])+($data2[4]*$data5[3])+($data2[5]*$data6[3])+($data2[6]*$data7[3])+($data2[7]*$data8[3]);
      $data10[] = ($data2[0]*$data1[4])+($data2[1]*$data2[4])+($data2[2]*$data3[4])+($data2[3]*$data4[4])+($data2[4]*$data5[4])+($data2[5]*$data6[4])+($data2[6]*$data7[4])+($data2[7]*$data8[4]);
      $data10[] = ($data2[0]*$data1[5])+($data2[1]*$data2[5])+($data2[2]*$data3[5])+($data2[3]*$data4[5])+($data2[4]*$data5[5])+($data2[5]*$data6[5])+($data2[6]*$data7[5])+($data2[7]*$data8[5]);
      $data10[] = ($data2[0]*$data1[6])+($data2[1]*$data2[6])+($data2[2]*$data3[6])+($data2[3]*$data4[6])+($data2[4]*$data5[6])+($data2[5]*$data6[6])+($data2[6]*$data7[6])+($data2[7]*$data8[6]);
      $data10[] = ($data2[0]*$data1[7])+($data2[1]*$data2[7])+($data2[2]*$data3[7])+($data2[3]*$data4[7])+($data2[4]*$data5[7])+($data2[5]*$data6[7])+($data2[6]*$data7[7])+($data2[7]*$data8[7]);
      

      $data11 = array();
      $data11[] = ($data3[0]*$data1[0])+($data3[1]*$data2[0])+($data3[2]*$data3[0])+($data3[3]*$data4[0])+($data3[4]*$data5[0])+($data3[5]*$data6[0])+($data3[6]*$data7[0])+($data3[7]*$data8[0]);
      $data11[] = ($data3[0]*$data1[1])+($data3[1]*$data2[1])+($data3[2]*$data3[1])+($data3[3]*$data4[1])+($data3[4]*$data5[1])+($data3[5]*$data6[1])+($data3[6]*$data7[1])+($data3[7]*$data8[1]);
      $data11[] = ($data3[0]*$data1[2])+($data3[1]*$data2[2])+($data3[2]*$data3[2])+($data3[3]*$data4[2])+($data3[4]*$data5[2])+($data3[5]*$data6[2])+($data3[6]*$data7[2])+($data3[7]*$data8[2]);
      $data11[] = ($data3[0]*$data1[3])+($data3[1]*$data2[3])+($data3[2]*$data3[3])+($data3[3]*$data4[3])+($data3[4]*$data5[3])+($data3[5]*$data6[3])+($data3[6]*$data7[3])+($data3[7]*$data8[3]);
      $data11[] = ($data3[0]*$data1[4])+($data3[1]*$data2[4])+($data3[2]*$data3[4])+($data3[3]*$data4[4])+($data3[4]*$data5[4])+($data3[5]*$data6[4])+($data3[6]*$data7[4])+($data3[7]*$data8[4]);
      $data11[] = ($data3[0]*$data1[5])+($data3[1]*$data2[5])+($data3[2]*$data3[5])+($data3[3]*$data4[5])+($data3[4]*$data5[5])+($data3[5]*$data6[5])+($data3[6]*$data7[5])+($data3[7]*$data8[5]);
      $data11[] = ($data3[0]*$data1[6])+($data3[1]*$data2[6])+($data3[2]*$data3[6])+($data3[3]*$data4[6])+($data3[4]*$data5[6])+($data3[5]*$data6[6])+($data3[6]*$data7[6])+($data3[7]*$data8[6]);
      $data11[] = ($data3[0]*$data1[7])+($data3[1]*$data2[7])+($data3[2]*$data3[7])+($data3[3]*$data4[7])+($data3[4]*$data5[7])+($data3[5]*$data6[7])+($data3[6]*$data7[7])+($data3[7]*$data8[7]);

      $data12 = array();
      $data12[] = ($data4[0]*$data1[0])+($data4[1]*$data2[0])+($data4[2]*$data3[0])+($data4[3]*$data4[0])+($data4[4]*$data5[0])+($data4[5]*$data6[0])+($data4[6]*$data7[0])+($data4[7]*$data8[0]);
      $data12[] = ($data4[0]*$data1[1])+($data4[1]*$data2[1])+($data4[2]*$data3[1])+($data4[3]*$data4[1])+($data4[4]*$data5[1])+($data4[5]*$data6[1])+($data4[6]*$data7[1])+($data4[7]*$data8[1]);
      $data12[] = ($data4[0]*$data1[2])+($data4[1]*$data2[2])+($data4[2]*$data3[2])+($data4[3]*$data4[2])+($data4[4]*$data5[2])+($data4[5]*$data6[2])+($data4[6]*$data7[2])+($data4[7]*$data8[2]);
      $data12[] = ($data4[0]*$data1[3])+($data4[1]*$data2[3])+($data4[2]*$data3[3])+($data4[3]*$data4[3])+($data4[4]*$data5[3])+($data4[5]*$data6[3])+($data4[6]*$data7[3])+($data4[7]*$data8[3]);
      $data12[] = ($data4[0]*$data1[4])+($data4[1]*$data2[4])+($data4[2]*$data3[4])+($data4[3]*$data4[4])+($data4[4]*$data5[4])+($data4[5]*$data6[4])+($data4[6]*$data7[4])+($data4[7]*$data8[4]);
      $data12[] = ($data4[0]*$data1[5])+($data4[1]*$data2[5])+($data4[2]*$data3[5])+($data4[3]*$data4[5])+($data4[4]*$data5[5])+($data4[5]*$data6[5])+($data4[6]*$data7[5])+($data4[7]*$data8[5]);
      $data12[] = ($data4[0]*$data1[6])+($data4[1]*$data2[6])+($data4[2]*$data3[6])+($data4[3]*$data4[6])+($data4[4]*$data5[6])+($data4[5]*$data6[6])+($data4[6]*$data7[6])+($data4[7]*$data8[6]);
      $data12[] = ($data4[0]*$data1[7])+($data4[1]*$data2[7])+($data4[2]*$data3[7])+($data4[3]*$data4[7])+($data4[4]*$data5[7])+($data4[5]*$data6[7])+($data4[6]*$data7[7])+($data4[7]*$data8[7]);
      
      $data13 = array();
      $data13[] = ($data5[0]*$data1[0])+($data5[1]*$data2[0])+($data5[2]*$data3[0])+($data5[3]*$data4[0])+($data5[4]*$data5[0])+($data5[5]*$data6[0])+($data5[6]*$data7[0])+($data5[7]*$data8[0]);
      $data13[] = ($data5[0]*$data1[1])+($data5[1]*$data2[1])+($data5[2]*$data3[1])+($data5[3]*$data4[1])+($data5[4]*$data5[1])+($data5[5]*$data6[1])+($data5[6]*$data7[1])+($data5[7]*$data8[1]);
      $data13[] = ($data5[0]*$data1[2])+($data5[1]*$data2[2])+($data5[2]*$data3[2])+($data5[3]*$data4[2])+($data5[4]*$data5[2])+($data5[5]*$data6[2])+($data5[6]*$data7[2])+($data5[7]*$data8[2]);
      $data13[] = ($data5[0]*$data1[3])+($data5[1]*$data2[3])+($data5[2]*$data3[3])+($data5[3]*$data4[3])+($data5[4]*$data5[3])+($data5[5]*$data6[3])+($data5[6]*$data7[3])+($data5[7]*$data8[3]);
      $data13[] = ($data5[0]*$data1[4])+($data5[1]*$data2[4])+($data5[2]*$data3[4])+($data5[3]*$data4[4])+($data5[4]*$data5[4])+($data5[5]*$data6[4])+($data5[6]*$data7[4])+($data5[7]*$data8[4]);
      $data13[] = ($data5[0]*$data1[5])+($data5[1]*$data2[5])+($data5[2]*$data3[5])+($data5[3]*$data4[5])+($data5[4]*$data5[5])+($data5[5]*$data6[5])+($data5[6]*$data7[5])+($data5[7]*$data8[5]);
      $data13[] = ($data5[0]*$data1[6])+($data5[1]*$data2[6])+($data5[2]*$data3[6])+($data5[3]*$data4[6])+($data5[4]*$data5[6])+($data5[5]*$data6[6])+($data5[6]*$data7[6])+($data5[7]*$data8[6]);
      $data13[] = ($data5[0]*$data1[7])+($data5[1]*$data2[7])+($data5[2]*$data3[7])+($data5[3]*$data4[7])+($data5[4]*$data5[7])+($data5[5]*$data6[7])+($data5[6]*$data7[7])+($data5[7]*$data8[7]);

      $data14 = array();
      $data14[] = ($data6[0]*$data1[0])+($data6[1]*$data2[0])+($data6[2]*$data3[0])+($data6[3]*$data4[0])+($data6[4]*$data5[0])+($data6[5]*$data6[0])+($data6[6]*$data7[0])+($data6[7]*$data8[0]);
      $data14[] = ($data6[0]*$data1[1])+($data6[1]*$data2[1])+($data6[2]*$data3[1])+($data6[3]*$data4[1])+($data6[4]*$data5[1])+($data6[5]*$data6[1])+($data6[6]*$data7[1])+($data6[7]*$data8[1]);
      $data14[] = ($data6[0]*$data1[2])+($data6[1]*$data2[2])+($data6[2]*$data3[2])+($data6[3]*$data4[2])+($data6[4]*$data5[2])+($data6[5]*$data6[2])+($data6[6]*$data7[2])+($data6[7]*$data8[2]);
      $data14[] = ($data6[0]*$data1[3])+($data6[1]*$data2[3])+($data6[2]*$data3[3])+($data6[3]*$data4[3])+($data6[4]*$data5[3])+($data6[5]*$data6[3])+($data6[6]*$data7[3])+($data6[7]*$data8[3]);
      $data14[] = ($data6[0]*$data1[4])+($data6[1]*$data2[4])+($data6[2]*$data3[4])+($data6[3]*$data4[4])+($data6[4]*$data5[4])+($data6[5]*$data6[4])+($data6[6]*$data7[4])+($data6[7]*$data8[4]);
      $data14[] = ($data6[0]*$data1[5])+($data6[1]*$data2[5])+($data6[2]*$data3[5])+($data6[3]*$data4[5])+($data6[4]*$data5[5])+($data6[5]*$data6[5])+($data6[6]*$data7[5])+($data6[7]*$data8[5]);
      $data14[] = ($data6[0]*$data1[6])+($data6[1]*$data2[6])+($data6[2]*$data3[6])+($data6[3]*$data4[6])+($data6[4]*$data5[6])+($data6[5]*$data6[6])+($data6[6]*$data7[6])+($data6[7]*$data8[6]);
      $data14[] = ($data6[0]*$data1[7])+($data6[1]*$data2[7])+($data6[2]*$data3[7])+($data6[3]*$data4[7])+($data6[4]*$data5[7])+($data6[5]*$data6[7])+($data6[6]*$data7[7])+($data6[7]*$data8[7]);

      $data15 = array();
      $data15[] = ($data7[0]*$data1[0])+($data7[1]*$data2[0])+($data7[2]*$data3[0])+($data7[3]*$data4[0])+($data7[4]*$data5[0])+($data7[5]*$data6[0])+($data7[6]*$data7[0])+($data7[7]*$data8[0]);
      $data15[] = ($data7[0]*$data1[1])+($data7[1]*$data2[1])+($data7[2]*$data3[1])+($data7[3]*$data4[1])+($data7[4]*$data5[1])+($data7[5]*$data6[1])+($data7[6]*$data7[1])+($data7[7]*$data8[1]);
      $data15[] = ($data7[0]*$data1[2])+($data7[1]*$data2[2])+($data7[2]*$data3[2])+($data7[3]*$data4[2])+($data7[4]*$data5[2])+($data7[5]*$data6[2])+($data7[6]*$data7[2])+($data7[7]*$data8[2]);
      $data15[] = ($data7[0]*$data1[3])+($data7[1]*$data2[3])+($data7[2]*$data3[3])+($data7[3]*$data4[3])+($data7[4]*$data5[3])+($data7[5]*$data6[3])+($data7[6]*$data7[3])+($data7[7]*$data8[3]);
      $data15[] = ($data7[0]*$data1[4])+($data7[1]*$data2[4])+($data7[2]*$data3[4])+($data7[3]*$data4[4])+($data7[4]*$data5[4])+($data7[5]*$data6[4])+($data7[6]*$data7[4])+($data7[7]*$data8[4]);
      $data15[] = ($data7[0]*$data1[5])+($data7[1]*$data2[5])+($data7[2]*$data3[5])+($data7[3]*$data4[5])+($data7[4]*$data5[5])+($data7[5]*$data6[5])+($data7[6]*$data7[5])+($data7[7]*$data8[5]);
      $data15[] = ($data7[0]*$data1[6])+($data7[1]*$data2[6])+($data7[2]*$data3[6])+($data7[3]*$data4[6])+($data7[4]*$data5[6])+($data7[5]*$data6[6])+($data7[6]*$data7[6])+($data7[7]*$data8[6]);
      $data15[] = ($data7[0]*$data1[7])+($data7[1]*$data2[7])+($data7[2]*$data3[7])+($data7[3]*$data4[7])+($data7[4]*$data5[7])+($data7[5]*$data6[7])+($data7[6]*$data7[7])+($data7[7]*$data8[7]);
      
      $data16 = array();
      $data16[] = ($data8[0]*$data1[0])+($data8[1]*$data2[0])+($data8[2]*$data3[0])+($data8[3]*$data4[0])+($data8[4]*$data5[0])+($data8[5]*$data6[0])+($data8[6]*$data7[0])+($data8[7]*$data8[0]);
      $data16[] = ($data8[0]*$data1[1])+($data8[1]*$data2[1])+($data8[2]*$data3[1])+($data8[3]*$data4[1])+($data8[4]*$data5[1])+($data8[5]*$data6[1])+($data8[6]*$data7[1])+($data8[7]*$data8[1]);
      $data16[] = ($data8[0]*$data1[2])+($data8[1]*$data2[2])+($data8[2]*$data3[2])+($data8[3]*$data4[2])+($data8[4]*$data5[2])+($data8[5]*$data6[2])+($data8[6]*$data7[2])+($data8[7]*$data8[2]);
      $data16[] = ($data8[0]*$data1[3])+($data8[1]*$data2[3])+($data8[2]*$data3[3])+($data8[3]*$data4[3])+($data8[4]*$data5[3])+($data8[5]*$data6[3])+($data8[6]*$data7[3])+($data8[7]*$data8[3]);
      $data16[] = ($data8[0]*$data1[4])+($data8[1]*$data2[4])+($data8[2]*$data3[4])+($data8[3]*$data4[4])+($data8[4]*$data5[4])+($data8[5]*$data6[4])+($data8[6]*$data7[4])+($data8[7]*$data8[4]);
      $data16[] = ($data8[0]*$data1[5])+($data8[1]*$data2[5])+($data8[2]*$data3[5])+($data8[3]*$data4[5])+($data8[4]*$data5[5])+($data8[5]*$data6[5])+($data8[6]*$data7[5])+($data8[7]*$data8[5]);
      $data16[] = ($data8[0]*$data1[6])+($data8[1]*$data2[6])+($data8[2]*$data3[6])+($data8[3]*$data4[6])+($data8[4]*$data5[6])+($data8[5]*$data6[6])+($data8[6]*$data7[6])+($data8[7]*$data8[6]);
      $data16[] = ($data8[0]*$data1[7])+($data8[1]*$data2[7])+($data8[2]*$data3[7])+($data8[3]*$data4[7])+($data8[4]*$data5[7])+($data8[5]*$data6[7])+($data8[6]*$data7[7])+($data8[7]*$data8[7]);
      
      // menjumlahkan nilai setiap matriks iterasi pertama
      $totaldata1 = $data9[0]+$data9[1]+$data9[2]+$data9[3]+$data9[4]+$data9[5]+$data9[6]+$data9[7];
      $totaldata2 = $data10[0]+$data10[1]+$data10[2]+$data10[3]+$data10[4]+$data10[5]+$data10[6]+$data10[7];
      $totaldata3 = $data11[0]+$data11[1]+$data11[2]+$data11[3]+$data11[4]+$data11[5]+$data11[6]+$data11[7];
      $totaldata4 = $data12[0]+$data12[1]+$data12[2]+$data12[3]+$data12[4]+$data12[5]+$data12[6]+$data12[7];
      $totaldata5 = $data13[0]+$data13[1]+$data13[2]+$data13[3]+$data13[4]+$data13[5]+$data13[6]+$data13[7];
      $totaldata6 = $data14[0]+$data14[1]+$data14[2]+$data14[3]+$data14[4]+$data14[5]+$data14[6]+$data14[7];
      $totaldata7 = $data15[0]+$data15[1]+$data15[2]+$data15[3]+$data15[4]+$data15[5]+$data15[6]+$data15[7];
      $totaldata8 = $data16[0]+$data16[1]+$data16[2]+$data16[3]+$data16[4]+$data16[5]+$data16[6]+$data16[7];
      $sumtotal = $totaldata1+$totaldata2+$totaldata3+$totaldata4+$totaldata5+$totaldata6+$totaldata7+$totaldata8;

      // hasil normalisasi iterasi pertama
      $eigenvector1 = $totaldata1/$sumtotal;
      $eigenvector2 = $totaldata2/$sumtotal;
      $eigenvector3 = $totaldata3/$sumtotal;
      $eigenvector4 = $totaldata4/$sumtotal;
      $eigenvector5 = $totaldata5/$sumtotal;
      $eigenvector6 = $totaldata6/$sumtotal;
      $eigenvector7 = $totaldata7/$sumtotal;
      $eigenvector8 = $totaldata8/$sumtotal;
      // Total eigenvector, total haruslah 1
      $totaleigenvector1 = $eigenvector1 + $eigenvector2 + $eigenvector3 + $eigenvector4 + $eigenvector5 + $eigenvector6 + $eigenvector7 + $eigenvector8;
      
      // perkalian matriks iterasi ke 2              
      $data17 = array();
      $data17[] = ($data9[0]*$data9[0])+($data9[1]*$data10[0])+($data9[2]*$data11[0])+($data9[3]*$data12[0])+($data9[4]*$data13[0])+($data9[5]*$data14[0])+($data9[6]*$data15[0])+($data9[7]*$data16[0]);
      $data17[] = ($data9[0]*$data9[1])+($data9[1]*$data10[1])+($data9[2]*$data11[1])+($data9[3]*$data12[1])+($data9[4]*$data13[1])+($data9[5]*$data14[1])+($data9[6]*$data15[1])+($data9[7]*$data16[1]);
      $data17[] = ($data9[0]*$data9[2])+($data9[1]*$data10[2])+($data9[2]*$data11[2])+($data9[3]*$data12[2])+($data9[4]*$data13[2])+($data9[5]*$data14[2])+($data9[6]*$data15[2])+($data9[7]*$data16[2]);
      $data17[] = ($data9[0]*$data9[3])+($data9[1]*$data10[3])+($data9[2]*$data11[3])+($data9[3]*$data12[3])+($data9[4]*$data13[3])+($data9[5]*$data14[3])+($data9[6]*$data15[3])+($data9[7]*$data16[3]);
      $data17[] = ($data9[0]*$data9[4])+($data9[1]*$data10[4])+($data9[2]*$data11[4])+($data9[3]*$data12[4])+($data9[4]*$data13[4])+($data9[5]*$data14[4])+($data9[6]*$data15[4])+($data9[7]*$data16[4]);
      $data17[] = ($data9[0]*$data9[5])+($data9[1]*$data10[5])+($data9[2]*$data11[5])+($data9[3]*$data12[5])+($data9[4]*$data13[5])+($data9[5]*$data14[5])+($data9[6]*$data15[5])+($data9[7]*$data16[5]);
      $data17[] = ($data9[0]*$data9[6])+($data9[1]*$data10[6])+($data9[2]*$data11[6])+($data9[3]*$data12[6])+($data9[4]*$data13[6])+($data9[5]*$data14[6])+($data9[6]*$data15[6])+($data9[7]*$data16[6]);
      $data17[] = ($data9[0]*$data9[7])+($data9[1]*$data10[7])+($data9[2]*$data11[7])+($data9[3]*$data12[7])+($data9[4]*$data13[7])+($data9[5]*$data14[7])+($data9[7]*$data15[7])+($data9[7]*$data16[7]);

      $data18 = array();
      $data18[] = ($data10[0]*$data9[0])+($data10[1]*$data10[0])+($data10[2]*$data11[0])+($data10[3]*$data12[0])+($data10[4]*$data13[0])+($data10[5]*$data14[0])+($data10[6]*$data15[0])+($data10[7]*$data16[0]);
      $data18[] = ($data10[0]*$data9[1])+($data10[1]*$data10[1])+($data10[2]*$data11[1])+($data10[3]*$data12[1])+($data10[4]*$data13[1])+($data10[5]*$data14[1])+($data10[6]*$data15[1])+($data10[7]*$data16[1]);
      $data18[] = ($data10[0]*$data9[2])+($data10[1]*$data10[2])+($data10[2]*$data11[2])+($data10[3]*$data12[2])+($data10[4]*$data13[2])+($data10[5]*$data14[2])+($data10[6]*$data15[2])+($data10[7]*$data16[2]);
      $data18[] = ($data10[0]*$data9[3])+($data10[1]*$data10[3])+($data10[2]*$data11[3])+($data10[3]*$data12[3])+($data10[4]*$data13[3])+($data10[5]*$data14[3])+($data10[6]*$data15[3])+($data10[7]*$data16[3]);
      $data18[] = ($data10[0]*$data9[4])+($data10[1]*$data10[4])+($data10[2]*$data11[4])+($data10[3]*$data12[4])+($data10[4]*$data13[4])+($data10[5]*$data14[4])+($data10[6]*$data15[4])+($data10[7]*$data16[4]);
      $data18[] = ($data10[0]*$data9[5])+($data10[1]*$data10[5])+($data10[2]*$data11[5])+($data10[3]*$data12[5])+($data10[4]*$data13[5])+($data10[5]*$data14[5])+($data10[6]*$data15[5])+($data10[7]*$data16[5]);
      $data18[] = ($data10[0]*$data9[6])+($data10[1]*$data10[6])+($data10[2]*$data11[6])+($data10[3]*$data12[6])+($data10[4]*$data13[6])+($data10[5]*$data14[6])+($data10[6]*$data15[6])+($data10[7]*$data16[6]);
      $data18[] = ($data10[0]*$data9[7])+($data10[1]*$data10[7])+($data10[2]*$data11[7])+($data10[3]*$data12[7])+($data10[4]*$data13[7])+($data10[5]*$data14[7])+($data10[7]*$data15[7])+($data10[7]*$data16[7]);
      

      $data19 = array();
      $data19[] = ($data11[0]*$data9[0])+($data11[1]*$data10[0])+($data11[2]*$data11[0])+($data11[3]*$data12[0])+($data11[4]*$data13[0])+($data11[5]*$data14[0])+($data11[6]*$data15[0])+($data11[7]*$data16[0]);
      $data19[] = ($data11[0]*$data9[1])+($data11[1]*$data10[1])+($data11[2]*$data11[1])+($data11[3]*$data12[1])+($data11[4]*$data13[1])+($data11[5]*$data14[1])+($data11[6]*$data15[1])+($data11[7]*$data16[1]);
      $data19[] = ($data11[0]*$data9[2])+($data11[1]*$data10[2])+($data11[2]*$data11[2])+($data11[3]*$data12[2])+($data11[4]*$data13[2])+($data11[5]*$data14[2])+($data11[6]*$data15[2])+($data11[7]*$data16[2]);
      $data19[] = ($data11[0]*$data9[3])+($data11[1]*$data10[3])+($data11[2]*$data11[3])+($data11[3]*$data12[3])+($data11[4]*$data13[3])+($data11[5]*$data14[3])+($data11[6]*$data15[3])+($data11[7]*$data16[3]);
      $data19[] = ($data11[0]*$data9[4])+($data11[1]*$data10[4])+($data11[2]*$data11[4])+($data11[3]*$data12[4])+($data11[4]*$data13[4])+($data11[5]*$data14[4])+($data11[6]*$data15[4])+($data11[7]*$data16[4]);
      $data19[] = ($data11[0]*$data9[5])+($data11[1]*$data10[5])+($data11[2]*$data11[5])+($data11[3]*$data12[5])+($data11[4]*$data13[5])+($data11[5]*$data14[5])+($data11[6]*$data15[5])+($data11[7]*$data16[5]);
      $data19[] = ($data11[0]*$data9[6])+($data11[1]*$data10[6])+($data11[2]*$data11[6])+($data11[3]*$data12[6])+($data11[4]*$data13[6])+($data11[5]*$data14[6])+($data11[6]*$data15[6])+($data11[7]*$data16[6]);
      $data19[] = ($data11[0]*$data9[7])+($data11[1]*$data10[7])+($data11[2]*$data11[7])+($data11[3]*$data12[7])+($data11[4]*$data13[7])+($data11[5]*$data14[7])+($data11[7]*$data15[7])+($data11[7]*$data16[7]);
      

      $data20 = array();
      $data20[] = ($data12[0]*$data9[0])+($data12[1]*$data10[0])+($data12[2]*$data11[0])+($data12[3]*$data12[0])+($data12[4]*$data13[0])+($data12[5]*$data14[0])+($data12[6]*$data15[0])+($data12[7]*$data16[0]);
      $data20[] = ($data12[0]*$data9[1])+($data12[1]*$data10[1])+($data12[2]*$data11[1])+($data12[3]*$data12[1])+($data12[4]*$data13[1])+($data12[5]*$data14[1])+($data12[6]*$data15[1])+($data12[7]*$data16[1]);
      $data20[] = ($data12[0]*$data9[2])+($data12[1]*$data10[2])+($data12[2]*$data11[2])+($data12[3]*$data12[2])+($data12[4]*$data13[2])+($data12[5]*$data14[2])+($data12[6]*$data15[2])+($data12[7]*$data16[2]);
      $data20[] = ($data12[0]*$data9[3])+($data12[1]*$data10[3])+($data12[2]*$data11[3])+($data12[3]*$data12[3])+($data12[4]*$data13[3])+($data12[5]*$data14[3])+($data12[6]*$data15[3])+($data12[7]*$data16[3]);
      $data20[] = ($data12[0]*$data9[4])+($data12[1]*$data10[4])+($data12[2]*$data11[4])+($data12[3]*$data12[4])+($data12[4]*$data13[4])+($data12[5]*$data14[4])+($data12[6]*$data15[4])+($data12[7]*$data16[4]);
      $data20[] = ($data12[0]*$data9[5])+($data12[1]*$data10[5])+($data12[2]*$data11[5])+($data12[3]*$data12[5])+($data12[4]*$data13[5])+($data12[5]*$data14[5])+($data12[6]*$data15[5])+($data12[7]*$data16[5]);
      $data20[] = ($data12[0]*$data9[6])+($data12[1]*$data10[6])+($data12[2]*$data11[6])+($data12[3]*$data12[6])+($data12[4]*$data13[6])+($data12[5]*$data14[6])+($data12[6]*$data15[6])+($data12[7]*$data16[6]);
      $data20[] = ($data12[0]*$data9[7])+($data12[1]*$data10[7])+($data12[2]*$data11[7])+($data12[3]*$data12[7])+($data12[4]*$data13[7])+($data12[5]*$data14[7])+($data12[7]*$data15[7])+($data12[7]*$data16[7]);

      $data21 = array();
      $data21[] = ($data13[0]*$data9[0])+($data13[1]*$data10[0])+($data13[2]*$data11[0])+($data13[3]*$data12[0])+($data13[4]*$data13[0])+($data13[5]*$data14[0])+($data13[6]*$data15[0])+($data13[7]*$data16[0]);
      $data21[] = ($data13[0]*$data9[1])+($data13[1]*$data10[1])+($data13[2]*$data11[1])+($data13[3]*$data12[1])+($data13[4]*$data13[1])+($data13[5]*$data14[1])+($data13[6]*$data15[1])+($data13[7]*$data16[1]);
      $data21[] = ($data13[0]*$data9[2])+($data13[1]*$data10[2])+($data13[2]*$data11[2])+($data13[3]*$data12[2])+($data13[4]*$data13[2])+($data13[5]*$data14[2])+($data13[6]*$data15[2])+($data13[7]*$data16[2]);
      $data21[] = ($data13[0]*$data9[3])+($data13[1]*$data10[3])+($data13[2]*$data11[3])+($data13[3]*$data12[3])+($data13[4]*$data13[3])+($data13[5]*$data14[3])+($data13[6]*$data15[3])+($data13[7]*$data16[3]);
      $data21[] = ($data13[0]*$data9[4])+($data13[1]*$data10[4])+($data13[2]*$data11[4])+($data13[3]*$data12[4])+($data13[4]*$data13[4])+($data13[5]*$data14[4])+($data13[6]*$data15[4])+($data13[7]*$data16[4]);
      $data21[] = ($data13[0]*$data9[5])+($data13[1]*$data10[5])+($data13[2]*$data11[5])+($data13[3]*$data12[5])+($data13[4]*$data13[5])+($data13[5]*$data14[5])+($data13[6]*$data15[5])+($data13[7]*$data16[5]);
      $data21[] = ($data13[0]*$data9[6])+($data13[1]*$data10[6])+($data13[2]*$data11[6])+($data13[3]*$data12[6])+($data13[4]*$data13[6])+($data13[5]*$data14[6])+($data13[6]*$data15[6])+($data13[7]*$data16[6]);
      $data21[] = ($data13[0]*$data9[7])+($data13[1]*$data10[7])+($data13[2]*$data11[7])+($data13[3]*$data12[7])+($data13[4]*$data13[7])+($data13[5]*$data14[7])+($data13[7]*$data15[7])+($data13[7]*$data16[7]);

      $data22 = array();
      $data22[] = ($data14[0]*$data9[0])+($data14[1]*$data10[0])+($data14[2]*$data11[0])+($data14[3]*$data12[0])+($data14[4]*$data13[0])+($data14[5]*$data14[0])+($data14[6]*$data15[0])+($data14[7]*$data16[0]);
      $data22[] = ($data14[0]*$data9[1])+($data14[1]*$data10[1])+($data14[2]*$data11[1])+($data14[3]*$data12[1])+($data14[4]*$data13[1])+($data14[5]*$data14[1])+($data14[6]*$data15[1])+($data14[7]*$data16[1]);
      $data22[] = ($data14[0]*$data9[2])+($data14[1]*$data10[2])+($data14[2]*$data11[2])+($data14[3]*$data12[2])+($data14[4]*$data13[2])+($data14[5]*$data14[2])+($data14[6]*$data15[2])+($data14[7]*$data16[2]);
      $data22[] = ($data14[0]*$data9[3])+($data14[1]*$data10[3])+($data14[2]*$data11[3])+($data14[3]*$data12[3])+($data14[4]*$data13[3])+($data14[5]*$data14[3])+($data14[6]*$data15[3])+($data14[7]*$data16[3]);
      $data22[] = ($data14[0]*$data9[4])+($data14[1]*$data10[4])+($data14[2]*$data11[4])+($data14[3]*$data12[4])+($data14[4]*$data13[4])+($data14[5]*$data14[4])+($data14[6]*$data15[4])+($data14[7]*$data16[4]);
      $data22[] = ($data14[0]*$data9[5])+($data14[1]*$data10[5])+($data14[2]*$data11[5])+($data14[3]*$data12[5])+($data14[4]*$data13[5])+($data14[5]*$data14[5])+($data14[6]*$data15[5])+($data14[7]*$data16[5]);
      $data22[] = ($data14[0]*$data9[6])+($data14[1]*$data10[6])+($data14[2]*$data11[6])+($data14[3]*$data12[6])+($data14[4]*$data13[6])+($data14[5]*$data14[6])+($data14[6]*$data15[6])+($data14[7]*$data16[6]);
      $data22[] = ($data14[0]*$data9[7])+($data14[1]*$data10[7])+($data14[2]*$data11[7])+($data14[3]*$data12[7])+($data14[4]*$data13[7])+($data14[5]*$data14[7])+($data14[7]*$data15[7])+($data14[7]*$data16[7]);

      $data23 = array();
      $data23[] = ($data15[0]*$data9[0])+($data15[1]*$data10[0])+($data15[2]*$data11[0])+($data15[3]*$data12[0])+($data15[4]*$data13[0])+($data15[5]*$data14[0])+($data15[6]*$data15[0])+($data15[7]*$data16[0]);
      $data23[] = ($data15[0]*$data9[1])+($data15[1]*$data10[1])+($data15[2]*$data11[1])+($data15[3]*$data12[1])+($data15[4]*$data13[1])+($data15[5]*$data14[1])+($data15[6]*$data15[1])+($data15[7]*$data16[1]);
      $data23[] = ($data15[0]*$data9[2])+($data15[1]*$data10[2])+($data15[2]*$data11[2])+($data15[3]*$data12[2])+($data15[4]*$data13[2])+($data15[5]*$data14[2])+($data15[6]*$data15[2])+($data15[7]*$data16[2]);
      $data23[] = ($data15[0]*$data9[3])+($data15[1]*$data10[3])+($data15[2]*$data11[3])+($data15[3]*$data12[3])+($data15[4]*$data13[3])+($data15[5]*$data14[3])+($data15[6]*$data15[3])+($data15[7]*$data16[3]);
      $data23[] = ($data15[0]*$data9[4])+($data15[1]*$data10[4])+($data15[2]*$data11[4])+($data15[3]*$data12[4])+($data15[4]*$data13[4])+($data15[5]*$data14[4])+($data15[6]*$data15[4])+($data15[7]*$data16[4]);
      $data23[] = ($data15[0]*$data9[5])+($data15[1]*$data10[5])+($data15[2]*$data11[5])+($data15[3]*$data12[5])+($data15[4]*$data13[5])+($data15[5]*$data14[5])+($data15[6]*$data15[5])+($data15[7]*$data16[5]);
      $data23[] = ($data15[0]*$data9[6])+($data15[1]*$data10[6])+($data15[2]*$data11[6])+($data15[3]*$data12[6])+($data15[4]*$data13[6])+($data15[5]*$data14[6])+($data15[6]*$data15[6])+($data15[7]*$data16[6]);
      $data23[] = ($data15[0]*$data9[7])+($data15[1]*$data10[7])+($data15[2]*$data11[7])+($data15[3]*$data12[7])+($data15[4]*$data13[7])+($data15[5]*$data14[7])+($data15[7]*$data15[7])+($data15[7]*$data16[7]);

      $data24 = array();
      $data24[] = ($data16[0]*$data9[0])+($data16[1]*$data10[0])+($data16[2]*$data11[0])+($data16[3]*$data12[0])+($data16[4]*$data13[0])+($data16[5]*$data14[0])+($data16[6]*$data15[0])+($data16[7]*$data16[0]);
      $data24[] = ($data16[0]*$data9[1])+($data16[1]*$data10[1])+($data16[2]*$data11[1])+($data16[3]*$data12[1])+($data16[4]*$data13[1])+($data16[5]*$data14[1])+($data16[6]*$data15[1])+($data16[7]*$data16[1]);
      $data24[] = ($data16[0]*$data9[2])+($data16[1]*$data10[2])+($data16[2]*$data11[2])+($data16[3]*$data12[2])+($data16[4]*$data13[2])+($data16[5]*$data14[2])+($data16[6]*$data15[2])+($data16[7]*$data16[2]);
      $data24[] = ($data16[0]*$data9[3])+($data16[1]*$data10[3])+($data16[2]*$data11[3])+($data16[3]*$data12[3])+($data16[4]*$data13[3])+($data16[5]*$data14[3])+($data16[6]*$data15[3])+($data16[7]*$data16[3]);
      $data24[] = ($data16[0]*$data9[4])+($data16[1]*$data10[4])+($data16[2]*$data11[4])+($data16[3]*$data12[4])+($data16[4]*$data13[4])+($data16[5]*$data14[4])+($data16[6]*$data15[4])+($data16[7]*$data16[4]);
      $data24[] = ($data16[0]*$data9[5])+($data16[1]*$data10[5])+($data16[2]*$data11[5])+($data16[3]*$data12[5])+($data16[4]*$data13[5])+($data16[5]*$data14[5])+($data16[6]*$data15[5])+($data16[7]*$data16[5]);
      $data24[] = ($data16[0]*$data9[6])+($data16[1]*$data10[6])+($data16[2]*$data11[6])+($data16[3]*$data12[6])+($data16[4]*$data13[6])+($data16[5]*$data14[6])+($data16[6]*$data15[6])+($data16[7]*$data16[6]);
      $data24[] = ($data16[0]*$data9[7])+($data16[1]*$data10[7])+($data16[2]*$data11[7])+($data16[3]*$data12[7])+($data16[4]*$data13[7])+($data16[5]*$data14[7])+($data16[7]*$data15[7])+($data16[7]*$data16[7]);
       
      // menjumlahkan nilai setiap matriks iterasi kedua
      $totaldata9 = $data17[0]+$data17[1]+$data17[2]+$data17[3]+$data17[4]+$data17[5]+$data17[6]+$data17[7];
      $totaldata10 = $data18[0]+$data18[1]+$data18[2]+$data18[3]+$data18[4]+$data18[5]+$data18[6]+$data18[7];
      $totaldata11 = $data19[0]+$data19[1]+$data19[2]+$data19[3]+$data19[4]+$data19[5]+$data19[6]+$data19[7];
      $totaldata12 = $data20[0]+$data20[1]+$data20[2]+$data20[3]+$data20[4]+$data20[5]+$data20[6]+$data20[7];
      $totaldata13 = $data21[0]+$data21[1]+$data21[2]+$data21[3]+$data21[4]+$data21[5]+$data21[6]+$data21[7];
      $totaldata14 = $data22[0]+$data22[1]+$data22[2]+$data22[3]+$data22[4]+$data22[5]+$data22[6]+$data22[7];
      $totaldata15 = $data23[0]+$data23[1]+$data23[2]+$data23[3]+$data23[4]+$data23[5]+$data23[6]+$data23[7];
      $totaldata16 = $data24[0]+$data24[1]+$data24[2]+$data24[3]+$data24[4]+$data24[5]+$data24[6]+$data24[7];
      $sumtotal2 = $totaldata9+$totaldata10+$totaldata11+$totaldata12+$totaldata13+$totaldata14+$totaldata15+$totaldata16;
      
      // hasil normalisasi iterasi kedua
      $eigenvector9 = $totaldata9/$sumtotal2;
      $eigenvector10 = $totaldata10/$sumtotal2;
      $eigenvector11 = $totaldata11/$sumtotal2;
      $eigenvector12 = $totaldata12/$sumtotal2;
      $eigenvector13 = $totaldata13/$sumtotal2;
      $eigenvector14 = $totaldata14/$sumtotal2;
      $eigenvector15 = $totaldata15/$sumtotal2;
      $eigenvector16 = $totaldata16/$sumtotal2;
      // Total eigenvector, total haruslah 1
      $totaleigenvector2 = $eigenvector9+$eigenvector10+$eigenvector11+$eigenvector12+$eigenvector13+$eigenvector14+$eigenvector15+$eigenvector16;

      // hasil nilai persentase dan nominal pengeluaran 
      $persentase1 = $eigenvector9*100;
      $pengeluaran1 = ($persentase1*$pengeluarankbm)/100;
      $persentase2 = $eigenvector10*100;
      $pengeluaran2 = ($persentase2*$pengeluarankbm)/100;
      $persentase3 = $eigenvector11*100;
      $pengeluaran3 = ($persentase3*$pengeluarankbm)/100;
      $persentase4 = $eigenvector12*100;
      $pengeluaran4 = ($persentase4*$pengeluarankbm)/100;
      $persentase5 = $eigenvector13*100;
      $pengeluaran5 = ($persentase5*$pengeluarankbm)/100;
      $persentase6 = $eigenvector14*100;
      $pengeluaran6 = ($persentase6*$pengeluarankbm)/100;
      $persentase7 = $eigenvector15*100;
      $pengeluaran7 = ($persentase7*$pengeluarankbm)/100;
      $persentase8 = $eigenvector16*100;
      $pengeluaran8 = ($persentase8*$pengeluarankbm)/100;

      // inputan ke database
      $this->inputdata->inputhasil($id_keu,$eigenvector9,$persentase1,10,2,$pengeluaran1);
      $this->inputdata->inputhasil($id_keu,$eigenvector10,$persentase2,11,2,$pengeluaran2);
      $this->inputdata->inputhasil($id_keu,$eigenvector11,$persentase3,12,2,$pengeluaran3);
      $this->inputdata->inputhasil($id_keu,$eigenvector12,$persentase4,13,2,$pengeluaran4);
      $this->inputdata->inputhasil($id_keu,$eigenvector13,$persentase5,14,2,$pengeluaran5);
      $this->inputdata->inputhasil($id_keu,$eigenvector14,$persentase6,15,2,$pengeluaran6);
      $this->inputdata->inputhasil($id_keu,$eigenvector15,$persentase7,16,2,$pengeluaran7);
      $this->inputdata->inputhasil($id_keu,$eigenvector16,$persentase8,17,2,$pengeluaran8);

      // perbedaan eigenvector, jika perubahan yang terjadi kecil maka nilai eigenvector 1 telah tepat.      
      $hasil1 = $eigenvector9-$eigenvector1;
      $hasil2 = $eigenvector10-$eigenvector2;
      $hasil3 = $eigenvector11-$eigenvector3;
      $hasil4 = $eigenvector12-$eigenvector4;
      $hasil5 = $eigenvector13-$eigenvector5;
      $hasil6 = $eigenvector14-$eigenvector6;
      $hasil7 = $eigenvector15-$eigenvector7;
      $hasil8 = $eigenvector16-$eigenvector8;
      

      // $dataeigenvector[0]=$eigenvector1; 
      // $dataeigenvector[1]=$eigenvector2; 
      // $dataeigenvector[2]=$eigenvector3;
      // $dataeigenvector[3]=$eigenvector4;
      // $dataeigenvector[4]=$eigenvector5;
      // $dataeigenvector[5]=$eigenvector6;
      // $dataeigenvector[6]=$eigenvector7;
      // $dataeigenvector[6]=$eigenvector8;

      // Melakukan perkalian matrik dari hasil data yang didapt dengan nilai eigen.
      $vektorsum1 = array();
      $vektorsum1[] = $eigenvector9*$data1[0];
      $vektorsum1[] = $eigenvector10*$data1[1];
      $vektorsum1[] = $eigenvector11*$data1[2];
      $vektorsum1[] = $eigenvector12*$data1[3];
      $vektorsum1[] = $eigenvector13*$data1[4];
      $vektorsum1[] = $eigenvector14*$data1[5];
      $vektorsum1[] = $eigenvector15*$data1[6];
      $vektorsum1[] = $eigenvector16*$data1[7];

      $vektorsum2 = array();
      $vektorsum2[] = $eigenvector9*$data2[0];
      $vektorsum2[] = $eigenvector10*$data2[1];
      $vektorsum2[] = $eigenvector11*$data2[2];
      $vektorsum2[] = $eigenvector12*$data2[3];
      $vektorsum2[] = $eigenvector13*$data2[4];
      $vektorsum2[] = $eigenvector14*$data2[5];
      $vektorsum2[] = $eigenvector15*$data2[6];
      $vektorsum2[] = $eigenvector16*$data2[7];

      $vektorsum3 = array();
      $vektorsum3[] = $eigenvector9*$data3[0];
      $vektorsum3[] = $eigenvector10*$data3[1];
      $vektorsum3[] = $eigenvector11*$data3[2];
      $vektorsum3[] = $eigenvector12*$data3[3];
      $vektorsum3[] = $eigenvector13*$data3[4];
      $vektorsum3[] = $eigenvector14*$data3[5];
      $vektorsum3[] = $eigenvector15*$data3[6];
      $vektorsum3[] = $eigenvector16*$data3[7];

      $vektorsum4 = array();
      $vektorsum4[] = $eigenvector9*$data4[0];
      $vektorsum4[] = $eigenvector10*$data4[1];
      $vektorsum4[] = $eigenvector11*$data4[2];
      $vektorsum4[] = $eigenvector12*$data4[3];
      $vektorsum4[] = $eigenvector13*$data4[4];
      $vektorsum4[] = $eigenvector14*$data4[5];
      $vektorsum4[] = $eigenvector15*$data4[6];
      $vektorsum4[] = $eigenvector16*$data4[7];

      $vektorsum5 = array();
      $vektorsum5[] = $eigenvector9*$data5[0];
      $vektorsum5[] = $eigenvector10*$data5[1];
      $vektorsum5[] = $eigenvector11*$data5[2];
      $vektorsum5[] = $eigenvector12*$data5[3];
      $vektorsum5[] = $eigenvector13*$data5[4];
      $vektorsum5[] = $eigenvector14*$data5[5];
      $vektorsum5[] = $eigenvector15*$data5[6];
      $vektorsum5[] = $eigenvector16*$data5[7];

      $vektorsum6 = array();
      $vektorsum6[] = $eigenvector9*$data6[0];
      $vektorsum6[] = $eigenvector10*$data6[1];
      $vektorsum6[] = $eigenvector11*$data6[2];
      $vektorsum6[] = $eigenvector12*$data6[3];
      $vektorsum6[] = $eigenvector13*$data6[4];
      $vektorsum6[] = $eigenvector14*$data6[5];
      $vektorsum6[] = $eigenvector15*$data6[6];
      $vektorsum6[] = $eigenvector16*$data6[7];

      $vektorsum7 = array();
      $vektorsum7[] = $eigenvector9*$data7[0];
      $vektorsum7[] = $eigenvector10*$data7[1];
      $vektorsum7[] = $eigenvector11*$data7[2];
      $vektorsum7[] = $eigenvector12*$data7[3];
      $vektorsum7[] = $eigenvector13*$data7[4];
      $vektorsum7[] = $eigenvector14*$data7[5];
      $vektorsum7[] = $eigenvector15*$data7[6];
      $vektorsum7[] = $eigenvector16*$data7[7];

      $vektorsum8 = array();
      $vektorsum8[] = $eigenvector9*$data8[0];
      $vektorsum8[] = $eigenvector10*$data8[1];
      $vektorsum8[] = $eigenvector11*$data8[2];
      $vektorsum8[] = $eigenvector12*$data8[3];
      $vektorsum8[] = $eigenvector13*$data8[4];
      $vektorsum8[] = $eigenvector14*$data8[5];
      $vektorsum8[] = $eigenvector15*$data8[6];
      $vektorsum8[] = $eigenvector16*$data8[7];

      // Penjumlahan dari masing-masing hasil perkalian matrik dengan nilai eigen
      $jumlahvektorsum1 = $vektorsum1[0]+$vektorsum1[1]+$vektorsum1[2]+$vektorsum1[3]+$vektorsum1[4]+$vektorsum1[5]+$vektorsum1[6]+$vektorsum1[7];
      $jumlahvektorsum2 = $vektorsum2[0]+$vektorsum2[1]+$vektorsum2[2]+$vektorsum2[3]+$vektorsum2[4]+$vektorsum2[5]+$vektorsum2[6]+$vektorsum2[7];
      $jumlahvektorsum3 = $vektorsum3[0]+$vektorsum3[1]+$vektorsum3[2]+$vektorsum3[3]+$vektorsum3[4]+$vektorsum3[5]+$vektorsum3[6]+$vektorsum3[7];
      $jumlahvektorsum4 = $vektorsum4[0]+$vektorsum4[1]+$vektorsum4[2]+$vektorsum4[3]+$vektorsum4[4]+$vektorsum4[5]+$vektorsum4[6]+$vektorsum4[7];
      $jumlahvektorsum5 = $vektorsum5[0]+$vektorsum5[1]+$vektorsum5[2]+$vektorsum5[3]+$vektorsum5[4]+$vektorsum5[5]+$vektorsum5[6]+$vektorsum5[7];
      $jumlahvektorsum6 = $vektorsum6[0]+$vektorsum6[1]+$vektorsum6[2]+$vektorsum6[3]+$vektorsum6[4]+$vektorsum6[5]+$vektorsum6[6]+$vektorsum6[7];
      $jumlahvektorsum7 = $vektorsum7[0]+$vektorsum7[1]+$vektorsum7[2]+$vektorsum7[3]+$vektorsum7[4]+$vektorsum7[5]+$vektorsum7[6]+$vektorsum7[7];
      $jumlahvektorsum8 = $vektorsum8[0]+$vektorsum8[1]+$vektorsum8[2]+$vektorsum8[3]+$vektorsum8[4]+$vektorsum8[5]+$vektorsum8[6]+$vektorsum8[7];

      // penjumlahan ini kemudian dibagi dengan nilai prioritas menyeluruh,
      $vk1 = $jumlahvektorsum1/$eigenvector9;
      $vk2 = $jumlahvektorsum2/$eigenvector10;
      $vk3 = $jumlahvektorsum3/$eigenvector11;
      $vk4 = $jumlahvektorsum4/$eigenvector12;
      $vk5 = $jumlahvektorsum5/$eigenvector13;
      $vk6 = $jumlahvektorsum6/$eigenvector14;
      $vk7 = $jumlahvektorsum7/$eigenvector15;
      $vk8 = $jumlahvektorsum8/$eigenvector16;

      // nilai lamda maks
      $lamda = ($vk1+$vk2+$vk3+$vk4+$vk5+$vk6+$vk7+$vk8)/$n;

      // menghitung indeks Konsistensi
      $indekskonsistensi = ($lamda - $n)/($n-1);

      $ir = $this->ahp->indeksrandom($n);

      // menghitung konsistensi rasio
      $rasiokonsistensi = $indekskonsistensi/$ir;
      $persenrasiokonsistensi = $rasiokonsistensi*100;
    }
}

/* End of file ahp.php */
/* Location: ./application/models/ahp.php */
?>