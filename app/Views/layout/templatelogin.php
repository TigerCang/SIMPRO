<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?= lang('app.xprojek') . " | " . lang('app.xdesc') ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="SIMPro DeskApp">
    <meta name="author" content="#">

    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url('assets') ?>/images/favicon.ico" type="image/gif">
    <link rel="icon" href="<?= base_url('assets') ?>/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('libraries') ?>/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('libraries') ?>/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('libraries') ?>/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('libraries') ?>/assets/icon/feather/css/feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('libraries') ?>/assets/css/style.css">
    <!-- extra css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('libraries') ?>/bower_components/extra/css/extra.css">

</head>

<body class="fix-menu">
    <!-- preloader -->
    <?= $this->include('layout/preloader') ?>

    <!-- Main content -->
    <?= $this->renderSection('contentlogin') ?>

    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/assets/js/common-pages.js"></script>
    <!-- data-table js -->
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- extra js -->
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/extra.js"></script>
    <script type="text/javascript" src="<?= base_url('libraries') ?>/bower_components/extra/js/kursor.js"></script>
</body>

</html>