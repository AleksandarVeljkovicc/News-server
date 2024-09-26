<?php

if(isset($_POST['login'])){
			$name=trim($_POST["first_name"]);
			$lastname=trim($_POST["last_name"]);
			$password=trim($_POST["password"]);
			$cPassword=trim($_POST["cPassword"]);
			$email=trim($_POST["email"]);
			$username=trim($_POST["username"]);			
			$city=trim($_POST["city"]);

			$errors=array();
			

			$date_of_birth="";
			if(isset($_POST["date_of_birth"]))		//date of birth
			{
				$date_of_birth=$_POST["date_of_birth"];
				$date_of_birth=filter_var($date_of_birth,FILTER_SANITIZE_STRING);
			}
			else
			{
				$date_of_birth=NULL;
			}



			if(empty($name)){				//name
			$errors['first_name']="You did not enter a name.";				
				}
				else if (strlen($name) < 3){
					$errors['first_name']="Name must be at least 3 characters long.";
				}
				else if (!ctype_alpha($name)){
					$errors['first_name']= "You can only enter text.";
				}
				


				if(empty($password)){						//pw
					$errors['password']="You did not enter a password.";	
				}
				else if(strlen($password)<5){
					$errors['password']="Password must be at least 5 characters long.";
				}
				else if(!validString($password)){
					$errors['password']="Password field contain forbidden characters.";																												// AND validString($cPassword) AND ($password==$cPassword))
				}



				if($cPassword!=$password){          //confirm pw
					$errors['cPassword']="Wrong reentered password.";	
				}
				else if(!validString($cPassword)){
					$errors['cPassword']="Confirmation password field contain forbidden characters.";																												// AND validString($cPassword) AND ($password==$cPassword))
				}


				$emailArray=array();
				$userArray=array();

				$query="SELECT * FROM user";
				$result=$db->query($query);
				if($db->num_rows($result)>0)
				{
					while($row=$db->fetch_assoc($result))
					{
						array_push($emailArray,$row['email'] );
						array_push($userArray,$row['username'] );

					}
				}

				if(empty($username)){			//username
				$errors['username']="You did not enter a username.";				
				}
				else if (strlen($username) < 5){
				$errors['username']="Username must be at least 5 characters long.";
				}
				else if(!validString($username)){
					$errors['username']="Username field contain forbidden characters.";																												// AND validString($cPassword) AND ($password==$cPassword))
				}
				else if(in_array($username, $userArray)){
					$errors['username']="Username already exist.";
					}

				
				if(empty($email))			//email
				{
					$errors['email']="You did not enter a email.";				
				}
				else if(in_array($email, $emailArray)){
					$errors['email']="Email already exist.";
					}
				else if(!$email=filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$errors['email']="You did not enter a valid email.";
				}
				

				if(isset($_POST['country']))                //country
				{
					$country=filter_var($_POST['country'],FILTER_SANITIZE_STRING);  								
				}
				else
				{
					$errors['country']="You did not choose a country.";
				}

				if($city != NULL)					//city
				{
					if(strlen($city)<3){
						$errors['city']="City must contain at least 3 characters."; 
					}
					if (!ctype_alpha($city)){
					$errors['city']= "You can only enter text.";
					}
				}
				

					if($_FILES['upload']['error'] === UPLOAD_ERR_OK)
					{
						
					
						if($_FILES['upload']['type']!="image/jpeg" AND $_FILES['upload']['type']!="image/png")		//image
						{
							$errors['upload']="Invalid image extension.";
						}
						
					}


				if(empty($lastname)){				//lastname
				$errors['last_name']="You did not enter a last name.";				
				}
				else if (strlen($lastname) < 5){
					$errors['last_name']="Last name must be at least 5 characters long.";
				}
				else if (!ctype_alpha($lastname)){
					$errors['last_name']= "You can only enter text.";
				}
			
				if(empty($errors))
				{						


					if($_FILES['upload']['tmp_name']!=NULL)
					{
						$image=$db->escape_string(file_get_contents($_FILES['upload']['tmp_name'])); //file_get_contents-hvata sliku u stringu. mysqli_real_escape_string() function is used to escape characters in a string, making it legal to use in an SQL statement.

						$picName=microtime(true)."_".$_FILES['upload']['name'];
						$uploads_dir = __DIR__."/../../images/users/";
						move_uploaded_file($_FILES['upload']['tmp_name'],$uploads_dir.$picName);	//parm1-fajl[tmp_name],param2-destinacija+naziv fajla.						
					}
					else
					{
						$image=NULL;
					}
					
						
					
						
					if($image!=null AND $date_of_birth!=NULL)
					{
						$query = "INSERT INTO user (name, last_name, username, email, image, password, country, city, date_of_birth) VALUES ('{$name}', '{$lastname}', '{$username}', '{$email}', '{$image}', '{$password}', '{$country}', '{$city}', '{$date_of_birth}')";
						$db->query($query);
						if($db->error())
						{
							echo Message::error("Error". "<br>".$db->error())."<br>";
						}
						else
						{
							header("Location: singupconfirm.php");
							Log::write("logs/".date("Y-m-d")."_singup.log", "Account successfully created - '{$name} {$lastname}'.");
						}
					}
					else if($date_of_birth==NULL AND $image==NULL)
					{
						$query = "INSERT INTO user (name, last_name, username, email, password, country, city) VALUES ('{$name}', '{$lastname}', '{$username}', '{$email}', '{$password}', '{$country}', '{$city}')";
						$db->query($query);
						if($db->error())
						{
							echo Message::error("Error". "<br>".$db->error())."<br>";
						}
						else
						{
							header("Location: singupconfirm.php");
							Log::write("logs/".date("Y-m-d")."_singup.log", "Account successfully created - '{$name} {$lastname}'.");
						}
					}
					else if($image==NULL AND $date_of_birth!=NULL)
					{
						$query = "INSERT INTO user (name, last_name, username, email, password, country, city, date_of_birth) VALUES ('{$name}', '{$lastname}', '{$username}', '{$email}', '{$password}', '{$country}', '{$city}', '{$date_of_birth}')";
						$db->query($query);
						if($db->error())
						{
							echo Message::error("Error". "<br>".$db->error())."<br>";
						}
						else
						{
							header("Location: singupconfirm.php");
							Log::write("logs/".date("Y-m-d")."_singup.log", "Account successfully created - '{$name} {$lastname}'.");
						}
					}
					else if($image!=NULL AND $date_of_birth==NULL)
					{
						$query = "INSERT INTO user (name, last_name, username, email, image, password, country, city) VALUES ('{$name}', '{$lastname}', '{$username}', '{$email}', '{$image}', '{$password}', '{$country}', '{$city}')";
						$db->query($query);
						if($db->error())
						{
							echo Message::error("Error". "<br>".$db->error())."<br>";
						}
						else
						{
							header("Location: singupconfirm.php");
							Log::write("logs/".date("Y-m-d")."_singup.log", "Account successfully created - '{$name} {$lastname}'.");
						}
					}
				}
		}
?>