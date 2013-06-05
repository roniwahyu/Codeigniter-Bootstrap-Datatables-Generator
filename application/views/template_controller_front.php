{php_open_first}

class Front extends CI_Controller {

    function __construct() {
        parent::__construct();
         if ($this->session->userdata("login") != TRUE) {
           $this->session->set_flashdata('login_notif','<p>You must be logged in</p>');
            redirect('admin_login', 'refresh');
        }
    }

    function index() {
        $data['content']='admin/front';
        $this->load->view('admin/template',$data);
    }

}
{php_close_first}
