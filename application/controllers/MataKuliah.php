<?php

/**
 * @property MataKuliah_model $MataKuliah_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class MataKuliah extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('MataKuliah_model');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $data['title'] = 'Data Mata Kuliah';
        $data['mata_kuliah'] = $this->MataKuliah_model->get_all();
        $data['message'] = $this->session->flashdata('message');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('matakuliah/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add() {
        $data['title'] = 'Tambah Mata Kuliah';
        $data['action'] = 'matakuliah/add';
        
        $this->form_validation->set_rules('kode', 'Kode', 'required|is_unique[mata_kuliah.kode]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('sks', 'SKS', 'required|numeric');
        $this->form_validation->set_rules('semester', 'Semester', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('matakuliah/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'sks' => $this->input->post('sks'),
                'semester' => $this->input->post('semester')
            ];
            
            $this->MataKuliah_model->insert($data);
            $this->session->set_flashdata('message', 'Data mata kuliah berhasil ditambahkan.');
            redirect('matakuliah');
        }
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Mata Kuliah';
        $data['action'] = "matakuliah/edit/$id";
        $data['mata_kuliah'] = $this->MataKuliah_model->get_by_id($id);
        
        if (!$data['mata_kuliah']) {
            show_404();
        }
        
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('sks', 'SKS', 'required|numeric');
        $this->form_validation->set_rules('semester', 'Semester', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('matakuliah/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'sks' => $this->input->post('sks'),
                'semester' => $this->input->post('semester')
            ];
            
            $this->MataKuliah_model->update($id, $data);
            $this->session->set_flashdata('message', 'Data mata kuliah berhasil diperbarui.');
            redirect('matakuliah');
        }
    }
    
    public function delete($id) {
        $mata_kuliah = $this->MataKuliah_model->get_by_id($id);
        
        if (!$mata_kuliah) {
            show_404();
        }
        
        $this->MataKuliah_model->delete($id);
        $this->session->set_flashdata('message', 'Data mata kuliah berhasil dihapus.');
        redirect('matakuliah');
    }
}