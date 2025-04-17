<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-table me-2"></i> Tabel Jadwal Mingguan</span>
        <a href="<?= base_url('jadwal/add') ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Jadwal
        </a>
    </div>
    <div class="card-body">
        <div class="jadwal-table table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 100px;">Waktu</th>
                        <?php foreach ($hari as $h): ?>
                        <th class="text-center"><?= $h ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jam as $j): ?>
                    <tr>
                        <td class="text-center"><?= $j ?></td>
                        <?php foreach ($hari as $h): ?>
                        <td>
                            <?php 
                            foreach ($jadwal as $jdw): 
                                $jam_mulai = strtotime($jdw->jam_mulai);
                                $jam_selesai = strtotime($jdw->jam_selesai);
                                $jam_curr = strtotime($j);
                                $jam_next = strtotime($j.':59');
                                
                                if ($jdw->hari == $h && $jam_curr >= $jam_mulai && $jam_curr < $jam_selesai): 
                            ?>
                            <div class="jadwal-item">
                                <div class="fw-bold"><?= $jdw->nama_matkul ?></div>
                                <div><i class="fas fa-user-tie me-1"></i> <?= $jdw->nama_dosen ?></div>
                                <div><i class="fas fa-door-open me-1"></i> <?= $jdw->nama_ruang ?></div>
                                <div><i class="fas fa-clock me-1"></i> <?= substr($jdw->jam_mulai, 0, 5) ?> - <?= substr($jdw->jam_selesai, 0, 5) ?></div>
                            </div>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Tambahkan tooltip untuk jadwal-item
    $('.jadwal-item').each(function() {
        $(this).attr('title', $(this).find('.fw-bold').text());
        new bootstrap.Tooltip($(this));
    });
});
</script>