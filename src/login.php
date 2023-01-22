<?php  require __DIR__ . '/env.php'; ?>
<?php require __DIR__ . '/includes/public_functions.php'; ?>
<?php require __DIR__ . '/includes/head_section.php'; ?>
	<title>Quiznight | Sign in </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
	<?php require __DIR__ . '/includes/navbar.php'; ?>
	<!-- // Navbar -->


	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="/src/login.php" >
			<h2>Login</h2>
			<?php require __DIR__ . '/includes/errors.php'; ?>
			<input type="text" name="tel" value="<?php echo $tel; ?>" placeholder="Phone number  ex:5380000" pattern="[0-9]{10}">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" class="btn" name="login_btn">Login</button>
			<p>
				Not yet a member? <a href="/src/register.php">Sign up</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->

<!-- Footer -->
<?php require __DIR__ . '/includes/footer.php'; ?>
<!-- // Footer -->