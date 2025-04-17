<?php
// Make sure $this is only used within a class context
// Define variables we'll need
$base_url = base_url();
$current_segment = isset($uri) ? $uri->segment(1) : '';
$current_segment2 = isset($uri) ? $uri->segment(2) : '';
$title = isset($title) ? $title : 'Dashboard';
?> 
<nav class="sidebar"> 
    <div class="sidebar-header"> 
        <h3>Penjadwalan Kuliah</h3> 
    </div> 
     
    <ul class="list-unstyled components"> 
        <li> 
            <a href="<?= base_url('dashboard') ?>" class="<?= ($current_segment == 'dashboard' || $current_segment == '') ? 'active' : '' ?>"> 
                <i class="fas fa-tachometer-alt"></i> Dashboard 
            </a> 
        </li> 
        <li> 
            <a href="<?= base_url('dosen') ?>" class="<?= ($current_segment == 'dosen') ? 'active' : '' ?>"> 
                <i class="fas fa-user-tie"></i> Data Dosen 
            </a> 
        </li> 
        <li> 
            <a href="<?= base_url('matakuliah') ?>" class="<?= ($current_segment == 'matakuliah') ? 'active' : '' ?>"> 
                <i class="fas fa-book"></i> Data Mata Kuliah 
            </a> 
        </li> 
        <li> 
            <a href="<?= base_url('ruang') ?>" class="<?= ($current_segment == 'ruang') ? 'active' : '' ?>"> 
                <i class="fas fa-door-open"></i> Data Ruang 
            </a> 
        </li> 
        <li> 
            <a href="<?= base_url('jadwal') ?>" class="<?= ($current_segment == 'jadwal' && $current_segment2 != 'tabel_mingguan') ? 'active' : '' ?>"> 
                <i class="fas fa-calendar-alt"></i> Data Jadwal 
            </a> 
        </li> 
        <li> 
            <a href="<?= base_url('jadwal/tabel_mingguan') ?>" class="<?= ($current_segment == 'jadwal' && $current_segment2 == 'tabel_mingguan') ? 'active' : '' ?>"> 
                <i class="fas fa-table"></i> Tabel Jadwal 
            </a> 
        </li> 
    </ul> 
</nav> 
 
<div class="content"> 
    <div class="page-header d-flex justify-content-between align-items-center"> 
        <h4><?= $title ?></h4> 
        <nav aria-label="breadcrumb"> 
            <ol class="breadcrumb mb-0"> 
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li> 
                <li class="breadcrumb-item active"><?= $title ?></li> 
            </ol> 
        </nav> 
    </div>
    
    <?php if (isset($session) && $session->flashdata('message')): ?> 
    <div class="alert alert-success alert-dismissible fade show" role="alert"> 
        <?= $session->flashdata('message') ?> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div> 
    <?php endif; ?> 
     
    <?php if (isset($session) && $session->flashdata('error')): ?> 
    <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
        <?= $session->flashdata('error') ?> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
    </div> 
    <?php endif; ?>