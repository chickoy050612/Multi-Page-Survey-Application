
<?php 

function formYourPurchases($err_msgs){
	$howPurchased = "";
	$purchases = array();

	if (isset($_SESSION['purchases'])) {
		$purchases = $_SESSION['purchases'];
	} else if (isset($_POST['purchases'])){
		$purchases = $_POST['purchases'];
	}
	
	if (isset($_SESSION['howPurchased'])){
		$howPurchased = $_SESSION['howPurchased'];
	} else if (isset($_POST['howPurchased'])){
		$howPurchased = $_POST['howPurchased'];
	}
	 
?>


<form method="POST" >
	<h2>Requirements</h2>
	<ul>
		<li>Q1 is required, and one of options must be selected.</li>
		<li>Q2 is required, and at least one option must be selected.</li>
	</ul>

	<fieldset>
	<legend>Survey (2/3)</legend>
	<h3>Q1) How did you complete your purchase?</h3>
	<table>
	<tr>
		<?php if($howPurchased=="Online"){?>
			<td><input type="radio" name="howPurchased" id="Online" value="Online" checked><label for="Online">Online</label></td>
		<?php }else{?>
			<td><input type="radio" name="howPurchased" id="Online" value="Online"><label for="Online">Online</label></td>
		<?php } ?>

		<?php if($howPurchased=="By phone"){?>
			<td><input type="radio" name="howPurchased" id="phone" value="By phone" checked><label for="phone">By phone</label></td>
		<?php }else{?>
			<td><input type="radio" name="howPurchased" id="phone" value="By phone" ><label for="phone">By phone</label></td>
		<?php } ?>

		<?php if($howPurchased=="Mobile App"){?>
			<td><input type="radio" name="howPurchased" id="App" value="Mobile App" checked><label for="App">Mobile App</label></td>
		<?php }else{?>
			<td><input type="radio" name="howPurchased" id="App" value="Mobile App"><label for="App">Mobile App</label></td>
		<?php } ?>

		<?php if($howPurchased=="In store"){?>
			<td><input type="radio" name="howPurchased" id="store" value="In store" checked><label for="store">In store</label></td>
		<?php }else{?>
			<td><input type="radio" name="howPurchased" id="store" value="In store"><label for="store">In store</label></td>
		<?php } ?>

		<?php if($howPurchased=="By mail"){?>
			<td><input type="radio" name="howPurchased" id="mail" value="By mail" checked><label for="mail">By mail</label></td>	
		<?php }else{?>
			<td><input type="radio" name="howPurchased" id="mail" value="By mail" ><label for="mail">By mail</label></td>	
		<?php } ?>
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
	<h3>Q2) Which of the following did you purchase?</h3>
	<table>
		<tr>
		<?php if(in_array("Home Phone", $purchases)){?>
		<td><input type="checkbox" name="purchases[]" id="homePhone" value="Home Phone" checked><label for="homePhone">Home Phone</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="homePhone" value="Home Phone" ><label for="homePhone">Home Phone</label></td>
		<?php } ?>
		</tr>
		<tr>
		<?php if(in_array("Mobile Phone", $purchases)){?>
			<td><input type="checkbox" name="purchases[]" id="mobilePhone" value="Mobile Phone" checked><label for="mobilePhone">Mobile Phone</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="mobilePhone" value="Mobile Phone"><label for="mobilePhone">Mobile Phone</label></td>
		<?php } ?>
		</tr>		
		<?php if(in_array("Smart TV", $purchases)){?>
			<td><input type="checkbox" name="purchases[]" id="smartTV" value="Smart TV" checked><label for="smartTV">Smart TV</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="smartTV" value="Smart TV" ><label for="smartTV">Smart TV</label></td>
		<?php } ?>
		</tr>
		<tr>
		<?php if(in_array("Laptop", $purchases)){?>
			<td><input type="checkbox" name="purchases[]" id="Laptop" value="Laptop" checked><label for="Laptop">Laptop</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="Laptop" value="Laptop" ><label for="Laptop">Laptop</label></td>
		<?php } ?>
		</tr>
		<tr>
		<?php if(in_array("Desktop Computer", $purchases)){?>
			<td><input type="checkbox" name="purchases[]" id="desktopComputer" value="Desktop Computer" checked><label for="desktopComputer">Desktop Computer</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="desktopComputer" value="Desktop Computer" ><label for="desktopComputer">Desktop Computer</label></td>
		<?php } ?>
		</tr>
		<tr>	
		<?php if(in_array("Tablet", $purchases)){?>
			<td><input type="checkbox" name="purchases[]" id="tablet" value="Tablet" checked><label for="tablet">Tablet</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="tablet" value="Tablet"><label for="tablet" >Tablet</label></td>
		<?php } ?>
		</tr>
		<tr>
		<?php if(in_array("Home Theater", $purchases)){?>
			<td><input type="checkbox" name="purchases[]" id="homeTheater" value="Home Theater" checked><label for="homeTheater">Home Theater</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="homeTheater" value="Home Theater" ><label for="homeTheater">Home Theater</label></td>
		<?php } ?>
		</tr>
		<tr>
		<?php if(in_array("MP3 player", $purchases)){?>
			<td><input type="checkbox" name="purchases[]" id="player" value="MP3 player" checked><label for="player">MP3 player</label></td>
		<?php }else{ ?>
			<td><input type="checkbox" name="purchases[]" id="player" value="MP3 player" ><label for="player">MP3 player</label></td>
		<?php } ?>
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
	</fieldset>

	<table>
		<tr><td><input type="submit" class="btn" name="sv_b_back2" value="Previous"></td>
		    <td><input type="submit" class="btn" name="sv_b_next2" value="Next"></td>
		</tr>
	</table>
<?php
}
?>

<?php

function validateYourPurchases(){
	$err_msgs = array();

	if(isset($_POST['sv_b_next2']) || isset($_POST['sv_b_back2'])){
		if (!isset($_POST['howPurchased'])){
			$err_msgs[0] = "One must be selected";
		}else{
			$howPurchased=$_POST['howPurchased'];
		}

		if (!isset($_POST['purchases'])){
			$err_msgs[1] = "At least one option must be selected";
		}else {
			if (count($_POST['purchases']) <1){
				$err_msgs[1] = "At least one option must be selected";
			}
			else{
				$purchases= $_POST['purchases'];
			}
		}

		if (count($err_msgs) == 0){
			$_POST['purchases'] = $purchases;
			$_POST['howPurchased'] = $howPurchased;
		}
	}

	return $err_msgs;
}
?>

<?php
function yourPurchasesPostToSession(){
	if(isset($_POST['howPurchased'])){
		$_SESSION['howPurchased'] = $_POST['howPurchased'];
	}
	if(isset($_POST['purchases'])){
		$_SESSION['purchases'] = $_POST['purchases'];
	}

}
?>
