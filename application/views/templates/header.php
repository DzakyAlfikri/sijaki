<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistem Penjadwalan Kuliah</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }
        .sidebar {
            background-color: var(--secondary-color);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            color: white;
            transition: all 0.3s;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }
        .sidebar-header {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.1);
        }
        .sidebar-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .sidebar ul.components {
            padding: 20px 0;
        }
        .sidebar ul li a {
            padding: 12px 20px;
            display: block;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--primary-color);
        }
        .sidebar ul li a.active {
            background-color: var(--primary-color);
            color: white;
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        .page-header {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: bold;
            padding: 15px 20px;
            border-radius: 5px 5px 0 0;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }
        .table th {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        .dashboard-stats .card {
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s;
        }
        .dashboard-stats .card:hover {
            transform: translateY(-5px);
        }
        .dashboard-stats .card-body {
            padding: 20px;
        }
        .dashboard-stats .number {
            font-size: 2rem;
            font-weight: bold;
        }
        .dashboard-stats .card-title {
            font-size: 1rem;
            color: #6c757d;
        }
        .dashboard-stats .icon {
            font-size: 2rem;
            color: var(--primary-color);
            opacity: 0.8;
        }
        .jadwal-table {
            overflow-x: auto;
        }
        .jadwal-table th, .jadwal-table td {
            min-width: 120px;
        }
        .jadwal-item {
            background-color: var(--primary-color);
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .alert-dismissible .btn-close {
            padding: 0.75rem 1rem;
        }
    </style>
</head>
<body>
    <div class="wrapper">
