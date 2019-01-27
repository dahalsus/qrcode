<?php
require_once 'config.php';

    if($_POST['act'] == 'rate'){
    	$ip = $_SERVER["REMOTE_ADDR"];
    	$therate = $_POST['rate'];
    	$thepost = $_POST['post_id'];

    	$query = mysqli_query($con,"SELECT * FROM ratings where ip= '$ip'  "); 
    	while($data = mysqli_fetch_assoc($query)){
    		$rate_db[] = $data;
    	}

    	if(@count($rate_db) == 0 ){
    		mysqli_query($con,"INSERT INTO ratings (item_id, ip, rate)VALUES('$thepost', '$ip', '$therate')");
    	}else{
    		mysqli_query($con,"UPDATE ratings SET rate= '$therate' WHERE ip = '$ip'");
    	}
    } 
?>