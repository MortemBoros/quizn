<?php  require __DIR__ . '/env.php'; ?>
<!-- Source code for handling registration and login -->
<?php  require __DIR__ . '/includes/registration_login.php'; ?>

<?php require __DIR__ . '/includes/head_section.php'; ?>

<title>Quiznight | Sign up </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include __DIR__ . '/includes/navbar.php'; ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="/src/register.php" >
			<h2>Register on Quiznight w/ Berke Can Kuyucular</h2>
			<?php include  __DIR__ . '/includes/errors.php' ?>
			<input  type="text" name="name" value="<?php echo $name; ?>"  placeholder="Name">
			<input  type="text" name="lastname" value="<?php echo $lastname; ?>"  placeholder="Last Name">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			<input  type="text" name="tel" value="<?php echo $tel; ?>"  placeholder="Phone number ex:5380000" pattern="[0-9]{10}">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" class="btn" name="reg_user">Register</button>
			<p>
			<form action="<?php echo '/index.php'; ?>" method="post" >
				Already a member? <a href="/src/login.php">Sign in</a>
			</form>
			</p>
		</form>
	</div>
</div>
<!-- // container -->
<!-- Footer -->
<?php require __DIR__ . '/includes/footer.php'; ?>
<!-- // Footer -->