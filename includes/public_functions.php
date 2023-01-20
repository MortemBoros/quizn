<?php
$group_name = "";
$group_code = "";
$user_id = "";
$errors = array(); 

error_reporting(E_ALL ^ E_WARNING);
$user_id = $_SESSION['user']['id'];


$question_active_check_query = "SELECT question, A, B, C, D, chosen, correct_answer  FROM images  WHERE chosen = 'y' LIMIT 1";   
$result_question_check = mysqli_query($conn, $question_active_check_query); 
$question_active = mysqli_fetch_assoc($result_question_check); 

$user_point_check_query = "SELECT  points FROM users  WHERE id = '$user_id'";   
$result_user_point = mysqli_query($conn, $user_point_check_query); 
$user_score = mysqli_fetch_assoc($result_user_point); 


if (isset($_POST['answera'])) {
	$answer = $question_active['A'];
	echo $answer;
	answering($answer);
}

if (isset($_POST['answerb'])) {
	$answer = $question_active['B'];
	answering($answer);
}

if (isset($_POST['answerc'])) {
	$answer = $question_active['C'];
	answering($answer);
}

if (isset($_POST['answerd'])) {
	$answer = $question_active['D'];
	answering($answer);
}



function answering($answer) {
	global $conn, $question_active, $user_score, $user_id;	
	$correct_answer = $question_active['correct_answer'];
	$user_points = $user_score['points'];
	if ($answer === $correct_answer) {
		$query = "UPDATE users SET points = '$user_points' +1 WHERE id = $user_id";
		mysqli_query($conn, $query);
		header('location: waiting.php');
		exit(0);
	}
	else{
		header('location: waiting.php');
		exit(0);
	}
}



if (isset($_POST['create_group'])) {
	createGroup($_POST);
} 

function createGroup($request_values){
	global $conn, $errors, $group_name, $group_code;
	$user_name = $_SESSION['user']['tel'];
	$group_name = esc($_POST['group_name']);
	$group_code = esc($_POST['group_code']);
	if(empty($group_code)) { array_push($errors, "We need the Group Code"); }
	$group_check_query = "SELECT * FROM playerGroups WHERE group_code = '$group_code'";
	$result = mysqli_query($conn, $group_check_query);
	$group = mysqli_fetch_assoc($result);
	if ($group) {
		if ($group['group_code'] === $group_code){
			if ($group['user_1'] === 'n') {
				$query = "UPDATE playerGroups Set user_1 = '$user_name' WHERE group_code = '$group_code'";
				mysqli_query($conn, $query);
				header('location: question.php');				
				exit(0);
			}elseif ($group['user_2'] === 'n') {
				$query = "UPDATE playerGroups Set user_2 = '$user_name' WHERE group_code = '$group_code'";
				mysqli_query($conn, $query);
				header('location: question.php');				
				exit(0);
			}elseif ($group['user_3'] === 'n') {
				$query = "UPDATE playerGroups Set user_3 = '$user_name' WHERE group_code = '$group_code'";
				mysqli_query($conn, $query);
				header('location: question.php');				
				exit(0);
			}elseif ($group['user_4'] === 'n') {
				$query = "UPDATE playerGroups Set user_4 = '$user_name' WHERE group_code = '$group_code'";
				mysqli_query($conn, $query);
				header('location: question.php');				
				exit(0);
			}else{
				array_push($errors, "Group is full");
			}
		}
	}elseif (empty($errors)){
	$query = "INSERT INTO playerGroups (group_code, group_name, user_1) VALUES ('$group_code','$group_name','$user_name')";
	mysqli_query($conn, $query);
	header('location: question.php');				
	exit(0);
	}
}


function esc(String $value){	
	// bring the global db connect object into function
	global $conn;

	$val = trim($value); // remove empty space sorrounding string
	$val = mysqli_real_escape_string($conn, $value);

	return $val;
}

function questionPageLinker(){
	header('location: question.php');
	exit(0);
}
function waitingPageLinker(){
	header('location: waiting.php');
	exit(0);
}


?>