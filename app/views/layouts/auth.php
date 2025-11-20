<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= $title ?? 'Login' ?></title>

<!-- AdminLTE (local dist) -->
<link rel="stylesheet" href="/assets/vendor/adminlte/dist/css/adminlte.min.css">

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- jQuery CDN (AdminLTE 4 may not require jQuery for core, but some plugins use it) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body class="hold-transition login-page">
<?= $content ?? '' ?>
<script src="/assets/vendor/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
