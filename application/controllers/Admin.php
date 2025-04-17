<?php

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property Admin_model $Admin_model
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form']);
        $this->load->model('Admin_model');
    }

    public function login() {
        // Jika sudah login
        if ($this->session->userdata('admin_id')) {
            redirect('dashboard');
        }

        // Proses login saat form disubmit
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $admin = $this->Admin_model->check_login($username, $password);

            if ($admin) {
                $this->session->set_userdata('admin_id', $admin->id);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah');
                redirect('admin/login');
            }
        }

        // Data untuk view
        $data['title'] = 'Login Admin';
        $data['error'] = $this->session->flashdata('error');

        $this->load->view('templates/header', $data);
        $this->load->view('admin/login', $data);
        $this->load->view('templates/footer');
    }

    public function logout() {
        $this->session->unset_userdata('admin_id');
        $this->session->set_flashdata('success', 'Anda berhasil logout');
        redirect('admin/login');
    }
}
