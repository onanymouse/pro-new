<?php
// Ambil user login
$user = $_SESSION['user'] ?? null;
?>

<nav class="main-header navbar navbar-expand navbar-dark bg-dark">

    <!-- Sidebar toggle -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <!-- Breadcrumb optional -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar -->
    <ul class="navbar-nav ms-auto">

        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge bg-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">3 Notifications</span>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users me-2"></i> Pelanggan baru terdaftar
                </a>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file-invoice-dollar me-2"></i> Tagihan jatuh tempo
                </a>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-network-wi
