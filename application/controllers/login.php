<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('general');
        $this->load->model('getdata');
	}

	public function index()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', '%s Harap Diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_index');
        } else { 
            $username = $this->input->post('username');
            $password = $this->input->post('password');        
            $datalevel = $this->getdata->getLevel($username);
                if ($this->general->verify($username, $password) == TRUE) {
                    $newdata = array(
                       'username'   => $username,
                       'nama'       => $datalevel->nama,
                       'level'      => $datalevel->level,
                       'logged_in'  => TRUE
                    );   
                    $this->session->set_userdata('login',$newdata);
                    if ($datalevel->level == 'user') {
                        redirect('home');
                    } elseif ($datalevel->level == 'administrator') {
                        redirect('home/admin');
                    } elseif ($datalevel->level == 'user2') {
                        redirect('home/user2');
                    }
                } else {
                    $this->general->information("Username atau Password Salah");
                    redirect('login');
                }
		}
	}

	public function verify()
	{
		$this->load->view('tampil');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
?>