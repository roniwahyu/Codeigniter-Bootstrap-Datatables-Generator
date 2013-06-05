{php_open}

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

    function get_one($id) {
        $this->db->where('{primary_key_tabel}{primary_key}', $id);
        $result = $this->db->get('{nama_tabel}');
        if ($result->num_rows() == 1) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    function insert() {
           $data = array(
        {fields_tabel1}
            '{name_field_table}' => $this->input->post('{name_field_table}', TRUE),
           {/fields_tabel1}
        );
        $this->db->insert('{nama_tabel}', $data);
    }

    function update($id) {
        $data = array(
         {fields_tabel2}
       '{name_field_table}' => $this->input->post('{name_field_table}', TRUE),
       {/fields_tabel2}
        );
        $this->db->where('{primary_key}', $id);
        $this->db->update('{nama_tabel}', $data);
    }

    function delete($id) {
        foreach ($id as $sip) {
            $this->db->where('{primary_key}{/primary_key_tabel}', $sip);
            $this->db->delete('{nama_tabel}');
        }
    }

}
{php_close}
