<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Billing ISP' ?></title>

    <!-- AdminLTE 4 CSS (Local) -->
    <link rel="stylesheet" href="/assets/vendor/adminlte/dist/css/adminlte.min.css">

    <!-- FontAwesome (CDN) -->
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" 
          integrity="sha512-pIVp27D...==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

</head>

<body class="layout-fixed sidebar-mini" data-bs-theme="dark">

<div class="wrapper">

    <!-- NAVBAR -->
    <?php require_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- SIDEBAR -->
    <?php require_once __DIR__ . '/../partials/sidebar.php'; ?>

    <!-- MAIN CONTENT -->
    <div class="content-wrapper px-3 py-2">

        <!-- Page header (breadcrumb optional) -->
        <?php if (!empty($pageTitle)): ?>
            <div class="content-header">
                <h4 class="fw-bold"><?= $pageTitle ?></h4>
            </div>
        <?php endif; ?>

        <section class="content">
            <?php require $viewPath; ?>
        </section>
        
        <?php require_once __DIR__ . '/../partials/footer.php'; ?>


    </div>

</div>

<!-- jQuery (CDN) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- AdminLTE JS (Local) -->
<script src="/assets/vendor/adminlte/dist/js/adminlte.min.js"></script>

<!-- Bootstrap 5 (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="/assets/js/app.js"></script>

</body>
</html>
