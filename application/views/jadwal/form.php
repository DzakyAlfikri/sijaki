<?php if (!empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <?= $error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <i class="fas fa-calendar-alt me-2"></i> <?= $title ?>
    </div>
    <div class="card-body">
        <?= form_open($action) ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
                        <select class="form-select <?= form_error('mata_kuliah_id') ? 'is-invalid' : '' ?>" id="mata_kuliah_id" name="mata_kuliah_id">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <?php foreach ($mata_kuliah as $mk): ?>
                            <option value="<?= $mk->id ?>" <?= set_select('mata_kuliah_id', $mk->id, isset($jadwal) && $jadwal->mata_kuliah_id == $mk->id) ?>>
                                <?= $mk->kode ?> - <?= $mk->nama ?> (<?= $mk->sks ?> SKS)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('mata_kuliah_id') ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="dosen_id" class="form-label">Dosen</label>
                        <select class="form-select <?= form_error('dosen_id') ? 'is-invalid' : '' ?>" id="dosen_id" name="dosen_id">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $d): ?>
                            <option value="<?= $d->id ?>" <?= set_select('dosen_id', $d->id, isset($jadwal) && $jadwal->dosen_id == $d->id) ?>>
                                <?= $d->nip ?> - <?= $d->nama ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('dosen_id') ?></div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="ruang_id" class="form-label">Ruang</label>
                        <select class="form-select <?= form_error('ruang_id') ? 'is-invalid' : '' ?>" id="ruang_id" name="ruang_id">
                            <option value="">-- Pilih Ruang --</option>
                            <?php foreach ($ruang as $r): ?>
                            <option value="<?= $r->id ?>" <?= set_select('ruang_id', $r->id, isset($jadwal) && $jadwal->ruang_id == $r->id) ?>>
                                <?= $r->kode ?> - <?= $r->nama ?> (Kapasitas: <?= $r->kapasitas ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('ruang_id') ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select class="form-select <?= form_error('hari') ? 'is-invalid' : '' ?>" id="hari" name="hari">
                            <option value="">-- Pilih Hari --</option>
                            <?php foreach ($hari as $h): ?>
                            <option value="<?= $h ?>" <?= set_select('hari', $h, isset($jadwal) && $jadwal->hari == $h) ?>>
                                <?= $h ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('hari') ?></div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control <?= form_error('jam_mulai') ? 'is-invalid' : '' ?>" id="jam_mulai" name="jam_mulai" value="<?= set_value('jam_mulai', isset($jadwal) ? $jadwal->jam_mulai : '') ?>">
                        <div class="invalid-feedback"><?= form_error('jam_mulai') ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control <?= form_error('jam_selesai') ? 'is-invalid' : '' ?>" id="jam_selesai" name="jam_selesai" value="<?= set_value('jam_selesai', isset($jadwal) ? $jadwal->jam_selesai : '') ?>">
                        <div class="invalid-feedback"><?= form_error('jam_selesai') ?></div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('jadwal') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        <?= form_close() ?>
    </div>
</div>
