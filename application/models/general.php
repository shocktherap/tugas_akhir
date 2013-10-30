<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class General extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('encrypt');
	}

	function information($info) {
        $this->session->set_flashdata('message', "<div class='alert alert-block alert-error fade in'>"."<button type='button' class='close' data-dismiss='alert'>×</button>".$info."</div>");
    }

    function informationSuccess($info) {
        $this->session->set_flashdata('message', "<div class='alert alert-block alert-success fade in'>"."<button type='button' class='close' data-dismiss='alert'>×</button>".$info."</div>");
    }

    public function bulan($id)
    {
    	$bulan = $id;
    	if ($bulan == 1) {
    		echo "Januari";
    	} elseif ($bulan == 2) {
    		echo "Februari";
    	} elseif ($bulan == 3) {
    		echo "Maret";
    	} elseif ($bulan == 4) {
    		echo "April";
    	} elseif ($bulan == 5) {
    		echo "Mei";
    	} elseif ($bulan == 6) {
    		echo "Juni";
    	} elseif ($bulan == 7) {
    		echo "Juli";
    	} elseif ($bulan == 8) {
    		echo "Agustus";
    	} elseif ($bulan == 9) {
    		echo "September";
    	} elseif ($bulan == 10) {
    		echo "Oktober";
    	} elseif ($bulan == 11) {
    		echo "November";
    	} elseif ($bulan == 12) {
    		echo "Desember";
    	} 
    }

    public function verify($username, $password)
    {
        $hash = $this->encrypt->sha1($password);

        $this->db->where('username', $username);
        $this->db->where('password', $hash);
        $query = $this->db->get('user');
            if ($query->num_rows() == 1)
                {
                    return TRUE;
                } elseif ($query->num_rows() > 1) {
                    return FALSE;
                }

    }

    public function user_data($username)
    {
        $username = $this->input->post('username');
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->rows();
    }

    function notAuthor() {
        $info = "Your Not Authorized and please to login first";
        $this->general->information($info);
        redirect('login');
    }

    public function checksess()
    {
        if (!$this->session->userdata('login')) {
            $this->notAuthor();
        }
    }

    public function validateadmin()
    {
        $session_data = $this->session->userdata('login');
        if ($session_data['level'] != "administrator") {
            $this->notAuthor();
        }
    }

    public function validateuser()
    {
        $session_data = $this->session->userdata('login');
        if ($session_data['level'] != "user") {
            $this->notAuthor();
        }
    }

    public function validateuser2()
    {
        $session_data = $this->session->userdata('login');
        if ($session_data['level'] != "user2") {
            $this->notAuthor();
        }
    }

    public function authadmin()
    {
        $this->checksess();
        $this->validateadmin();
    }

    public function authuser()
    {
        $this->checksess();
        $this->validateuser();
    }

    public function authuser2()
    {
        $this->checksess();
        $this->validateuser2();
    }

    public function checkpass()
    {
        $session_data = $this->session->userdata('login');
        $username = $session_data['username'];
        $hash = $this->encrypt->sha1($this->input->post('oldpassword'));
        $this->db->where('username', $username);
        $this->db->where('password', $hash);
        $query = $this->db->get('user');
            if ($query->num_rows() == 1)
                {
                    return TRUE;
                } elseif ($query->num_rows() > 1) {
                    return FALSE;
                }

    }

    public function checkbulantahun($bulan, $tahun)
    {
        if ($bulan > 2013 && $bulan < 0) {
            redirect('home/warning');
        }
        if ($tahun < 2012 && $tahun > 2017) {
            redirect('home/warning');
        }
    }
}

/* End of file general.php */
/* Location: ./application/models/general.php */
?>