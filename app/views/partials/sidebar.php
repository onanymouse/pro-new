<?php
// /app/views/partials/sidebar.php

// --- Simple helper (replace getSetting() dengan implementasi nyata) ---
if (!function_exists('getSetting')) {
    function getSetting($key, $default = false) {
        // contoh: baca dari DB atau cache. Untuk sekarang return default supaya tidak error.
        // Ganti ini dengan query ke table notification_settings / settings_features.
        return $default;
    }
}

if (!function_exists('hasRole')) {
    function hasRole($roles = []) {
        if (!isset($_SESSION['user'])) return false;
        $role = $_SESSION['user']['role'] ?? '';
        if (!is_array($roles)) $roles = [$roles];
        return in_array($role, $roles);
    }
}

if (!function_exists('featureEnabled')) {
    function featureEnabled($featureKey) {
        // contoh pemakaian: featureEnabled('genieacs_enabled')
        return getSetting($featureKey, true); // default true
    }
}

// --- active link helper (simple) ---
$currentUrl = $_SERVER['REQUEST_URI'] ?? '';
function isActive($path) {
    global $currentUrl;
    return (strpos($currentUrl, $path) !== false) ? 'active' : '';
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/dashboard" class="brand-link">
        <span class="brand-text fw-bold">Billing ISP</span>
    </a>

    <div class="sidebar">
        <!-- User panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="#" class="d-block"><?= htmlspecialchars($_SESSION['user']['name']) ?> <small class="text-muted">(<?= $_SESSION['user']['role'] ?>)</small></a>
                <?php else: ?>
                    <a href="/login" class="d-block">Guest</a>
                <?php endif; ?>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-lte-toggle="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link <?= isActive('/dashboard') ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Customers -->
                <?php if(hasRole(['superadmin','admin','teknisi','kolektor'])): ?>
                <li class="nav-item <?= isActive('/customers') ?>">
                    <a href="#" class="nav-link <?= (isActive('/customers') ? 'active' : '') ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pelanggan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if(hasRole(['superadmin','admin','teknisi'])): ?>
                        <li class="nav-item">
                            <a href="/customers" class="nav-link <?= isActive('/customers') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Daftar Pelanggan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/customers/create" class="nav-link <?= isActive('/customers/create') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Tambah Pelanggan</p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(hasRole('kolektor')): ?>
                        <li class="nav-item">
                            <a href="/collector/customers" class="nav-link <?= isActive('/collector') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Pelanggan Saya</p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a href="/customers/import" class="nav-link <?= isActive('/customers/import') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Import CSV</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Packages -->
                <?php if(hasRole(['superadmin','admin'])): ?>
                <li class="nav-item">
                    <a href="/packages" class="nav-link <?= isActive('/packages') ?>">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>Paket Internet</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Routers / MikroTik -->
                <?php if(hasRole(['superadmin','admin','teknisi'])): ?>
                <li class="nav-item <?= isActive('/routers') ?>">
                    <a href="#" class="nav-link <?= (isActive('/routers') ? 'active' : '') ?>">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p>
                            MikroTik / Router
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/routers" class="nav-link <?= isActive('/routers') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Daftar Router</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/routers/monitor" class="nav-link <?= isActive('/routers/monitor') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Monitoring Router</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/routers/queues" class="nav-link <?= isActive('/routers/queues') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Queues & QoS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/routers/tools" class="nav-link <?= isActive('/routers/tools') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Tools (Ping, Traceroute)</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- GenieACS / TR-069 (opsional feature) -->
                <?php if(featureEnabled('genieacs_enabled') && hasRole(['superadmin','admin','teknisi'])): ?>
                <li class="nav-item">
                    <a href="/genieacs" class="nav-link <?= isActive('/genieacs') ?>">
                        <i class="nav-icon fas fa-satellite-dish"></i>
                        <p>GenieACS (TR-069)</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Invoices / Tagihan -->
                <?php if(hasRole(['superadmin','admin','kolektor'])): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link <?= (isActive('/invoices') ? 'active' : '') ?>">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Tagihan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/invoices" class="nav-link <?= isActive('/invoices') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Daftar Tagihan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/invoices/generate" class="nav-link <?= isActive('/invoices/generate') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Generate Otomatis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/invoices/overdue" class="nav-link <?= isActive('/invoices/overdue') ?>">
                                <i class="far fa-circle nav-icon"></i><p>Tunggakan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Payments -->
                <?php if(hasRole(['superadmin','admin','kolektor','pelanggan'])): ?>
                <li class="nav-item">
                    <a href="/payments" class="nav-link <?= isActive('/payments') ?>">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Kolektor management -->
                <?php if(hasRole(['superadmin','admin'])): ?>
                <li class="nav-item">
                    <a href="/collectors" class="nav-link <?= isActive('/collectors') ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Kolektor</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Ticketing / Support -->
                <?php if(hasRole(['superadmin','admin','teknisi','pelanggan'])): ?>
                <li class="nav-item">
                    <a href="/tickets" class="nav-link <?= isActive('/tickets') ?>">
                        <i class="nav-icon fas fa-headset"></i>
                        <p>Tiket / Support</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Reports -->
                <?php if(hasRole(['superadmin','admin'])): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link <?= (isActive('/reports') ? 'active' : '') ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/reports/finance" class="nav-link <?= isActive('/reports/finance') ?>"><i class="far fa-circle nav-icon"></i><p>Keuangan</p></a></li>
                        <li class="nav-item"><a href="/reports/usage" class="nav-link <?= isActive('/reports/usage') ?>"><i class="far fa-circle nav-icon"></i><p>Penggunaan Bandwidth</p></a></li>
                        <li class="nav-item"><a href="/reports/router" class="nav-link <?= isActive('/reports/router') ?>"><i class="far fa-circle nav-icon"></i><p>Router / OLT</p></a></li>
                        <li class="nav-item"><a href="/reports/collector" class="nav-link <?= isActive('/reports/collector') ?>"><i class="far fa-circle nav-icon"></i><p>Per Kolektor</p></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Settings & Integrations -->
                <?php if(hasRole(['superadmin'])): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link <?= (isActive('/settings') ? 'active' : '') ?>">
                        <i class="nav-icon fas fa-gear"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/settings/features" class="nav-link <?= isActive('/settings/features') ?>"><i class="far fa-circle nav-icon"></i><p>Feature Toggle</p></a></li>
                        <li class="nav-item"><a href="/settings/integrations" class="nav-link <?= isActive('/settings/integrations') ?>"><i class="far fa-circle nav-icon"></i><p>Integrasi (MikroTik / GenieACS)</p></a></li>
                        <li class="nav-item"><a href="/settings/notifications" class="nav-link <?= isActive('/settings/notifications') ?>"><i class="far fa-circle nav-icon"></i><p>Notifikasi (WA / Telegram)</p></a></li>
                        <li class="nav-item"><a href="/settings/system" class="nav-link <?= isActive('/settings/system') ?>"><i class="far fa-circle nav-icon"></i><p>System & Backup</p></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Tools & Utilities (role-based smaller access) -->
                <li class="nav-item">
                    <a href="#" class="nav-link <?= (isActive('/tools') ? 'active' : '') ?>">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Tools
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if(hasRole(['superadmin','admin','teknisi'])): ?>
                        <li class="nav-item"><a href="/tools/ping" class="nav-link <?= isActive('/tools/ping') ?>"><i class="far fa-circle nav-icon"></i><p>Ping</p></a></li>
                        <li class="nav-item"><a href="/tools/speedtest" class="nav-link <?= isActive('/tools/speedtest') ?>"><i class="far fa-circle nav-icon"></i><p>Speedtest</p></a></li>
                        <?php endif; ?>

                        <?php if(hasRole(['superadmin','admin'])): ?>
                        <li class="nav-item"><a href="/tools/db-backup" class="nav-link <?= isActive('/tools/db-backup') ?>"><i class="far fa-circle nav-icon"></i><p>Backup DB</p></a></li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- Logs & System -->
                <?php if(hasRole(['superadmin','admin'])): ?>
                <li class="nav-item">
                    <a href="/logs" class="nav-link <?= isActive('/logs') ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>System Logs</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Logout -->
                <li class="nav-item mt-3">
                    <a href="/logout" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
