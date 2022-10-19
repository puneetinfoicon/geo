<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PageBuilder</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=0.9, user-scalable=no">

<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/grapesjs@0.15.9/dist/css/grapes.min.css">-->
    <link rel="stylesheet" href="<?= asset('public/assets/pcss/grapes.min.css')?>">
    <link rel="stylesheet" href="<?= asset('public/assets/pcss/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= asset('public/assets/pcss/bootstrap-select.min.css')?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= asset('public/assets/pcss/toastr.min.css')?>">
    <link rel="stylesheet" href="<?= phpb_asset('pagebuilder/app.css') ?>">
    <?= $pageBuilder->customStyle(); ?>

    <script src="<?= asset('public/assets/pjs/grapes.min.js')?>"></script>
    <script src="<?= asset('public/assets/pjs/underscore-min.js')?>"></script>
    <script src="<?= asset('public/assets/pjs/jquery-3.4.1.min.js')?>"></script>
    <script src="<?= asset('public/assets/pjs/popper.min.js')?>"></script>
    <script src="<?= asset('public/assets/pjs/bootstrap.min.js')?>"></script>
    <script src="<?= asset('public/assets/pjs/bootstrap-select.min.js')?>"></script>
    <script src="<?= asset('public/assets/pjs/toastr.min.js')?>"></script>
    <script src="<?= asset('public/assets/pjs/beautify-html.min.js')?>"></script>
    <?= $pageBuilder->customScripts('head'); ?>
</head>

<body>

<?php
require __DIR__ . '/pagebuilder.php';
?>

<script src="<?= phpb_asset('pagebuilder/app.js') ?>"></script>
<?= $pageBuilder->customScripts('body'); ?>

<script>
    function qqqq(){
        // $('.ig1').attr('src',"assets/img/icon/Arrow-left.svg");
        // $('.ig2').attr('src',"assets/img/icon/Arrow-left.svg");
    }
    setInterval(function() {
        qqqq();
    }, 100);
</script>
</body>
</html>
