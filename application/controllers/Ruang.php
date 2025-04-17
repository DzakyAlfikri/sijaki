<?php
/**
 * @property Ruang_model $Ruang_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Ruang extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Ruang_model');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $data['title'] = 'Data Ruang';
        $data['ruang'] = $this->Ruang_model->get_all();
        $data['message'] = $this->session->flashdata('message');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('ruang/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add() {
        $data['title'] = 'Tambah Ruang';
        $data['action'] = 'ruang/add';
        
        $this->form_validation->set_rules('kode', 'Kode', 'required|is_unique[ruang.kode]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('ruang/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'kapasitas' => $this->input->post('kapasitas')
            ];
            
            $this->Ruang_model->insert($data);
            $this->session->set_flashdata('message', 'Data ruang berhasil ditambahkan.');
            redirect('ruang');
        }
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Ruang';
        $data['action'] = "ruang/edit/$id";
        $data['ruang'] = $this->Ruang_model->get_by_id($id);
        
        if (!$data['ruang']) {
            show_404();
        }
        
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('ruang/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'kapasitas' => $this->input->post('kapasitas')
            ];
            
            $this->Ruang_model->update($id, $data);
            $this->session->set_flashdata('message', 'Data ruang berhasil diperbarui.');
            redirect('ruang');
        }
    }
    
    public function delete($id) {
        $ruang = $this->Ruang_model->get_by_id($id);
        
        if (!$ruang) {
            show_404();
        }
        
        $this->Ruang_model->delete($id);
        $this->session->set_flashdata('message', 'Data ruang berhasil dihapus.');
        redirect('ruang');
    }
}