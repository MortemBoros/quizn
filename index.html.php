<?php require_once('config.php') ?>
<?php  include('includes/public_functions.php'); ?>
<?php require_once('includes/head_section.php') ?>
  <title>QuizNight | Home </title>
</head>
<body>
  <!-- container - wraps whole page -->
  <div class="container">
    <!-- navbar -->
    <?php include('includes/navbar.php') ?>
    <!-- // navbar -->

    <!-- banner -->
    <?php include('includes/banner.php') ?>
    <!-- // banner -->
<?php if (isset($_SESSION['user']['tel'])) { ?>
    <!-- Page content -->
    <div class="content">
      <hr>     
      <h1 align="center"> The game Will start soon... </h1>
      <?php include('includes/grouping.php') ?>
    </div>
<?php } ?>
    <br>


    
    <!-- // Page content -->


    <!-- footer -->
    <?php include('includes/footer.php') ?>
    <!-- // footer -->