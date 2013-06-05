<?php

class Coba extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->library('sql_table');
        $this->sql_table->create_user();

    }

}
?>
