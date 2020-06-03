<?php
function formSurveySave(){
?>
	<form method="POST" >
	<table border=1 cellpadding="5">
	<tr><td colspan="2" style="font-weight:bold;font-size:20px;">Summary of Basic Information</td></tr>
	<tr><td>Full Name<td><?php echo $_SESSION['fullName']; ?></td></tr>
	<tr><td>Age<td><?php echo $_SESSION['age']; ?></td></tr>
	<tr><td>Student?</td><td><?php echo $_SESSION['student']; ?></td></tr>
	<tr><td colspan="2" style="font-weight:bold;font-size:20px;">Summary of Your Purchases</td></tr>
	<tr><td>How purchased?</td><td><?php echo $_SESSION['howPurchased']; ?></td></tr>
	<tr><td>Your purchases</td>
	<td>
	<?php 
		foreach($_SESSION['purchases'] as $value){
			echo "$value<br>"; 
		}	
	?>
	</td></tr>
	<tr><td colspan="2" style="font-weight:bold;font-size:20px;">Summary of Your Review</td></tr>
	<tr><td>Satisfaction</td>
	<td>
	<?php 
		foreach($_SESSION['satisfaction'] as $key=>$value){
			echo "$key : $value<br>"; 
		}	
	?>
	</td></tr>
	<tr><td>Recommend</td>
	<td>
	<?php 
		foreach($_SESSION['recommend'] as $key=>$value){
			echo "$key : $value<br>"; 
		}	
	?>
	</td></tr>
	</table>
	<br>
    <table>
    <tr>
        <td><input type="submit" class="btn" name="sv_b_back4" value="Previous"></td>
        <td><input type="submit" class="btn" name="sv_b_next4" value="Save"></td>
    </tr>
    </table>
	</form>
<?php
}
?>

<?php
function saveSurvey($db_conn){

	$qry_sv = "insert into participants set part_fullname= ?, part_age= ?, part_student= ?";
	$student="";
	if($_SESSION['student']=="Full Time"){
		$student="Y";
	}else if($_SESSION['student']=="Part Time"){
		$student="P";
	}else if($_SESSION['student']=="No"){
		$student="N";
	}

	if (isset($_SESSION['fullName'])){
		$field_data = array($_SESSION['fullName'],$_SESSION['age'],$student);
	}

	$stmt = $db_conn->prepare($qry_sv);
	if (!$stmt){
		echo "<p>Error in paticipants prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
		exit(1);
	}
	$status = $stmt->execute($field_data);
	if (!$status){
		echo "<p>Error in paticipants execute: ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
		exit(1);
	}
	$id = $db_conn->lastInsertId();
	unset($field_data);
	
	if (isset($_SESSION['purchases'])){
		$purchases=$_SESSION['purchases'];
		$howPurchased=$_SESSION['howPurchased'];
		$satisfaction=$_SESSION['satisfaction'];
		$recommend=$_SESSION['recommend'];

		$qry_re = "insert into responses set resp_part_id= ?, resp_product= ?, resp_how_purchased= ?, resp_satisfied=?,resp_recommend=?";
		
		foreach($purchases as $value){
			$field_data = array($id,$value,$howPurchased,$satisfaction[$value],$recommend[$value]);
			$stmt = $db_conn->prepare($qry_re);
			if (!$stmt){
				echo "<p>Error in responses prepare: ".$dbc->errorCode()."</p>\n<p>Message ".implode($dbc->errorInfo())."</p>\n";
				exit(1);
			}
			$status = $stmt->execute($field_data);
			if (!$status){
				echo "<p>Error in responses execute ".$stmt->errorCode()."</p>\n<p>Message ".implode($stmt->errorInfo())."</p>\n";
				exit(1);
			}
		}
	}
	unset($field_data);
}
?>
