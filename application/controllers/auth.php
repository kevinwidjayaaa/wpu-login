<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/auth_header');
            $this->load->view('templates/auth_footer');
            $this->load->view('auth/login');
            // echo'test';
        } else {
            //login bisa
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            //if exist
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    //kalo sukses
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],

                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 2) {
                        redirect('user');
                    } else {
                        redirect('admin');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    wrong password
                  </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    email is not activated
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                email is not registered
                </div>');
            redirect('auth');
        }
        //. var_dump($user);
        //die;

    }
    public function regisration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'this email has already registered'
        ]);
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'WPU regisration';
            $this->load->library('form_validation');
            $this->load->view('templates/auth_header', $data);
            $this->load->view('templates/auth_footer');
            $this->load->view('auth/regisration');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'role_id' => 2,
                'is_active' => 1,


            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            yeay your account has been created
          </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            finally you logout
          </div>');
        redirect('auth');
    }
}
