<?php 
require __DIR__ . '/env.php';
$user_tel = $_SESSION['user']['tel'];


$group_user_check_query = "SELECT user_1, user_2, user_3, user_4 FROM playerGroups WHERE user_1 = '$user_tel' OR user_2 = '$user_tel' OR user_3 = '$user_tel' OR user_4 = '$user_tel'";
$result_group_user = $conn->query($group_user_check_query);
$group_user = $result_group_user->fetch_assoc(); 
 
if ($group_user) { 
?>
	<div class="form" style="width: 40%; margin: 20px auto">
		<h1 align="center" >You are set <?php echo $_SESSION['user']['name'] ?></h1>
		<a href="question.php" class="button-27">Start the Game</a>
	</div>
<?php }else{ ?>
		<h1 align="center"> Lets set up your team: </h1>
      
        <div class="form" style="width: 40%; margin: 20px auto">
          <form method="post" action="<?php echo 'index.php'; ?>">
          <?php include('/includes/errors.php') ?>

              <input type="group_name" name="group_name" value="<?php echo $group_name; ?>" placeholder="Group Name">
            <input type="group_code" name="group_code" value="<?php echo $group_code; ?>" placeholder="Group Code">
              <button type="submit" class="button-27" name="create_group">Start</button>
          </form>
        </div>

<?php } ?>