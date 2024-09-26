<?php
if(isset($_POST['username']) && isset($_POST['password']))
			{
				$username=trim($_POST['username']);
				$password=trim($_POST['password']);
				if($username!="" && $password!="")
				{
					if(validString($username) && validString($password))
					{
						$query="SELECT * FROM userview WHERE username='{$username}'";
						$result=$db->query($query);
						if($db->num_rows($result)==1)
						{
							$row=$db->fetch_object($result);
							if($row->password==$password)
							{
								if($row->active==1)   //kreiranje sesija i kolacica.
								{
									$_SESSION['id']=$row->user_id;
									$_SESSION['info']=$row->name . " " . $row->last_name;
									$_SESSION['status']=$row->status;
									$_SESSION['username']=$row->username;

									Log::write("logs/".date("Y-m-d")."_login.log", "login successful for user '{$_SESSION['info']}'.");

									if(isset($_POST['cBox']))
									{
										setcookie("id", $_SESSION['id'], time()+(3600*24*30), "/");
										setcookie("info", $_SESSION['info'], time()+(3600*24*30), "/");
										setcookie("status", $_SESSION['status'], time()+(3600*24*30), "/");
										setcookie("username", $_SESSION['username'], time()+(3600*24*30), "/");																		
									}
									header("Location: index.php");
								}
								else
								{
									echo Message::info("Information correct, but the user isn't active!<br>{$row->comment}");
									Log::write("logs/".date("Y-m-d")."_login.log", "Information correct, but the user '{$row->username}' isn't active!");
								}
							}
							else
							{
								echo Message::error("Wrong password for user '{$username}'!" );
								Log::write("logs/".date("Y-m-d")."_login.log", "Wrong password for user '{$username}'.");
							}
						}
						else
						{
							echo Message::error("User with username '{$username}' isn't registered!" );
							Log::write("logs/".date("Y-m-d")."_login.log", "User with username '{$username}' isn't registered." );
						}
					}
					else
					{
						echo Message::error("Fields contain forbidden characters!");
						Log::write("logs/".date("Y-m-d")."_login.log", "Fields contain forbidden characters: {$username} {$password} - {$_SERVER['REMOTE_ADDR']}");
					}
				}
				else
				{
					echo Message::error("Every information is necessary!");
				}
			}
			else
			{
				echo Message::info("Welcome to login page.");
			}
?>