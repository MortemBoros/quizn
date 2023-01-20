<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>
<?php  include('includes/head_section.php'); ?>
	<title>LifeBlog | Sign in </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
	<?php include('includes/navbar.php'); ?>
	<!-- // Navbar -->


	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="login.php" >
			<h2>Login</h2>
			<?php include('includes/errors.php') ?>
			<input type="text" name="tel" value="<?php echo $tel; ?>" placeholder="Phone number  ex:5380000" pattern="[0-9]{10}">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" class="btn" name="login_btn">Login</button>
			<p>
				Not yet a member? <a href="register.php">Sign up</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->

<!-- Footer -->
	<?php include('includes/footer.php'); ?>
<!-- // Footer -->