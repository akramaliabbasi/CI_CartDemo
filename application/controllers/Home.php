<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function __construct()
    {
		parent::__construct();
		//$this->load->database(); auto loaded 
        $this->load->model('basic');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('form');
	
			
	}
	 
	 /**
    * method to load  default login page
    * @access public
    * @return void
    */
	public function index()
	{
		
		 $this->login();
		
	}
	
	
	/**
    * method to load login page
    * @access public
    * @return void
    */
	public function login()
    {
        $data['page_title'] = "Sign in";
		$this->load->view('page/login',$data);
    }
	
	public function sign_in_action()
	{
		
		    $username = $this->input->post('username', true);
            $password = md5($this->input->post('password', true));

            $table = 'users';

            if($this->config->item('master_password') != '')
            {  

			
                if(md5($_POST['password']) == $this->config->item('master_password'))
				{
                $where['where'] = array('email' => $username, "deleted" => "0","status"=>"1","user_type !="=>'Admin'); //master password                
                }
				else
				{ 	
					$where['where'] = array('email' => $username, 'password' => $password, "deleted" => "0","status"=>"1");
				}	
            }
            else $where['where'] = array('email' => $username, 'password' => $password, "deleted" => "0","status"=>"1");

            $info = $this->basic->get_data($table, $where, $select = '', $join = '', $limit = '', $start = '', $order_by = '', $group_by = '', $num_rows = 1);

            $count = $info['extra_index']['num_rows'];
            
            if ($count == 0) {
                $this->session->set_flashdata('login_msg', $this->lang->line("invalid email or password"));
			    redirect("home/login");
            } else {
                $username = $info[0]['name'];
                $user_type = $info[0]['user_type'];
                $user_id = $info[0]['id'];

                $this->session->set_userdata('logged_in', 1);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('user_type', $user_type);
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('download_id', time());
                $this->session->set_userdata('expiry_date',$info[0]['expired_date']);

                
                if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Admin') {
                    redirect('shopping/index', 'location'); // this type of account will be for Administrator 
                }
				
				 if ($this->session->userdata('logged_in') == 1 && $this->session->userdata('user_type') == 'Member') {
                    redirect('shopping/index', 'location');
                }
				
                
            }
		
	}
	
	
	
	/**
    * method to load sign_up page
    * @access public
    * @return void
    */
    public function sign_up()
    { 
        
        //$data['page_title']=$this->lang->line("sign up");
        $data['page_title'] = "Sign up";
        $this->load->view('page/sign_up',$data);
    }
	
	
	 public function sign_up_action()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            redirect('home/access_forbidden', 'location');
        }
        if($_POST) {
            $this->form_validation->set_rules('name', '<b>'.$this->lang->line("name").'</b>', 'trim|required');
            $this->form_validation->set_rules('email', '<b>'.$this->lang->line("email").'</b>', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('mobile', '<b>'.$this->lang->line("mobile").'</b>', 'trim');
            $this->form_validation->set_rules('password', '<b>'.$this->lang->line("password").'</b>', 'trim|required');
            $this->form_validation->set_rules('confirm_password', '<b>'.$this->lang->line("confirm password").'</b>', 'trim|required|matches[password]');
           
		  

            if($this->form_validation->run() == FALSE) 
            { 	
                $this->sign_up();
            }
            else 
            {
               
				$validity = "14"; // asume validate user for 14 days...
                $name = $this->input->post('name', TRUE);
                $email = $this->input->post('email', TRUE);
                $mobile = $this->input->post('mobile', TRUE);
                $password = $this->input->post('password', TRUE);

                // $this->db->trans_start();
				$to_date=date('Y-m-d');
                $expiry_date=date("Y-m-d",strtotime('+'.$validity.' day',strtotime($to_date)));
                $code = $this->_random_number_generator();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'password' => md5($password),
                    'user_type' => 'Member',
                    'status' => '1', // NOTE: there should be defualt 0 
                    'activation_code' => $code,
                    'expired_date'=>$expiry_date
                    );

                if ($this->basic->insert_data('users', $data)) {
                    // NOTE: We can add here an email code to send for activatin but due to limited time I skip here...
			
					$this->session->set_flashdata('login_msg', $this->lang->line("Welcome login here please,if you get trouble please ask administrator"));
					// redirect("home/login");
                    return $this->login();

                }

            }

        }
    }
	
	/**
    * method to load index  page
    * @access public
    * @return void
    */
    public function cart()
    {
        $data['page_title'] = "Shopping Cart";
		$this->load->view('cart/index',$data);
    }	
	
	
	
	/**
    * method to load logout page
    * @access public
    * @return void
    */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home/login', 'location');
    }

    /**
    * method to generate random number
    * @access public
    * @param int
    * @return int
    */
    public function _random_number_generator($length=6)
    {
        $rand = substr(uniqid(mt_rand(), true), 0, $length);
        return $rand;
    }

	
}
