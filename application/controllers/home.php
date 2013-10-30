<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('inputdata');
		$this->load->model('general');
		$this->load->model('ahp');
		$this->load->model('getdata');
		session_start();
	}
// input data ahp
	public function inputbul()
	{
		for ($x=1; $x < 6; $x++) {
			if ($x == 1) {
				for ($i=1; $i < 13; $i++) { 
					for ($j=2012; $j < 2018; $j++) {
					 	for ($z=29; $z < 33; $z++) { 
							$this->inputdata->inputbul($i,$j,1,$z);
							// echo "data ".$i.$j." was created";
						}
					}
				}
			} elseif ($x == 2) {
				for ($i=1; $i < 13; $i++) { 
					for ($j=2012; $j < 2018; $j++) {
					 	for ($z=33; $z < 40; $z++) { 
							$this->inputdata->inputbul($i,$j,2,$z);
							// echo "data ".$i.$j." was created";
						}
					}
				}
				for ($i=1; $i < 13; $i++) { 
					for ($j=2012; $j < 2018; $j++) {
					 	for ($z=2; $z < 26; $z++) { 
							$this->inputdata->inputbul($i,$j,2,$z);
							// echo "data ".$i.$j." was created";
						}
					}
				}
			} elseif ($x == 3) {
				for ($i=1; $i < 13; $i++) { 
					for ($j=2012; $j < 2018; $j++) {
					 	for ($z=26; $z < 28; $z++) { 
							$this->inputdata->inputbul($i,$j,3,$z);
							// echo "data ".$i.$j." was created";
						}
					}
				}
			} elseif ($x == 4) {
				for ($i=1; $i < 13; $i++) { 
					for ($j=2012; $j < 2018; $j++) {
						$z = 1;
							$this->inputdata->inputbul($i,$j,4,$z);
							// echo "data ".$i.$j." was created";
					}
				}
			} elseif ($x == 5) {
				for ($i=1; $i < 13; $i++) { 
					for ($j=2012; $j < 2018; $j++) {
						$z = 28;
							$this->inputdata->inputbul($i,$j,5,$z);
							// echo "data ".$i.$j." was created";
					}
				}
			}
		}
		echo "done";
	}

	public function inputdatakeuangan()
	{
		for ($i=1; $i < 13; $i++) { 
			for ($j=2012; $j < 2018; $j++) {
				if ($j == 2012) {
				 	$k = 1;
				 } elseif ($j == 2013) {
				 	$k = 2;
				 } elseif ($j == 2014) {
				 	$k = 3;
				 } elseif ($j == 2015) {
				 	$k = 4;
				 } elseif ($j == 2016) {
				 	$k = 5;
				 } elseif ($j == 2017) {
				 	$k = 6;
				 }
			$this->inputdata->inputdatakeu($i.$j,$i,$k);
				 // echo $i.$j."/".$i."/".$k."</br>";
			}
		}
		echo "done";
	}
	public function index()
	{
        $this->general->checksess();
		$data['content'] = "home/index";
		$this->load->view('template',$data);
	}

	public function bulan($bulan)
	{
		$this->general->checksess();
		if ($bulan < 13 && $bulan > 0) {
			$data['bulan'] = $bulan;
			$data['content'] = "home/bulan_index";
			$this->load->view('template',$data);		
		} else {
			 redirect('home/warning');
		}
	}

	public function entrydata()
	{
		$this->general->checksess();
		$data['content'] = "home/entrydata";
		$this->load->view('template', $data);
	}

	public function entry($bulan, $tahun)
	{
		$this->general->checksess();
		$this->general->checkbulantahun($bulan, $tahun);
		$id = $bulan.$tahun;		
		$this->inputdata->insertdetaildatakeuangan($id);
		$this->inputdata->update($id);
		$namabulan = $this->getdata->getnamabulan($bulan);
		$info = "Data Bulan ".$namabulan->nama_bulan." tahun ".$tahun." berhasil di tambah";
        $this->general->informationSuccess($info);
		redirect('home/bulan/'.$bulan);		
	}

	public function viewdetail()
	{
		$this->general->checksess();
		$data['content'] = "home/viewdetail";
		$this->load->view('template', $data);	
	}

	public function updatedata()
	{
		$this->general->checksess();
		$data['content'] = "home/updatedata";
		$this->load->view('template', $data);
	}

	public function cleardata($bulan, $tahun)
	{
		$id = $bulan.$tahun;
		$this->general->checksess();
		$this->general->checkbulantahun($bulan, $tahun);
		$this->inputdata->cleardatakeuangan($id);
		$this->inputdata->cleardetaildatakeuangan($id);
		$this->inputdata->cleardatastatusrencana($id);
		$this->inputdata->cleardatarencana($id);
		$namabulan = $this->getdata->getnamabulan($bulan);
		$info = "Data bulan ".$namabulan->nama_bulan." tahun ".$tahun." berhasil di hapus";
        $this->general->informationSuccess($info);
		redirect('home/bulan/'.$bulan);
	}

	public function update($bulan, $tahun)
	{
		$this->general->checksess();
		$this->general->checkbulantahun($bulan, $tahun);
		$id = $bulan.$tahun;		
		$this->inputdata->insertdetaildatakeuangan($id);
		$this->inputdata->update($id);
		$namabulan = $this->getdata->getnamabulan($bulan);
		$info = "Data Bulan ".$namabulan->nama_bulan." tahun ".$tahun." berhasil di tambah";
        $this->general->informationSuccess($info);
		redirect('home/bulan/'.$bulan);		
	}

	public function sistem($bulan,$tahun)
	{
		$id = $bulan.$tahun;
		$this->general->checksess();
		$this->general->checkbulantahun($bulan, $tahun);
		$data['content'] = "home/sistem";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('siswa', 'Jumlah Siswa', 'required|numeric');
        $this->form_validation->set_rules('biaya', 'besar biaya satuan BOS', 'required|numeric');
        $this->form_validation->set_message('required', '%s Harap diisi');
        $this->form_validation->set_message('numeric', '%s Harus angka');

        if ($this->form_validation->run() == FALSE) {
        	$data['hasil'] = null;
            $this->load->view('template',$data);
        } else {
        	$jumlah_siswa = $this->input->post('siswa');
            $satuan = $this->input->post('biaya');
            $total  = $jumlah_siswa*$satuan;
        	$data['hasil'] = array('jumlah' => $total, 'data' => array('pertama' => 'pertama','kedua' => 'kedua'));
        	$this->ahp->kriteriautama($id,$total);
            $dataahp2 = $this->getdata->getahp2($id);
            $datakriteria = array();
            foreach ($dataahp2 as $key) {
            	$datakriteria[$key['id_pengeluaran']] = $key['pengeluaran'];
            }
            $this->ahp->kriteriaatk($id,$datakriteria[33]);
            $this->ahp->kriteriabhp($id,$datakriteria[34]);
            $this->ahp->kriterialdj($id,$datakriteria[35]);
			$this->ahp->kriteriakbm($id,$datakriteria[36]);
            $this->ahp->kriteriaks($id,$datakriteria[37]);
            $this->ahp->kriteriapp($id,$datakriteria[38]);
            $this->load->view('template',$data);
		}
	}

	public function help()
	{
		$this->general->checksess();
		$data['content'] = "home/help";
		$this->load->view('template', $data);
	}

	public function printdetail($bulan, $tahun)
	{
		$id = $bulan.$tahun;
		$this->general->checksess(); 
		$this->general->checkbulantahun($bulan, $tahun);
		$print = $this->getdata->getnamabulan($bulan);
		$data_detail = $this->getdata->getDataBy($id);
          $value = array();
          foreach ($data_detail as $key) {
             $value[] = $key['nominal'];
          }
        $data_keuangan = $this->getdata->getdatakeuangan($id);
        $data5 = $data_keuangan->jml_bp;
        $data6 = $data_keuangan->jml_bb;
        $data7 = $data_keuangan->jml_bpr;
        $data8 = $data_keuangan->jml_bll;
        $data9 = $data_keuangan->jml_total;
		$this->load->helper('pdf');
        $this->load->library('cezpdf');
        prep_pdf();

        $db_data[] = array('no' => '1.1', 'category' => 'Honorarium Guru dan Tenaga Kependidikan Honorer', 'output' => 'Rp. '.$value[0] = number_format($value[0],2,",","."));
        $db_data[] = array('no' => '2.1', 'category' => 'Alat Tulis Kantor', 'output' => 'Rp. '.$value[1] = number_format($value[1],2,",","."));
        $db_data[] = array('no' => '2.1.1', 'category' => 'Papan Data', 'output' => 'Rp. '.$value[2] = number_format($value[2],2,",","."));
        $db_data[] = array('no' => '2.1.2', 'category' => 'Printer', 'output' => 'Rp. '.$value[3] = number_format($value[3],2,",","."));
        $db_data[] = array('no' => '2.1.3', 'category' => 'Perangkat komputer', 'output' => 'Rp. '.$value[4] = number_format($value[4],2,",","."));
        $db_data[] = array('no' => '2.2.1', 'category' => 'Buku Tulis, pensil, bahan praktikum', 'output' => 'Rp. '.$value[5] = number_format($value[5],2,",","."));
        $db_data[] = array('no' => '2.2.2', 'category' => 'Foto Kopi', 'output' => 'Rp. '.$value[6] = number_format($value[6],2,",","."));
        $db_data[] = array('no' => '2.3.1', 'category' => 'Langganan Listrik', 'output' => 'Rp. '.$value[7] = number_format($value[7],2,",","."));
        $db_data[] = array('no' => '2.3.2', 'category' => 'Langganan Telepon', 'output' => 'Rp. '.$value[8] = number_format($value[8],2,",","."));
        $db_data[] = array('no' => '2.4.1', 'category' => 'Tes Semester', 'output' => 'Rp. '.$value[9] = number_format($value[9],2,",","."));
        $db_data[] = array('no' => '2.4.1.1', 'category' => 'Pengawas', 'output' => 'Rp. '.$value[10] = number_format($value[10],2,",","."));
        $db_data[] = array('no' => '2.4.1.2', 'category' => 'Pembuat Soal', 'output' => 'Rp. '.$value[11] = number_format($value[11],2,",","."));
        $db_data[] = array('no' => '2.4.1.3', 'category' => 'Percetakan Dokumen', 'output' => 'Rp. '.$value[12] = number_format($value[12],2,",","."));
        $db_data[] = array('no' => '2.4.1.4', 'category' => 'Cetak brosur dan spanduk', 'output' => 'Rp. '.$value[13] = number_format($value[13],2,",","."));
        $db_data[] = array('no' => '2.4.2', 'category' => 'Ujian AKhir Sekolah', 'output' => 'Rp. '.$value[14] = number_format($value[14],2,",","."));
        $db_data[] = array('no' => '2.4.3', 'category' => 'Ulangan Umum Harian', 'output' => 'Rp. '.$value[15] = number_format($value[15],2,",","."));
        $db_data[] = array('no' => '2.4.4', 'category' => 'Pengadaan Bahan teori /praktek', 'output' => 'Rp. '.$value[16] = number_format($value[16],2,",","."));
        $db_data[] = array('no' => '2.5.1', 'category' => 'Kegiatan Osis', 'output' => 'Rp. '.$value[17] = number_format($value[17],2,",","."));
        $db_data[] = array('no' => '2.5.2', 'category' => 'Penyelenggaraan Lomba', 'output' => 'Rp. '.$value[18] = number_format($value[18],2,",","."));
        $db_data[] = array('no' => '2.5.3', 'category' => 'Kegiatan Pramuka', 'output' => 'Rp. '.$value[19] = number_format($value[19],2,",","."));
        $db_data[] = array('no' => '2.5.4', 'category' => 'Pembinaan Keagamaan', 'output' => 'Rp. '.$value[20] = number_format($value[20],2,",","."));
        $db_data[] = array('no' => '2.5.5', 'category' => 'Kegiatan Sanggar Belajar', 'output' => 'Rp. '.$value[21] = number_format($value[21],2,",","."));
        $db_data[] = array('no' => '2.6.1', 'category' => 'Buku Pelajaran Pokok', 'output' => 'Rp. '.$value[22] = number_format($value[22],2,",","."));
        $db_data[] = array('no' => '2.6.2', 'category' => 'Buku Penunjang', 'output' => 'Rp. '.$value[23] = number_format($value[23],2,",","."));
        $db_data[] = array('no' => '2.7.1', 'category' => 'Bantuan Untuk Siswa', 'output' => 'Rp. '.$value[24] = number_format($value[24],2,",","."));
        $db_data[] = array('no' => '3.1', 'category' => 'Biaya Perawatan ringan', 'output' => 'Rp. '.$value[25] = number_format($value[25],2,",","."));
        $db_data[] = array('no' => '3.1.1', 'category' => 'Biaya Pembuatan Taman', 'output' => 'Rp. '.$value[26] = number_format($value[26],2,",","."));
        $db_data[] = array('no' => '4.1', 'category' => 'Upah Tukang', 'output' => 'Rp. '.$value[27] = number_format($value[27],2,",","."));
        $db_data[] = array('no' => '*', 'category' => 'Jumlah Belanja Pegawai', 'output' => 'Rp. '.$data5 = number_format($data5,2,",","."));
        $db_data[] = array('no' => '*', 'category' => 'Jumlah Belanja Barang', 'output' => 'Rp. '.$data6 = number_format($data6,2,",","."));
        $db_data[] = array('no' => '*', 'category' => 'Jumlah Belanja Pemeliharaan', 'output' => 'Rp. '.$data7 = number_format($data7,2,",","."));
        $db_data[] = array('no' => '*', 'category' => 'Jumlah Belanja Lain-lain', 'output' => 'Rp. '.$data8 = number_format($data8,2,",","."));
        $db_data[] = array('no' => '**', 'category' => 'Jumlah Total Pengeluaran', 'output' => 'Rp. '.$data9 = number_format($data9,2,",","."));
       
        $col_names = array(
            'no' => '#',
            'category' => 'Category',
            'output' => 'Pengeluaran',
        );
        $this->cezpdf->ezTable($db_data,$col_names,'Data Pengeluaran bulan '.$print->nama_bulan.' tahun '.$tahun,array('width'=>550,'showHeading'=> 0));
        $this->cezpdf->ezStream();
	}

	public function printoutput($bulan, $tahun)
	{
		$this->general->checksess(); 
		$this->general->checkbulantahun($bulan, $tahun);
		$print = $this->getdata->getnamabulan($bulan);
		$data1 = $this->getdata->getprint($bulan.$tahun);
		$data= $this->getdata->getprintkriteria($bulan.$tahun);
		
		$this->load->helper('pdf');
        $this->load->library('cezpdf');
        prep_pdf();
        $a = 0;
        foreach ($data as $key) {
        	$namapengeluaran = $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
        	$db_data[] = array('Nomor' => $a= $a+1, 'category' =>  $namapengeluaran->nama, 'output' => 'Rp. '.$key['pengeluaran']);	
        }        
       
        $col_names = array(
            'Nomor' => 'Nomor',
            'category' => 'Uraian',
            'output' => 'Jumlah',
        );
        $a = 0;
        foreach ($data1 as $key) {
        	$namapengeluaran = $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
        	$db_data1[] = array('Nomor' => $a= $a+1, 'category' =>  $namapengeluaran->nama, 'output' => 'Rp. '.$key['pengeluaran']);	
        }        
       
        $col_names1 = array(
            'Nomor' => 'Nomor',
            'category' => 'Uraian',
            'output' => 'Jumlah',
        );
        $this->cezpdf->ezTable($db_data,$col_names,'Kriteria Utama '.$print->nama_bulan.' '.$tahun,array('width'=>10,'showHeading'=> 0));
        $this->cezpdf->addText(150,800,15,"Rencana Anggaran Pendapatan dan Belanja Sekolah");
        $this->cezpdf->ezTable($db_data1,$col_names1,'Subkriteria '.$print->nama_bulan.' '.$tahun,array('width'=>550,'showHeading'=> 0));
        $this->cezpdf->ezStream();
	}

	public function printoutput2($bulan, $tahun)
	{
		$this->general->checksess(); 
		$this->general->checkbulantahun($bulan, $tahun);
		$print = $this->getdata->getnamabulan($bulan);
		$data = $this->getdata->getprintkriteriarencana($bulan.$tahun);
		$data1 = $this->getdata->getprintrencana($bulan.$tahun);
		
		
		$this->load->helper('pdf');
        $this->load->library('cezpdf');
        prep_pdf();
        $a = 0;
        foreach ($data as $key) {
        	$namapengeluaran = $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
        	$db_data[] = array('Nomor' => $a= $a+1, 'category' =>  $namapengeluaran->nama, 'output' => 'Rp. '.$key['pengeluaran2']);	
        }        
       
        $col_names = array(
            'Nomor' => 'Nomor',
            'category' => 'Uraian',
            'output' => 'Jumlah',
        );
        $a = 0;
        foreach ($data1 as $key) {
        	$namapengeluaran = $this->getdata->getnamapengeluaran($key['id_pengeluaran']);
        	$db_data1[] = array('Nomor' => $a= $a+1, 'category' =>  $namapengeluaran->nama, 'output' => 'Rp. '.$key['pengeluaran2']);	
        }        
       
        $col_names1 = array(
            'Nomor' => 'Nomor',
            'category' => 'Uraian',
            'output' => 'Jumlah',
        );
        $this->cezpdf->ezTable($db_data,$col_names,'Kriteria Utama '.$print->nama_bulan.' '.$tahun,array('width'=>10,'showHeading'=> 0));
        $this->cezpdf->addText(150,800,15,"Rencana Anggaran Pendapatan dan Belanja Sekolah");
        $this->cezpdf->ezTable($db_data1,$col_names1,'Subkriteria '.$print->nama_bulan.' '.$tahun,array('width'=>550,'showHeading'=> 0));
        $this->cezpdf->ezStream();
	}

	public function gantipass()
	{
		$this->general->checksess();
		$data['content'] = "home/gantipass";
		$this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password Baru', 'required|matches[confpassword]');
        $this->form_validation->set_rules('confpassword', 'Confirm Password Baru', 'required');
        $this->form_validation->set_rules('oldpassword', 'Password Lama', 'required');
        $this->form_validation->set_message('required', '%s Harap Diisi');
        $this->form_validation->set_message('matches', 'Password baru dan confirm password baru tidak sama');

        if ($this->form_validation->run() == FALSE) {
			$this->load->view('template', $data);
        } else { 
        	if ($this->general->checkpass() == TRUE) {
        		$this->inputdata->gantipass();
	     		$info = "Password berhasil di ganti";
		        $this->general->informationSuccess($info);
				redirect('home/gantipass');   	
        	} else {
        		$info = "Password Lama Anda Salah";
		        $this->general->information($info);
				redirect('home/gantipass');   	
        	}
        	
		}
	}

	public function warning()
	{
		$this->load->view('administrator/warning');
	}

	function logout() {
        	$this->general->checksess();
            $this->session->unset_userdata('login');
            $this->session->sess_destroy();
            session_destroy();
            redirect('login', 'refresh');
    }

    public function admin()
    {
    	$this->general->authadmin();
		$data['content'] = "home/index";
		$this->load->view('template',$data);
    }

    public function user2()
    {
    	$this->general->authuser2();
		$data['content'] = "home/index";
		$this->load->view('template',$data);
    }

    public function resetpass()
	{
		$this->general->authuser2();
		$data['content'] = "administrator/resetpass";
		$this->load->view('template',$data);	
	}

	public function reset($id)
	{
		$this->general->authuser2();
		$this->inputdata->resetuser($id);
		$info = "Password berhasil di reset";
        $this->general->informationSuccess($info);
		redirect('home/resetpass');
	}

	public function peringatan()
	{
		$this->load->view('administrator/warning');
	}

	public function updaterencana($bulan, $tahun, $jumlah)
	{
		$data['total'] = $jumlah;
		$data['id'] = $bulan.$tahun;
		$data['content'] = "home/updaterencana";
		$this->load->view('template', $data);
	}
	public function entryupdate1($id, $total)
	{
		$this->inputdata->updaterencanapengeluaran($id);
		$this->inputdata->rencana_last_update($id);
		$this->inputdata->updatestatusrencana($id);
		$this->inputdata->updatestatustotal($id,$total);
		$session_data = $this->session->userdata('login');
		if ($session_data['username'] == "user") {
			$this->inputdata->updatestatussetuju($id,0);
		}
		$bulan = substr($id,0,1);
		$info = "Rencana Anggaran Baru Berhasil Dibuat";
        $this->general->informationSuccess($info);
		redirect('home/bulan/'.$bulan);
	}

	public function updaterencana2($bulan, $tahun)
	{
		$data['id'] = $bulan.$tahun;
		$total = $this->getdata->gettotalpengeluaran($data['id']);
		$data['total'] = $total->total_rencana_pengeluaran;
		$data['content'] = "home/updaterencana2";
		$this->load->view('template', $data);	
	}

	public function buatrencana($bulan, $tahun)
	{
		$data['id'] = $bulan.$tahun;
		$total = $this->getdata->gettotalpengeluaran($data['id']);
		$data['total'] = $total->total_rencana_pengeluaran;
		$data['content'] = "home/buatrencana";
		$this->load->view('template', $data);	
	}

	public function lihatrencana($bulan, $tahun)
	{
		$data['id'] = $bulan.$tahun;
		$total = $this->getdata->gettotalpengeluaran($data['id']);
		$data['total'] = $total->total_rencana_pengeluaran;
		$data['content'] = "home/lihatrencana";
		$this->load->view('template', $data);	
	}
	public function persetujuan($bulan, $tahun, $value)
	{
		$id = $bulan.$tahun;
		$this->inputdata->updatestatussetuju($id, $value);
		if ($value == 1) {
			$info = "Rencana Anggaran Disetujui";
			$this->general->informationSuccess($info);
		} else {
			$info = "Rencana Anggaran Batal Disetujui";
			$this->general->information($info);
		}
		redirect('home/lihatrencana/'.$bulan.'/'.$tahun);
	}

	public function jikaterjadilupapasswordpadaadminmakainiharusdilakukan()
	{
		$this->inputdata->resetuser(1);
		$this->inputdata->resetuser(2);
		$this->inputdata->resetuser(3);
		$info = "Password berhasil di reset";
        $this->general->informationSuccess($info);
		redirect('login');
	}
}


/* End of file home.php */
/* Location: ./application/controllers/home.php */
?>