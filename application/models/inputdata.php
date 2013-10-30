<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Inputdata extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
// delete
	public function inputbul($i,$j,$x,$z)
	{
		$object = array('id_data_keu' => $i.$j, 'tipe_prioritas' => $x, 'id_pengeluaran' => $z);
		$this->db->insert('ahp', $object);
	}
// _-------------------------------------------------
	public function insert($id)
	{
		$jumlah_BB  = 	$this->input->post('atk1')+
						$this->input->post('atk2')+
						$this->input->post('atk3')+
						$this->input->post('atk4')+
						$this->input->post('bhp1')+
						$this->input->post('bhp2')+
						$this->input->post('ldj1')+
						$this->input->post('ldj2')+
						$this->input->post('kbm1')+
						$this->input->post('kbm2')+
						$this->input->post('kbm3')+
						$this->input->post('kbm4')+
						$this->input->post('kbm5')+
						$this->input->post('kbm6')+
						$this->input->post('kbm7')+
						$this->input->post('kbm8')+
						$this->input->post('ks1')+
						$this->input->post('ks2')+
						$this->input->post('ks3')+
						$this->input->post('ks4')+
						$this->input->post('ks5')+
						$this->input->post('pp1')+
						$this->input->post('pp2')+
						$this->input->post('sbsd1');
		$jumlah_BP = $this->input->post('bp');
		$jumlah_BPR = $this->input->post('bpr1')+$this->input->post('bpr2');;
		$jumlah_BLL  = $this->input->post('bll1');
		$jumlah_total = $jumlah_BLL + $jumlah_BPR + $jumlah_BP + $jumlah_BB;
		$data = array(	'jml_bp'	=> $jumlah_BP,
						'jml_bb'	=> $jumlah_BB,
						'jml_bpr'	=> $jumlah_BPR,
						'jml_bll'	=> $jumlah_BLL,
						'jml_total'	=> $jumlah_total,
						'last_update_by' => $user,
						'last_update_at' => $human
			);
		$this->db->where('id',$id);
		$query = $this->db->update('data_keuangan', $data);
	}

	public function insertdetaildatakeuangan($id)
	{
		$this->inputdetaildatakeuangan($id,1,$this->input->post('bp'));
		$this->inputdetaildatakeuangan($id,2,$this->input->post('atk1'));
		$this->inputdetaildatakeuangan($id,3,$this->input->post('atk2'));
		$this->inputdetaildatakeuangan($id,4,$this->input->post('atk3'));
		$this->inputdetaildatakeuangan($id,5,$this->input->post('atk4'));
		$this->inputdetaildatakeuangan($id,6,$this->input->post('bhp1'));
		$this->inputdetaildatakeuangan($id,7,$this->input->post('bhp2'));
		$this->inputdetaildatakeuangan($id,8,$this->input->post('ldj1'));
		$this->inputdetaildatakeuangan($id,9,$this->input->post('ldj2'));
		$this->inputdetaildatakeuangan($id,10,$this->input->post('kbm1'));
		$this->inputdetaildatakeuangan($id,11,$this->input->post('kbm2'));
		$this->inputdetaildatakeuangan($id,12,$this->input->post('kbm3'));
		$this->inputdetaildatakeuangan($id,13,$this->input->post('kbm4'));
		$this->inputdetaildatakeuangan($id,14,$this->input->post('kbm5'));
		$this->inputdetaildatakeuangan($id,15,$this->input->post('kbm6'));
		$this->inputdetaildatakeuangan($id,16,$this->input->post('kbm7'));
		$this->inputdetaildatakeuangan($id,17,$this->input->post('kbm8'));
		$this->inputdetaildatakeuangan($id,18,$this->input->post('ks1'));
		$this->inputdetaildatakeuangan($id,19,$this->input->post('ks2'));
		$this->inputdetaildatakeuangan($id,20,$this->input->post('ks3'));
		$this->inputdetaildatakeuangan($id,21,$this->input->post('ks4'));
		$this->inputdetaildatakeuangan($id,22,$this->input->post('ks5'));
		$this->inputdetaildatakeuangan($id,23,$this->input->post('pp1'));
		$this->inputdetaildatakeuangan($id,24,$this->input->post('pp2'));
		$this->inputdetaildatakeuangan($id,25,$this->input->post('sbsd1'));
		$this->inputdetaildatakeuangan($id,26,$this->input->post('bpr1'));
		$this->inputdetaildatakeuangan($id,27,$this->input->post('bpr2'));
		$this->inputdetaildatakeuangan($id,28,$this->input->post('bll1'));
	}

	public function inputdetaildatakeuangan($id,$id_pengeluaran,$nominal)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('id_pengeluaran', $id_pengeluaran);
		$object = array('nominal' => $nominal);
		$query = $this->db->update('detail_data_keuangan', $object);
	}

	public function update($id)
	{
		$now = time();
            $timestamp = $now;
            $timezone = 'UTC';
            $daylight_saving = FALSE;
            $GMY = gmt_to_local($timestamp, $timezone, $daylight_saving);
            $human = unix_to_human($GMY);

        $session_data = $this->session->userdata('login');
        if( $session_data['username'] == "user" ){
        	$user = 1;
        } else {
        	$user = 2;
        }

        $jumlah_BB  = 	$this->input->post('atk1')+
						$this->input->post('atk2')+
						$this->input->post('atk3')+
						$this->input->post('atk4')+
						$this->input->post('bhp1')+
						$this->input->post('bhp2')+
						$this->input->post('ldj1')+
						$this->input->post('ldj2')+
						$this->input->post('kbm1')+
						$this->input->post('kbm2')+
						$this->input->post('kbm3')+
						$this->input->post('kbm4')+
						$this->input->post('kbm5')+
						$this->input->post('kbm6')+
						$this->input->post('kbm7')+
						$this->input->post('kbm8')+
						$this->input->post('ks1')+
						$this->input->post('ks2')+
						$this->input->post('ks3')+
						$this->input->post('ks4')+
						$this->input->post('ks5')+
						$this->input->post('pp1')+
						$this->input->post('pp2')+
						$this->input->post('sbsd1');
		$jumlah_BP = $this->input->post('bp');
		$jumlah_BPR = $this->input->post('bpr1')+$this->input->post('bpr2');;
		$jumlah_BLL  = $this->input->post('bll1');
		$jumlah_total = $jumlah_BLL + $jumlah_BPR + $jumlah_BP + $jumlah_BB;


		$data = array(	'jml_bp'	=> $jumlah_BP,
						'jml_bb'	=> $jumlah_BB,
						'jml_bpr'	=> $jumlah_BPR,
						'jml_bll'	=> $jumlah_BLL,
						'jml_total'	=> $jumlah_total,
						'status' => 1,
						'catatan' =>$this->input->post('catatan'),
					  	'last_update_at' => $human,
					  	'last_update_by' => $user

					  	);
		$this->db->where('id', $id);
		$this->db->update('data_keuangan', $data);
	}

	public function cleardatakeuangan($id)
	{
		$clear = "0";
		$data = array(	'catatan' 	=> "", 
						'status'	=> $clear,
						'last_update_by' => $clear,
						'last_update_at' => ""
			);
		$this->db->where('id', $id);
		$this->db->update('data_keuangan', $data);	
	}

	public function cleardetaildatakeuangan($id)
	{
		$clear = "0";
		$data = array(	'nominal' 	=> $clear);
		$this->db->where('id', $id);
		$this->db->update('detail_data_keuangan', $data);	
	}

	public function cleardatastatusrencana($id)
	{
		$id = $id+1;
		$clear = "0";
		$data = array( 'status_rencana' => $clear,'total_rencana_pengeluaran'=>$clear);
		$this->db->where('id', $id);
		$this->db->update('data_keuangan', $data);	
	}

	public function cleardatarencana($id)
	{
		$id = $id+1;
		$clear = "0";
		$data = array( 'prioritas' => $clear,
						'persentase'=>$clear,
						'pengeluaran'=>$clear,
						'persentase2'=>$clear,
						'pengeluaran2'=>$clear
			);
		$this->db->where('id_data_keu', $id);
		$this->db->update('ahp', $data);	
	}	

	public function resetuser($id)
	{
		$hash = $this->encrypt->sha1("12345");
		$this->db->where('id', $id);
		$object = array('password' => $hash);
		$this->db->update('user', $object);
	}

	public function gantipass()
	{
		$session_data = $this->session->userdata('login');
		$hash = $this->encrypt->sha1($this->input->post('password'));
		$object = array('password' => $hash);
        $username = $session_data['username'];
        $this->db->where('username', $username);
        $this->db->update('user', $object);
	}

	public function inputhasil($id,$prioritas,$persentase, $id_pengeluaran,$tipe_prioritas,$pengeluaran)
	{
		$object = array('prioritas' => $prioritas,'persentase'=> $persentase,'pengeluaran' => $pengeluaran);
		
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', $tipe_prioritas);
		$this->db->where('id_pengeluaran', $id_pengeluaran);
		$this->db->update('ahp', $object);
	}

	public function inputrencana1($id,$id_pengeluaran,$persentase2, $pengeluaran2)
	{
		$object = array('persentase2' => $persentase2,
						'pengeluaran2'=> $pengeluaran2
			);
		$this->db->where('id_data_keu', $id);
		$this->db->where('id_pengeluaran', $id_pengeluaran);
		$this->db->update('ahp', $object);
	}

	public function updatestatusrencana($id)
	{
		$this->db->where('id', $id);
		$object = array('status_rencana' => 1);
		$this->db->update('data_keuangan', $object);
	}

	public function updatestatustotal($id, $total)
	{
		$this->db->where('id', $id);
		$object = array('total_rencana_pengeluaran' => $total);
		$this->db->update('data_keuangan', $object);
	}

	public function updaterencanapengeluaran($id)
	{
		$this->inputdata->inputrencana1($id,29,$this->input->post('hitung1'),$this->input->post('hasil1'));
		$this->inputdata->inputrencana1($id,1,$this->input->post('hitung1'),$this->input->post('hasil1'));
		$this->inputdata->inputrencana1($id,30,$this->input->post('hitung2'),$this->input->post('hasil2'));
		$this->inputdata->inputrencana1($id,31,$this->input->post('hitung3'),$this->input->post('hasil3'));
		$this->inputdata->inputrencana1($id,32,$this->input->post('hitung4'),$this->input->post('hasil4'));
		$this->inputdata->inputrencana1($id,28,$this->input->post('hitung4'),$this->input->post('hasil4'));

		$this->inputdata->inputrencana1($id,33,$this->input->post('hitungtotalbb8'),$this->input->post('hasilhitungtotalbb8'));
		$this->inputdata->inputrencana1($id,34,$this->input->post('hitungtotalbb9'),$this->input->post('hasilhitungtotalbb9'));
		$this->inputdata->inputrencana1($id,35,$this->input->post('hitungtotalbb10'),$this->input->post('hasilhitungtotalbb10'));
		$this->inputdata->inputrencana1($id,36,$this->input->post('hitungtotalbb11'),$this->input->post('hasilhitungtotalbb11'));
		$this->inputdata->inputrencana1($id,37,$this->input->post('hitungtotalbb12'),$this->input->post('hasilhitungtotalbb12'));
		$this->inputdata->inputrencana1($id,38,$this->input->post('hitungtotalbb13'),$this->input->post('hasilhitungtotalbb13'));
		$this->inputdata->inputrencana1($id,39,$this->input->post('hitungtotalbb14'),$this->input->post('hasilhitungtotalbb14'));
		$this->inputdata->inputrencana1($id,25,$this->input->post('hitungtotalbb14'),$this->input->post('hasilhitungtotalbb14'));

		$this->inputdata->inputrencana1($id,2,$this->input->post('hitungtotalatk1'),$this->input->post('hasilhitungtotalatk1'));
		$this->inputdata->inputrencana1($id,3,$this->input->post('hitungtotalatk2'),$this->input->post('hasilhitungtotalatk2'));
		$this->inputdata->inputrencana1($id,4,$this->input->post('hitungtotalatk3'),$this->input->post('hasilhitungtotalatk3'));
		$this->inputdata->inputrencana1($id,5,$this->input->post('hitungtotalatk4'),$this->input->post('hasilhitungtotalatk4'));

		$this->inputdata->inputrencana1($id,6,$this->input->post('hitungtotalbhp1'),$this->input->post('hasilhitungtotalbhp1'));
		$this->inputdata->inputrencana1($id,7,$this->input->post('hitungtotalbhp2'),$this->input->post('hasilhitungtotalbhp2'));

		$this->inputdata->inputrencana1($id,8,$this->input->post('hitungtotalldj1'),$this->input->post('hasilhitungtotalldj1'));
		$this->inputdata->inputrencana1($id,9,$this->input->post('hitungtotalldj2'),$this->input->post('hasilhitungtotalldj2'));

		$this->inputdata->inputrencana1($id,10,$this->input->post('hitungtotalkbm1'),$this->input->post('hasilhitungtotalkbm1'));
		$this->inputdata->inputrencana1($id,11,$this->input->post('hitungtotalkbm2'),$this->input->post('hasilhitungtotalkbm2'));
		$this->inputdata->inputrencana1($id,12,$this->input->post('hitungtotalkbm3'),$this->input->post('hasilhitungtotalkbm3'));
		$this->inputdata->inputrencana1($id,13,$this->input->post('hitungtotalkbm4'),$this->input->post('hasilhitungtotalkbm4'));
		$this->inputdata->inputrencana1($id,14,$this->input->post('hitungtotalkbm5'),$this->input->post('hasilhitungtotalkbm5'));
		$this->inputdata->inputrencana1($id,15,$this->input->post('hitungtotalkbm6'),$this->input->post('hasilhitungtotalkbm6'));
		$this->inputdata->inputrencana1($id,16,$this->input->post('hitungtotalkbm7'),$this->input->post('hasilhitungtotalkbm7'));
		$this->inputdata->inputrencana1($id,17,$this->input->post('hitungtotalkbm8'),$this->input->post('hasilhitungtotalkbm8'));

		$this->inputdata->inputrencana1($id,18,$this->input->post('hitungtotalks1'),$this->input->post('hasilhitungtotalks1'));
		$this->inputdata->inputrencana1($id,19,$this->input->post('hitungtotalks2'),$this->input->post('hasilhitungtotalks2'));
		$this->inputdata->inputrencana1($id,20,$this->input->post('hitungtotalks3'),$this->input->post('hasilhitungtotalks3'));
		$this->inputdata->inputrencana1($id,21,$this->input->post('hitungtotalks4'),$this->input->post('hasilhitungtotalks4'));
		$this->inputdata->inputrencana1($id,22,$this->input->post('hitungtotalks5'),$this->input->post('hasilhitungtotalks5'));

		$this->inputdata->inputrencana1($id,23,$this->input->post('hitungtotalpp1'),$this->input->post('hasilhitungtotalpp1'));
		$this->inputdata->inputrencana1($id,24,$this->input->post('hitungtotalpp2'),$this->input->post('hasilhitungtotalpp2'));

		$this->inputdata->inputrencana1($id,26,$this->input->post('hitungtotalbpr6'),$this->input->post('hasilhitungtotalbpr6'));
		$this->inputdata->inputrencana1($id,27,$this->input->post('hitungtotalbpr7'),$this->input->post('hasilhitungtotalbpr7'));
	}

	public function rencana_last_update($id)
	{
			$now = time();
            $timestamp = $now;
            $timezone = 'UTC';
            $daylight_saving = FALSE;
            $GMY = gmt_to_local($timestamp, $timezone, $daylight_saving);
            $human = unix_to_human($GMY);

		$session_data = $this->session->userdata('login');
        $user = $session_data['nama'];
		$this->db->where('id', $id);
		$object = array('rencana_last_update_by' => $user,'rencana_last_update_at' => $human);
		$this->db->update('data_keuangan', $object);
	}

	public function updatestatussetuju($id,$value)
	{
		$this->db->where('id', $id);
		$object = array('status_setuju' => $value);
		$this->db->update('data_keuangan', $object);
	}

	public function inputdatakeu($id,$bulan,$tahun)
	{
		$object = array('id' => $id,'bulan'=>$bulan, 'tahun'=>$tahun );
		$this->db->insert('data_keuangan', $object);
	}
}
/* End of file inputdata.php */
/* Location: ./application/models/inputdata.php */
?>