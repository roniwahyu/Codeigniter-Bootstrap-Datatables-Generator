{php_open} if(!defined('BASEPATH')) exit('No direct script access allowed');

class {nama_tabel} extends MX_Controller {

    function __construct() {
        parent::__construct();
          if ($this->session->userdata("login") != TRUE) {
            $this->session->set_flashdata('login_notif','<p>You must be logged in</p>');
            //redirect('login', 'refresh');
        }
        //Load IgnitedDatatables Library
        $this->load->library('Datatables');
        $this->load->model('{nama_tabel}_model','{nama_tabel}db',TRUE);
    }

    public function index() {
        $this->load->view('{nama_tabel}_view');
    }
     {primary_key_tabel}

    public function getdatatables(){
        $this->datatables->select('{primary_key},{fields_tabel1}{name_field_table},{/fields_tabel1}')
                        ->from('{nama_tabel}');
        echo $this->datatables->generate();
    }

   

    public function get(${primary_key}=null){
        if(${primary_key}!==null){
            echo json_encode($this->{nama_tabel}db->get_one(${primary_key}));
        }
    }

    public function submit(){
        if ($this->input->post('ajax')){
          if ($this->input->post('{primary_key}')){
            $this->{nama_tabel}db->update($this->input->post('{primary_key}'));
          }else{
            $this->{nama_tabel}db->save();
          }

        }else{
          if ($this->input->post('submit')){
              if ($this->input->post('{primary_key}')){
                $this->{nama_tabel}db->update($this->input->post('{primary_key}'));
              }else{
                $this->{nama_tabel}db->save();
              }
          }
        }
    }

    public function delete(${primary_key}=null) {
      ${primary_key} = $this->input->post('{primary_key}');
        if (isset($_POST['{primary_key}'])) {
            ${primary_key}=$_POST['{primary_key}'];
            $this->db->delete('{nama_tabel}', array('{primary_key}' => ${primary_key}));
            $this->session->set_flashdata('notif','data has been deleted');
        } elseif(!empty(${primary_key})){
            $hapus['kode'] = $this->uri->segment(3);
            $this->db->delete('{nama_tabel}', array('{primary_key}' => $hapus['kode']));
        } else {
            $this->session->set_flashdata('notif', 'no data deleted');
        }
    }
    {/primary_key_tabel}

}

/** Module {nama_tabel} Controller **/
/** Build & Development By Syahroni Wahyu - roniwahyu@gmail.com */
