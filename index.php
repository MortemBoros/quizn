<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . 'src/env.php';
?>

<?php require __DIR__ . '/src/includes/public_functions.php'; ?>
<?php require __DIR__ . '/src/includes/head_section.php'; ?>

    <title>QuizNight | Home </title>
</head>
<body>
  <!-- container - wraps whole page -->
  <div class="container">
    <!-- navbar -->
    <?php require __DIR__ . '/src/includes/navbar.php'; ?>
    <!-- // navbar -->

    <!-- banner -->
    <?php require __DIR__ . '/src/includes/banner.php'; ?>
    <!-- // banner -->
<?php if (isset($_SESSION['user']['tel'])) { ?>
    <!-- Page content -->
    <div class="content">
      <hr>     
      <h1 align="center"> The game Will start soon... </h1>
      <?php require __DIR__ . '/src/includes/grouping.php'; ?>
    </div>
<?php } ?>
    <br>


    
    <!-- // Page content -->


    <!-- footer -->
    <?php require __DIR__ . '/src/includes/footer.php'; ?>
    <!-- // footer -->

