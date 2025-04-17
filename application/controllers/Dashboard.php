<?php

/**
 * @property CI_DB $db
 * @property Jadwal_model $Jadwal_model
 * @property CI_Session $session
 */
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect('admin/login');
        }
        $this->load->database();
        $this->load->model('Jadwal_model');
    }
    
    public function index() {
        $data['title'] = 'Dashboard';
        $data['total_dosen'] = $this->db->count_all('dosen');
        $data['total_matkul'] = $this->db->count_all('mata_kuliah');
        $data['total_ruang'] = $this->db->count_all('ruang');
        $data['total_jadwal'] = $this->db->count_all('jadwal');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
