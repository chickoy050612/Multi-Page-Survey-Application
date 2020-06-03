<?php 

function formSatisAndRecom($err_msgs){
	$satisfaction = array();
	$recommend = array();

	if (isset($_SESSION['recommend'])) {
		$recommend = $_SESSION['recommend'];
	} else if (isset($_POST['recommend'])){
		$recommend = $_POST['recommend'];
	}

	if (isset($_SESSION['satisfaction'])) {
		$satisfaction = $_SESSION['satisfaction'];
	} else if (isset($_POST['satisfaction'])){
		$satisfaction = $_POST['satisfaction'];
	}
	 
?>
<form method="POST" >
	<h2>Requirements</h2>
	<ul>
		<li>Q1 (including subqueries) is required, and one of options in every subquery must be selected.</li>
		<li>Q2 (including subqueries) is required, and a valid recommend type in every subquery must be chosen.</li>
	</ul>

	<fieldset>
	<legend>Survey (3/3)</legend>
	<h3>(Q1) How happy are you with each device  on a scale from 1 (not satisfied) to 5 (very satisfied)?</h3>
	<?php foreach($_SESSION['purchases'] as $key => $value){?>
		<table >
		<tr>
		<td>Q1-<?php echo $key+1?>)</td>
		<td style="width: 150px;"><?php echo $value?> : </td>
		<?php if(!empty($satisfaction[$value]) && $satisfaction[$value]=="1"){?>
			<td ><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>1" value="1" checked><label for="<?php echo $value?>1">1 (not satisfied) </label></td>
		<?php }else{?>
			<td ><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>1" value="1"><label for="<?php echo $value?>1">1 (not satisfied)  </label></td>
		<?php } ?>

		<?php if(!empty($satisfaction[$value]) && $satisfaction[$value]=="2"){?>
			<td style="width: 40px;"><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>2" value="2" checked><label for="<?php echo $value?>2">2  </label></td>
		<?php }else{?>
			<td style="width: 40px;"><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>2" value="2" ><label for="<?php echo $value?>2">2  </label></td>
		<?php } ?>

		<?php if(!empty($satisfaction[$value]) && $satisfaction[$value]=="3"){?>
			<td style="width: 40px;"><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>3" value="3" checked><label for="<?php echo $value?>3">3  </label></td>
		<?php }else{?>
			<td style="width: 40px;"><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>3" value="3"><label for="<?php echo $value?>3">3  </label></td>
		<?php } ?>

		<?php if(!empty($satisfaction[$value]) && $satisfaction[$value]=="4"){?>
			<td style="width: 40px;"><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>4" value="4" checked><label for="<?php echo $value?>4">4  </label></td>
		<?php }else{?>
			<td style="width: 40px;"><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>4" value="4"><label for="<?php echo $value?>4">4  </label></td>
		<?php } ?>

		<?php if(!empty($satisfaction[$value]) && $satisfaction[$value]=="5"){?>
			<td ><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>5" value="5" checked><label for="<?php echo $value?>5">5 (very satisfied) </label></td>	
		<?php }else{?>
			<td ><input type="radio" name="satisfaction[<?php echo $value?>]" id="<?php echo $value?>5" value="5" ><label for="<?php echo $value?>5">5 (very satisfied)</label></td>	
		<?php } ?>
		</tr>
	</table>
	<div class="warning">
		<?php

		if(isset($_POST['recommend']) && empty($_POST['satisfaction'][$value])){
			echo "Wanning! ".$err_msgs[0];
		}

		?>
	</div>
	<?php } ?>
	
	<h3>(Q2) Would you recommend the purchase of each device to a friend?</h3>
	<?php foreach($_SESSION['purchases'] as $key => $value){?>
	<table>
		<tr>
		<td>Q2-<?php echo $key+1?>)</td>
		<td style="width: 150px;"><?php echo $value?> : </td>

		<td><select id="<?php echo $value?>" class="seltyle" name="recommend[<?php echo $value?>]" size="1">
		<?php if(!empty($recommend[$value]) && $recommend[$value]=="Choice"){?>
						<option selected="selected" value="Choice">Select type</option>
		<?php } else { ?>
						<option value="Choice">Select type</option>
		<?php }
			if(!empty($recommend[$value]) && $recommend[$value]=="Yes"){ ?>
						<option selected="selected" value="Yes">Yes</option>
		<?php } else { ?>
						<option value="Yes">Yes</option>
		<?php }
			if(!empty($recommend[$value]) && $recommend[$value]=="Maybe"){?>
						<option selected="selected" value="Maybe">Maybe</option>
		<?php } else { ?>
						<option value="Maybe">Maybe</option>
		<?php }
			if(!empty($recommend[$value]) && $recommend[$value]=="No"){?>
						<option selected="selected" value="No">No</option>
		<?php } else { ?>
						<option value="No">No</option>
		<?php } ?>
			</select></td>
		</tr>
	</table>

	<div class="warning">
		<?php 
		if(!empty($recommend[$value]) && $recommend[$value]=="Choice" && isset($_POST['recommend'])){
			echo "Wanning! ".$err_msgs[1];
		}
		?>
	</div>
	<?php } ?>
	</fieldset>
	
	<table>
		<tr><td><input type="submit" class="btn" name="sv_b_back3" value="Previous"></td>
		    <td><input type="submit" class="btn" name="sv_b_next3" value="Next"></td>
		</tr>
	</table>
<?php
}
?>

<?php

function validateSatisAndRecom(){
	$err_msgs=array();

	if (isset($_POST['sv_b_next3']) || isset($_POST['sv_b_back3'])){
		if (!isset($_POST['satisfaction'])){
			$err_msgs[0] = "One option must be selected";
		}else if(count($_POST['satisfaction'])!=count($_SESSION['purchases'])){
			$err_msgs[0] = "One option must be selected";
		}else{
			$satisfaction=$_POST['satisfaction'];
		}

		if (!isset($_POST['recommend'])){
			$err_msgs[1] = "No recommend type specified";
		} else {
			$recommend = $_POST['recommend'];
			foreach($recommend as $value){
				if($value=="Choice"){
					$err_msgs[1] = "A valid recommend type must be chosen";
					break;
				}
			}
		}

		if (count($err_msgs) == 0){
			$_POST['recommend'] = $recommend;
			$_POST['satisfaction'] = $satisfaction;
		}
	}
	return $err_msgs;
}
?>

<?php
function satisAndRecomPostToSession(){
	if(isset($_POST['satisfaction'])){
		$_SESSION['satisfaction'] = $_POST['satisfaction'];
	}
	if(isset($_POST['recommend'])){
		$_SESSION['recommend'] = $_POST['recommend'];
	}
}
?>
