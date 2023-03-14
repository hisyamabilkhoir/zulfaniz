<!doctype html>
<html lang="en">

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('login') ?>/css/style.css">
    <style>
        .ftco-section {
            padding: 2em 0 !important;
        }

        body {
            background-image: url("<?= base_url('login/img/bg-login.jpg') ?>");
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <!-- contennt -->
    <?= $this->renderSection("page_content") ?>

    <script src="<?= base_url('login') ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('login') ?>/js/popper.js"></script>
    <script src="<?= base_url('login') ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('login') ?>/js/main.js"></script>
</body>

</html>