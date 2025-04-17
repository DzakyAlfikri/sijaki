<?php if (!empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <i class="fas fa-door-open me-2"></i> <?= $title ?>
    </div>
    <div class="card-body">
        <?= form_open($action) ?>
            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control <?= form_error('kode') ? 'is-invalid' : '' ?>" id="kode" name="kode" value="<?= set_value('kode', isset($ruang) ? $ruang->kode : '') ?>">
                <div class="invalid-feedback"><?= form_error('kode') ?></div>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= set_value('nama', isset($ruang) ? $ruang->nama : '') ?>">
                <div class="invalid-feedback"><?= form_error('nama') ?></div>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" class="form-control <?= form_error('kapasitas') ? 'is-invalid' : '' ?>" id="kapasitas" name="kapasitas" value="<?= set_value('kapasitas', isset($ruang) ? $ruang->kapasitas : '') ?>">
                <div class="invalid-feedback"><?= form_error('kapasitas') ?></div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('ruang') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        <?= form_close() ?>
    </div>
</div>
