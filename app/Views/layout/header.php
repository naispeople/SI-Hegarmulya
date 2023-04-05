<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?? 'Dashboard'; ?> | SI Hegar Mulya</title>

<!-- Custom fonts for this template-->
<link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <!-- Kasir React Library -->
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
  <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?= $this->include('layout/sidebar') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">