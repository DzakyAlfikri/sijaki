<?php if (!empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <i class="fas fa-user-tie me-2"></i> <?= $title ?>
    </div>
    <div class="card-body">
        <?= form_open($action) ?>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" id="nip" name="nip" value="<?= set_value('nip', isset($dosen) ? $dosen->nip : '') ?>">
                <div class="invalid-feedback"><?= form_error('nip') ?></div>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= set_value('nama', isset($dosen) ? $dosen->nama : '') ?>">
                <div class="invalid-feedback"><?= form_error('nama') ?></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= set_value('email', isset($dosen) ? $dosen->email : '') ?>">
                <div class="invalid-feedback"><?= form_error('email') ?></div>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" id="no_hp" name="no_hp" value="<?= set_value('no_hp', isset($dosen) ? $dosen->no_hp : '') ?>">
                <div class="invalid-feedback"><?= form_error('no_hp') ?></div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('dosen') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        <?= form_close() ?>
    </div>
</div>
