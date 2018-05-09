<?php
	// $user_name = $_POST["username"];
	// echo $user_name;

	// if (isset($_POST["username"])) {
	// 	$user_name = $_POST["username"];
	// } else {
	// 	$user_name = "No Name";
	// }

	$user_name = (isset($_POST["username"])) ? $_POST["username"] : "No Name";

	$message = "Hello, {$user_name}";
	$return = [
		"userName" => $user_name,
		"computedString" => $message
	];

	echo json_encode($return);
?>