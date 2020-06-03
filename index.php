<?php 
	session_start(); 
	if (!isset($_SESSION['mode'])){
		$_SESSION['mode'] = "Display";
	}
	require_once("./includes/db_connection.php"); 
	require_once("./includes/formBasicInfo.php");
	require_once("./includes/formSatisAndRecom.php");
	require_once("./includes/formYourPurchases.php");
	require_once("./includes/formSurveySave.php");
	require_once("./includes/clearSurveyFromSession.php");
	require_once("./includes/displayErrors.php");
	require_once("./includes/formThankDisplay.php");
?>
<html>
	<head>
		<title>Welcome to Survey</title>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
	</head>
	<body>
<?php


if (isset($_POST['sv_b_add']) && ($_POST['sv_b_add'] == "Start Survey")){
	$_SESSION['mode'] = "Add";
	$_SESSION['add_part'] = 0;
} 

if(($_SESSION['mode'] == "Add") && ($_SERVER['REQUEST_METHOD'] == "GET")){ 
	switch ($_SESSION['add_part']) {
		case 0:
		case 1:
			$err_msgs=array("","","");
			formBasicInfo($err_msgs);
			break;
		case 2:			
			$err_msgs=array("","");
			formYourPurchases($err_msgs);
			break;
		case 3:
			$err_msgs=array("","");
			formSatisAndRecom($err_msgs);
			break;
		default:
	}
} else if($_SESSION['mode'] == "Add"){ 
	switch ($_SESSION['add_part']) {
		case 0:
			echo "<h1> Basic Information </h1>\n";
			$_SESSION['add_part'] = 1;
			$err_msgs=array("","","");
			formBasicInfo($err_msgs);
			break;
		case 1:
			
			$err_msgs = validateBasicInfo();
			if (count($err_msgs) > 0){
				basicInfoPostToSession();
				echo "<h1> Basic Information </h1>\n";
				displayErrors($err_msgs);
				formBasicInfo($err_msgs);
			} else if ((isset($_POST['sv_b_next1']))
				&& ($_POST['sv_b_next1'] == "Next")){
				echo "<h1> Survey about your purchases </h1>\n";
				basicInfoPostToSession();
				$_SESSION['add_part'] = 2;
				$err_msgs=array("","");
				formYourPurchases($err_msgs);
			}else{
				basicInfoPostToSession();
				echo "<h1> Basic Information </h1>\n";
				$err_msgs=array("","","");
				$_SESSION['add_part'] = 1;
				formBasicInfo($err_msgs);
			}

			break;
		case 2:
		
			$err_msgs = validateYourPurchases();
			
			if (count($err_msgs) > 0){
				yourPurchasesPostToSession();
				echo "<h1> Survey about your purchases </h1>\n";
				displayErrors($err_msgs);
				formYourPurchases($err_msgs);
			} else if ((isset($_POST['sv_b_next2']))
					&& ($_POST['sv_b_next2'] == "Next")){
				echo "<h1> Survey of Satisfaction </h1>\n";
				yourPurchasesPostToSession();
				$_SESSION['add_part'] = 3;
				$err_msgs=array("","");
				formSatisAndRecom($err_msgs);
			} else if ((isset($_POST['sv_b_back2']))
						&& ($_POST['sv_b_back2'] == "Previous")){
				echo "<h1> Basic Information </h1>\n";
				yourPurchasesPostToSession();
				$_SESSION['add_part'] = 1;
				$err_msgs=array("","","");
				formBasicInfo($err_msgs);
			}else{
				echo "<h1> Survey about your purchases </h1>\n";
				yourPurchasesPostToSession();
				$_SESSION['add_part'] = 2;
				$err_msgs=array("","");
				formYourPurchases($err_msgs);
			}
			break;
		case 3:
			$err_msgs = validateSatisAndRecom();
			if (count($err_msgs) > 0){
				satisAndRecomPostToSession();
				echo "<h1> Survey of Satisfaction </h1>\n";
				displayErrors($err_msgs);
				formSatisAndRecom($err_msgs);
			}else if ((isset($_POST['sv_b_next3']))
					&& ($_POST['sv_b_next3'] == "Next")){
				echo "<h1> Summary of Survey </h1>\n";
				satisAndRecomPostToSession();
				$_SESSION['add_part'] = 4;
				formSurveySave();
			} else if ((isset($_POST['sv_b_back3']))
						&& ($_POST['sv_b_back3'] == "Previous")){
				echo "<h1> Survey about your purchases </h1>\n";
				satisAndRecomPostToSession();
				$_SESSION['add_part'] = 2;
				$err_msgs=array("","");
				formYourPurchases($err_msgs);
			}else{
				satisAndRecomPostToSession();
				echo "<h1> Survey of Satisfaction </h1>\n";
				$err_msgs=array("","");
				$_SESSION['add_part'] = 3;
				formSatisAndRecom($err_msgs);
			}
			break;
		case 4:
			if ((isset($_POST['sv_b_next4']))
					&& ($_POST['sv_b_next4'] == "Save")){
				$db_conn = connectDB();
				saveSurvey($db_conn);
				$db_conn = NULL;
				$_SESSION['add_part'] = 0;
				clearSurveyFromSession();
				$_SESSION['mode'] = "Display";
				formThankDisplay();
			} else if ((isset($_POST['sv_b_back4']))
						&& ($_POST['sv_b_back4'] == "Previous")){
				echo "<h1> Survey of satisfaction </h1>\n";
				$_SESSION['add_part'] = 3;
				$err_msgs=array("","");
				formSatisAndRecom($err_msgs);
			}else{
				echo "<h1> Summary of Survey </h1>\n";
				$_SESSION['add_part'] = 4;
				formSurveySave();
			}
			break;
		default:
	}
}else if($_SESSION['mode'] == "Display"){ 
	formSurveyDisplay();
}  
?>
	</body>
</html>

<?php
function formSurveyDisplay(){
	$db_conn = connectDB();
?>
		<h1> Welcome to Survey </h1>
		<h3 style="font-style:italic;"> Welcome to our survey. Our survey purposes that your ..</h3>
		<fieldset style="text-align: center;">
			<legend>How to take the survey</legend>
			<div style="margin-top:20px;text-align: left;">
			You must..
			</div>
			<img src="./images/logo.png">
		</fieldset>
		<form method="POST">
			<table>
			<tr>
				<td><input type="submit" class="btn" name ="sv_b_add" value="Start Survey"></td>
			</tr>
			</table>
		</form>
		</div>
<?php } ?>
