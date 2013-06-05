<?php

class Generator extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        echo anchor('generator/write', 'CRUD');
    }

    function write() {
        $success = array();
        $this->load->database();
        $semua_tabel = $this->db->list_tables();
        $list_tabel = array();
        $data['php_open_first'] = '<?php';
        $data['php_close_first'] = '?>';
        //generate views template
        $source_view_template = $this->parser->parse('template_view_template', $data, TRUE);
        if (write_file('generator/views/admin/template.php', $source_view_template)) {
            $success[] = 'view template.php';
        }
        //generate views front

        foreach ($semua_tabel as $lst_tabel) {
            $list_tabel[] = array('nama_tabel_front' => $lst_tabel);
        }
        $data['list_tabel'] = $list_tabel;
        $source_view_front = $this->parser->parse('template_view_front', $data, TRUE);
        if (write_file('generator/views/admin/front.php', $source_view_front)) {
            $success[] = 'view front.php';
        }
        //generate controller front
        $source_controller_front = $this->parser->parse('template_controller_front', $data, TRUE);
        if (write_file('generator/controllers/admin/front.php', $source_controller_front)) {
            $success[] = 'controller front.php';
        }
        foreach ($semua_tabel as $tabel) {
            //inisialisai awal
            $data['php_open'] = '<?php';
            $data['php_close'] = '?>';
            $data['nama_tabel'] = $tabel;
            $data['k_nama_tabel'] = ucfirst($tabel);


            $data['field_tabel'] = $this->db->field_data($tabel);
            $field_crud = array();
            $name_field = array();
            //generate field name table non primary key
            foreach ($data['field_tabel'] as $field_tabel) {

                if (!$field_tabel->primary_key) {
                    $field_crud[] = array('name_field_table' => $field_tabel->name);
                }
            }
            //generate field name table primary key
            $data_primary = array();
            foreach ($data['field_tabel'] as $name_primary) {
                if ($name_primary->primary_key) {
                    $data_primary[] = array('primary_key' => $name_primary->name);
                }
            }

            $data['primary_key_tabel'] = $data_primary;
            //  $data['name_field'] = $name_field;
            $data['fields_tabel1'] = $field_crud;
            $data['fields_tabel2'] = $field_crud;
            $data['fields_tabel3'] = $field_crud;
            $data['fields_tabel4'] = $field_crud;
            $data['fields_tabel5'] = $field_crud;
            $data['fields_tabel6'] = $field_crud;
            $data['fields_tabel7'] = $field_crud;
            //generate table
            $source_model = $this->parser->parse('template_model', $data, TRUE);
            if (write_file('generator/models/' . $tabel . '_model.php', $source_model)) {
                $success[] = 'model '.$tabel.'_model.php';
            }
            /**
            Generator Models
            **/
            //generate table
            $source_model = $this->parser->parse('template_model-datatables', $data, TRUE);
            if (write_file('generator/models/bootstrap-datatables/' . $tabel . '_model.php', $source_model)) {
                $success[] = 'model '.$tabel.'_model.php';
            }

            /**
            Generator Controller
            **/

            //generate controller
            $data['primary_key_tabel2'] = $data_primary;

            
            $source_controller = $this->parser->parse('template_controller', $data, TRUE);
            if (write_file('generator/controllers/admin/' . $tabel . '.php', $source_controller)) {
                $success[] = 'controller '.$tabel.'.php';
            }

            $source_controller = $this->parser->parse('template_controller-datatables', $data, TRUE);
            if (write_file('generator/controllers/bootstrap-datatables/' . $tabel . '.php', $source_controller)) {
                $success[] = 'controller '.$tabel.'.php';
            }
            /**
            Generator View
            **/
            //generator views all
            ///
            $source_view_all = $this->parser->parse('template_view_all', $data, TRUE);
            if (write_file('generator/views/admin/' . $tabel . '_all.php', $source_view_all)) {
                $success[] = 'view '.$tabel.'_all.php';
            }

            //generator view ajax datatables and input form 
            //written by Syahroni Wahyu - roniwahyu@gmail.com 04/01/2013
            $source_view_all = $this->parser->parse('template_view-datatables', $data, TRUE);
            if (write_file('generator/views/bootstrap-datatables/' . $tabel . '_view.php', $source_view_all)) {
                $success[] = 'view '.$tabel.'_view.php';
            }
            //genertor views form

            $source_view_all = $this->parser->parse('template_view_form', $data, TRUE);
            if (write_file('generator/views/admin/form_' . $tabel . '.php', $source_view_all)) {
                $success[] = 'view form_'.$tabel.'.php';
            }
        }
        $this->load->library('sql_table');
        $this->sql_table->create_user();
         $source_controller_login = $this->parser->parse('template_controller_admin_login', $data, TRUE);
            if (write_file('generator/controllers/admin_login.php', $source_controller_login)) {
                $success[] = 'view controller admin_login.php';
            }
            $source_view_login = $this->parser->parse('template_login_view', $data, TRUE);
            if (write_file('generator/views/login_view.php', $source_view_login)) {
                $success[] = 'view view login_view.php';
            }
         $source_auth = $this->parser->parse('template_auth', $data, TRUE);
            if (write_file('generator/libraries/auth.php', $source_auth)) {
                $success[] = 'view library auth.php';
            }
        echo "<h2>Success generate file :</h2>";
        echo "<ol>";
        foreach ($success as $scs){
            echo "<li>".$scs."</li>";
        }

        echo "</ol>";
    }

}
?>
