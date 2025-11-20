<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= $title ?? 'Dashboard' ?></title>

<link rel="stylesheet" href="/assets/vendor/adminlte/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="layout-fixed sidebar-mini" data-bs-theme="dark">

<div class="wrapper">
    <?php require __DIR__ . '/../partials/navbar.php'; ?>
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <div class="content-wrapper px-3 py-2">
        <?php if (!empty($pageTitle)): ?>
            <div class="content-header"><h4 class="fw-bold"><?= $pageTitle ?></h4></div>
        <?php endif; ?>
        <section class="content">
            <?= $content ?? '' ?>
        </section>
    </div>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="/assets/vendor/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
