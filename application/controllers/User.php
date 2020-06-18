<?php
class User extends CI_Controller
{
    public function index()
    {
        $this->load->view('login/login');
    }
    public function login()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('user-name', 'Username', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/login');
        } else {

            $this->load->model('login_model');
            $result = $this->login_model->login();
            if ($result['userExist']) {

                $this->load->library('session');
                $newUserData = array(
                    'user-name'  => $result['user-name'],
                    'user-id'     => $result['user-id'],
                    'logged-in' => TRUE
                );

                $this->session->set_userdata($newUserData);

                $this->load->view('partials/header');
                $this->load->view('user/dashboard');
                $this->load->view('partials/footer');
            } else {
                $this->load->view('login/login', $result);
            }
        }
    }
    public function register()
    {
        $this->load->view('login/register');
    }
    public function logout()
    {
        unset($_SESSION['user-name'],
        $_SESSION['user-id'],
        $_SESSION['logged-in']);
        $this->load->view('visitor_home/visitor_home');
    }
}
