<?php include('../config.php') ?>
<?php include 'includes/admin_functions.php'; ?>
<?php include('includes/head_section.php'); ?>
	<title>Admin | Dashboard</title>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="<?php echo 'dashboard.php' ?>">
				<h1>QuizNight - Admin </h1>
			</a>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<div class="user-info">
				<span><?php echo $_SESSION['user']['name'] ?></span> &nbsp; &nbsp; 
				<a href="<?php echo '../logout.php'; ?>" class="logout-btn">logout</a>
			</div>
		<?php endif ?>
	</div>
	<div class="container dashboard">
		<h1>Welcome</h1>
		<div class="stats">
			<a href="users.php" class="first">
				<span>0</span> <br>
				<span>Newly registered users</span>
			</a>
			<a>
				<span>0</span> <br>
				<span>Published comments</span>
			</a>
		</div>
		<br><br><br>
		<div class="buttons">
			<a href="users.php">Add Users</a>
			<a href="images.php">Add Question</a>
		</div>
	</div>
	
</body>
</html>
