<?php if (!empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-user-tie me-2"></i> Daftar Dosen</span>
        <a href="<?= base_url('dosen/add') ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Dosen
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dosen)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data dosen</td>
                    </tr>
                    <?php else: ?>
                    <?php $no = 1; foreach ($dosen as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nip ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->no_hp ?></td>
                        <td>
                            <a href="<?= base_url('dosen/edit/'.$row->id) ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('dosen/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" data-bs-toggle="tooltip" title="Hapus">
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
