<?php
/**
 * @property Jadwal_model $Jadwal_model
 * @property Dosen_model $Dosen_model
 * @property MataKuliah_model $MataKuliah_model
 * @property Ruang_model $Ruang_model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Jadwal extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->model('Dosen_model');
        $this->load->model('MataKuliah_model');
        $this->load->model('Ruang_model');
        $this->load->library(['form_validation', 'session']);
    }
    
    public function index() {
        $data['title'] = 'Data Jadwal Kuliah';
        $data['jadwal'] = $this->Jadwal_model->get_all_with_relations();
        $data['message'] = $this->session->flashdata('message');
        $data['error'] = $this->session->flashdata('error');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('jadwal/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function tabel_mingguan() {
        $data['title'] = 'Tabel Jadwal Mingguan';
        $data['jadwal'] = $this->Jadwal_model->get_all_with_relations();
        $data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $data['jam'] = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('jadwal/tabel_mingguan', $data);
        $this->load->view('templates/footer');
    }
    
    public function add() {
        $data['title'] = 'Tambah Jadwal Kuliah';
        $data['action'] = 'jadwal/add';
        $data['dosen'] = $this->Dosen_model->get_all();
        $data['mata_kuliah'] = $this->MataKuliah_model->get_all();
        $data['ruang'] = $this->Ruang_model->get_all();
        $data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        
        $this->form_validation->set_rules('dosen_id', 'Dosen', 'required');
        $this->form_validation->set_rules('mata_kuliah_id', 'Mata Kuliah', 'required');
        $this->form_validation->set_rules('ruang_id', 'Ruang', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('jadwal/form', $data);
            $this->load->view('templates/footer');
        } else {
            $jadwal_data = [
                'dosen_id' => $this->input->post('dosen_id'),
                'mata_kuliah_id' => $this->input->post('mata_kuliah_id'),
                'ruang_id' => $this->input->post('ruang_id'),
                'hari' => $this->input->post('hari'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai')
            ];
            
            // Cek konflik jadwal
            $konflik = $this->_cek_konflik_jadwal($jadwal_data);
            
            if ($konflik) {
                $data['error'] = $konflik;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('jadwal/form', $data);
                $this->load->view('templates/footer');          
            } else {
                $this->Jadwal_model->insert($jadwal_data);
                $this->session->set_flashdata('message', 'Data jadwal berhasil ditambahkan.');
                redirect('jadwal');
            }
        }
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Jadwal Kuliah';
        $data['action'] = "jadwal/edit/$id";
        $data['jadwal'] = $this->Jadwal_model->get_by_id($id);
        $data['dosen'] = $this->Dosen_model->get_all();
        $data['mata_kuliah'] = $this->MataKuliah_model->get_all();
        $data['ruang'] = $this->Ruang_model->get_all();
        $data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        
        if (!$data['jadwal']) {
            show_404();
        }
        
        $this->form_validation->set_rules('dosen_id', 'Dosen', 'required');
        $this->form_validation->set_rules('mata_kuliah_id', 'Mata Kuliah', 'required');
        $this->form_validation->set_rules('ruang_id', 'Ruang', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('jadwal/form', $data);
            $this->load->view('templates/footer');
        } else {
            $jadwal_data = [
                'dosen_id' => $this->input->post('dosen_id'),
                'mata_kuliah_id' => $this->input->post('mata_kuliah_id'),
                'ruang_id' => $this->input->post('ruang_id'),
                'hari' => $this->input->post('hari'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai')
            ];
            
            // Cek konflik jadwal
            $konflik = $this->_cek_konflik_jadwal($jadwal_data, $id);
            
            if ($konflik) {
                $data['error'] = $konflik;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('jadwal/form', $data);
                $this->load->view('templates/footer');     
            } else {
                $this->Jadwal_model->update($id, $jadwal_data);
                $this->session->set_flashdata('message', 'Data jadwal berhasil diperbarui.');
                redirect('jadwal');
            }
        }
    }
    
    public function delete($id) {
        $jadwal = $this->Jadwal_model->get_by_id($id);
        
        if (!$jadwal) {
            show_404();
        }
        
        $this->Jadwal_model->delete($id);
        $this->session->set_flashdata('message', 'Data jadwal berhasil dihapus.');
        redirect('jadwal');
    }
    
    private function _cek_konflik_jadwal($jadwal_data, $current_id = null) {
        // Konflik ruangan: ruangan yang sama pada hari dan jam yang sama
        $ruang_konflik = $this->Jadwal_model->cek_konflik_ruang(
            $jadwal_data['ruang_id'],
            $jadwal_data['hari'],
            $jadwal_data['jam_mulai'],
            $jadwal_data['jam_selesai'],
            $current_id
        );
        
        if ($ruang_konflik) {
            return "Konflik ruangan: Ruang sudah digunakan pada waktu tersebut";
        }
        
        // Konflik dosen: dosen yang sama pada hari dan jam yang sama
        $dosen_konflik = $this->Jadwal_model->cek_konflik_dosen(
            $jadwal_data['dosen_id'],
            $jadwal_data['hari'],
            $jadwal_data['jam_mulai'],
            $jadwal_data['jam_selesai'],
            $current_id
        );
        
        if ($dosen_konflik) {
            return "Konflik dosen: Dosen sudah memiliki jadwal pada waktu tersebut";
        }
        
        return false;
    }
}
