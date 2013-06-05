<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Sql_table {

    var $AT = null;

    function __construct() {
        $this->AT = & get_instance();
        $this->AT->load->database();
    }

    function create_user() {
        $this->AT->db->query("
            
    CREATE TABLE IF NOT EXISTS `user_ci` (
    `id` int(7) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `level` int(4) NOT NULL,
    `status` enum('1','0') NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

        $this->AT->db->where('id', 1);
        $result = $this->AT->db->get('user_ci');
        if ($result->num_rows != 1) {
            $this->AT->db->query("INSERT INTO `user_ci` (`id`, `username`, `password`, `email`, `level`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 1, '1');");
        }
    }

}
?>
