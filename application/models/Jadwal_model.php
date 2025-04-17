<?php 
class Jadwal_model extends CI_Model {
    private $table = 'jadwal';
    
    public function get_all() {
        return $this->db->get($this->table)->result();
    }
    
    public function get_all_with_relations() {
        $this->db->select('jadwal.*, dosen.nama as nama_dosen, mata_kuliah.nama as nama_matkul, ruang.nama as nama_ruang');
        $this->db->from($this->table);
        $this->db->join('dosen', 'dosen.id = jadwal.dosen_id');
        $this->db->join('mata_kuliah', 'mata_kuliah.id = jadwal.mata_kuliah_id');
        $this->db->join('ruang', 'ruang.id = jadwal.ruang_id');
        $this->db->order_by('jadwal.hari', 'ASC');
        $this->db->order_by('jadwal.jam_mulai', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
    
    // Fungsi untuk mengecek konflik jadwal ruangan
    public function cek_konflik_ruang($ruang_id, $hari, $jam_mulai, $jam_selesai, $current_id = null) {
        $this->db->where('ruang_id', $ruang_id);
        $this->db->where('hari', $hari);
        if ($current_id) {
            $this->db->where('id !=', $current_id);
        }
        
        // Cek apakah ada jadwal yang bentrok
        $this->db->where("(
            (jam_mulai <= '$jam_mulai' AND jam_selesai > '$jam_mulai') OR
            (jam_mulai < '$jam_selesai' AND jam_selesai >= '$jam_selesai') OR
            (jam_mulai >= '$jam_mulai' AND jam_selesai <= '$jam_selesai')
        )");
        
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }
    
    // Fungsi untuk mengecek konflik jadwal dosen
    public function cek_konflik_dosen($dosen_id, $hari, $jam_mulai, $jam_selesai, $current_id = null) {
        $this->db->where('dosen_id', $dosen_id);
        $this->db->where('hari', $hari);
        
        // Kecualikan jadwal saat ini jika sedang mengedit
        if ($current_id) {
            $this->db->where('id !=', $current_id);
        }
        
        // Cek apakah ada jadwal yang bentrok
        $this->db->where("(
            (jam_mulai <= '$jam_mulai' AND jam_selesai > '$jam_mulai') OR
            (jam_mulai < '$jam_selesai' AND jam_selesai >= '$jam_selesai') OR
            (jam_mulai >= '$jam_mulai' AND jam_selesai <= '$jam_selesai')
        )");
        
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }
    
    // Mendapatkan jadwal berdasarkan hari
    public function get_by_hari($hari) {
        $this->db->select('jadwal.*, dosen.nama as nama_dosen, mata_kuliah.nama as nama_matkul, ruang.nama as nama_ruang');
        $this->db->from($this->table);
        $this->db->join('dosen', 'dosen.id = jadwal.dosen_id');
        $this->db->join('mata_kuliah', 'mata_kuliah.id = jadwal.mata_kuliah_id');
        $this->db->join('ruang', 'ruang.id = jadwal.ruang_id');
        $this->db->where('jadwal.hari', $hari);
        $this->db->order_by('jadwal.jam_mulai', 'ASC');
        return $this->db->get()->result();
    }
}