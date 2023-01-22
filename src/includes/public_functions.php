<?php
$group_name = "";
$group_code = "";
$user_id = "";
$errors = array(); 

error_reporting(E_ALL ^ E_WARNING);
$user_id = $_SESSION['user']['id'];


$question_active_check_query = "SELECT question, A, B, C, D, chosen, correct_answer  FROM images  WHERE chosen = 'y' LIMIT 1";   
$result_question_check = $conn->query($question_active_check_query); 
$question_active = $result_question_check->fetch_assoc(); 

$user_point_check_query = "SELECT  points FROM users  WHERE id = '$user_id'";   
$result_user_point = $conn->query($user_point_check_query); 
$user_score = $result_user_point->fetch_assoc(); 


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
		$conn->query($query);
		header('location: /src/waiting.php');
		exit(0);
	}
	else{
		header('location: /src/waiting.php');
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
	$result = $conn->query($group_check_query);
	$group = $result->fetch_assoc();
	if ($group) {
		if ($group['group_code'] === $group_code){
			if ($group['user_1'] === 'n') {
				$query = "UPDATE playerGroups Set user_1 = '$user_name' WHERE group_code = '$group_code'";
				$conn->query($query);
				header('location: /src/question.php');				
				exit(0);
			}elseif ($group['user_2'] === 'n') {
				$query = "UPDATE playerGroups Set user_2 = '$user_name' WHERE group_code = '$group_code'";
				$conn->query($query);
				header('location: /src/question.php');				
				exit(0);
			}elseif ($group['user_3'] === 'n') {
				$query = "UPDATE playerGroups Set user_3 = '$user_name' WHERE group_code = '$group_code'";
				$conn->query($query);
				header('location: /src/question.php');				
				exit(0);
			}elseif ($group['user_4'] === 'n') {
				$query = "UPDATE playerGroups Set user_4 = '$user_name' WHERE group_code = '$group_code'";
				$conn->query($query);
				header('location: /src/question.php');				
				exit(0);
			}else{
				array_push($errors, "Group is full");
			}
		}
	}elseif (empty($errors)){
	$query = "INSERT INTO playerGroups (group_code, group_name, user_1) VALUES ('$group_code','$group_name','$user_name')";
	$conn->query($query);
	header('location: question.php');				
	exit(0);
	}
}


function esc(String $value){	
	// bring the global db connect object into function
	global $conn;

	$val = trim($value); // remove empty space sorrounding string
	$val = $conn->real_escape_string($value);

	return $val;
}

function questionPageLinker(){
	header('location: /src/question.php');
	exit(0);
}
function waitingPageLinker(){
	header('location: /src/waiting.php');
	exit(0);
}


?>