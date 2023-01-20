<?php 
// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$name = "";
$lastname = "";
$role = "";
$email = "";
$tel = "";
// general variables
$errors = [];

$image_id = 0;
$isEditingImages = false;
$question = "";
$A = "";
$B = "";
$C = "";
$D = "";
$chosen = "";
$correct_answer = "";


/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// if user clicks the create admin button
if (isset($_POST['create_admin'])) {
	createAdmin($_POST);
}
// if user clicks the Edit admin button
if (isset($_GET['edit-admin'])) {
	$isEditingUser = true;
	$admin_id = $_GET['edit-admin'];
	editAdmin($admin_id);
}
// if user clicks the update admin button
if (isset($_POST['update_admin'])) {
	updateAdmin($_POST);
}
// if user clicks the Delete admin button
if (isset($_GET['delete-admin'])) {
	$admin_id = $_GET['delete-admin'];
	deleteAdmin($admin_id);
}

/* - - - - - - - - - - 
-  Image actions
- - - - - - - - - - -*/
// if user clicks the create image button
if (isset($_POST['create_image'])) { createImage($_POST); }
// if user clicks the Edit image button
if (isset($_GET['edit-image'])) {
	$isEditingImages = true;
	$image_id = $_GET['edit-image'];
	editImage($image_id);
}
// if user clicks the update image button
if (isset($_POST['update_image'])) {
	updateImage($_POST);
}
// if user clicks the Delete image button
if (isset($_GET['delete-image'])) {
	$image_id = $_GET['delete-image'];
	deleteImage($image_id);
}
if (isset($_GET['publish-image'])) {
	$image_id = $_GET['publish-image'];
	publishImage($image_id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new admin data from form
* - Create new admin user
* - Returns all admin users with their roles 
* * * * * * * * * * * * * * * * * * * * * * */
function createAdmin($request_values){
	global $conn, $errors, $role, $name, $lastname, $tel, $email;
	$name = esc($request_values['name']);
	$lastname = esc($request_values['lastname']);
	$email = esc($request_values['email']);
	$tel = esc($request_values['tel']);
	$password = esc($request_values['password']);

	if(isset($request_values['role'])){
		$role = esc($request_values['role']);
	}
	// form validation: ensure that the form is correctly filled
	if (empty($name)) { array_push($errors, "Uhmm...We gonna need the name"); }
	if (empty($lastname)) { array_push($errors, "Uhmm...We gonna need the lastname"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($tel)) { array_push($errors, "Uhmm...We gonna need the phone number"); }
	if (empty($role)) { array_push($errors, "Role is required for admin users");}
	if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }

	// Ensure that no user is registered twice. 
	// the email and usernames should be unique
	$user_check_query = "SELECT * FROM users WHERE tel='$tel' 
							OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	if ($user) { // if user exists
		if ($user['tel'] === $tel) {
		  array_push($errors, "Phone number already exists");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "Email already exists");
		}
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database
		$query = "INSERT INTO users (name, lastname, email, tel, role, password, created_at, updated_at) 
				  VALUES('$name', '$lastname', '$email', '$tel', '$role', '$password', now(), now())";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user created successfully";
		header('location: users.php');
		exit(0);
	}
}



/* * * * * * * * * * * * * * * * * * * * *
* - Takes admin id as parameter
* - Fetches the admin from database
* - sets admin fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editAdmin($admin_id)
{
	global $conn, $tel, $role, $isEditingUser, $admin_id, $email;

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$admin = mysqli_fetch_assoc($result);

	// set form values ($tel and $email) on the form to be updated
	$tel = $admin['tel'];
	$email = $admin['email'];
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Receives admin request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateAdmin($request_values){
	global $conn, $errors, $role, $tel, $isEditingUser, $admin_id, $email, $name, $lastname;
	// get id of the admin to be updated
	$admin_id = $request_values['admin_id'];
	// set edit state to false
	$isEditingUser = false;


	$name = esc($request_values['name']);
	$lastname = esc($request_values['lastname']);
	$email = esc($request_values['email']);
	$tel = esc($request_values['tel']);
	$password = esc($request_values['password']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//encrypt the password (security purposes)
		$password = md5($password);

		$query = "UPDATE users SET name='$name', lastname='$lastname', email='$email', tel='$tel', role='$role', password='$password' WHERE id=$admin_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user updated successfully";
		header('location: users.php');
		exit(0);
	}
}
// delete admin user 
function deleteAdmin($admin_id) {
	global $conn;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header("location: users.php");
		exit(0);
	}
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all admin users and their corresponding roles
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getAdminUsers(){
	global $conn, $roles;
	$sql = "SELECT * FROM users WHERE role IS NOT NULL";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}
/* * * * * * * * * * * * * * * * * * * * *
* - Escapes form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}
// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

/* - - - - - - - - - - 
-  Image functions
- - - - - - - - - - -*/
// get all images from DB
function getAllImages() {
	global $conn;
	$sql = "SELECT * FROM linkImages";
	$result = mysqli_query($conn, $sql);
	$images = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $images;
}
function createImage($request_values){
	global $conn, $errors, $image_name, $A, $B, $C, $D, $correct_answer;
	$image_name = esc($request_values['question']);
	$A = esc($request_values['A']);
	$B = esc($request_values['B']);
	$C = esc($request_values['C']);
	$D = esc($request_values['D']);
	$correct_answer = esc($request_values['correct_answer']);
	if (empty($image_name)) { 
		array_push($errors, "Image name required"); 
	}
	if (empty($A)) { 
		array_push($errors, "Answer A required"); 
	}
	if (empty($B)) { 
		array_push($errors, "Answer B required"); 
	}
	if (empty($C)) { 
		array_push($errors, "Answer C required"); 
	}
	if (empty($D)) { 
		array_push($errors, "Answer D required"); 
	}
	if (empty($correct_answer)) { 
		array_push($errors, "Correct answer required"); 
	}
	// Ensure that no image is saved twice. 
	$image_check_query = "SELECT * FROM linkImages WHERE question='$image_name' LIMIT 1";
	$result = mysqli_query($conn, $image_check_query);
	if (mysqli_num_rows($result) > 0) { // if image exists
		array_push($errors, "Image already exists");
	}
	// register image if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO images (question, A, B, C, D, correct_answer) 
				  VALUES('$image_name', '$A', '$B', '$C', '$D', '$correct_answer')";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Question created successfully";
		header('location: images.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes image id as parameter
* - Fetches the image from database
* - sets image fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editImage($image_id) {
	global $conn, $image_name, $isEditingImages, $image_id;
	$sql = "SELECT * FROM linkImages WHERE id=$image_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$images = mysqli_fetch_assoc($result);
	// set form values ($image_name) on the form to be updated
	$image_name = $images['question'];
}
function updateImage($request_values) {
	global $conn, $errors, $image_name, $image_id, $A, $B, $C, $D, $correct_answer;
	$image_name = esc($request_values['image_name']);
	$image_id = esc($request_values['image_id']);
	// validate form
	if (empty($image_name)) { 
		array_push($errors, "Image name required"); 
	}
	if (empty($A)) { 
		array_push($errors, "Answer A required"); 
	}
	if (empty($B)) { 
		array_push($errors, "Answer B required"); 
	}
	if (empty($C)) { 
		array_push($errors, "Answer C required"); 
	}
	if (empty($D)) { 
		array_push($errors, "Answer D required"); 
	}
	if (empty($correct_answer)) { 
		array_push($errors, "Correct answer required"); 
	}
	// register image if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE linkImages SET question='$image_name', A='$A', B='$B', C='$C', D='$D', correct_answer='$correct_answer' WHERE id=$image_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Question updated successfully";
		header('location: images.php');
		exit(0);
	}
}
// delete image 
function deleteImage($images_id) {
	global $conn;
	$sql = "DELETE FROM linkImages WHERE id=$images_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "Image successfully deleted";
		header("location: images.php");
		exit(0);
	}
}

function publishImage($image_id) {
	global $conn, $image_name, $image_id, $chosen;
	$query = "UPDATE linkImages SET chosen = ''";
	mysqli_query($conn, $query);
	$query2 = "UPDATE linkImages SET chosen = 'y' WHERE id=$image_id ";
	mysqli_query($conn, $query2);
}