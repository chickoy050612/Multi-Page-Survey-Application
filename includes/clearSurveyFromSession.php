<?php
function clearSurveyFromSession(){
	if (isset($_SESSION['student'])){
		unset($_SESSION['student']);
	}
	if (isset($_SESSION['fullName'])){
        unset($_SESSION['fullName']);
	}
	
	if (isset($_SESSION['age'])){
        unset($_SESSION['age']);
	}
	if (isset($_SESSION['howPurchased'])){
        unset($_SESSION['howPurchased']);
	}
	if (isset($_SESSION['purchases'])){
        unset($_SESSION['purchases']);
	}
	if (isset($_SESSION['satisfaction'])){
        unset($_SESSION['satisfaction']);
	}
	if (isset($_SESSION['recommend'])){
        unset($_SESSION['recommend']);
	}
}
?>
