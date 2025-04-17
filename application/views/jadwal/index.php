<?php if (!empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-calendar-alt me-2"></i> Daftar Jadwal Kuliah</span>
        <div>
            <a href="<?= base_url('jadwal/tabel_mingguan') ?>" class="btn btn-sm btn-info me-2">
                <i class="fas fa-table me-1"></i> Lihat Tabel Mingguan
            </a>
            <a href="<?= base_url('jadwal/add') ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Jadwal
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Ruang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jadwal)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data jadwal</td>
                    </tr>
                    <?php else: ?>
                    <?php $no = 1; foreach ($jadwal as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->hari ?></td>
                        <td><?= substr($row->jam_mulai, 0, 5) ?> - <?= substr($row->jam_selesai, 0, 5) ?></td>
                        <td><?= $row->nama_matkul ?></td>
                        <td><?= $row->nama_dosen ?></td>
                        <td><?= $row->nama_ruang ?></td>
                        <td>
                            <a href="<?= base_url('jadwal/edit/'.$row->id) ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('jadwal/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" data-bs-toggle="tooltip" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>