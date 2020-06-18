<?php
class Login_model extends CI_Model
{
    public function login()
    {
        $result = array();
        $userName = trim($this->input->post('user-name'));
        $password = trim($this->input->post('password'));
        $data = array('username' => $userName, 'pwd' => $password);

        $query = $this->db->get_where('user', $data);
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $result['user-id'] = $row['id'];
            $result['user-name'] = $row['username'];
            $result['userExist'] = true;
            $result['msg'] = "valid user";
        } else {
            $result['msg'] = "invalid user name or password";
            $result['userExist'] = false;
        }
        return $result;
    }
}
