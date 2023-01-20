<div class="header">
	<div class="logo">
		<a href="<?php echo 'dashboard.php' ?>">
			<h1>QuizNight - Admin</h1>
		</a>
	</div>
	<div class="user-info">
		<span><?php echo $_SESSION['user']['name'] ?></span> &nbsp; &nbsp; <a href="<?php echo '../logout.php'; ?>" class="logout-btn">logout</a>
	</div>
</div>