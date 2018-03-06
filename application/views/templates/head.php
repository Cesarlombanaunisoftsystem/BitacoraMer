<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title> <?php if(isset($profile)&& $titulo) { echo $profile . '|' . $titulo;} else if(isset($profile)){ echo $profile; } else { echo $titulo; }  ?></title>
  <!-- Plugins  -->
  <!-- alertify -->
  <link rel="stylesheet" href="<?= base_url('plugins/alertify/css/alertify.css')?>">
  <!-- select2 -->
  <link rel="stylesheet" href="<?= base_url('plugins/select2/select2.css')?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('plugins/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('plugins/font-awesome-4.7.0/css/font-awesome.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
  <!-- Datepicker -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- jquery confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <!-- custom -->
  <link rel="stylesheet" href="<?= base_url('plugins/iCheck/all.css')?>">
  <link rel="stylesheet" href="<?= base_url('dist/css/AdminLTE.css')?>">
  <link rel="stylesheet" href="<?= base_url('dist/css/skins/_all-skins.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('dist/css/style.css')?>">
