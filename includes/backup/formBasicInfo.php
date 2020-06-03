<?php 

function formBasicInfo($err_msgs){
	$t = "";
	$fname = "";
	$age = "";
	if (isset($_SESSION['student'])) {
		$t = $_SESSION['student'];
	} else if (isset($_POST['student'])){
		$t1 = $_POST['student'];
		if (($t1 == "Full Time") || ($t1 == "Part Time") 
			|| ($t1 == "No")) {
			$t = $_POST['student'];
		}
	}

	if (isset($_SESSION['fullName'])){
		$fname = $_SESSION['fullName'];
	} else if (isset($_POST['fullName'])){
		$fname = $_POST['fullName'];
	}

	if (isset($_SESSION['age'])){
		$age = $_SESSION['age'];
	} else if (isset($_POST['age'])){
		$age = $_POST['age'];
	}
	 
?>
<form method="POST" >
	<h2>Requirements</h2>
	<ul>
		<li>Your full Name is required</li>
		<li>Your age is required</li>
		<li>Your student type is required</li>
	</ul>

	<h3>Q1) Please, enter your full name.</h3>
	<table>
	<tr><td><label for="fullName">Full Name: </label></td>
		<td><input type="text" class="text" name="fullName" id="fullName" size="30" maxlength="30" value="<?php echo $fname; ?>"></td>
	</tr>
	</table>
	<div class="warning">
		<?php 
		if(empty($err_msgs[0])){
			echo "";
		}else{
			echo "Wanning! ".$err_msgs[0]; 
		}
		?>
	</div>
	<h3>Q2) Please, enter your age.</h3>
	<table>
	<tr><td><label for="age">Your Age: </label></td>
		<td><input type="text" class="text" name="age" id="age" size="3" maxlength="3" value="<?php echo $age; ?>"></td>
	</tr>
	</table>
	<div class="warning">
		<?php 
		if(empty($err_msgs[1])){
			echo "";
		}else{
			echo "Wanning! ".$err_msgs[1]; 
		}
		?>
	</div>
	<h3>Q3) Are you a student?</h3>
	<table>
		<tr><td><label for="student">Student Type:</label></td>
			<td><select id="student" class="seltyle" name="student" size="1">
<?php if((strlen($t) ==0) ){ ?>
				<option selected="selected" value="Choice">Select type</option>
<?php } else { ?>
				<option value="Choice">Select type</option>
<?php }
	  if ($t == "Full Time"){ ?>
				<option selected="selected" value="Full Time">Yes, Full Time</option>
<?php } else { ?>
				<option value="Full Time">Yes, Full Time</option>
<?php }
	  if ($t == "Part Time"){ ?>
				<option selected="selected" value="Part Time">Yes, Part Time</option>
<?php } else { ?>
				<option value="Part Time">Yes, Part Time</option>
<?php }
	  if ($t == "No"){ ?>
				<option selected="selected" value="No">No</option>
<?php } else { ?>
				<option value="No">No</option>
<?php } ?>
			</select></td>
		</tr>
	</table>

	<div class="warning">
		<?php 
		if(empty($err_msgs[2])){
			echo "";
		}else{
			echo "Wanning! ".$err_msgs[2]; 
		}
		?>
	</div>
	<br>
	<table>
		<tr><td><input type="submit" class="btn" disabled="disabled" name="sv_b_back" value="Previous"></td>
		    <td><input type="submit" class="btn" name="sv_b_next" value="Next"></td>
		</tr>
	</table>
<?php
}
?>

<?php

function validateBasicInfo(){
	$err_msgs = array();

	if (!isset($_POST['fullName'])){
		$err_msgs[0] = "Your full name must be specified";
	}else {
		$fname = trim($_POST['fullName']);
		if (strlen($fname) == 0){
			$err_msgs[0] = "Your full name must be specified";
		} else if (strlen($fname) > 30) {
			$err_msgs[0] = "The full name must be no longer than 30 characters in length";
		}
	}

	if (!isset($_POST['age'])){
		$err_msgs[1] = "Your age must be specified";
	}else {
		$age = trim($_POST['age']);
		if (strlen($age) == 0){
			$err_msgs[1] = "Your age must be specified";
		} else if (!is_numeric($age)) {
			$err_msgs[1] = "The age must be numeric";
		} else if ((int) $age<1){
			$err_msgs[1] = "The age must be greater than 0";
		}
	}

	if (!isset($_POST['student'])){
		$err_msgs[2] = "No student type specified";
	} else {
		$student = trim($_POST['student']);
		if (!(($student == "Full Time") 
			  || ($student == "Part Time")
			  || ($student == "No"))){
			$err_msgs[2] = "A valid student type must be chosen";
		}
	}

	if (count($err_msgs) == 0){
		$_POST['student'] = $student;
		$_POST['fullName'] = $fname;
		$_POST['age'] = $age;
	}
	return $err_msgs;
}
?>

<?php
function basicInfoPostToSession(){
	$_SESSION['fullName'] = $_POST['fullName'];
	$_SESSION['student'] = $_POST['student'];
	$_SESSION['age'] = $_POST['age'];
}
?>
