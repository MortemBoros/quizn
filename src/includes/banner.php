<?php if (isset($_SESSION['user']['tel'])) { ?>
	<div class="logged_in_info">
		<span>Welcome <?php echo $_SESSION['user']['name'] ?></span>
		|
		<span><a href="/src/logout.php">Logout</a></span>
	</div>
<?php }else{ ?>
	<div class="banner">
		<div class="welcome_msg">
			<h1>Today's Inspiration</h1>
			<p> 
			    One day your life <br> 
			    will flash before your eyes. <br> 
			    Make sure it's worth watching. <br>
				<span>~ Gerard Way</span>
			</p>
			<form action="<?php echo '/index.php'; ?>" method="post" >
			<button class="btn" type="submit" name="loginlinker">Join us!</button>
			</form>
		</div>

		<div class="login_div">
			<form action="<?php echo '/index.php'; ?>" method="post" >
				<h2>Login</h2>
				<div style="width: 60%; margin: 0px auto;">
					<?php include('errors.php') ?>
				</div>
				<input type="text" name="tel" value="<?php echo $tel; ?>" placeholder="Phone number">
				<input type="password" name="password"  placeholder="Password"> 
				<button class="btn" type="submit" name="login_btn">Sign in</button>
			</form>
		</div>
	</div>
<?php } ?>