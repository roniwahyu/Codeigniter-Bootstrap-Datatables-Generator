{php_open} if(!defined('BASEPATH')) exit('No direct script access allowed');


class {k_nama_tabel}_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($limit, $uri) {

        $result = $this->db->get('{nama_tabel}', $limit, $uri);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }
    {primary_key_tabel}
    function get_one(${primary_key}) {
        $this->db->where('{primary_key}', ${primary_key});
        $result = $this->db->get('{nama_tabel}');
        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    function save() {
           $data = array(
        {fields_tabel1}
            '{name_field_table}' => $this->input->post('{name_field_table}', TRUE),
           {/fields_tabel1}
        );
        $this->db->insert('{nama_tabel}', $data);
    }

    function update(${primary_key}) {
        $data = array(
        '{primary_key}' => $this->input->post('{primary_key}',TRUE),{fields_tabel2}
       '{name_field_table}' => $this->input->post('{name_field_table}', TRUE),
       {/fields_tabel2}
        );
        $this->db->where('{primary_key}', ${primary_key});
        $this->db->update('{nama_tabel}', $data);
    }

    function delete(${primary_key}) {
        foreach (${primary_key} as $row) {
            $this->db->where('{primary_key}{/primary_key_tabel}', $row);
            $this->db->delete('{nama_tabel}');
        }
    }

}
{php_close}
