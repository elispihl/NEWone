<?php


 //require another php file
 require_once("../config.php");
 
 
 $everything_was_okay= true;

	//*********************
	// TO field validation
	//*********************
	if(isset($_GET["to"])){ //if there is ?to= in the URL
		if(empty($_GET["to"])){ //if it is empty
		    $everything_was_okay= false;
			echo "Please enter the recipient! <br>"; // yes it is empty
		}else{
			echo "To: ".$_GET["to"]."<br>"; //no it is not empty
		}
	}

	//check if there is variable in the URL
	if(isset($_GET["message"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		//if its empty
		if(empty($_GET["message"])){
			 $everything_was_okay= false;
			//it is empty
			
			echo "Please enter the message! <br>";
		}else{
			//its not empty
			echo "Message: ".$_GET["message"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as message";
	$everything_was_okay= false;
	}
	
	
	
	//Getting the message from address
	// if there is ?name= .. then $_GET["name"]
	//$my_message = $_GET["message"];
	//$to = $_GET["to"];
	
	
	//echo "My message is ".$my_message." and is to ".$to;
	
	
	// ? was everything okay
	
	if($everything_was_okay == true){
	
		echo "Saving to database .... ";
		
		// connection with username and password
		// access username from confiq
		//echo $db_username;
		// 1 localhost
		// 2 username
		// 3 password
		// 4 database
		
		$mysql = new mysqli ("localhost",$db_username,$db_password, "webpr2016_elispihl");
		
		$stmt = $mysql ->prepare("INSERT INTO messages_example(recipient, message)VALUES (?,?)");	
		
		// we are replacing question marks with values
		//s - string, date or smth that is based on characters and
		//i - integer, number
		//d - decimal, float
		
		// for each question mark its type with one letter
		
		$stmt->bind_param("ss" , $_GET["recipient"], $_GET["message"]);
		
		//save
	
		if($stmt->execute());
			echo "saved successfully";
		}else{
			echo $stmt->error;
		
		}

?>

<h2> First application </h2>

<form method="get">
	<label for="to">to:* <label>
	<input type="text" name="to"><br><br>
	
	<label for="message">Message:* <label>
	<input type="text" name="message"><br><br>
	
	<!-- This is the save button-->
	<input type="submit" value="Save to DB">

<form>

<p>Idea</p>
