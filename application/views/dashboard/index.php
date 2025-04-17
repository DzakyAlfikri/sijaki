<div class="container mt-5">
    <!-- Tambahkan Baris untuk Tombol Logout -->
    <div class="row justify-content-end">
        <div class="col-md-2 text-end">
            <a href="<?= base_url('admin/logout') ?>" class="btn btn-danger">
                Logout <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>

    <!-- Statistik Dashboard -->
    <div class="row dashboard-stats mt-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="number"><?= $total_dosen ?></div>
                            <div class="card-title">Total Dosen</div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="number"><?= $total_matkul ?></div>
                            <div class="card-title">Total Matkul</div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="number"><?= $total_ruang ?></div>
                            <div class="card-title">Total Ruang</div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="number"><?= $total_jadwal ?></div>
                            <div class="card-title">Total Jadwal</div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Aplikasi -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i> Informasi Aplikasi
                </div>
                <div class="card-body">
                    <h5>Selamat Datang di Sistem Penjadwalan Kuliah</h5>
                    <p>Sistem ini membantu pengelolaan jadwal perkuliahan dengan fitur-fitur berikut:</p>
                    <ul>
                        <li>Pengelolaan data dosen, mata kuliah, dan ruangan</li>
                        <li>Pengaturan jadwal kuliah dengan validasi konflik waktu</li>
                        <li>Visualisasi jadwal dalam bentuk tabel mingguan</li>
                    </ul>
                    <p>Silahkan gunakan menu di sebelah kiri untuk navigasi ke modul yang diinginkan.</p>
                    <div class="text-center mt-4">
                        <a href="<?= base_url('jadwal/tabel_mingguan') ?>" class="btn btn-primary">
                            <i class="fas fa-table me-2"></i> Lihat Tabel Jadwal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
