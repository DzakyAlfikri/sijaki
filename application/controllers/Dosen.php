<?php

/**
 * @property Dosen_model $Dosen_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Dosen extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Dosen_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
    }
    
    public function index() {
        $data['title'] = 'Data Dosen';
        $data['dosen'] = $this->Dosen_model->get_all();
        $data['message'] = $this->session->flashdata('message');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dosen/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add() {
        $data['title'] = 'Tambah Dosen';
        $data['action'] = 'dosen/add';
        
        $this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[dosen.nip]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dosen/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp')
            ];
            
            $this->Dosen_model->insert($data);
            $this->session->set_flashdata('message', 'Data dosen berhasil ditambahkan.');
            redirect('dosen');
        }
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Dosen';
        $data['action'] = "dosen/edit/$id";
        $data['dosen'] = $this->Dosen_model->get_by_id($id);
        
        if (!$data['dosen']) {
            show_404();
        }
        
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dosen/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp')
            ];
            
            $this->Dosen_model->update($id, $data);
            $this->session->set_flashdata('message', 'Data dosen berhasil diperbarui.');
            redirect('dosen');
        }
    }
    
    public function delete($id) {
        $dosen = $this->Dosen_model->get_by_id($id);
        
        if (!$dosen) {
            show_404();
        }
        
        $this->Dosen_model->delete($id);
        $this->session->set_flashdata('message', 'Data dosen berhasil dihapus.');
        redirect('dosen');
    }
}