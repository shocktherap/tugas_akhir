<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Getdata extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getBulan()
	{
		$query = $this->db->get('bulan');
		return $query->result();
	}

	public function getCatatan($id)
	{
		$this->db->select('catatan');
		$this->db->where('id', $id);
		$query = $this->db->get('data_keuangan');
		return $query->row();
	}

	public function getStatus($id)
	{
		$this->db->select('status');
		$this->db->where('id', $id);
		$query = $this->db->get('data_keuangan');
		return $query->row();
	}

	public function insert($data)
	{
		$data = array('id' => $data);
		$query = $this->db->insert('data_keuangan', $data);
	}

	public function getDataBy($id)
	{

		$this->db->order_by('id_pengeluaran', 'asc');
		$this->db->select('nominal');
		$this->db->where('id_data_keu', $id);
		$this->db->where('id_pengeluaran <', 29);
		$query = $this->db->get('detail_data_keuangan');
		return $query->result_array();
	}

	public function getdatakeuangan($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('data_keuangan');
		return $query->row();
	}

    public function getJml($bulan)
    {
    	// $this->db->select('jml_bp');
    	$this->db->where('bulan', $bulan);
    	$query = $this->db->get('data_keuangan');
    	return $query->result_array();
    }

    public function getDataByBln($bln)
	{
		$this->db->select('jml_bp, jml_bb, jml_bpr, jml_bll');
		$this->db->where('bulan', $bln);
		$query = $this->db->get('data_keuangan');
		return $query->result_array();
	}

	public function getLevel($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('user', 1);
		return $query->row();
	}

	public function getuser()
	{
		$query = $this->db->get('user');
		return $query->result_array();
	}

	public function getadmindata($username)
	{
		$query = $this->db->get_where('user', array('username' => $username));
		return $query->row();
	}

	public function getnamauser($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('user');
		return $query->row();
	}

	public function getnamapengeluaran($id)
	{
		$this->db->select('nama');
		$this->db->where('id', $id);
		$query =$this->db->get('pengeluaran');
		return $query->row();
	}

	public function getnamabulan($id)
	{
		$this->db->select('nama_bulan');
		$this->db->where('id', $id);
		$query =$this->db->get('bulan');
		return $query->row();
	}

	public function getrowpengeluaran($id)
	{
		$this->db->select('nama');
		$this->db->where('id', $id);
		$query =$this->db->get('pengeluaran');
		return $query->num_rows();
	}

	public function gettotalpengeluaran($id)
	{
		$this->db->select('total_rencana_pengeluaran');
		$this->db->where('id', $id);
		$query = $this->db->get('data_keuangan');
		return $query->row();
	}

	public function getahp3($id)
	{
		$this->db->order_by('prioritas','desc');
		$query = $this->db->get_where('ahp', array('id_data_keu' => $id, 'tipe_prioritas' => 3));
		return $query->result_array();
	}

	public function getahp1($id)
	{
		$this->db->order_by('prioritas','desc');
		$query = $this->db->get_where('ahp', array('id_data_keu' => $id, 'tipe_prioritas' => 1));
		return $query->result_array();
	}

	public function getahpupdate1($id)
	{
		$query = $this->db->get_where('ahp', array('id_data_keu' => $id, 'tipe_prioritas' => 1));
		return $query->result_array();
	}

	public function getahpupdate3($id)
	{
		$query = $this->db->get_where('ahp', array('id_data_keu' => $id, 'tipe_prioritas' => 3));
		return $query->result_array();
	}

	public function getahpupdateatk($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 1);
		$this->db->where('id_pengeluaran <', 6);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahpupdateldj($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 7);
		$this->db->where('id_pengeluaran <', 10);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahpupdateks($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 17);
		$this->db->where('id_pengeluaran <', 23);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahpupdatepp($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 22);
		$this->db->where('id_pengeluaran <', 25);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahpupdatekbm($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 9);
		$this->db->where('id_pengeluaran <', 18);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahpupdatebhp($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 5);
		$this->db->where('id_pengeluaran <', 8);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahpupdate2($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 32);
		$this->db->where('id_pengeluaran <', 40);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahp2($id)
	{
		$this->db->order_by('prioritas','desc');
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 32);
		$this->db->where('id_pengeluaran <', 40);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getahp4($id)
	{
		$query = $this->db->get_where('ahp', array('id_data_keu' => $id, 'tipe_prioritas' => 4));
		return $query->row();
	}

	public function getahp5($id)
	{
		$query = $this->db->get_where('ahp', array('id_data_keu' => $id, 'tipe_prioritas' => 5));
		return $query->row();
	}

	public function getahp6($id)
	{
		$this->db->order_by('pengeluaran','desc');
		$this->db->where('id_data_keu', $id);
		$this->db->where('tipe_prioritas', 2);
		$this->db->where('id_pengeluaran >', 1);
		$this->db->where('id_pengeluaran <', 27);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getprint($id)
	{
		$this->db->order_by('pengeluaran', 'desc');
		$this->db->where('id_data_keu', $id);
		$this->db->where('id_pengeluaran <', 29);
		$this->db->where('id_pengeluaran >', 0);
		$this->db->where('pengeluaran !=', 0);
		$query = $this->db->get('ahp');
		return $query->result_array();;
	}

	public function getprintrencana($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('id_pengeluaran <', 29);
		$this->db->where('id_pengeluaran >', 0);
		$this->db->order_by('pengeluaran2', 'desc');
		$query = $this->db->get('ahp');
		return $query->result_array();;
	}

	public function getprintkriteria($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('id_pengeluaran <', 33);
		$this->db->where('id_pengeluaran >', 28);
		$this->db->where('pengeluaran !=', 0);
		$query = $this->db->get('ahp');
		return $query->result_array();;
	}

	public function getprintkriteriarencana($id)
	{
		$this->db->where('id_data_keu', $id);
		$this->db->where('id_pengeluaran <', 33);
		$this->db->where('id_pengeluaran >', 28);
		$query = $this->db->get('ahp');
		return $query->result_array();;
	}


	public function getstatusrencana($id)
	{
		$this->db->select('status_rencana');
		$this->db->where('id', $id);
		$query = $this->db->get('data_keuangan');
		return $query->row();
	}

	public function getrencanapengeluaran($id)
	{
		$this->db->where('id_data_keu', $id);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getnamaprioritas($id)
	{
		$this->db->select('nama_prioritas');
		$this->db->where('id', $id);
		$query = $this->db->get('prioritas');
		return $query->row();
	}

	public function getpersentasekriteriautama($id)
	{
		$this->db->select('persentase2');
		$this->db->where('id_pengeluaran > ', 28);
		$this->db->where('id_pengeluaran < ', 33);
		$this->db->where('id_data_keu', $id);
		$query = $this->db->get('ahp');
		return $query->result_array();
	}

	public function getpersetujuan($id)
	{
		$this->db->select('status_setuju,rencana_last_update_by, rencana_last_update_at');
		$this->db->where('id', $id);
		$query = $this->db->get('data_keuangan');
		return $query->row();
	}

	public function getpersetujuan2($id)
	{
		$this->db->select('status_setuju');
		$this->db->where('id', $id);
		$query = $this->db->get('data_keuangan');
		return $query->row();
	}

}

/* End of file getData_model.php */
/* Location: ./application/models/getData_model.php */
?>