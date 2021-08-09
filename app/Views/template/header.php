<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4.0.5/bootstrap-4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/sl-1.3.1/datatables.min.css"/>

    <?php if($_SESSION['role'] == 'Superadmin'): ?>
      <link rel="stylesheet" href="/css/superadmin/style.css">
    <?php elseif($_SESSION['role'] == 'Admin'): ?>
      <link rel="stylesheet" href="/css/admin/admin.css">
    <?php else: ?>
    <link rel="stylesheet" href="/css/student/student.css">
    <?php endif; ?>

    <title>ODRS</title>

  </head>
  <?php if($_SESSION['role'] == 'Admin'): ?>
    <body class="d-flex flex-column vh-100">
  <?php endif;?>
    <body>


    <?php if($_SESSION['role'] == 'Superadmin'): ?>
      <?= view('template/superadmin') ?>
      <?= view('template/sidebar') ?>
    <?php elseif($_SESSION['role'] == 'Admin'): ?>
      <?= view('template/admin') ?>
    <?php else: ?>
      <?= view('template/user')?>
    <?php endif; ?>


    <main class="page-content" id="content">

      <!-- sidebar-wrapper  -->
