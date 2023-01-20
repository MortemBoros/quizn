<?php include('../config.php') ?>
<?php  include('includes/admin_functions.php'); ?>
<?php include('includes/head_section.php'); ?>
<!-- Get all images from DB -->
<?php $images = getAllImages();	?>
	<title>Admin | Manage Questions</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include('includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include('includes/menu.php') ?>

		<!-- Middle form - to create and edit -->
		<div class="action">
			<h1 class="page-title">Create/Edit Questions</h1>
			<form method="post" action="<?php echo 'images.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include('../includes/errors.php') ?>
				<!-- if editing image, the id is required to identify that image -->
				<?php if ($isEditingImages === true): ?>
					<input type="hidden" name="image_id" value="<?php echo $image_id; ?>">
				<?php endif ?>
				<input type="text" name="question" value="<?php echo $question; ?>" placeholder="Image">
				<input type="text" name="A" value="<?php echo $A; ?>" placeholder="Answer A">
				<input type="text" name="B" value="<?php echo $B; ?>" placeholder="Answer B">
				<input type="text" name="C" value="<?php echo $C; ?>" placeholder="Answer C">
				<input type="text" name="D" value="<?php echo $D; ?>" placeholder="Answer D">
				<input type="text" name="correct_answer" value="<?php echo $correct_answer; ?>" placeholder="Correct answer">
				<!-- if editing image, display the update button instead of create button -->
				<?php if ($isEditingImages === true): ?> 
					<button type="submit" class="btn" name="update_image">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_image">Save Question</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include('../includes/messages.php') ?>
			<?php if (empty($images)): ?>
				<h1>No images in the database.</h1>
			<?php else: ?>
				<table class="table">
					<thead>
						<th>N</th>
						<th>Image Name</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
					<?php foreach ($images as $key => $image): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $image['question']; ?></td>
							<td>
								<a class="fa fa-pencil btn edit"
									href="images.php?edit-image=<?php echo $image['id'] ?>">
								</a>
							</td>
							<td>
								<a class="fa fa-trash btn delete"								
									href="images.php?delete-image=<?php echo $image['id'] ?>">
								</a>
							</td>
							<td>
								<a class="fa fa-bomb btn publish"
									href="images.php?publish-image=<?php echo $image['id'] ?>">
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>